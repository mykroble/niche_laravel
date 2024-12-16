<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class BookmarksController extends Controller
{
    public function addBookmark(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|integer|exists:blogs,id',
        ]);
        $existing = DB::table('bookmarks')
            ->where('user_id', Auth::id())
            ->where('blog_id', $request->blog_id)
            ->exists();

        if (!$existing) {
            DB::table('bookmarks')->insert([
                'user_id' => Auth::id(),
                'blog_id' => $request->blog_id,
                'date_added' => now(),
            ]);

            return redirect()->back()->with('success', 'Blog bookmarked successfully!');
        } else {
            return redirect()->back()->with('info', 'You already bookmarked this blog.');
        }
    }
    public function removeBookmark(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|integer|exists:blogs,id',
        ]);
        DB::table('bookmarks')
            ->where('user_id', Auth::id())
            ->where('blog_id', $request->blog_id)
            ->delete();
        return redirect()->route('bookmarks')->with('success', 'Bookmark removed successfully!');
    }
    public function toggleBookmark(Request $request){
        $request->validate([
            'blog_id' => 'required|integer|exists:blogs,id',
        ]);

        $userId = Auth::id();
        $blogId = $request->blog_id;

        $existing = DB::table('bookmarks')
            ->where('user_id', $userId)
            ->where('blog_id', $blogId)
            ->exists();

        if ($existing) {
            DB::table('bookmarks')
                ->where('user_id', $userId)
                ->where('blog_id', $blogId)
                ->delete();

            return response()->json(['status' => 'removed']);
        } else {
            DB::table('bookmarks')->insert([
                'user_id' => $userId,
                'blog_id' => $blogId,
                'date_added' => now(),
            ]);

            return response()->json(['status' => 'added']);
        }
    }

}
