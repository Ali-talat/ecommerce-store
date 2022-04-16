<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        if(\auth()->guard('admin')->check()){
            return \redirect()->route('dashborad.index');
        }
        return \view('admin.auth.login');
    }

    public function postLogin(AdminLoginRequest $request){
        

        $remember_me = $request->has('remember_me') ? true : false ;
        if(\auth()->guard('admin')->attempt(['email'=>$request->email , 'password'=>$request->password],$remember_me)){
            return redirect()->route('dashborad.index');
        }else{
            return \redirect()->back()->with(['error'=>'هناك خطا بالبيانات']);
        }
    }
}
