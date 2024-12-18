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

    public function destroy($id)
    {
        $user = Auth::user();
        $post = Blog::find($id);

        if (!$post || $post->author_user_id !== $user->id) {
            return redirect()->route('profile')->with('error', 'You can only delete your own posts.');
        }

        $post->delete();

        return redirect()->route('profile')->with('success', 'Post deleted successfully.');
    }

    
    public function toggleLike(Request $request)
    {
        $blogId = $request->input('blog_id');
        $userId = Auth::id();

        $existingLike = DB::table('likes')
            ->where('user_id', $userId)
            ->where('blog_id', $blogId)
            ->first();

        if ($existingLike) {
            DB::table('likes')
                ->where('user_id', $userId)
                ->where('blog_id', $blogId)
                ->delete();

            $status = 'unliked';
        } else {
            DB::table('likes')->insert([
                'user_id' => $userId,
                'blog_id' => $blogId,
                'date_added' => now(),
            ]);

            $status = 'liked';
        }

        $likeCount = DB::table('likes')
            ->where('blog_id', $blogId)
            ->count();

        return response()->json(['status' => $status, 'likeCount' => $likeCount]);
    }

    public function profile()
    {
        $userId = Auth::id();

        $blogs = DB::table('blogs')->get();

        $likedBlogIds = DB::table('likes')
            ->where('user_id', $userId)
            ->pluck('blog_id')
            ->toArray();

        $likeCounts = DB::table('likes')
            ->select('blog_id', DB::raw('COUNT(*) as count'))
            ->groupBy('blog_id')
            ->pluck('count', 'blog_id')
            ->toArray();

        $authUserLikedBlogs = DB::table('likes')
            ->where('user_id', Auth::id())
            ->pluck('blog_id')
            ->toArray();

        return view('homepage', compact('blogs', 'likedBlogIds', 'likeCounts', 'authUserLikedBlogs'));
    }
}

