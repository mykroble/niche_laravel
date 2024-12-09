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
        ]);

        // $config = HTMLPurifier_Config::createDefault();
        // $config->set('HTML.Allowed', 'p,b,i,u,a[href],img[src|alt|width|height|data-*],span[style],div[style]');
        // $purifier = new HTMLPurifier($config);
        // $cleanContent = $purifier->purify($request['content']);

        $timestamp = now();
        try {
            $blogId = DB::table('blogs')->insertGetId([
                'author_user_id' => Auth::id(),
                'title' => $request['title'],
                'content' => $request['content'],
                'date_created' => $timestamp,
                'date_last_updated' => $timestamp,
                'is_public' => '1',
                'is_available' => '1',
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
                $blogImageData[] = ['blog_id' => $blogId, 'file_path' => $path, 'image_id' => $imageId];
            }
        }
        if(!empty($blogImageData)){
            $insertCheck = false;
            $insertCheck = DB::table('blog_images')->insert($blogImageData);
            if($insertCheck){
                return redirect()->route('homepage');
            } else {
                return back()->with('error', 'Failed to upload images');
            }
        }
    }

    public function createBlog(){
        
        // $userInput = '# header';
        // $converter = new CommonMarkConverter();
        // $htmlContent = $converter->convertToHtml($userInput);

        // return view('posteditor')->with('htmlContent',$htmlContent);
        return view('posteditor');
    }

    public function viewBlog($blogId){
        $blogData = DB::table('blogs')->where('id', $blogId)->first();
        $blogImages = DB::table('blog_images')->where('blog_id', $blogId)->get();
        return view('blogViewer', compact('blogData', 'blogImages'));
    }

}

?>