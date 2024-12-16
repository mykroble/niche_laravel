

    <div class="profile-section">
        <!-- the clickable area is too wide we need to make it smaller-->
        <a href="{{ route('profile') }}" class="text-decoration-none text-white">
            <img src="{{ asset('pics/sampleIcon.jpg') }}" alt="Profile Picture" class="rounded-circle mb-2">
            <h5 class="mb-1">Username</h5> <!-- retrieve from table user-->
        </a>
        <p class="text-muted small">user@example.com</p><!-- retrieve from table user-->
    </div>
    <a href="{{route('homepage')}}">Home</a>
    <a href="#">Explore</a>
    <a href="#">Notifications</a>
    <a href="{{route('message')}}">Messages</a><!-- not final-->
    <a href="{{route('bookmarks')}}">Bookmarks</a>
    <a href="#">More</a>
    <form method="GET" action="{{ route('createBlog') }}">
        <button type="submit" class="btn btn-primary w-100 mt-3">Post</button><!-- i remember you saying you want 
        something like this but i feel you meant for it to be in main-->
    </form>
    <form method="POST" action="{{ route('logout.submit') }}">
        @csrf
        <button type="submit" class="btn btn-light w-100">Sign out</button>
    </form>