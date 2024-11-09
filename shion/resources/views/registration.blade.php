<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Niche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/registration.css">
    <script src="View/toggle_password.js"></script>
</head>
<body class="m-0 p-0 h-auto">
    <div class="vw-100 vh-100 m-0 p-0 d-flex">

        <div class="w-50 h-100 d-inline-block left_side">
            <span class="text-success" style="display:<?php echo isset($_SESSION['accountCreated']) ? "block" : "none" ; ?>">Account successfully created! <a href="index.php">login?</a></span>
            <div class="form_bg">
                <div class="logo_space">
                    <!-- Place logo image here -->
                </div>
                <div class="text_area">
                    <p>Signup and find your Niche!</p>
                </div>
                <form class="form" action="" method="POST">
                    <span class="text_label">Pick your username</span>
                    <input class="input_box" type="text" id="register_uName" name="register_uName" value="<?php echo isset($_SESSION['dupNameValue']) ? $_SESSION['dupNameValue'] : ""; ?>" required>
                    <span class="text-danger error_text"><?php echo isset($_SESSION['duplicateNameMessage']) ? $_SESSION['duplicateNameMessage'] : null; ?></span>
                    <div class="m-1"></div>
                    <span class="text_label">Enter your Email address</span>
                    <input class="input_box" type="text" id="register_eAdd" name="register_eAdd" value="<?php echo isset($_SESSION['dupEAddValue']) ? $_SESSION['dupEAddValue'] : ""; ?>" required>
                    <span class="text-danger error_text"><?php echo isset($_SESSION['duplicateEAddMessage']) ? $_SESSION['duplicateEAddMessage'] : null; ?></span>
                    <div class="m-1"></div>
                    <span class="text_label">Create your password</span>
                    <div class="d-flex justify-content-around password_div">
                        <input class="input_box input_password" type="password" id="pword" name="register_pword" required>
                        <div class="d-inline-block eye_toggle_img_div" onclick="toggleEye(1)">
                            <img src="css/registration_pics/eye_closed.svg" class="eye_toggle_img" id="eye_toggle_1"></img>
                        </div>
                    </div>
                    <div class="text-danger error_text"><?php echo isset($_SESSION['pWordError']) ? $_SESSION['pWordError'] : null; ?></div>
                    <div class="m-1" style="display:<?php echo isset($_SESSION['pWordError']) ? "none" : "block" ; ?>"></div>
                    <!-- <div class="m-1"></div> -->
                    <span class="text_label">Confirm your password</span>
                    <div class="d-flex justify-content-around password_div">
                        <input class="input_box input_password" type="password" id="re_pword" name="register_re_pword" required>
                        <div class="d-inline-block eye_toggle_img_div" onclick="toggleEye(2)">
                            <img src="css/registration_pics/eye_closed.svg" class="eye_toggle_img" id="eye_toggle_2"></img>
                        </div>
                    </div>
                    <div class="button_div">
                        <button class="login_button" style="text-align: center">Signup</button>
                        <div class="already_account_div">
                            <a href="index.php" class="already_account">Already have an account?</a>
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