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
        Status successfully updated for user: <b>"{{ session('successMessage') }}"</b>
    </div>
    @endif
    <div class="table-wrapper">
        <h1 class="text-white">User List</h1>

        <table border="1" class="table table-dark w-100">
            <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Icon</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Display Name</th>
                    <th>Age</th>
                    <th>Access Level</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-white">
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><div class="image-container-user"><img src="{{ asset($user->icon_file_path) }}" class="user-icon"></div></td>
                        <td>@ {{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->display_name }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                        <td>{{ $user->is_banned ? 'Banned' : 'Alive' }}</td>
                        <td><button onclick="userDetail({{ $user->id }})" class="btn btn-light btn-sm">View</button></td>
                        @if($user->is_banned === 0)
                        <td><button class="btn btn-danger btn-sm m-0 text-black" onclick="toggleBanUser('{{ $user->id }}', '{{ $user->username }}')">Ban user</button></td>
                        @else
                        <td><button class="btn btn-secondary btn-sm m-0 text-black" onclick="toggleBanUser('{{ $user->id }}', '{{ $user->username }}')">Unban user</button></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function toggleBanUser(userId, username){
            var userConfirmed = confirm('Are you sure you want to ban this user?\n\nID: ' + userId + '\nUsername: ' + username);
    
            if (userConfirmed) {
                var url = "{{ route('admin.toggleBanUser', ['id' => 'userId']) }}".replace('userId', userId);
                window.location.href = url;
            }
        }

        function userDetail(userId) {
            var url = "{{ route('admin.userDetail', ['id' => 'userId']) }}".replace('userId', userId);
            
            window.location.href = url;
        }
    </script>

</body>
</html>