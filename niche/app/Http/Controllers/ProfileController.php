<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog; 
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
        $likedBlogIds = DB::table('likes')
        ->where('user_id', Auth::id())
        ->pluck('blog_id')
        ->toArray();
        
        $likeCounts = DB::table('likes')
            ->select('blog_id', DB::raw('COUNT(*) as count'))
            ->groupBy('blog_id')
            ->pluck('count', 'blog_id')
            ->toArray();
        return view('profile', [
            'blogs' => $blogs, 
            'userDetails' => $userDetails, 
            'likedBlogIds' => $likedBlogIds, 
            'likeCounts' => $likeCounts
        ]);
    }


    public function handleProfileForm1(Request $request)
    {
        $request->validate([
            'display_name' => 'required|string|regex:/^(?=.*\S).+$/',
            'birthday' => 'required|before:now|date',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:8', 
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
            $user->update($data);
        } else {
            return redirect()->route('login')->withErrors(['error' => 'User not authenticated.']);
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
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

    $post = Blog::find($id);

    if (!$post) {
        return redirect()->back()->withErrors(['error' => 'Post not found.']);
    }

    if ($post->author_user_id !== $user->id) {
        return redirect()->back()->withErrors(['error' => 'You can only delete your own posts.']);
    }
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $post = Blog::find($id);

        if (!$post || $post->author_user_id !== $user->id) {
            return redirect()->route('profile')->with('error', 'You can only delete your own posts.');
        }

    $post->delete();

    return redirect()->back()->with('success', 'Post deleted successfully.');
}


}

