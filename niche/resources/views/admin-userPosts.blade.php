<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body class="bg-dark m-0 p-0">
    @if(session('successMessage'))
    <div class="alert alert-success" role="alert">
        Status successfully updated for blog: <b>"{{ session('successMessage') }}"</b>
    </div>
    @endif
    <button class="btn btn-light btn-sm m-2"><a href="{{route('adminPage')}}" class="text-decoration-none text-black">Go back</a></button>
    <div class="table-wrapper">
        <h1 class="text-white">Posts by @ {{$blogs->first()->username ?? 'Unknown' }}</h1>

        <table border="1" class="table table-dark w-100">
            <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Last Updated</th>
                    <th>Visibility</th>
                    <th>Status</th>
                    <th>Channel</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-white">
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->date_created }}</td>
                        <td>{{ $blog->date_last_updated }}</td>
                        <td>{{ $blog->is_public ? 'Public' : 'Private'}}</td>
                        <td>{{ $blog->is_banned ? 'Banned' : 'Alive'}}</td>
                        <td>{{ $blog->channel }}</td>
                        <td><button onclick="viewPosts({{ $blog->id }})" class="btn btn-light btn-sm">View Post</button></td>
                        @if($blog->is_banned === 0)
                        <td><button class="btn btn-danger btn-sm m-0"><a href="{{ route('admin.toggleBanPost', ['id' => $blog->id]) }}" class="text-decoration-none text-black w-100 h-100 p-1">Ban Post</a></button></td>
                        @else
                        <td><button class="btn btn-secondary btn-sm m-0"><a href="{{ route('admin.toggleBanPost', ['id' => $blog->id]) }}" class="text-decoration-none text-black w-100 h-100 p-1">Unban Post</a></button></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function viewPosts(blogId) {
            var url = "{{ route('admin.viewPost', ['id' => ':blogId']) }}".replace(':blogId', blogId);
            
            window.location.href = url;
        }
    </script>

</body>
</html>