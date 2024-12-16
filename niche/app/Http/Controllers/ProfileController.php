<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfPage(Request $request)
{
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->withErrors(['error' => 'User not authenticated.']);
    }

    // Retrieve posts for the authenticated user
    $blogs = DB::table('blogs')
        ->join('users', 'blogs.author_user_id', '=', 'users.id')
        ->select('blogs.*', 'users.display_name', 'users.username')
        ->where('blogs.author_user_id', $user->id)
        ->orderBy('blogs.date_created', 'desc')
        ->get();

    // Retrieve user profile data
    $userDetails = DB::table('users')
        ->select('username', 'email', 'display_name', 'birthday', 'gender')
        ->where('id', $user->id)
        ->first();

    // Calculate age if the birthday exists
    if ($userDetails && $userDetails->birthday) {
        $birthday = new \Carbon\Carbon($userDetails->birthday);
        $userDetails->age = $birthday->age;
    } else {
        $userDetails->age = null;
    }

    return view('profile', [
        'blogs' => $blogs, 
        'userDetails' => $userDetails
    ]);
}

public function handleProfileForm1(Request $request)
{
    $request->validate([
        'display_name' => 'required|string|regex:/^(?=.*\S).+$/',
        'birthday' => 'required|before:now|date',
        'gender' => 'required',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
        'password' => 'nullable|min:8', // Optional field for updating password
    ]);

    $data = [
        'display_name' => $request->input('display_name'),
        'birthday' => $request->input('birthday'),
        'gender' => $request->input('gender'),
        'email' => $request->input('email'),
    ];

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->input('password'));
    }

    $user = auth()->user();
    
    if ($user) {
        $user->update($data); // Update user record
    } else {
        return response()->json(['error' => 'User not authenticated.'], 401);
    }

    return response()->json(['message' => 'Profile updated successfully.'], 200);
}
        

}
