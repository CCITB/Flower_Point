<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class LocateController extends Controller
{
  public function locate(Request $request){
    //판매자가 로그인한 유저가 존재할 경우
    if($sellerinfo = auth()->guard('seller')->user()){
      // $sellerprimary = $sellerinfo->s_no;
      // $data = DB::table('seller')
      // ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
      // ->where('s_no','=', $sellerprimary )->get();
      // $store_address = DB::table('store_address')->where('st_no' ,'=', $data[0]->st_no)->get();

      //seller 주소의 store address
      $store_address = DB::table('store_address')->select('*')->get();

      return view('/locate', compact('store_address'));
    }

    elseif($customerinfo = auth()->guard('customer')->user()){
      $customerprimary = $customerinfo->c_no;
      // $customer_address = DB::table('customer_address')->select('a_address')->get();
      // echo $customer_address;
      $customer_address = DB::table('customer_address')->select('*')->where('c_no','=', $customerprimary )->get('');
      $store_address = DB::table('store_address')->select('a_address')->get();
      // $customer_address = DB::table('customer_address')->where('c_no' ,'=', $data1[0]->c_no)->get();
      echo $customer_address;
      echo $store_address;
      return view('/locate', compact('customer_address','store_address'));

    }
    else{
      return view('login/login_customer');
    }
  }

}
