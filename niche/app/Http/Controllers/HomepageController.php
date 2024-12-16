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
        
        $bookmarkedBlogIds = DB::table('bookmarks')
        ->where('user_id', Auth::id())
        ->pluck('blog_id')
        ->toArray();

    return view('homepage', compact('blogs', 'channels', 'selectedChannelId', 'bookmarkedBlogIds'));
    }
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
        ->orderBy('bookmarks.date_added', 'desc')
        ->get();

    return view('bookmarks', ['blogs' => $bookmarks]);
    }
}
?>