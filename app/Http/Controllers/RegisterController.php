<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

//어지수
class RegisterController extends Controller
{
  public function registerview()
  {
    return view('register');
  }

//customer register query -- 어지수
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

//seller register query -- 어지수
  public function seller_store(Request $request)
  {
    //동일 아이디 확인
    $input_id = trim($_POST['s_id']);
    $sellers = DB::table('seller')-> where('s_id','=',$input_id)->get()->count();

    //database insert
    if($sellers<1){
      DB::table('seller')->insert([
        's_id'=>$request->input('s_id'),
        's_password' => $request->input('s_password'),
        's_name' => $request->input('s_name'),
        's_phonenum' => $request->input('s_phonenum'),
        's_email' => $request->input('s_email'),
        's_gender' => $request->input('s_gender'),
        's_birth' => $request->input('s_birth')
      ]);
      return redirect('/information');
    }
    else{
      //code...
    }
  }

//[register_seller jQuery부분] ID중복검사 -- 어지수
  public function index(Request $request)
  {
    $input = $request->input('id');
    $sellers = DB::table('seller')-> where('s_id','=',$input)->get()->count();

    return response()->json($sellers);

    // if($input != NULL)
    // {
    //   if($sellers<1){
    //     return response()->json(['success'=>'아이디가 중복되지 않았습니다.']);
    //   }
    //   else{
    //     return response()->json(['success'=>'아이디가 중복됩니다.']);
    //   }
    // }
  }

}
