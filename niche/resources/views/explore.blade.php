@extends('layouts.exploreLayout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')

<div class="d-flex bg-dark flex-column align-items-center main-content">
    <div class="card">
        @foreach ($blogs as $blog)
        <div class="blog-container">
            <div class="channel m-0 p-0 h-100 w-100 d-flex justify-content-between">
                <div class="d-flex">
                    <div class="image-container-channel">
                        <img src="{{ asset('pics/channel-icon.svg') }}" class="channel-icon">
                    </div>
                    <p class="m-auto p-1 text-white"><u>{{ $blog->channelTitle }}</u></p>
                </div>
                <form action="{{ route('channel.join') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $blog->channelId }}" name="channel-id">
                    <button type="submit" class="btn btn-success btn-sm mx-3">Join</button>
                </form>
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
                </div>
            </div>
        </div>
        <hr>


        <!-- <div class="blog-container">
            <div class="h-100 w-100 d-flex justify-content-between channel">
                <div class="d-flex">
                    <div class="image-container-channel">
                        <img src="{{ asset('pics/channel-icon.svg') }}" class="channel-icon">
                    </div>
                    <p class="m-auto p-1">{{ $blog->channelTitle }}</p>
                </div>
                <form action="{{ route('channel.join') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $blog->channelId }}" name="channel-id">
                    <button type="submit" class="btn btn-success btn-sm">Join</button>
                </form>
            </div>
            <div class="blog" data-blog-id="{{ $blog->id }}">
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
        </div>
        <hr> -->
        @endforeach
    </div>
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