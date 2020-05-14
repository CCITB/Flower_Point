<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
  public function main(){
    return view('main');
  }
  public function login_customer(){
    return view('login.login_customer');
  }
  public function login_seller(){
    return view('login.login_seller');
  }
  public function register_costomer(){
    return view('register.register_customer');
  }
  public function register_seller(){
    return view('register.register_seller');
  }
}
