<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\BlogPostRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderPostRequest;
use App\Http\Requests\SliderPutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Sliders;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['slider']= Sliders::orderBy('slider_must','ASC')->get();
        return view('backend.sliders.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderPostRequest $request)
    {
        $slider=$request->except('_token');
        $request->flashExcept('_token','slider_file');
        if(strlen($request->slider_slug)>3) {
            $slug=Str::slug($request->slider_slug);
        }
        else {
            $slug=Str::slug($request->slider_title);
        }
        $slider['slider_slug']=$slug;
        if($request->hasFile('slider_file')) {
            $file_name=uniqid().'.'.$request->slider_file->getClientOriginalExtension();
            $request->slider_file->move(public_path('images/sliders'),$file_name);
            $slider['slider_file']=$file_name;
        }
        /*
        else {
            $file_name=null;
        }
        */
        $sliders=Sliders::insert($slider);
        if($sliders) {
            return redirect(route('slider.index'))->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliders=Sliders::where('id','=',$id)->first();
        return view('backend.sliders.edit',compact('sliders',$sliders));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderPutRequest $request, $id)
    {
        $file_exist=false;
        $slider=$request->except('_token','_method');
        $request->flashExcept(['_token','slider_file']);
        if(strlen($request->slider_slug)>3) {
            $slug=Str::slug($request->slider_slug);
        }
        else {
            $slug=Str::slug($request->slider_title);
        }
        $slider['slider_slug']=$slug;
        if($request->hasFile('slider_file')) {
            $file_name=uniqid().'.'.$request->slider_file->getClientOriginalExtension();
            $request->slider_file->move(public_path('images/sliders'),$file_name);
            $slider['slider_file']=$file_name;
            $file_exist=true;
        }
        else {
            $slider['slider_file']=Sliders::Where('id','=',$id)->first()->slider_file;
        }
        $file_name=Sliders::Where('id','=',$id)->first()->slider_file;
        $path='images/sliders/'.$file_name;
        $sliders=Sliders::Where('id','=',$id)->update($slider);
        if($sliders) {
            if(file_exists($path) && $file_exist==true) {
                @unlink(public_path($path));         
            }
            return redirect(route('slider.index'))->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız');
    }
    
    //Deletes related a row from database with sending Id value 
    public function destroy($id)
    {
        $slider=Sliders::where('id','=',$id)->first();
        $file_name='images/sliders/'.$slider->slider_file;
        if($slider->delete()) {
            @unlink($file_name);
            return true;
        }    
        return false;
    }

    public function sortable() {

        foreach($_POST['item'] as $key=>$value) {
            $sliders=Sliders::find(intval($value));
            $sliders->slider_must=intval($key);
            $sliders->save();
        }
        echo true;
    }
    
}
