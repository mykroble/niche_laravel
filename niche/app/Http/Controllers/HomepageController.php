<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller{
    public function loadHomepage(){
        $blogs = DB::table('blogs')->join('users', 'blogs.author_user_id', '=', 'users.id')->select('blogs.*', 'users.display_name', 'users.username')->orderBy('date_created', 'desc')->limit(100)->get();
        return view('homepage', compact('blogs'));
    }
}
?>