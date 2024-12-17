<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegistrationController extends Controller{

    public function showRegistrationPage(){
        return view('registration');
    }

    public function handleRegistrationSubmit(Request $request)
    {
        $request->validate([
            'r_username' => 'required|string|unique:users,username',
            'r_email' => 'required|email|unique:users,email',
            'r_password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[\W_]/',
                'confirmed',
            ],
        ],[
                'r_username.required' => 'Please provide a username.',
                'r_username.string' => 'Username must be a valid string.',
                'r_username.unique' => 'This username is already taken.',
                'r_email.required' => 'An email address is required.',
                'r_email.email' => 'Please provide a valid email address.',
                'r_email.unique' => 'This email address is already registered.',
                'r_password.required' => 'A password is required.',
                'r_password.min' => 'Your password must be at least 8 characters long.',
                'r_password.regex' => 'Your password must include at least one lowercase letter, one uppercase letter, one number, and one special character.',
                'r_password.confirmed' => 'The password confirmation does not match.',
            ]
        );

        $user = User::create([
            'username' => $request->r_username,
            'email' => $request->r_email,
            'password' => Hash::make($request->r_password),
            'display_name' => $request->r_username
        ]);

        if($user != null && $request->has('proceed')){
            Auth::login($user);
            if(Auth::check()){
                return redirect()->route('homepage');
            }
        }else if($user != null){
            return redirect()->route('registration')->with('created',true);
        } else {
            return back()->with('error', 'signup failed.')->withInput($request->only('r_username', 'r_email'));
        }
    }
}
//     public function pWordValidate($pWord, $rePWord){
//         $retBool = false;
//         $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

//         if ($pWord != $rePWord) {
//             $_SESSION['pWordError'] = "Passwords are not same.";
//         } else if (!preg_match($password_pattern, $pWord)) {
//             $_SESSION['pWordError'] = "Password must have at least 8 character length with mimimum 1 uppercase, 1 lowercase, 1 number and 1 special characters.";
//         } else {
//             $retBool = true;
//         }
//         return $retBool;
//     }
    
//     public function registAccount($registObj, $uName, $EmailAdd, $pWord, $rePWord){        //4 parameters
//         //check duplicate of user name and email address,
//         //also check if the entered password is strong enough,
//         //and insert to db if its valid.
//         //If successful, prompt message that the account is created, and then run: header("Refresh:0);
//         if($registObj->pWordValidate($pWord, $rePWord) == true){
//             require_once 'Model/registration_model.php';
//             $registModelObj = new registModel($this->conn);
//             if($registModelObj->insertNewUser($uName, $EmailAdd, $pWord) == true){
//                 $_SESSION['accountCreated'] = "Account created successfully";
//             }
//         }
//         header("Refresh:0");
//     }
    
//     public function loadRegist(){
//         require_once 'View/registration_view.php';
//         unset($_SESSION['duplicateNameMessage']);
//         unset($_SESSION['dupNameValue']);
//         unset($_SESSION['duplicateEAddMessage']);
//         unset($_SESSION['dupEAddValue']);
//         unset($_SESSION['pWordError']);
//         unset($_SESSION['accountCreated']);
//     }
// }

?>