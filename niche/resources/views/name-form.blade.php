<!-- resources/views/name-form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Form Example</title>
</head>
<body>
    <h1>Submit Your Name</h1>
    
    <!-- Form to input the name -->
    <form action="{{ route('name.submit') }}" method="POST">
        @csrf <!-- CSRF token for security -->
        <label for="name">Enter your name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        <button type="submit">Submit</button>
    </form>

    <!-- Display the submitted name if available -->
    @if (isset($name))
        <h2>Hello, {{ $name }}!</h2>
    @endif
</body>
</html>