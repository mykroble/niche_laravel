<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        @include('components.profile_modal_basic_info')
        <div class="container min-vh-100 w-100">
            <!-- include header -->
            <div class="main h-100 w-100">
                <div class="row">
                    <!-- include sidebar -->
                    <div class="sidebar col-sm-3 bg-secondary"></div>
                    <div class="content col-sm-9">
                        <div class="row">
                            <div class="post bg-success">
                                whatever here
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/profile_modal.js') }}"></script>
    </body>
    </html>

    <!-- <button id="edit" onclick="openModal(1)">edit</button> -->