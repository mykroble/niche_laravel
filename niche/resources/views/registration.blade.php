<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Niche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/registration.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/toggle_password.js') }}"></script>
</head>
<body class="m-0 p-0 h-auto">
    <div class="vw-100 vh-100 m-0 p-0 d-flex">

        <div class="w-50 h-100 d-inline-block left_side">
            @if(session('created'))
            <div class="text-success">Account created successfully!<a href="{{ route('login') }}">Login?</a></div>
            @endif
            <div class="form_bg">
                <div class="logo_space">
                    <!-- Place logo image here -->
                </div>
                <div class="text_area">
                    <p>Signup and find your Niche!</p>
                </div>
                <form class="form" action="{{route('registrationForm.handle')}}" method="POST">
                    @csrf
                    <span class="text_label">Pick your username</span>
                    <input class="input_box {{ $errors->has('r_username') ? 'input_error' : '' }}" type="text" id="r_username" name="r_username" value="{{old('r_username')}}" required>
                    @error('r_username')
                        <div class="input_error_message">{{$message}}</div>
                    @enderror
                    <div class="m-1"></div>
                    <span class="text_label">Enter your Email address</span>
                    <input class="input_box {{ $errors->has('r_email') ? 'input_error' : '' }}" type="text" id="r_email" name="r_email" value="{{old('r_email')}}"required>
                    @error('r_email')
                        <div class="input_error_message">{{$message}}</div>
                    @enderror
                    <div class="m-1"></div>
                    <span class="text_label">Create your password</span>
                    <div class="d-flex justify-content-around password_div">
                        <input class="input_box input_password {{ $errors->has('r_password') ? 'input_error' : '' }}" type="password" id="r_password" name="r_password" required>
                        <div class="d-inline-block eye_toggle_img_div" onclick="toggleEye(1)">
                            <img src="{{asset('css/registration_pics/eye_closed.svg')}}" class="eye_toggle_img" id="eye_toggle_1"></img>
                        </div>
                    </div>
                    @if(session()->has('error'))
                    <div class="input_error_message">{{ session('error') }}</div>
                    @else
                    @error('r_password')
                    <div class="input_error_message">{{$message}}</div>
                    @enderror
                    @endif
                    <span class="text_label">Confirm your password</span>
                    <div class="d-flex justify-content-around password_div">
                        <input class="input_box input_password" type="password" id="r_password_confirmation" name="r_password_confirmation" required>
                        <div class="d-inline-block eye_toggle_img_div" onclick="toggleEye(2)">
                            <img src="{{asset('css/registration_pics/eye_closed.svg')}}" class="eye_toggle_img" id="eye_toggle_2"></img>
                        </div>
                    </div>
                    <label for="proceed" class="text-label">
                        <input type="checkbox" name="proceed" id="proceed"> Login automatically after signup
                    </label>
                    <div class="button_div">
                        <button class="login_button" style="text-align: center">Signup</button>
                        <div class="already_account_div">
                            <a href="{{route('login')}}" class="already_account">Already have an account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="w-50 h-100 d-inline-block right_side"></div>

    </div>
    <div></div>
</body>
</html>