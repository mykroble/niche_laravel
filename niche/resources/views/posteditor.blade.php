<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Blog Editor</title>
    <link href="{{ asset('css/posteditor.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div id="editor">
        <div class="section">
            <div class="text-section" contenteditable="true">Text Here</div>
        </div>
        <div class="wrapper-add-section">
            <div class="add-section">
                <hr>
                <button type="button" onclick="createTextSection(event)" class="btn btn-light p-0"><img src="{{ asset('pics/textBox.svg') }}"></button>
                <button type="button" onclick="createImageSection(event)" class="btn btn-light p-0"><img src="{{ asset('pics/imgBox.svg') }}"></button>
                <button type="button" onclick="createMarkedSection(event)" class="btn btn-light p-0"><img src="{{ asset('pics/markdown.svg') }}"></button>
                <hr>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary m-5" data-bs-toggle="modal" data-bs-target="#previewModal">
        Post Blog
    </button>
    <form id="blogForm" method="POST" action="{{ route('saveBlog.submit') }}" style="display:none" enctype="multipart/form-data">
        @csrf
        <input type="text" id="title" name="title" style="display:none">
        <input type="text" id="content" name="content" style="display:none">
        <input type="number" id="channel" name="channel" style="display:none">
        <input type="number" id="visibility" name="visibility" style="display:none">
    </form>
    @include('components/posteditor_preview_modal')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/15.0.3/lib/marked.umd.min.js" integrity="sha512-Kt7350NAX8m05J2xcXWI1kAyZQjLm5c/yW0tz5qOpPyKhaidt+p5axcaL3TCaoYfJ11eHOO8nXKtXyGo+z5PMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.2.2/purify.min.js" integrity="sha512-aMwmSY1jtPTUuu81C/rDUHoj2IyPpqqSX6N+efBFVFIe5nV4ZsKebsEWDUxsVdDMy3XVhY4TsZ3WHgXmhSufjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/posteditor.js') }}"></script>
    <script>
        const plusSignURL = "{{ asset('pics/plusSign.svg') }}";
    </script>
</body>
</html>