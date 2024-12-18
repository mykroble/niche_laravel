@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')

<div class="d-flex bg-dark flex-column align-items-center main-content">
    @if(count($channels) > 0)
    <div class="card">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        <div class="channels-section my-4">
            <h4 class="text-white">Channels</h4>
            <div class="row flex-nowrap overflow-auto" style="white-space: nowrap;">
                @foreach ($channels as $channel)
                    <a href="{{ route('homepage', ['channel_id' => $channel->id]) }}" 
                    class="col-auto bg-warning channel border p-3 mb-2 rounded mx-2 {{ $selectedChannelId == $channel->id ? 'bg-secondary text-white' : '' }}"
                    style="flex: 0 0 auto;">
                        <strong>{{ $channel->title }}</strong>
                    </a>
                @endforeach
            </div>
        </div>

        @foreach ($blogs as $blog)
        <div class="blog-container">
            <div class="channel m-0 p-0 h-100 d-flex justify-content-between">
                <div class="d-flex">
                    <div class="image-container-channel">
                        <img src="{{ asset('pics/channel-icon.svg') }}" class="channel-icon">
                    </div>
                    <p class="m-auto p-1 text-white-50">{{ $blog->channelTitle }}</p>
                </div>
            </div>
            <div class="blog" data-blog-id="{{ $blog->id }}">
                <div class="d-flex my-3 ">
                    <div class="image-container-user">
                        <img src="{{ asset($blog->icon_file_path) }}" class="user-icon">
                    </div>
                    <div class="d-block userinfo">
                        <div class="m-0 p-0">{{ $blog->display_name }}</div>
                        <div class="m-0 p-0 text-secondary username">@ {{ $blog->username }}</div>
                    </div>
                </div>
                <h5>{{ $blog->title }}</h5>
                <div class="preview" data-blogId="{{ $blog->id }}">{!! $blog->content !!}</div>
                <div class="d-flex justify-content-start">
                    <span class="px-3 mt-2">5 likes</span>
                    <span class="px-3 mt-2">10 Community Members</span>
                    <button 
                        class="btn mt-2 btn-sm toggle-bookmark {{ in_array($blog->id, $bookmarkedBlogIds) ? 'btn-success' : 'btn-primary' }}" 
                        data-blog-id="{{ $blog->id }}">
                        {{ in_array($blog->id, $bookmarkedBlogIds) ? 'Bookmarked' : 'Bookmark' }}
                    </button>
                </div>
            </div>
        </div>
        <hr>
        @endforeach

    </div>
    @else
    <p class="display-1 no-channel-display">You do not have any channels yet. Find more in <a href="{{route('explore')}}">Explore</a></p>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const bookmarkButtons = document.querySelectorAll('.toggle-bookmark');

    bookmarkButtons.forEach(button => {
        button.addEventListener('click', function() {
            event.stopPropagation();
            const blogId = this.dataset.blogId;
            const button = this;

            fetch("{{ route('bookmarks.toggle') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ blog_id: blogId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'added') {
                    button.classList.remove('btn-primary');
                    button.classList.add('btn-success');
                    button.textContent = 'Bookmarked';
                } else if (data.status === 'removed') {
                    button.classList.remove('btn-success');
                    button.classList.add('btn-primary');
                    button.textContent = 'Bookmark';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});

    const blogs = document.querySelectorAll('.blog');
    blogs.forEach(blog => {
        blog.addEventListener('click', function(event){
            let id = blog.dataset.blogId;
            console.log('clicked' + id);
            var url = "{{ route('viewBlog', ['value' => 'blogId']) }}".replace('blogId', id);
            window.location.href = url;
        })
    });
    $.ajax({
    url: '{{ route("livechat.index") }}',
    type: 'GET',
    success: function(messages) {
        messages.forEach(function(message) {
            $('#chat-messages').append('<p>' + message.comment_content + '</p>');
        });
    }
});
$('#send-message').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '{{ route("livechat.store") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            channel_id: 1, // Hardcoded example; replace dynamically
            comment_content: $('#message-input').val()
        },
        success: function(message) {
            $('#chat-messages').append('<p>' + message.comment_content + '</p>');
            $('#message-input').val('');
        }
    });
});
setInterval(function() {
    var lastMessageId = $('#chat-messages').children().last().data('message-id');

    $.ajax({
        url: '{{ route("livechat.fetchNew") }}',
        type: 'GET',
        data: { last_message_id: lastMessageId },
        success: function(newMessages) {
            newMessages.forEach(function(message) {
                $('#chat-messages').append('<p data-message-id="' + message.id + '">' + message.comment_content + '</p>');
            });
        }
    });
}, 2000); // Poll every 2 seconds

    const blogImages = @json($images);
    Object.entries(blogImages).forEach(([blogId, images]) => {
        console.log('aaa');
        const preview = document.querySelector(`.preview[data-blogId="${blogId}"]`);
        const imageContainers = preview.querySelectorAll('.image-container-uploaded');

        imageContainers.forEach(imageContainer => {
            let imageId = imageContainer.dataset.imageId;
            let uploadedImg = imageContainer.querySelector('.uploaded-image');
            if(uploadedImg){
                let imageRow = images.find(image => image.image_id === parseInt(imageId));
                if(imageRow){
                    let filePath = imageRow.file_path;
                    uploadedImg.src = `{{ asset('${filePath}') }}`;
                }
            }
        });
    });

</script>

@endsection