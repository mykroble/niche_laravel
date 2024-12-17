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
    <h1>User List</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->display_name }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->is_admin }}</td>
                    <td>{{ $user->is_banned }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>