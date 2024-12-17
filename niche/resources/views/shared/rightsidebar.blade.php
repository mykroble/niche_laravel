<div class="messages-section col-4 pr-2">
    <div class="search-draft p-3 rounded border">
        <h5 class="fw-bold mb-3">Search Blogs</h5>
        <form id="searchForm" class="message-input border-top mt-2 pt-2 d-flex align-items-center">
            <input type="text" id="searchQuery" class="form-control me-2" placeholder="Search by blog title..." />
            <button type="submit" class="btn btn-warning ">Search</button>
        </form>
        <div id="searchResults" class="mt-3  rounded p-2" style="min-height: 0px; max-height: 270px; overflow-y: auto;">
            
        </div>


        <!-- live chat -->
    </div>
    <div class="messages rounded border p-3 mt-3">
        <div class="text-warning px-2 py-1 mb-2">
            <strong>Live Chat</strong>
        </div>
        <div class="messages-content overflow-auto px-2 py-2" style="max-height: 500px;">
            <div class="message d-flex align-items-start mb-2">
                <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                <div>
                    <span class="fw-bold text-primary">jatpuan:</span>
                    <span>eww</span>
                </div>
            </div>
            <div class="message d-flex align-items-start mb-2">
                <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                <div>
                    <span class="fw-bold text-success">alinaxdino:</span>
                    <span>BETTER</span>
                </div>
            </div>
            <div class="message d-flex align-items-start mb-2">
                <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                <div>
                    <span class="fw-bold text-warning">YukiMare_:</span>
                    <span>eeewwww</span>
                </div>
            </div>
            <div class="message d-flex align-items-start mb-2">
                <img src="https://via.placeholder.com/30" class="rounded-circle me-2" alt="User">
                <div>
                    <span class="fw-bold text-danger">wynlouv:</span>
                    <span>EWWWWW</span>
                </div>
            </div>
        </div>
        <div class="message-input border-top mt-2 pt-2 d-flex align-items-center">
            <input type="text" class="form-control me-2" placeholder="Type your message..." />
            <button class="btn btn-primary bg-info">Send</button>
        </div>
    </div>
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
</script>