<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller{
    public function loadHomepage(Request $request)
    {
        
        $selectedChannelId = $request->input('channel_id');

        
        $channels = DB::table('user_channels')
            ->join('channel', 'user_channels.channel_id', '=', 'channel.id')
            ->where('user_channels.user_id', Auth::id())
            ->orderBy('user_channels.date_added', 'desc')
            ->select('channel.*', 'user_channels.date_added')
            ->get();

        
        $blogsQuery = DB::table('blogs')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->select('blogs.*', 'users.display_name', 'users.username')
            ->orderBy('blogs.date_created', 'desc');

        
        if ($selectedChannelId) {
            $blogsQuery->where('blogs.channel_id', $selectedChannelId);
        }

        $blogs = $blogsQuery->limit(100)->get();

        return view('homepage', compact('blogs', 'channels', 'selectedChannelId'));
    }
}
?>