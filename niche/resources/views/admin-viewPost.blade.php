<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{ $blogData->title }}</title>
    <link href="{{ asset('css/blogViewer.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="bg-dark m-0 p-0 text-white">
    <div class="d-flex justify-content-between p-2 w-auto mx-2">
        <button class="btn btn-light btn-sm p-1"><a href="{{ route('admin.userDetail', ['id' => $blogData->author_user_id]) }}" class="text-decoration-none text-black w-100 h-100 p-2">Go back</a></button>
        @if($blogData->is_banned === 0)
        <button class="btn btn-danger btn-sm m-0"><a href="{{ route('admin.toggleBanPost', ['id' => $blogData->id]) }}" class="text-decoration-none text-black w-100 h-100 p-1">Ban Post</a></button>
        @else
        <button class="btn btn-secondary btn-sm m-0"><a href="{{ route('admin.toggleBanPost', ['id' => $blogData->id]) }}" class="text-decoration-none text-black w-100 h-100 p-1">Unban Post</a></button>
        @endif
    </div>
    <div class="title px-3 py-1 text-white"><h2 class="p-0 m-0">{{ $blogData->title }}</h2><p>by: @ {{ $blogData->username }}</p></div>
    <div id="content">{!!$blogData->content !!}</div>
    <script>

        const content = document.getElementById('content');
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