<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    @yield('loadAssets')
</head>
<body class="bg-dark m-0 p-0">
    <div class="container-fluid m-0 p-0">
        <div class="row m-0 p-0 vh-100">
            <div class="sidebar col-sm-2 m-0 p-0">
                <div class="st">
                    @include('shared.sidebar')
                </div>
            </div>
            <div class="col-sm-7">
                @yield('content')
            </div>
            <div class="rightsidebar col-sm-3 border-start m-0 p-0">
                @include('shared.rightsidebar')
            </div>
        </div>
    </div>
</body>
</html>