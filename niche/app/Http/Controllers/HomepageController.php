<?php

namespace App\Http\Controllers;
use App\Models\LiveChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    // Load Homepage with channels, blogs, and bookmarked blogs
    public function loadHomepage(Request $request)
    {
        $selectedChannelId = $request->input('channel_id'); // Capture selected channel
    
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
            ->where('blogs.is_banned', 0)
            ->where('users.is_banned', 0)
            ->select('blogs.*', 'users.display_name', 'users.username', 'users.icon_file_path', 'channel.title AS channelTitle')
            ->orderBy('blogs.date_created', 'desc');
    
        if ($selectedChannelId) {
            $blogsQuery->where('blogs.channel_id', $selectedChannelId);
        }
    
        $blogs = $blogsQuery->limit(100)->get();
    
        // Retrieve bookmarked blog IDs
        $bookmarkedBlogIds = DB::table('bookmarks')
            ->where('user_id', Auth::id())
            ->pluck('blog_id')
            ->toArray();
    
        // Fetch messages for the selected channel (if available)
        $messages = [];
        if ($selectedChannelId) {
            $messages = DB::table('live_chats')
                ->join('users', 'live_chats.user_id', '=', 'users.id')
                ->where('live_chats.channel_id', $selectedChannelId)
                ->select('live_chats.*', 'users.display_name as username')
                ->orderBy('live_chats.created_at', 'asc')
                ->get();
        }
    
        return view('homepage', compact('blogs', 'channels', 'selectedChannelId', 'bookmarkedBlogIds', 'messages'));
    }
    

    // Bookmark a blog
    public function bookmarkBlog(Request $request)
    {
        $blogId = $request->input('blog_id');
        $userId = Auth::id();

        $alreadyBookmarked = DB::table('bookmarks')
            ->where('user_id', $userId)
            ->where('blog_id', $blogId)
            ->exists();

        if (!$alreadyBookmarked) {
            DB::table('bookmarks')->insert([
                'user_id' => $userId,
                'blog_id' => $blogId,
                'date_added' => now(),
            ]);
        }

        return response()->json(['success' => true]);
    }

    // Show bookmarked blogs
    public function showBookmarks()
    {
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
