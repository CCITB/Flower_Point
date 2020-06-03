<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  //
  public function login_s(Request $login)//$login 가 form에 있는 모든 값을 가지고 있음
  {
    $seller_id = $login->get('login_id');
    $seller_pw = $login->get('login_pw');
    // $db_seller = DB::table('seller')->select('s_id','s_password')->where([
    //   's_id'=>$seller_id,
    //   's_password'=>$seller_pw
    //   ])->get();
    //
    //
    //   if(count($db_seller)>0){
    //     session()->put('iding',$seller_id);
    //
    //     return view('main');
    //   }else {
    //     return redirect('/login_seller');
    //   }
    if(! auth() ->guard('seller') ->attempt(['s_id' => $seller_id, 'password' => $seller_pw])) {
      return back();
    }

    return redirect('/');
  }

  public function login_c(Request $login)
  {
    $customer_id = $login->get('login_id');
    $customer_pw = $login->get('login_pw');
    if(! auth() ->guard('customer')->attempt(['c_id' => $customer_id, 'password' => $customer_pw])) {
      return back();
    }
    return redirect('/');

    }
    public function logout(Request $logout)
    { //로그아웃 시켜주는 함수
      if(!auth()->guard('seller')->logout()){
      auth()->guard('customer')->logout();
      // session()->forget('iding');
    }
      return redirect('/');
    }

}
