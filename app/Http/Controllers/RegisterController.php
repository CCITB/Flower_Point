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
        $s_tel1 = $request->input('seller_tel1');
        $s_tel2 = $request->input('seller_tel2');
        $s_tel3 = $request->input('seller_tel3');

        $s_tel = $s_tel1.'-'.$s_tel2.'-'.$s_tel3;

        DB::table('seller')->insert([
          's_id'=>$request->input('s_id'),
          's_password' => bcrypt($request->input('s_password')),
          's_name' => $request->input('s_name'),
          's_phonenum' => $request->$s_tel,
          's_email' => $request->input('s_email'),
          's_gender' => $request->input('s_gender'),
          's_birth' => $request->input('s_birth_y').$request->input('s_birth_m').$request->input('s_birth_d')
        ]);
        $datas =  $request->input('s_id');
        $sid = DB::table('seller')->where('s_id','=',$datas )->first();

        $s_num1 = $request->input('registeration_num1');
        $s_num2 = $request->input('registeration_num2');
        $s_num3 = $request->input('registeration_num3');
        $s_num = $s_num1.'-'.$s_num2.'-'.$s_num3;

        DB::table('store')->insert([
          'st_name'=>$request->input('st_name'),
          'st_tel' => $request->input('st_tel'),
          'st_address' => $request->input('st_address'),
          'st_registeration_num' => $s_num,
          'st_introduce' => $request->input('st_introduce'),
            'seller_no' =>  $sid->s_no
        ]);
        // return $sid->s_no;
        return redirect('/login_seller');
      }
    }
    //register jquery -- 어지수
    // public function s_overlapID(Request $request){
    //   $input = $request->input('id');
    //   $sellers = DB::table('seller')-> where('s_id','=',$input)->get()->count();
    //   return response()->json($sellers);
    // }
    public function s_overlap(Request $request)
    {
      $input = $request->input('id');
      $sellers = DB::table('seller')-> where('s_id','=',$input)->get()->count();
      return response()->json($sellers);
    }

    //[resister_seller jQuery부분] --어지수
    public function c_overlap(Request $request)
    {
      $input = $request->input('id');
      $customers = DB::table('customer')-> where('c_id','=',$input)->get()->count();
      return response()->json($customers);
    }
  }
