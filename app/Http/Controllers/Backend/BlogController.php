<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\BlogPostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blogs;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['blog']= Blogs::orderBy('blog_must','ASC')->get();
        return view('backend.blogs.index',compact('data'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostRequest $request)
    {
        $blog=$request->except('_token');
        $request->flashExcept('_token','blog_file');
        if(strlen($request->blog_slug)>3) {
            $slug=Str::slug($request->blog_slug);
        }
        else {
            $slug=Str::slug($request->blog_title);
        }
        $blog['blog_slug']=$slug;
        if($request->hasFile('blog_file')) {
            $file_name=uniqid().'.'.$request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path('images/blogs'),$file_name);
            $blog['blog_file']=$file_name;
        }
        /*
        else {
            $file_name=null;
        }
        */
        $blogs=Blogs::insert($blog);
        if($blogs) {
            return redirect(route('blog.index'))->with('success','iþlem baþarýlý');
        }
        return back()->with('error','iþlem baþarýsýz');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogs=Blogs::where('id','=',$id)->first();
        return view('backend.blogs.edit',compact('blogs',$blogs));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostRequest $request, $id)
    {
        $file_exist=false;
        $blog=$request->except('_token','_method');
        $request->flashExcept(['_token','blog_file']);
        if(strlen($request->blog_slug)>3) {
            $slug=Str::slug($request->blog_slug);
        }
        else {
            $slug=Str::slug($request->blog_title);
        }
        $blog['blog_slug']=$slug;
        if($request->hasFile('blog_file')) {
            $file_name=uniqid().'.'.$request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path('images/blogs'),$file_name);
            $blog['blog_file']=$file_name;
            $file_exist=true;
        }
        else {
            $blog['blog_file']=Blogs::Where('id','=',$id)->first()->blog_file;
        }
        $file_name=Blogs::Where('id','=',$id)->first()->blog_file;
        $path='images/blogs/'.$file_name;
        
        $blogs=Blogs::Where('id','=',$id)->update($blog);
        if($blogs) {
            if(file_exists($path) && $file_exist==true) {
                @unlink(public_path($path));         
            }
            return redirect(route('blog.index'))->with('success','iþlem baþarýlý');
        }
        return back()->with('error','iþlem baþarýsýz');
    }
    
    //Deletes related a row from database with sending Id value 
    public function destroy($id)
    {
        $blog=Blogs::where('id','=',$id)->first();
        $file_name='images/blogs/'.$blog->blog_file;

        if($blog->delete()) {
            @unlink($file_name);
            return true;
        }    
        return false;
    }

    public function sortable() {

        foreach($_POST['item'] as $key=>$value) {
            $blogs=Blogs::find(intval($value));
            $blogs->blog_must=intval($key);
            $blogs->save();
        }
        echo true;
    }
    
}
