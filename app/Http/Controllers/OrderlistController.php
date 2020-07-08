<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

//어지수
class OrderlistController extends Controller
{
  //[seller] 나의 주문관리 -- 정경진
  public function orderlist(Request $request){
    if($sellerinfo = auth()->guard('seller')->user()){
    $sellerprimary = $sellerinfo->s_no;
    $order = DB::table('payment')
    ->join('delivery','payment.delivery_no','=','delivery.d_no')
    ->join('product','payment.product_no','=','product.p_no')
    ->join('customer','payment.customer_no','=','customer.c_no')
    ->join('store','product.store_no','store.st_no')
    ->join('seller','store.seller_no','seller.s_no')
    ->select('*','payment.created_at')->where('s_no','=', $sellerprimary)->get();
      return view('seller/seller_myorderlist',compact('order'));
    }
    else{
      return view('login/login_seller');
    }
  }
  //결제상태 변경
  public function payment_status(Request $request){
    DB::table('payment')->update([
      'pm_status' => '결제 완료'
    ]);
    return redirect('seller.seller_myorderlist');
  }
  //배송정보 입력
  public function delivery_status(Request $request){
    DB::table('delivery')->update([
      'd_status' => '배송중'
    ]);
    return view('seller/seller_myorderlist');
  }

}
