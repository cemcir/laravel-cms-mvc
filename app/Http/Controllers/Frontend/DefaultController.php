<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ContactPostRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Models\Blogs;
use App\Mail\SendMail;


class DefaultController extends Controller
{
    public function index() {
        $data['blog']=Blogs::all()->sortBy('blog_must');
        $data['slider']=Sliders::all()->sortBy('slider_must');
        return view('frontend.default.index',compact('data',$data));
    }
    
    public function contact() {
        
        return view('frontend.default.contact');
    }
    
    public function sendMail(ContactPostRequest $request) {
        
        $request->flashExcept(['_token','phone','email']);
        
        $data=$request->except(['_token']);
        
        Mail::to('enescemcir1994@gmail.com')->send(new SendMail($data));
        return back()->with('success','Mail Başarıyla gönderildi');
    }
}
