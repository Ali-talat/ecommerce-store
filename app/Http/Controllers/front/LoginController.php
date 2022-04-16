<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminLoginRequest;
use App\Http\Requests\FrontLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        if(\auth()->guard('user')->check()){
            return \redirect()->route('site.index');
        }
        return \view('auth.login');
    }

    public function postLogin(FrontLoginRequest $request){
        

        if(auth()->guard('user')->attempt(['email'=>$request->email , 'password'=>$request->password])){
            return redirect()->route('site.index');
        }else{
            return \redirect()->back()->with(['error'=>'هناك خطا بالبيانات']);
        }
    }
}
