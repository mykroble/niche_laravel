<div class="messages-section col-4 pr-2">
    <div class="search-draft p-3 rounded border">
        <h5 class="fw-bold mb-3">Search Blogs</h5>
        <form id="searchForm" class="message-input border-top mt-2 pt-2 d-flex align-items-center">
            <input type="text" id="searchQuery" class="form-control me-2" placeholder="Search by blog title..." />
            <button type="submit" class="btn btn-warning ">Search</button>
        </form>
        <div id="searchResults" class="mt-3  rounded p-2" style="min-height: 0px; max-height: 270px; overflow-y: auto;">
            
        </div>
        @if(Route::is('homepage'))
    <!-- Live Chat Section -->
    <div class="messages rounded border p-3 mt-3">
        <div class="d-flex justify-content-between">
            <div class="text-warning px-2 py-1 mb-2">
                <strong>Live Chat</strong>
            </div>

            <!-- Channel Dropdown -->
            <select id="channel-dropdown" class="form-select w-auto">
    @foreach ($channels as $channel)
        <option value="{{ $channel->id }}" {{ $selectedChannelId == $channel->id ? 'selected' : '' }}>
            {{ $channel->title }}
        </option>
    @endforeach
</select>

        </div>

        <!-- Messages -->
        <div class="messages-content overflow-auto px-2 py-2" style="max-height: 500px;" id="chat-messages">
            <!-- Messages will be dynamically loaded here -->
            @foreach ($messages as $message)
                <div class="message d-flex align-items-start mb-2">
                    <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                    <div>
                        <span class="fw-bold text-primary">{{ $message->username }}:</span>
                        <span>{{ $message->comment_content }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Message Input -->
        <div class="message-input border-top mt-2 pt-2 d-flex align-items-center">
            <input type="text" class="form-control me-2" id="message-input" placeholder="Type your message..." />
            <button class="btn btn-primary bg-info" id="send-message-btn">Send</button>
        </div>
    </div>
    <!-- end of live chat -->
@endif


    </div>

<script>
document.getElementById('searchForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let query = document.getElementById('searchQuery').value;
    let searchResultsContainer = document.getElementById('searchResults');
    if (query != ""){
        fetch("{{ route('blogs.search') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: JSON.stringify({ query: query })
        })
        .then(response => response.json())
        .then(data => {
            searchResultsContainer.innerHTML = "";

            if (data.blogs.length > 0) {
                data.blogs.forEach(blog => {
                    let blogUrl = "{{ route('viewBlog', ['value' => ':id']) }}".replace(':id', blog.id);
                    searchResultsContainer.innerHTML += `
                        <a href="${blogUrl}" class="text-decoration-none text-light">
                            <div class="blog p-2 border mb-2 rounded">
                                <h6 class="mb-0">${blog.title}</h6>
                                <p class="text-secondary mb-0">By @${blog.username}</p>
                            </div>
                        </a>
                    `;
                });
            } else {
                searchResultsContainer.innerHTML = `<p class="text-light">No results found.</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            searchResultsContainer.innerHTML = `<p class="text-danger">Something went wrong. Please try again.</p>`;
        });
    }
    
});
document.addEventListener('DOMContentLoaded', function () {
    const sendMessageButton = document.getElementById('send-message-btn');
    const channelDropdown = document.getElementById('channel-dropdown');

    // Set the initial data-channel-id
    const initialSelectedChannelId = channelDropdown.value;
    sendMessageButton.setAttribute('data-channel-id', initialSelectedChannelId);

    // Fetch messages for the selected channel
    function fetchMessages(channelId) {
        fetch(`/homepage/live-chat/messages?channel_id=${channelId}`)
            .then(response => response.json())
            .then(data => {
                const chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML = ''; // Clear messages
                if (data && data.length > 0) {
                    data.forEach(message => {
                        chatMessages.innerHTML += `
                            <div class="message d-flex align-items-start mb-2">
                                <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                                <div>
                                    <span class="fw-bold text-primary">${message.username}:</span>
                                    <span>${message.message}</span>
                                </div>
                            </div>`;
                    });
                } else {
                    chatMessages.innerHTML = '<div>No messages found.</div>';
                }
            })
            .catch(error => console.error('Error fetching messages:', error));
    }

    // Handle channel change
    channelDropdown.addEventListener('change', function () {
        const selectedChannelId = this.value;
        sendMessageButton.setAttribute('data-channel-id', selectedChannelId);
        fetchMessages(selectedChannelId); // Fetch new messages for the channel
    });

    // Send a new message
    sendMessageButton.addEventListener('click', function () {
        const channelId = sendMessageButton.getAttribute('data-channel-id');
        const commentContent = document.getElementById('message-input').value;

        if (commentContent.trim() === '') return;

        sendMessageButton.disabled = true;
        sendMessageButton.textContent = 'Sending...';

        fetch("{{ route('livechat.send') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                channel_id: channelId,
                comment_content: commentContent
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const newMessage = data.message;
                const chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML += `
                    <div class="message d-flex align-items-start mb-2">
                        <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                        <div>
                            <span class="fw-bold text-primary">${newMessage.username}:</span>
                            <span>${newMessage.message}</span>
                        </div>
                    </div>`;
                document.getElementById('message-input').value = '';
            }
            sendMessageButton.disabled = false;
            sendMessageButton.textContent = 'Send';
        })
        .catch(error => {
            console.error('Error sending message:', error);
            sendMessageButton.disabled = false;
            sendMessageButton.textContent = 'Send';
        });
    });

    // Initial fetch for messages
    fetchMessages(initialSelectedChannelId);
});
</script>