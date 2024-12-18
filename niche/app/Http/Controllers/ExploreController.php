<?php

namespace App\Http\Controllers;

use App\Models\user_channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExploreController extends Controller{
    public function loadExplore()
    {
        $userId = Auth::id();

        $blogsQuery = DB::table('blogs')
        ->join('users', 'blogs.author_user_id', '=', 'users.id')
        ->join('channel', 'blogs.channel_id', '=', 'channel.id')
        ->leftJoin('user_channels', function($join) use ($userId) {
            $join->on('user_channels.channel_id', '=', 'channel.id')
                ->where('user_channels.user_id', '=', $userId);
        })
        ->select('blogs.*', 'users.display_name', 'users.username', 'channel.id AS channelId', 'channel.title AS channelTitle', 'users.icon_file_path')
        ->whereNull('user_channels.channel_id')
        ->where('blogs.is_banned', 0)
        ->where('users.is_banned', 0)
        ->orderBy('blogs.date_created', 'desc');

        $blogs = $blogsQuery->limit(100)->get();

        $blogIds = $blogs->pluck('id');

        $images = DB::table('blog_images')
            ->whereIn('blog_id', $blogIds)
            ->select('*')
            ->get()
            ->groupBy('blog_id');

        return view('explore', compact('blogs', 'images'));
    }

    public function joinChannel(Request $request){
    
        $userId = Auth::id();
        $channelId = $request->input('channel-id');

        $existingSubscription = DB::table('user_channels')
        ->where('user_id', $userId)
        ->where('channel_id', $channelId)
        ->first();

        if(!$existingSubscription){
            user_channel::create([
                'user_id' => $userId,
                'channel_id' => $channelId,
                'date_added' => now(),
            ]);
        }

        return redirect()->back();
    }
}
?>