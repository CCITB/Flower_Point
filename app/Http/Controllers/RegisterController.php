<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
  public function registerview()
  {
    return view('register');
  }
  #customer register query
  public function customer_store(Request $request)
  {
    DB::table('customer')->insert([
      'c_id'=>$request->input('c_id'),
      'c_password' => $request->input('c_password'),
      'c_name' => $request->input('c_name'),
      'c_phonenum' => $request->input('c_phonenum'),
      'c_email' => $request->input('c_email'),
      'c_gender' => $request->input('c_gender'),
      'c_birth' => $request->input('c_birth')
    ]);
    return redirect('/login');
  }


  #seller register query
  public function seller_store(Request $request)
  {
    $sellers = trim($_POST['s_id']);
    $sellers_count = DB::table('seller')->where('s_id','=',$sellers)->get()->count();

    //id_cehck
    if($_POST['s_id'] != NULL){

      if($sellers_count<1){
        echo "존재하지 않는 아이디입니다.";
      }

      else{
        echo "존재하는 아이디입니다.";
      }

    }

    // //database insert
    // if($sellers_count<1){
    //   DB::table('seller')->insert([
    //     's_id'=>$request->input('s_id'),
    //     's_password' => $request->input('s_password'),
    //     's_name' => $request->input('s_name'),
    //     's_phonenum' => $request->input('s_phonenum'),
    //     's_email' => $request->input('s_email'),
    //     's_gender' => $request->input('s_gender'),
    //     's_birth' => $request->input('s_birth')
    //   ]);
    //   return redirect('/information');
    // }
    //
    // else {
    //    //code;
    // }

  }
}
