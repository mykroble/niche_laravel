<?php

class regist{
    private $conn;
    function __construct($conn){
        $this->conn = $conn;
    }

    // public function checkAvail($uName, $EmailAdd){      //I didnt need this
    //     require_once 'Model/registration_model.php';
    //     $registModelObj = new registModelObj($this->conn);
    //     $availableName = true;
    //     $availableEAdd = true;
    //     $availableName = $registModelObj->availName($uName);
    //     $availableEAdd = $registModelObj->availEAdd($EmailAdd);
    //     if($availableName == false){
    //         $_SESSION['duplicateNameMessage'] = "this username is already taken";
    //         $_SESSION['dupNameValue'] = $uName;
    //     }
    //     if($availableEAdd == false){
    //         $_SESSION['duplicateEAddMessage'] = "this Email address is already registered";
    //         $_SESSION['dupEAddValue'] = $EmailAdd;
    //     }
    //     if($availableName == true && $availableEAdd == true){
    //         unset($_SESSION['duplicateNameMessage']);
    //         unset($_SESSION['dupNameValue']);
    //         unset($_SESSION['duplicateEAddMessage']);
    //         unset($_SESSION['dupEAddValue']);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function pWordValidate($pWord, $rePWord){
        $retBool = false;
        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        if ($pWord != $rePWord) {
            $_SESSION['pWordError'] = "Passwords are not same.";
        } else if (!preg_match($password_pattern, $pWord)) {
            $_SESSION['pWordError'] = "Password must have at least 8 character length with mimimum 1 uppercase, 1 lowercase, 1 number and 1 special characters.";
        } else {
            $retBool = true;
        }
        return $retBool;
    }
    
    public function registAccount($registObj, $uName, $EmailAdd, $pWord, $rePWord){        //4 parameters
        //check duplicate of user name and email address,
        //also check if the entered password is strong enough,
        //and insert to db if its valid.
        //If successful, prompt message that the account is created, and then run: header("Refresh:0);
        if($registObj->pWordValidate($pWord, $rePWord) == true){
            require_once 'Model/registration_model.php';
            $registModelObj = new registModel($this->conn);
            if($registModelObj->insertNewUser($uName, $EmailAdd, $pWord) == true){
                $_SESSION['accountCreated'] = "Account created successfully";
            }
        }
        header("Refresh:0");
    }
    
    public function loadRegist(){
        require_once 'View/registration_view.php';
        unset($_SESSION['duplicateNameMessage']);
        unset($_SESSION['dupNameValue']);
        unset($_SESSION['duplicateEAddMessage']);
        unset($_SESSION['dupEAddValue']);
        unset($_SESSION['pWordError']);
        unset($_SESSION['accountCreated']);
    }
}

?>