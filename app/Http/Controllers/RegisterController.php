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
  #seller register query
  public function seller_store(Request $request)
  {
    //동일 아이디 확인
    $input_id = trim($_POST['s_id']);
    $sellers = DB::table('seller')-> where('s_id','=',$input_id)->get()->count();

    $s_birth_array = array();
    $s_birth_array[0] = trim($_POST['s_birth_y']);
    $s_birth_array[1] = trim($_POST['s_birth_m']);
    $s_birth_array[2] = trim($_POST['s_birth_d']);

    $s_birth = implode($s_birth_array);

    //database insert
    if($sellers<1){
      DB::table('seller')->insert([
        's_id'=>$request->input('s_id'),
        's_password' => $request->input('s_password'),
        's_name' => $request->input('s_name'),
        's_phonenum' => $request->input('s_phonenum'),
        's_email' => $request->input('s_email'),
        's_gender' => $request->input('s_gender'),
        's_birth' => $request->input($s_birth)
      ]);
      return redirect('/information');
    }
    else{
      //code...
    }
  }
  //[resister_seller jQuery부분] PW일치여부 -- 어지수
  public function s_overlap(Request $request)
  {
    $overlap_pw = $request->input('pw');
    return response()->json($overlap_pw);

    $overlap_name = $request->input('name');
    return response()->json($overlap_name);
  }

  //[register_seller jQuery부분] ID중복검사 -- 어지수
  public function s_overlapID(Request $request)
  {
    $input = $request->input('id');
    $sellers = DB::table('seller')-> where('s_id','=',$input)->get()->count();
    return response()->json($sellers);
  }


  //[resister_seller jQuery부분] PW일치여부 -- 어지수
  public function c_overlapPW(Request $request)
  {
    $overlap_pw2 = $request->input('pw');
    return response()->json($overlap_pw2);
  }

  //[register_customer jQuery부분] ID중복 검사 --어지수
  public function c_overlapID(Request $request)
  {
    $input = $request->input('id');
    $customers = DB::table('customer')-> where('c_id','=',$input)->get()->count();
    return response()->json($customers);
  }


  public function login_s(Request $login)//$login 가 form에 있는 모든 값을 가지고 있음
  {
    $seller_id = $login->get('login_id');
    $seller_pw = $login->get('login_pw');
    $db_seller = DB::table('seller')->select('s_id','s_password')->where([
      's_id'=>$seller_id,
      's_password'=>$seller_pw
      ])->get();


      if(count($db_seller)>0){
        session()->put('iding',$seller_id);

        return view('main');
      }else {
        return redirect('/login_seller');
      }

    }

    public function login_c(Request $login)
    {
      $customer_id = $login->get('login_id');
      $customer_pw = $login->get('login_pw');
      $db_customer = DB::table('customer')->select('c_id','c_password')->where([
        'c_id'=>$customer_id,
        'c_password'=>$customer_pw
        ])->get();

        if(count($db_customer)>0){
          session()->put('iding',$customer_id);

          return view('main');
        }else {
          return redirect('/login_customer');
        }

      }


      public function logout(Request $logout)
      {
        session()->forget('iding');
        return redirect('/');
      }
    }
