<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class login_index extends Controller
{
    public function login_index(){
        return view('login');
    }
    public function logout_index(){
        session()->put('user_name', null);
        session()->put('user_id', null);
        return Redirect::to('/login');
    }
}
