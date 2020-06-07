<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{
  public function main(){
    $data = DB::table('product')->get();
    // $alldata = [$data,$imagepath];
    // return $data;
    return view('main',compact('data'));
  }
  public function login_customer(){
    if(auth()->guard('seller')->check()){
      return redirect('/');
    }
    if(auth()->guard('customer')->check()){
      return redirect('/');
    }
    return view('login.login_customer');
  }
  public function login_seller(){
    if(auth()->guard('customer')->check()){
      return redirect('/');
    }
    if(auth()->guard('seller')->check()){
      return redirect('/');
    }
    return view('login.login_seller');
  }
  public function register_costomer(){
    return view('register.register_customer');
  }
  public function register_seller(){
    return view('register.register_seller');
  }
  public function register_terms_customers(){
    return view('register.register_terms_customers');
  }
  public function register_terms_sellers(){
    return view('register.register_terms_sellers');
  }
  public function register_information(){
    return view('register.register_information');
  }
}
