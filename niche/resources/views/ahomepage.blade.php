<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/homepage.css')}}">
</head>
<body class="bg-dark">
    @include('shared.sidebar')
    <div class="col-5 content container-fluid d-flex flex-column min-vh-100">
        <div class="row">
            <!-- make into a loop -->
            <div class="d-flex bg-dark flex-column align-items-center py-4 main-content">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/50" class="rounded-circle mr-3" alt="Niche">
                        <div class="m-4"><!-- Title of the niche not the blog-->
                            <strong>Niche Title</strong> <small>idk</small>
                        </div>
                    </div>
                    <p class="mt-3">My Experience at the mall</p>
                    <div class="d-flex justify-content-start">
                        <span>503 posts</span>
                        <span>30 active</span>
                        <span>25K visits</span>
                        <span>371 Community Members</span>
                    </div>
                </div>
            </div>

            <div class="messages-section col-4 border pr-2">
                <div class="row messages border m-2">Search (draft)</div>
                <div class="row messages border m-2">Messages (draft)</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>