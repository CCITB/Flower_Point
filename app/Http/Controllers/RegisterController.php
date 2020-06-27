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
    $input_id = trim($_POST['c_id']);
    $customers = DB::table('customer')-> where('c_id','=',$input_id)->get()->count();

    //database insert
    if($customers<1){
      $c_tel1 = $request->input('c_tel1');
      $c_tel2 = $request->input('c_tel2');
      $c_tel2 = $request->input('c_tel3');

      $c_tel = $c_tel1.'-'.$c_tel2.'-'.$c_tel2;

    DB::table('customer')->insert([
      'c_id'=>$request->input('c_id'),
      'c_password' => bcrypt($request->input('c_password')),
      'c_name' => $request->input('c_name'),
      'c_phonenum' => $c_tel,
      'c_email' => $request->input('c_email'),
      'c_gender' => $request->input('c_gender'),
      'c_birth' => $request->input('c_birth_y').$request->input('c_birth_m').$request->input('c_birth_d')
    ]);

    //입력된 c_id를 통해 현재 c_id의 칼럼 전체를 받아옴.
    $customer =  $request->input('c_id');
    $cid = DB::table('customer')->where('c_id','=',$customer )->first();

    DB::table('customer_address')->insert([
      'c_no'=> $cid->c_no,
      'a_post' => $request->input('postcode'),
      'a_address' => $request->input('address'),
      'a_detail' => $request->input('detailAddress'),
      'a_extra' => $request->input('extraAddress')
    ]);
  return redirect('/login_customer');
  }
}

  //seller register query -- 어지수
  public function seller_store(Request $request)
  {
    //동일 아이디 확인
    $input_id = trim($_POST['s_id']);
    $sellers = DB::table('seller')-> where('s_id','=',$input_id)->get()->count();

    //database insert
    if($sellers<1){
      $s_tel1 = $request->input('s_tel1');
      $s_tel2 = $request->input('s_tel2');

      $s_tel = $s_tel1.$s_tel2;

      DB::table('seller')->insert([
        's_id'=>$request->input('s_id'),
        's_password' => bcrypt($request->input('s_password')),
        's_name' => $request->input('s_name'),
        's_phonenum' => $s_tel,
        's_email' => $request->input('s_email'),
        's_gender' => $request->input('s_gender'),
        's_birth' => $request->input('s_birth_y').$request->input('s_birth_m').$request->input('s_birth_d')
      ]);
      //입력된 s_id를 통해 현재 s_id의 칼럼 전체를 받아옴.
      $datas =  $request->input('s_id');
      $sid = DB::table('seller')->where('s_id','=',$datas )->first();

      DB::table('store')->insert([
        'st_name'=>$request->input('st_name'),
        'st_tel' => $request->input('st_tel'),
        'st_registeration_num' => $request->input('registeration_num'),
        'st_introduce' => $request->input('st_introduce'),
        'seller_no' =>  $sid->s_no
      ]);

      //입력된 c_id를 통해 현재 c_id의 칼럼 전체를 받아옴.
      $stdata =  $request->input('st_name');
      $stno = DB::table('store')->where('st_name','=',$stdata )->first();

      DB::table('store_address')->insert([
        'st_no'=> $stno->st_no,
        'a_post' => $request->input('postcode'),
        'a_address' => $request->input('address'),
        'a_detail' => $request->input('detailAddress'),
        'a_extra' => $request->input('extraAddress')
      ]);
      // //사업자등록번호
      // $st_num1 = $request->input('registeration_num1');
      // $st_num2 = $request->input('registeration_num2');
      // $st_num3 = $request->input('registeration_num3');
      // $st_num = $st_num1.'-'.$st_num2.'-'.$st_num3;

      //주소
      // $st_post = $request->input('postcode');
      // $st_add = $request->input('address');
      // $st_detail = $request->input('detailAddress');
      // $st_extra = $request->input('extraAddress');
      // $st_address = '['.$st_post.']'.$st_add.','.$st_detail.$st_extra;
      // return $sid->s_no;
      return redirect('/login_seller');
    }
  }
  //register jquery -- 어지수
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
