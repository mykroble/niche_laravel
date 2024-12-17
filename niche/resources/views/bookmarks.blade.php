@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'My Bookmarks')

@section('content')
<div class="d-flex bg-dark flex-column align-items-center main-content">
    <div class="card">
        <div class="container my-2 text-white">
            <h3 class="text-white mb-2">My Bookmarks</h3>
        </div>
        <hr>
        @if(count($blogs) > 0)
        @foreach ($blogs as $blog)
        <div class="blog-container">
            <div class="channel m-0 p-0 h-100 d-flex justify-content-between">
                <div class="d-flex">
                    <div class="image-container-channel">
                        <img src="{{ asset('pics/channel-icon.svg') }}" class="channel-icon">
                    </div>
                    <p class="m-auto p-1 text-white-50">{{ $blog->channel }}</p>
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
                <span class="px-3">5 likes</span>
                <span>10 Community Members</span>
                </div>
                <button class="btn btn-sm btn-primary bookmark-btn" data-blog-id="{{ $blog->id }}">
                    Remove Bookmark
                </button>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    @else
    <p class="display-1 no-channel-display">You do not have any bookmarks yet. Find more in <a href="{{route('homepage')}}">Homepage</a></p>
    @endif
</div>

<script>
 
    const blogs = document.querySelectorAll('.blog');
    blogs.forEach(blog => {
        blog.addEventListener('click', function(event){
            let id = blog.dataset.blogId;
            console.log('clicked' + id);
            var url = "{{ route('viewBlog', ['value' => 'blogId']) }}".replace('blogId', id);
            window.location.href = url;
        })
    });

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