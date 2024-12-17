<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{
    public function loadAdminPage()
    {
        
        $usersQuery = DB::table('users')
            ->join('blogs', 'users.id', '=', 'blogs.id')
            ->select('users.*')
            ->orderby('COUNT(blogs.id)', 'desc');

        $users = $usersQuery->skip(0)->limit(100)->get();

        return view('admin', compact('users'));
    }
}
?>