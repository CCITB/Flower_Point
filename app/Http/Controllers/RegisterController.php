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
      'c_password' => bcrypt($request->input('c_password')),
      'c_name' => $request->input('c_name'),
      'c_phonenum' => $request->input('c_phonenum'),
      'c_email' => $request->input('c_email'),
      'c_gender' => $request->input('c_gender'),
      'c_birth' => $request->input('c_birth_y').$request->input('c_birth_m').$request->input('c_birth_d')]);
      return redirect('/login_customer');
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
          's_password' => bcrypt($request->input('s_password')),
          's_name' => $request->input('s_name'),
          's_phonenum' => $request->input('s_phonenum'),
          's_email' => $request->input('s_email'),
          's_gender' => $request->input('s_gender'),
          's_birth' => $request->input('s_birth_y').$request->input('s_birth_m').$request->input('s_birth_d')
        ]);
        return redirect('/login_seller');
      }
      else{
        //code...
      }
    }
    //register jquery -- 어지수
    public function s_overlapID(Request $request){
      $input = $request->input('id');
      $sellers = DB::table('seller')-> where('s_id','=',$input)->get()->count();
      return response()->json($sellers);
    }
    public function s_overlap(Request $request)
    {
      $overlap_pw = $request->input('pw');
      return response()->json($overlap_pw);

      $overlap_ck = $request->input('check');
      return response()->json($overlap_ck);

      $overlap_name = $request->input('name');
      return response()->json($overlap_name);

      $overlap_birth_y = $request->input('s_birth_y');
      return response()->json($overlap_birth_y);

      $overlap_birth_m = $request->input('s_birth_m');
      return response()->json($overlap_birth_m);

      $overlap_birth_d = $request->input('s_birth_d');
      return response()->json($overlap_birth_d);

      $overlap_s_gender = $request->input('s_gender');
      return response()->json($overlap_s_gender);

      $overlap_s_email = $request->input('s_email');
      return response()->json($overlap_s_email);
    }

    //[resister_seller jQuery부분] --어지수
    public function c_overlap(Request $request)
    {
      $input = $request->input('id');
      $customers = DB::table('customer')-> where('c_id','=',$input)->get()->count();
      return response()->json($customers);

      $overlap_pw2 = $request->input('pw');
      return response()->json($overlap_pw2);

      $overlap_name = $request->input('name');
      return response()->json($overlap_name);

      $overlap_birth_y = $request->input('c_birth_y');
      return response()->json($overlap_birth_y);

      $overlap_birth_m = $request->input('c_birth_m');
      return response()->json($overlap_birth_m);

      $overlap_birth_d = $request->input('c_birth_d');
      return response()->json($overlap_birth_d);

      $overlap_s_gender = $request->input('c_gender');
      return response()->json($overlap_s_gender);

      $overlap_s_email = $request->input('c_email');
      return response()->json($overlap_s_email);
    }
