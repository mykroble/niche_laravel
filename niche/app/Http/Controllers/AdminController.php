<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{
    public function loadAdminPage()
    {
        
        // $usersQuery = DB::table('users')
        //     ->leftJoin('blogs', 'users.id', '=', 'blogs.author_user_id')
        //     ->select('users.id','users.username', 'users.email', 'users.display_name', 'users.age', 'users.is_admin', 'users.is_banned', DB::raw('COUNT(blogs.id) as blog_count'))
        //     ->groupBy('users.id','users.username', 'users.email', 'users.display_name', 'users.age', 'users.is_admin', 'users.is_banned',)
        //     ->orderBy('blog_count', 'desc');

        $usersQuery = DB::table('users')
            ->leftJoin('blogs', 'users.id', '=', 'blogs.author_user_id')
            ->select('users.id','users.username', 'users.email', 'users.display_name', 'users.age', 'users.is_admin', 'users.is_banned', DB::raw('MAX(blogs.date_last_updated) as latest_blog_date'))
            ->groupBy('users.id','users.username', 'users.email', 'users.display_name', 'users.age', 'users.is_admin', 'users.is_banned')
            ->orderByDesc('latest_blog_date');

        $users = $usersQuery->skip(0)->limit(100)->get();

        return view('admin', compact('users'));
    }

    public function loadUserPosts(Request $request){
        $userId = $request->input('userId');

        $blogsQuery = DB::table('blogs')
            ->where('author_user_id', $userId)
            ->orderBy('created_at', 'desc');
            
        $blogs = $blogsQuery->skip(0)->limit(100)->get();
        
        return view('admin-userPosts', compact($blogs));
    }
}
?>