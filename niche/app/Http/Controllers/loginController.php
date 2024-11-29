<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller{

    public function showLoginPage(){
        $imageSources = $this->getImageSources();
        return view('login', compact('imageSources'));
    }
    
    public function getImageSources(){
        return[
            asset('pics/collecting-vinyls.jpg'),
            asset('pics/gardening.jpg'),
            asset('pics/painting.jpg'),
            asset('pics/yoga.jpg'),
            asset('pics/photocards.jpeg')
        ];
    }

    public function handleLoginSubmit(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $arr = $request->only('email', 'password');

        if(Auth::attempt($arr, $request->has('remember'))){
            return redirect()->intended('homepage');
        } else {
            return redirect()->back()
                ->withErrors(['password' => 'Invalid credentials. Please try again.'])
                ->withInput($request->only('email'));
        }

    }

    public function handleLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

?>