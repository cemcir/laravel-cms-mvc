<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index() {
        return view('backend.default.index');
    }

    public function login() {
        return view('backend.default.login');
    }

    public function authenticate(Request $request) {
        $request->flashOnly(['email','remember_me']);
        
        $credentials=$request->only(['email','password']);
        $remember_me=$request->has('remember_me') ? true : false;
        if(Auth::attempt($credentials,$remember_me)){
            return redirect()->intended(route('nedmin.Index'));
        }
        return back()->with('error','Kullanıcı adı veya şifre yanlış');
    }

    public function logout() {
        Auth::logout();
        return redirect(route('nedmin.Login'))->with('success','Güvenli Çıkış Yapıldı');
    }
}
