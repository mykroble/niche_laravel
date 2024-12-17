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

        // Retrieve blogs based on selected channel or all joined channels
        $blogsQuery = DB::table('blogs')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->join('channel', 'blogs.channel_id', '=', 'channel.id')
            ->join('user_channels', 'blogs.channel_id', '=', 'user_channels.channel_id')
            ->where('user_channels.user_id', Auth::id())
            ->select('blogs.*', 'users.display_name', 'users.username', 'channel.title AS channelTitle')
            ->orderBy('blogs.date_created', 'asc');

        if ($selectedChannelId) {
            $blogsQuery->where('blogs.channel_id', $selectedChannelId);
        }

        $blogs = $blogsQuery->limit(100)->get();

        // Bookmarked blogs
        $bookmarkedBlogIds = DB::table('bookmarks')
            ->where('user_id', Auth::id())
            ->pluck('blog_id')
            ->toArray();

        return view('homepage', compact('blogs', 'channels', 'selectedChannelId', 'bookmarkedBlogIds'));
    }

    // 2. Send a message to a specific channel
    public function sendMessage(Request $request)
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

    // 3. Fetch initial chat messages for a specific channel
    public function getMessages(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|integer',
        ]);

        $channelId = $request->input('channel_id');

        // Retrieve the last 50 messages for the selected channel
        $messages = DB::table('live_chats')
            ->join('users', 'live_chats.user_id', '=', 'users.id')
            ->where('live_chats.channel_id', $channelId)
            ->select('live_chats.*', 'users.display_name as username')
            ->orderBy('live_chats.created_at', 'asc')
            ->limit(50)
            ->get();

        return response()->json($messages);
    }

    // 4. Poll for new messages in a channel
    public function fetchNewMessages(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|integer',
            'last_message_id' => 'nullable|integer',
        ]);

        $channelId = $request->input('channel_id');
        $lastMessageId = $request->input('last_message_id') ?? 0;

        // Retrieve new messages based on the last seen message ID
        $newMessages = DB::table('live_chats')
            ->join('users', 'live_chats.user_id', '=', 'users.id')
            ->where('live_chats.channel_id', $channelId)
            ->where('live_chats.id', '>', $lastMessageId)
            ->select('live_chats.*', 'users.display_name as username')
            ->orderBy('live_chats.created_at', 'asc')
            ->get();

        return response()->json($newMessages);
    }
}
