<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog; // Import Blog model
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
    // Validate the form data
    $request->validate([
        'display_name' => 'required|string|regex:/^(?=.*\S).+$/',
        'birthday' => 'required|before:now|date',
        'gender' => 'required',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
        'password' => 'nullable|min:8', // Optional field for updating password
    ]);

    // Prepare the data to update
    $data = [
        'display_name' => $request->input('display_name'),
        'birthday' => $request->input('birthday'),
        'gender' => $request->input('gender'),
        'email' => $request->input('email'),
    ];

    // If the password is provided, update it
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->input('password'));
    }

    // Get the authenticated user
    $user = auth()->user();

    if ($user) {
        $user->update($data); // Update the user's profile
    } else {
        return redirect()->route('login')->withErrors(['error' => 'User not authenticated.']);
    }

    // Redirect back to the profile page with a success message
    return redirect()->route('profile')->with('success', 'Profile updated successfully.');
}
        
    public function destroy($id)
    {
        $user = Auth::user();

        // Find the post by ID
        $post = Blog::find($id); // Make sure Blog model is imported

        // Check if the post exists and if the authenticated user is the author
        if (!$post || $post->author_user_id !== $user->id) {
            return redirect()->route('profile')->with('error', 'You can only delete your own posts.');
        }

        // Delete the post
        $post->delete();

        // Redirect back to the profile page with a success message
        return redirect()->route('profile')->with('success', 'Post deleted successfully.');
    }
}
