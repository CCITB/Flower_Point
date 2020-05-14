<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function find_id(){
        return view('find_id');
    }

    public function find_pw(){
        return view('find_password');
    }


}
