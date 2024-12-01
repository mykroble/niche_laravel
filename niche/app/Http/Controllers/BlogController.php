<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Purify\Facades\Purify;

class BlogController extends Controller{

    public function saveBlogSubmit(Request $request){

        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string',
        ]);

        $purifiedContent = Purify::clean($request['content']);

        $timestamp = now();
        $blogId = DB::table('blogs')->insertGetId([
            'author_user_id' => Auth::id(),
            'title' => $request['title'],
            'content' => $purifiedContent,    //need validation
            'date_created' => $timestamp,
            'date_last_updated' => $timestamp,
            'is_public' => '1'
        ]);
        //save images

        $request->validate([
            'image_*' => 'nullable|file|image|max:2048'
        ]);

        $blogImageData = [];

        foreach ($request->allFiles() as $inputName => $file) {
            if (str_starts_with($inputName, 'image_')) {
                $path = $file->store('blog_images', 'public');
                $blogImageData[] = ['blog_id' => $blogId, 'file_path' => $path, 'alt' => ''];
            }
        }
        if(!empty($blogImageData)){
            $insertCheck = DB::table('blog_images')->insert($blogImageData);
        }
    }

    public function createBlogSubmit(){     //return user to empty blog.
        return view('posteditor');
    }

}

?>