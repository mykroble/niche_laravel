<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Image Upload with Editor</title>
    <link href="{{ asset('css/posteditor.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div contenteditable="true" id="editor"></div>
    <button id="addImageBtn">Add Image</button>
    <button type="button" id="showCurrentContent" onclick="showCurr()">Show</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#previewModal">
        Launch demo modal
    </button>
    <form id="blogForm" method="POST" action="{{ route('saveBlog.submit') }}">
        @csrf
        <input type="hidden" id="content" name="content">
        <input type="submit" value="Submit">
    </form>
    @include('components/posteditor_preview_modal')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/posteditor.js') }}"></script>
    <script>
        // Initialize Bootstrap Modal using JavaScript
        const modalButton = document.querySelector('[data-bs-toggle="modal"]');
        modalButton.addEventListener('click', function() {
            console.log("Modal button clicked");
        });
    </script>
</body>
</html>