<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload with Editor</title>
    <style>
        .editor {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 200px;
            width: 80%;
            margin: auto auto;
            overflow: auto;
            background: red;
            resize:none;
        }

        .image-container {
            display: inline-block;
            position: relative;
            margin: 10px 0;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
        }

        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            cursor: pointer;
        }

        .resizable-handle {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background: blue;
            cursor: se-resize;
        }
    </style>
</head>
<body>
        <textarea contenteditable="true" class="editor"></textarea>
        <input type="file" id="imageInput" accept="image/*" style="display: none;" />
        <button id="addImageBtn">Add Image</button>

    <script src="{{ asset('js/posteditor.js') }}"></script>
</body>
</html>