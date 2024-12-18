<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller{

    public function saveBlogSubmit(Request $request){

        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'channel' => 'required',
            'visibility' => 'required',
        ]);

        $timestamp = now();
        try {
            $blogId = DB::table('blogs')->insertGetId([
                'author_user_id' => Auth::id(),
                'title' => $request['title'],
                'content' => $request['content'],
                'date_created' => $timestamp,
                'date_last_updated' => $timestamp,
                'is_public' => $request['visibility'],
                'channel_id' => $request['channel'],
            ]);
        } catch (QueryException) {
            return back()->with('error', 'Failed to save blog');
        }

        $request->validate([
            'image_*' => 'nullable|file|image|max:2048'
        ]);

        $blogImageData = [];
        foreach ($request->allFiles() as $inputName => $file) {
            if (str_starts_with($inputName, 'image_')) {
                preg_match('/\d+/', $inputName, $matches);
                $imageId = $matches[0];
                $path = $file->store('blog_images', 'public');
                $blogImageData[] = ['blog_id' => $blogId, 'file_path' => 'storage/'.$path, 'image_id' => $imageId];
            }
        }

        $insertCheck = true;
        if(!empty($blogImageData)){
            $insertCheck = DB::table('blog_images')->insert($blogImageData);
        }

        if($insertCheck){
            return redirect()->route('viewBlog', ['value' => $blogId]);
        } else {
            return back()->with('error', 'Failed to upload images');
        }
    }

    public function createBlog(){

        $channels = DB::table('user_channels')
            ->join('channel', 'user_channels.channel_id', '=', 'channel.id')
            ->where('user_channels.user_id', Auth::id())
            ->orderBy('user_channels.id', 'asc')
            ->select('channel.*')
            ->get();
        
        return view('posteditor')->with('channels', $channels);
    }

    public function viewBlog($blogId){
        $blogData = DB::table('blogs')
            ->join('users', 'users.id', '=', 'blogs.author_user_id')
            ->select('blogs.*', 'users.username AS username')
            ->where('blogs.id', $blogId)
            ->where('blogs.is_banned', 0)
            ->where('users.is_banned', 0)
            ->first();
        if($blogData){
            $blogImages = DB::table('blog_images')->where('blog_id', $blogId)->get();
            return view('blogViewer', compact('blogData', 'blogImages'));
        } else {
            return view('blogViewer')->with('pageUnavailable');
        }
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');
    
        $blogs = DB::table('blogs')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->select('blogs.id', 'blogs.title', 'blogs.date_created', 'users.username')
            ->where('blogs.title', 'LIKE', '%' . $query . '%')
            ->where('blogs.is_banned', 0)
            ->where('users.is_banned', 0)
            ->orderBy('blogs.date_created', 'desc')
            ->get();
        return response()->json(['blogs' => $blogs]);
    }

}

?>