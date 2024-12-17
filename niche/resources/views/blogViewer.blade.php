@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{ $blogData->title }}</title>
    <link href="{{ asset('css/blogViewer.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="title sticky-top p-3 text-white"><h2>{{ $blogData->title }}</h2></div>
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

    <script src="{{ asset('js/blogViewer.js') }}"></script>
</body>
</html>
@endsection