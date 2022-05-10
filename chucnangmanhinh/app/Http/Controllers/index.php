<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class index extends Controller
{
    public function AuthLogin(){
        $user_id = session()->get('user_id');
        if($user_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('/login')->send();
        }
    }
    public function trangchu(){
        $this->AuthLogin();
        return view('index');
    }
}
