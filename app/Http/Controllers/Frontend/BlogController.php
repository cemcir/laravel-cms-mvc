<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogController extends Controller
{
    public function index() {
        $data['blog']=Blogs::all()->sortBy('blog_must');
        return view('frontend.blog.index')->with('data',$data);
    }

    public function detail($slug) {
        $blogList=DB::table('blogs')->orderBy('blog_must','DESC')->get();
        $blog=Blogs::where('blog_slug','=',$slug)->first();
        if(isset($blog)) {
            return view('frontend.blog.detail',compact('blog','blogList')); 
        }
        else
            return response()->view('errors.404');
    }
}
