<?php

require_once 'Model/db_connect.php';
$DatabaseObj = new Database();
$conn = $DatabaseObj->getConnection();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {     //if logged in
    require 'Controller/homepage_ctrl.php';     //not made yet. I might wanna write this using header() so it won't create long chain of link link
} else if(isset($_GET['signup']) && $_GET['signup'] == 1){
    require 'Controller/registration_ctrl.php';
    $registObj = new regist($conn);
    if(isset($_POST['register_uName'])){
        $registObj->registAccount(
            $registObj,
            htmlspecialchars($_POST['register_uName']),
            htmlspecialchars($_POST['register_eAdd']),
            htmlspecialchars($_POST['register_pword']),
            htmlspecialchars($_POST['register_re_pword'])
        );
        // $registObj->checkAvail($_POST['register_uName'], $_POST['register_eAdd']);  //temporary code
    } else {
        $registObj->loadRegist();
    }
} else {
    require 'Controller/login_ctrl.php';
    $loginControlObj = new loginControl($conn);
    if(isset($_POST['userLogin'])){     //if user submit login form
        $loginControlObj->loginUser(
            htmlspecialchars($_POST['userLogin']),
            htmlspecialchars($_POST['userLoginPword'])
        );
    }
    $loginControlObj->loadLogin();
    unset($_SESSION['loginError']);
}

?>