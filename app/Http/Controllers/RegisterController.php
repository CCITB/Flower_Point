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
    //동일 아이디 확인
    $input_cid = trim($_POST['c_id']);
    $customers = DB::table('customer')-> where('c_id','=',$input_cid)->get()->count();

    if($customers<1){
      DB::table('customer')->insert([
        'c_id'=>$request->input('c_id'),
        'c_password' => $request->input('c_password'),
        'c_name' => $request->input('c_name'),
        'c_phonenum' => $request->input('c_phonenum'),
        'c_address'=> $request->input('c_address'),
        'c_email' => $request->input('c_email'),
        'c_gender' => $request->input('c_gender'),
        'c_birth' => $request->input('c_birth')
      ]);
      return redirect('/login_customer');
    }
  }

  //seller register query -- 어지수
  public function seller_store(Request $request)
  {
    //동일 아이디 확인
    $input_sid = trim($_POST['s_id']);
    $sellers = DB::table('seller')-> where('s_id','=',$input_sid)->get()->count();

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
  }

  //[register_seller jQuery부분] ID중복검사 -- 어지수
  public function overlapID(Request $request)
  {
    $overlap_id = $request->input('id');
    $sellers = DB::table('seller')-> where('s_id','=',$overlap_id)->get()->count();
    return response()->json($sellers);
  }

  //[resister_seller jQuery부분] PW일치여부 -- 어지수
  // public function overlapPW(Request $request)
  // {
  //   $overlap_pw = $request->input('pw');
  //   return response()->json($overlap_pw);
  // }

  //insert stroe table -- 어지수
  public function store_information(Request $request)
  {

    //동일 매장 확인
    $input_stname = trim($_POST['st_name']);
    $stores = DB::table('store')-> where('st_name','=',$input_stname)->get()->count();

    if($stores<1){
      DB::table('store')->insert([
        'st_name'=>$request->input('st_name'),
        'registeration_num' => $request->input('st_registeration_num'),
        'st_address' => $request->input('st_address'),
        'st_tel' => $request->input('st_tel'),
        'st_introduce' => $request->input('st_introduce')
      ]);
    }
  }

//
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
      }
      else {
        return redirect('/login_customer');
      }

    }


    public function logout(Request $logout)
    {
      session()->forget('iding');
      return redirect('/');
    }
  }
