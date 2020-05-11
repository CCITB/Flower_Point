<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
  public function main(){
      return view('index');
  }
  public function login(){
    return view('login');
  }
}
