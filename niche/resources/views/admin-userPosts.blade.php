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
    <div class="table-wrapper">
        <h1 class="text-white">User List</h1>

        <table border="1" class="table table-dark w-100">
            <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Display Name</th>
                    <th>Age</th>
                    <th>is_admin</th>
                    <th>is_banned</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-white">
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>@ {{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->display_name }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->is_admin }}</td>
                        <td>{{ $user->is_banned }}</td>
                        <td data-userId="{{ $user->id }}"><button onclick="userDetail({{ $user->id }})" class="btn btn-light btn-sm">View</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>