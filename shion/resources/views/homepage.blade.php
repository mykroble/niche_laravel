<html>
<body>
    <h1>Welcome User ID ?!</h1>
    <form method="POST" action="{{ route('logout.submit') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
