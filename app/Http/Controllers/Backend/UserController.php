<?php

namespace App\Http\Controllers\Backend;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserPutRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user']=User::orderBy('user_must','ASC')->get();
        return view('backend.users.index',compact('data'));
        //dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        $user=$request->except('_token');
        $request->flashExcept('_token','user_file','password');
        //dd($request->all());
        
        if($request->hasFile('user_file')) {
            $file_name=uniqid().'.'.$request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'),$file_name);
            $user['user_file']=$file_name;
        }
        else {
            $file_name=null;
        }
        $user['password']=Hash::make($request->password);
        $users=User::insert($user);
        if($users) {
            return redirect(route('user.index'))->with('success','İşlem Başarılı');
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
        $users=User::where('id','=',$id)->first();
        return view('backend.users.edit',compact('users',$users));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPutRequest $request, $id) 
    {
        $file_exist=false;
        $user=$request->except('_token','_method');
        $request->flashExcept(['_token','user_file','password']);
        if(strlen($user['password'])==0) {
            $user['password']=User::where('id','=',$id)->first()->password;
        }
        else {
            $request->validate(
                ['password'=>'required|min:6|regex:/[a-z]/'],
                [
                    'password.required'=>'şifre alanı boş bırakılamaz',
                    'password.min'=>'şifre alanı minimum 6 karakter olmalıdır',
                    'password.regex'=>'şifre en az bir tane küçük harf içermelidir'
                ]              
            );
            $user['password']=Hash::make($request->password);
        }
     
        if($request->hasFile('user_file')) {
            $file_name=uniqid().'.'.$request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'),$file_name);
            $user['user_file']=$file_name;
            $file_exist=true;
        }
        else {
            $user['user_file']=User::Where('id','=',$id)->first()->user_file;
        }
        $file_name=User::Where('id','=',$id)->first()->user_file;
        $path='images/users/'.$file_name;
        $users=User::Where('id','=',$id)->update($user);
        if($users) {
            if(file_exists($path) && $file_exist==true) {
                @unlink(public_path($path));         
            }
            return redirect(route('user.index'))->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız');
       
    }
    
    //Deletes related a row from database with sending Id value 
    public function destroy($id)
    {
        $user=User::where('id','=',$id)->first();
        $file_name=$user->user_file;
        $path='images/users/'.$file_name;
        if($user->delete()) {
            if(file_exists($path)) {
                @unlink($path);
            }
            return true;
        }    
        return false;
    }

    public function sortable() {

        foreach($_POST['item'] as $key=>$value) {
            $users=User::find(intval($value));
            $users->user_must=intval($key);
            $users->save();
        }
        echo true;
    }
}
