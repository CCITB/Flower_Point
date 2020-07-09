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
      ->select('*','payment.created_at')->where('s_no','=', $sellerprimary)->orderBy('pm_no', 'asc')->get();
      return view('seller/seller_myorderlist',compact('order'));
    }
    else{
      return view('login/login_seller');
    }
  }
  //결제상태 변경
  public function payment_status(Request $request){

    //check된 row의 배열값
    $pm_no = $request->get("check_on");

    //payment Table과 delivery Table의 조인
    //$delivery_join = DB::table('payment')->join('delivery','payment.delivery_no','=','delivery.d_no');

    for($i=0; $i<count($pm_no); $i++){
      //각 값과 pm_no이 일치하는 값의 pm_status만 결제완료로 변경
      DB::table('payment')->where('pm_no',$pm_no[$i])
      ->join('delivery','payment.delivery_no','=','delivery.d_no')
      ->update(['payment.pm_status' => '결제 완료',
      'delivery.d_status' => '배송 준비중']);
    }
    return response()->json($pm_no);
    // return redirect('/sellermyorderlist');
  }
  //배송정보 입력
  public function delivery_status(Request $request){
    //check된 index값을 담은 배열
    $pm_no = $request->get("check_on");
    //송장번호를 담은 배열
    $invoice = $request->get("invoice");
    //배송업체명을 담은 배열
    $delivery = $request->get("delivery");

    for($i=0; $i<count($pm_no); $i++){
      //체크된 값과 동일한 결제 ,
      DB::table('payment')->where('pm_no',$pm_no[$i])
      ->join('delivery','payment.delivery_no','=','delivery.d_no')
      ->update([
        'd_invoice_num' => $invoice[i],
        'd_company' => $delivery[i],
        'd_status' => '배송중'
      ]);
    }
    return response()->json($invoice);
    //return redirect('/sellermyorderlist');
  }

}
