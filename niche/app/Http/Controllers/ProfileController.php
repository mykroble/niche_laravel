<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller{

    public function showProfPage(){
        return view('profile');
    }

    public function handleProfileForm1(Request $request){
        $request->validate(
            [
                'disp_name' => 'required|string|regex:/^(?=.*\S).+$/',
                'birthday' => 'required|before:now|date',
                'gender' => 'required',
                'country' => 'required'
            ],
            [
                'disp_name.required' => '',
                'disp_name.string' => '',
                'disp_name.regex' => '',
                'birthday.required' => '',
                'birthday.before' => '',
                'birthday.date' => '',
                'gender.required' => '',
                'country.required' => '',
            ]
        );
        $data = [
            'display_name' => $request->input('disp_name'),
            'birthday' => $request->input('birthday'),
            'gender' => $request->input('gender'),
            'country' => $request->input('country')
        ];
        

        $user = User::find($id); 

        if ($user) {
            $user->update($data); 
        } else {
            // Handle the case when the user is not found, e.g., return an error
        }
        

        // temporary php code will update later to include sesssion data for user update 
        // - dale 
    }
}



?>