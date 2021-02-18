<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;

class PageController extends Controller
{
    public function detail($slug) {
        //$blogList=DB::table('blogs')->orderBy('blog_must','DESC')->get();
        $pageList=Pages::all()->sortBy('page_must');
        $page=Pages::where('page_slug','=',$slug)->first();
        if(isset($page)) {
            return view('frontend.page.detail',compact('page','pageList')); 
        }
        else
            return response()->view('errors.404');
    }
}
