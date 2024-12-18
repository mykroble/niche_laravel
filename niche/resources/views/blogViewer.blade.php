@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('css/blogViewer.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')
@if(session('pageUnavailable'))
    <div class="title px-1 pt-3 text-white"><h2 class="p-0 m-0">{{ $blogData->title }}</h2><p class="m-0 p-0">by: @ {{ $blogData->username }}</p></div>
    <hr class="border-white">
    <div id="content" class="text-white">{!!$blogData->content !!}</div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/15.0.3/lib/marked.umd.min.js" integrity="sha512-Kt7350NAX8m05J2xcXWI1kAyZQjLm5c/yW0tz5qOpPyKhaidt+p5axcaL3TCaoYfJ11eHOO8nXKtXyGo+z5PMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
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
@else
    <div class="m-auto text-white">Content unavaiable</div>
@endif
@endsection