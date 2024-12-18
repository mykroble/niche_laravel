<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    // 1. Load Homepage with channels, blogs, and bookmarked blogs
    public function loadHomepage(Request $request)
    {
        $selectedChannelId = $request->input('channel_id');

        // Retrieve channels the user has joined
        $channels = DB::table('user_channels')
            ->join('channel', 'user_channels.channel_id', '=', 'channel.id')
            ->where('user_channels.user_id', Auth::id())
            ->orderBy('user_channels.id', 'asc')
            ->select('channel.*', 'user_channels.date_added')
            ->get();

        
        $blogsQuery = DB::table('blogs')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->join('channel', 'blogs.channel_id', '=', 'channel.id')
            ->join('user_channels', 'blogs.channel_id', '=', 'user_channels.channel_id')
            ->where('user_channels.user_id', Auth::id())

            ->select('blogs.*', 'users.display_name', 'users.username', 'channel.title AS channelTitle')
            ->orderBy('blogs.date_created', 'desc');


            
        if ($selectedChannelId) {
            $blogsQuery->where('blogs.channel_id', $selectedChannelId);
        }

        $blogs = $blogsQuery->limit(100)->get();
        
        $bookmarkedBlogIds = DB::table('bookmarks')
            ->where('user_id', Auth::id())
            ->pluck('blog_id')
            ->toArray();

    return view('homepage', compact('blogs', 'channels', 'selectedChannelId', 'bookmarkedBlogIds'));
    }
    public function bookmarkBlog(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|integer',
            'comment_content' => 'required|string|max:255',
        ]);

        $channelId = $request->input('channel_id');

        // Insert the new message into the live_chats table
        $messageId = DB::table('live_chats')->insertGetId([
            'channel_id' => $channelId,
            'user_id' => Auth::id(),
            'comment_content' => $request->input('comment_content'),
            'created_at' => now(),
        ]);

        // Retrieve the inserted message with the sender's username
        $newMessage = DB::table('live_chats')
            ->join('users', 'live_chats.user_id', '=', 'users.id')
            ->where('live_chats.id', $messageId)
            ->select('live_chats.*', 'users.display_name as username')
            ->first();

        return response()->json($newMessage);
    }
    public function showBookmarks(){
        $bookmarks = DB::table('bookmarks')
        ->join('blogs', 'bookmarks.blog_id', '=', 'blogs.id')
        ->join('users', 'blogs.author_user_id', '=', 'users.id')
        ->select(
            'blogs.id',
            'blogs.title',
            'blogs.content',
            'blogs.date_created',
            'users.username',
            'users.display_name'
        )
        ->where('bookmarks.user_id', Auth::id())
        ->where('blogs.is_banned', 0)
        ->where('users.is_banned', 0)
        ->orderBy('bookmarks.date_added', 'desc')
        ->get();

    return view('bookmarks', ['blogs' => $bookmarks]);
    }
}
