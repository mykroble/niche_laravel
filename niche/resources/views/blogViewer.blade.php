@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('css/blogViewer.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')

    <div class="title px-1 pt-3 text-white"><h2 class="p-0 m-0">{{ $blogData->title }}</h2><p class="m-0 p-0">by: @ {{ $blogData->username }}</p></div>
    <hr class="border-white">

    <div id="content" class="text-white mb-3">{!!$blogData->content !!}</div>
    <div class="w-100">
        
        <div class="comment-wrapper text-white">
            <div class="d-flex m-0 w-100">
                <div class="comment-user-icon d-flex justify-content-start">
                    <img src="{{ asset(auth()->User()->icon_file_path) }}" class="user-icon">
                </div>
                <div class="d-block userinfo w-100">
                    <div class="m-0 p-0">{{ auth()->User()->display_name }}<span class="mx-1 p-0 text-secondary username">@ {{ auth()->User()->username }}</span></div>
                    <form action="{{ route('blogs.comment') }}" method="POST">
                        @csrf
                        <label for="commentInput" class="form-label">Comments: </label>
                        <div class="d-flex">
                            <input type="text" name="commentInput" id="commentInput" class="w-100">
                            <input type="submit" class="btn btn-sm btn-success">
                        </div>
                        <div id="emailHelp" class="form-text text-white">Share your thoughts!</div>
                        <input type="hidden" name="blog_id" value="{{ $blogData->id }}">
                    </form>
                </div>
            </div>
        </div>
        @foreach ($comments as $comment)
        <div class="comment-wrapper text-white">
            <div class="d-flex m-0">
                <div class="comment-user-icon d-flex justify-content-start">
                    <img src="{{ asset($comment->icon_file_path) }}" class="user-icon">
                </div>
                <div class="d-block userinfo">
                    <div class="m-0 p-0">{{ $comment->display_name }}<span class="mx-1 p-0 text-secondary username">@ {{ $comment->username }}</span></div>
                    <div>
                        <p class="m-0 p-0">{{ $comment->content }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <hr>

    <script>

        const blogImages = @json($blogImages);
        const imageContainers = content.querySelectorAll('.image-container-uploaded');
        imageContainers.forEach(imageContainer => {
            let imageId = imageContainer.dataset.imageId;
            let uploadedImg = imageContainer.querySelector('.uploaded-image');
            if(uploadedImg){
                let imageRow = blogImages.find(image => image.image_id === parseInt(imageId));
                if(imageRow){
                    let filePath = imageRow.file_path;
                    uploadedImg.src = `{{ asset('${filePath}') }}`;
                }
            }
        });
        content.style.display = 'block';
    </script>
@endsection