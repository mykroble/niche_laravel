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
            ->orderBy('user_channels.id', 'asc')
            ->select('channel.*', 'user_channels.date_added')
            ->get();

            
        $blogsQuery = DB::table('blogs')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->join('channel', 'blogs.channel_id', '=', 'channel.id')
            ->join('user_channels', 'blogs.channel_id', '=', 'user_channels.channel_id')
            ->where('user_channels.user_id', Auth::id())
            ->select('blogs.*', 'users.display_name', 'users.username', 'users.icon_file_path', 'channel.title AS channelTitle')
            ->orderBy('blogs.date_created', 'desc');
            
        if ($selectedChannelId) {
            $blogsQuery->where('blogs.channel_id', $selectedChannelId);
        }

        $blogs = $blogsQuery->limit(100)->get();
            
        $blogIds = $blogs->pluck('id');

        $images = DB::table('blog_images')
            ->whereIn('blog_id', $blogIds)
            ->select('*')
            ->get()
            ->groupBy('blog_id');
        
        $bookmarkedBlogIds = DB::table('bookmarks')
            ->where('user_id', Auth::id())
            ->pluck('blog_id')
            ->toArray();

    return view('homepage', compact('blogs', 'images', 'channels', 'selectedChannelId', 'bookmarkedBlogIds'));
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
        ->join('channel', 'channel.id', '=', 'bookmarks.id')
        ->join('blogs', 'bookmarks.blog_id', '=', 'blogs.id')
        ->join('users', 'blogs.author_user_id', '=', 'users.id')
        ->select(
            'blogs.id',
            'blogs.title',
            'blogs.content',
            'blogs.date_created',
            'users.username',
            'users.display_name',
            'users.icon_file_path',
            'channel.title as channel'
        )
        ->where('bookmarks.user_id', Auth::id())
        ->orderBy('bookmarks.date_added', 'desc')
        ->limit(100)
        ->get();

        $blogIds = $bookmarks->pluck('id');

        $images = DB::table('blog_images')
            ->whereIn('blog_id', $blogIds)
            ->select('*')
            ->get()
            ->groupBy('blog_id');

    return view('bookmarks', ['blogs' => $bookmarks], compact('images'));
    }
}
?>