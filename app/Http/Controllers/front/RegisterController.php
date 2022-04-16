<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminLoginRequest;
use App\Http\Requests\FrontLoginRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
       
        return $request ;
    }
}
