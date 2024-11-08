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
    <header class="pt-2">
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
    <div class="row full-height">
        <div class="col-md-5">
            <h2>Login</h2>
            <form method="POST" action="{{ route('loginForm.handleSubmit') }}" class="p-4 border rounded blurred-background">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label text-light">Email</label>
                    <input type="text" class="form-control {{ $errors->has('email') ? 'input_error' : '' }}" id="email" name="email" value="{{old('email')}}"required>
                    @error('email')
                        <div class="input_error_message">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-light">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="input_error_message">{{$message}}</div>
                    @enderror
                </div>
                <label for="remember" class="form-label text-light text-end">
                    <input type="checkbox" name="remember" id="remember"> Remember Me
                </label>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="mt-3">
                    <p>Don't have an account? <a href="">Create an Account</a></p>
                </div>
            </form>
        </div>

        <div class="col-md-5 px-5">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($imageSources as $index => $imageSource)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">';
                            <img src="{{ asset($imageSource) }}" class="d-block w-100"  alt="Carousel Image">
                            </div>
                    @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

    <footer class="pb-1 text-center text-light">
    <p>© 2024 Niche Find your Niche.</p>
    </footer>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>