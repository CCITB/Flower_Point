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
    $order = DB::table('payment')->join('delivery','payment.delivery_no','=','delivery.d_no')->join('product','payment.product_no','=','product.p_no')
    ->join('customer','payment.customer_no','=','customer.c_no')
    ->select('*','payment.created_at')->paginate(5);
    // return $order;
    // $pm = DB::table('payment')->select('*')->where('pm_no','=',$order2[0]->pm_no)->get();
    // $name = DB::table('customer')->select('c_name')->where('c_no','=',$order2[0]->customer_no)->get();
    $order3 = DB::table('product')->select('*')->where('p_no','=',$order[0]->product_no)->get();
    // $order4 = DB::table('payment')->select('pm_pay')->where('customer_no','=',$order2[0]->c_no)->get();
    // return $order3;
    // return $order2;
      return view('seller/seller_myorderlist',compact('order'));
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
