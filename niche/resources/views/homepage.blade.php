<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- no matter how hard i tried css link just dont seem to work for me can you convert it in css folder hihi-->
   <style>
        body {
            color: white;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 10px;
        }

        .sidebar a {
            color: #8899A6;
            font-weight: bold;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }

        .sidebar a:hover {
            color: white;
        }
        
        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            color: white;
            background-color: #212529;
            width: 100%;
        }

        .profile-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-section img {
            width: 80px;
            height: 80px;
        }
        
        .messages-section {
            height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            padding: 10px 20px;
            color: white;
        }
        
        .messages {
            height: 40%;
        }
    </style>
</head>
<body class="bg-dark">
    
    <!-- Sidebar -->
    <div class="sidebar bg-dark">
        <div class="profile-section">
            <!-- the clickable area is too wide we need to make it smaller-->
            <a href="{{ route('profile') }}" class="text-decoration-none text-white">
                <img src="css/pics/photography.jpeg" alt="Profile Picture" class="rounded-circle mb-2">
                <h5 class="mb-1">Username</h5> <!-- retrieve from table user-->
            </a>
            <p class="text-muted small">user@example.com</p><!-- retrieve from table user-->
        </div>
        <a href="#">Home</a>
        <a href="#">Explore</a>
        <a href="#">Notifications</a>
        <a href="#">Messages</a><!-- not final-->
        <a href="#">Bookmarks</a>
        <a href="#">More</a>
        <button class="btn btn-primary w-100 mt-3">Post</button><!-- i remember you saying you want 
        something like this but i feel you meant for it to be in main-->
        <form method="POST" action="{{ route('logout.submit') }}" class="mt-3">
            @csrf<!-- dunno what this means didnt wanna touch it-->
            <button type="submit" class="btn btn-light w-100">Sign out</button>
        </form>
    </div>
    <div class="content container-fluid d-flex flex-column min-vh-100">
        <div class="row">

            <!-- make into a loop -->
            <div class="col-5 d-flex bg-dark flex-column align-items-center py-4 main-content">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/50" class="rounded-circle mr-3" alt="Niche">
                        <div class="m-4"><!-- Title of the niche not the blog-->
                            <strong>Niche Title</strong> <small>idk</small>
                        </div>
                    </div>
                    <p class="mt-3">My Experience at the mall</p>
                    <!-- title of the blog -->
                    <div class="d-flex justify-content-between">
                        <span>503 posts</span>
                        <span>30 active</span>
                        <span>25K visits</span>
                        <span>371 Community Members</span>
                        <!-- im not very sure of these yet. like what do we want to keep track-->
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