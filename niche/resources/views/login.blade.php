<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
    
</head>
<body>
    <div class="container-fluid d-flex flex-column min-vh-100 bg-dark">
        <header class="pt-2 bg-danger">
            <div class="row justify-content-between align-items-center">
                <div class="col-3">
                    <a class="text-decoration-none text-light" href="#">Niche</a>
                </div>
                <div class="col d-flex justify-content-evenly">
                    <ul class="list-unstyled d-flex gap-4 mb-0">
                        <li><a class="text-decoration-none text-light" href="#">Home</a></li>
                        <li><a class="text-decoration-none text-light" href="#">Explore</a></li>
                        <li><a class="text-decoration-none text-light" href="#">Profile</a></li>
                        <li><a class="text-decoration-none text-light" href="#">Pins</a></li>
                        <li><a class="text-decoration-none text-light" href="#">Settings</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main class="main flex-grow-1">
            <div class="login-container">
                <div class="text-center text-light tagline">
                    Find the space where you truly belong.
                </div>
                <div class="login-form">
                    <h2 class="text-center text-dark">Login</h2>
                    @auth
                    <div class="text-success text-center">Looks like you are already signed in.<a href="{{route('homepage')}}"> To Homepage?</a></div>
                    @endauth
                    <form method="POST" action="{{ route('loginForm.handle') }}" class="p-4">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-dark">Email</label>
                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{old('email')}}" required>
                            @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-dark">Password</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-end">
                            <label for="remember" class="form-label text-dark">
                                <input type="checkbox" name="remember" id="remember"> Remember Me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <div class="mt-3 text-center">
                            <p class="text-dark">Don't have an account? <a href="{{route('registration')}}">Create an Account</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer class="footer bg-danger">
            <p>© 2024 Niche. Find your Niche.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>