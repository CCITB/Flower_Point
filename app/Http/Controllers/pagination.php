<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class pagination extends Controller
{
  public function pages()
  {
      $myqna = DB::table('seller')->paginate(5);

      return view('myQna', ['myqn' => $myqna]);
  }

  public function postlist()
  {
      // $mypd = DB::table('product')->paginate(2);
      //
      // return view('post_list', ['mp' => $mypd]);

      // if(auth()->guard('seller')->check()){
      //   return view('post_list');
      // }
      // if(auth()->guard('customer')->check()){
      //   echo "<script>alert('잘못된요청입니다.')</script>";
      //   return redirect('/');
      // }
      // else
      // return view('login.login_seller');
  }



}
