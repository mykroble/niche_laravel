<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            $user = DB::table('users')
                ->select('is_admin')
                ->where('email', '=', $arr['email'])
                ->first();

            if($user && $user->is_admin === 1){
                return redirect()->route('adminPage');
            } else{
                return redirect()->route('homepage');
            }
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