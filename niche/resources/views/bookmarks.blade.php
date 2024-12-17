@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'My Bookmarks')

@section('content')
<div class="container my-4 text-white">
    <h3 class="text-white mb-4">My Bookmarks</h3>
    
    @foreach ($blogs as $blog)
        <div class="blog border p-3 mb-2 rounded" data-blog-id="{{ $blog->id }}">
            <div class="d-flex mb-3">
                    <div class="image-container-user">
                        <img src="{{ asset($blog->icon_file_path) }}" class="user-icon">
                    </div>
                    <p class="my-auto">
                        {{ $blog->display_name }}
                        <span class="text-secondary">@ {{ $blog->username }}</span>
                    </p>
                </div>
            <h5>{{ $blog->title }}</h5>
            <div class="preview" data-blogId="{{ $blog->id }}">{!! $blog->content !!}</div>
            <div class="d-flex justify-content-start">
                <span class="px-3">5 likes</span>
                <span>10 Community Members</span>
            </div>
        </div>
        <button class="btn btn-sm btn-primary bookmark-btn" data-blog-id="{{ $blog->id }}">
            Remove Bookmark
        </button>
        <hr>
    @endforeach
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