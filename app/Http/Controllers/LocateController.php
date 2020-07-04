<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

//정경진, 어지수
class LocateController extends Controller
{
  public function locate(Request $request){
    //정경진
    //판매자가 로그인한 유저가 존재할 경우
    if($sellerinfo = auth()->guard('seller')->user()){

      //seller 주소의 store address
      $store_address = DB::table('store_address')->select('*')->get();

      return view('/locate', compact('store_address'));
    }

    elseif($customerinfo = auth()->guard('customer')->user()){
    //어지수
      $customerprimary = $customerinfo->c_no;
      $customer_address = DB::table('customer_address')->select('*')->where('c_no','=', $customerprimary )->get('');

      //store의 주소를 보여주기 위해 사용
      $store_address = DB::table('store_address')->select('st_no','a_address','a_detail','a_extra')->get();

      //store의 정보를 가져오기 위한 join
      $store= DB::table('store')
              ->select('st_no','st_name','st_introduce')->get();

      return view('/locate', compact('customer_address','store_address','store'));

    }
    else{
      return redirect('/');
    }
  }

}
