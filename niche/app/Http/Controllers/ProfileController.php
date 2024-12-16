<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller{

    public function showProfPage(){
        return view('profile');
    }

    public function handleProfileForm1(Request $request)
    {
        $request->validate(
            [
                'display_name' => 'required|string|regex:/^(?=.*\S).+$/',
                'birthday' => 'required|before:now|date',
                'gender' => 'required',
                'email' => 'required|email|unique:users,email,' . auth()->id(),
                'password' => 'nullable|min:8', // Optional field for updating password
            ],
            [
                'display_name.required' => 'Display name is required.',
                'display_name.string' => 'Display name must be a string.',
                'display_name.regex' => 'Display name cannot be empty.',
                'birthday.required' => 'Birthday is required.', 
                'birthday.before' => 'Birthday must be before today.',
                'birthday.date' => 'Birthday must be a valid date.',
                'gender.required' => 'Gender is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Provide a valid email address.',
                'email.unique' => 'This email is already taken.',
                'password.min' => 'Password must be at least 8 characters long.',
            ]
        );
    
        // Prepare the data for updating
        $data = [
            'display_name' => $request->input('display_name'),
            'birthday' => $request->input('birthday'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
        ];
    
        // If a password is provided, hash it before updating
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }
    
        // Retrieve the currently authenticated user
        $user = auth()->user(); // Get the currently authenticated user
    
        if ($user) {
            $user->update($data); // Update the user record in the database
        } else {
            // Handle the case when the user is not authenticated
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
    
        return response()->json(['message' => 'Profile updated successfully.'], 200);
    }
    
    public function populatePosts(Request $request)
    {
        $userId = auth()->user(); // Get the currently authenticated user


        // Retrieve posts from the database for the given user ID
        $posts = DB::table('blogs') // Replace 'posts' with your actual table name
            ->where('user_id', $userId)
            ->get();

        // Return a view with the posts
        return view('components.posts', ['posts' => $posts]);
    }

    public function populateLikes(Request $request)
    {
        $userId = auth()->user(); // Get the currently authenticated user

        // Retrieve likes from the database for the given user ID
        $likes = DB::table('likes') // Replace 'likes' with your actual table name
            ->where('user_id', $userId)
            ->get();

        // Return a view with the likes
        return view('components.likes', ['likes' => $likes]);
    }
}




?>