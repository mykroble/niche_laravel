<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{
    public function loadAdminPage()
    {

        $this->authAdmin();
        
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

    public function loadUserPosts($userId){

        $this->authAdmin();

        $blogsQuery = DB::table('blogs')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->join('channel', 'blogs.channel_id', '=', 'channel.id')
            ->select('blogs.*', 'channel.title AS channel', 'users.username AS username')
            ->where('author_user_id', $userId)
            ->orderBy('created_at', 'desc');
            
        $blogs = $blogsQuery->skip(0)->limit(100)->get();
        
        return view('admin-userPosts', ['blogs' => $blogs]);
    }

    public function viewUserPost($blogId){

        $this->authAdmin();

        $blogData = DB::table('blogs')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->select('blogs.id', 'blogs.title', 'blogs.content', 'blogs.author_user_id', 'blogs.is_banned', 'users.username AS username')
            ->where('blogs.id', $blogId)
            ->first();

        $blogImages = DB::table('blog_images')
            ->where('blog_id', $blogId)
            ->get();

        return view('admin-viewPost', compact('blogData', 'blogImages'));
    }

    public function toggleBanPost($blogId){
        $this->authAdmin();

        $blog = DB::table('blogs')
            ->select('blogs.is_banned', 'blogs.author_user_id', 'blogs.title')
            ->where('blogs.id', $blogId)
            ->first();

        $toggled;

        if($blog->is_banned === 0){
            $toggled = 1;
        } else {
            $toggled = 0;
        }

        DB::table('blogs')
            ->where('blogs.id', $blogId)
            ->update(['blogs.is_banned' => $toggled]);

        return redirect()
            ->route('admin.userDetail', ['id' => $blog->author_user_id])
            ->with('successMessage', ''. $blog->title);
    }

    public function toggleBanUser($userId){
        $this->authAdmin();

        $user = DB::table('users')
            ->select('users.username', 'users.is_banned')
            ->where('users.id', $userId)
            ->first();

        $toggled;

        if($user->is_banned === 0){
            $toggled = 1;
        } else {
            $toggled = 0;
        }

        DB::table('users')
            ->where('users.id', $userId)
            ->update(['users.is_banned' => $toggled]);

        return redirect()
            ->route('adminPage')
            ->with('successMessage', ''. $user->username);
    }

    public function authAdmin(){
        
        if(!Auth::check() || Auth::user()->is_admin !== 1){
            abort(403, 'Unauthorized access');
        }

    }
}
?>