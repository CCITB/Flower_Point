<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FindController extends Controller
{
  public function find_id(){
    return view('find_information.find_id');
  }

  public function find_pw(){
    return view('find_information.find_pw');
  }
  public function find_pw_way(){
    return view('find_information.find_pw_way');
  }

  public function find_pw_reset(){
    return view('find_information.find_pw_reset');
  }

  public function find_check(){
    return view('find_information.find_check');
  }

}
