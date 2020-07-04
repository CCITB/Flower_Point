<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  //곽승지
  public function login_s(Request $login)//$login 가 form에 있는 모든 값을 가지고 있음
  {
    $urlPrevious = url()->previous();
    $urlBase = url()->to('/');
    $seller_id = $login->get('login_id');
    $seller_pw = $login->get('login_pw');
    if(! auth() ->guard('seller') ->attempt(['s_id' => $seller_id, 'password' => $seller_pw])) {
      return back();
    }
    return redirect($urlPrevious);
  }

  public function login_c(Request $login)
  {
    $urlPrevious = url()->previous();
    $urlBase = url()->to('/');
    // return $urlPrevious;
    $customer_id = $login->get('login_id');
    $customer_pw = $login->get('login_pw');
    if(! auth() ->guard('customer')->attempt(['c_id' => $customer_id, 'password' => $customer_pw])) {
      return back();
    }
    return redirect($urlPrevious);

    }

    public function logout(Request $logout)
    { //로그아웃 시켜주는 함수
    //   if(!auth()->guard('seller')->logout()){
    //   auth()->guard('customer')->logout();
    // }
    $urlPrevious = url()->previous();
    $urlBase = url()->to('/');
      auth()->logout();
      session()->flush();
      return redirect($urlPrevious);
    }
    //정경진
    publiC function check_login(Request $request){
      $input_id = $request->get('input_id');
      $input_pw = $request->get('input_pw');



      if(! auth() ->guard('customer')->attempt(['c_id' => $input_id, 'password' => $input_pw])) {
        return response()->json(0);
      }

    else{
      return response()->json(1);
    }

    }

    publiC function check_sellerlogin(Request $request){
        $input_id = $request->get('input_id');  //뷰에서 보내준 input_id라는 key값을 $input_id라는 변수로 선언
        $input_pw = $request->get('input_pw');


    if(! auth() ->guard('seller')->attempt(['s_id' => $input_id, 'password' => $input_pw])) {
      return response()->json(0); //$input_id와 db테이블의 c_id가 같고 $input_pw와 db테이블의 password가 같지않으면 0을 반환
    }
    else{
      return response()->json(1);
    }
    }

}
