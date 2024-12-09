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
            '' => '',
            '' => '',
            '' => ''
        ];

        $user = User::create($data);

        //do checking and redirect and stuff, too tired ill sleep. ITS 2 AM AHHHH
    }
}



?>