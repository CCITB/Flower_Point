<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;
use \Carbon\Carbon;

//어지수
class OrderlistController extends Controller
{
  //[seller] 나의 주문관리 -- 정경진
  public function orderlist(Request $request){
    if($sellerinfo = auth()->guard('seller')->user()){
      $sellerprimary = $sellerinfo->s_no;
      $order = DB::table('payment')
      // ->join('delivery','payment.delivery_no','=','delivery.d_no')
      ->join('paymentjoin','payment.pm_no','=','paymentjoin.payment_no')
      ->join('order','order.o_no','=','paymentjoin.order_no')
      ->join('product','payment.product_no','=','product.p_no')
      ->join('customer','payment.customer_no','=','customer.c_no')
      ->join('store','product.store_no','store.st_no')
      ->join('seller','store.seller_no','seller.s_no')
      ->select('*','payment.created_at')->where('s_no','=', $sellerprimary)->orderBy('pm_no', 'asc')->get();

      // $store= DB::table('payment')
      // ->join('product','payment.product_no','=','product.p_no')
      // ->join('store','product.store_no','=','store.st_no')
      // ->join('seller','store.seller_no','seller.s_no')
      // ->where('s_no','=',$sellerprimary);

      $pm_wait = DB::table('payment')
      ->join('product','payment.product_no','=','product.p_no')
      ->join('store','product.store_no','=','store.st_no')
      ->join('seller','store.seller_no','seller.s_no')
      ->where('s_no','=',$sellerprimary)
      ->where('pm_status','like','%결제 대기%')->get()->count();

      $d_wait = DB::table('payment')
      ->join('product','payment.product_no','=','product.p_no')
      ->join('store','product.store_no','=','store.st_no')
      ->join('seller','store.seller_no','seller.s_no')
      ->where('s_no','=',$sellerprimary)
      ->where('pm_d_status','like','%배송 준비중%')->get()->count();

      $d_ing = DB::table('payment')
      ->join('product','payment.product_no','=','product.p_no')
      ->join('store','product.store_no','=','store.st_no')
      ->join('seller','store.seller_no','seller.s_no')
      ->where('s_no','=',$sellerprimary)
      ->where('pm_d_status','like','%배송중%')->get()->count();

      $d_complete = DB::table('payment')
      ->join('product','payment.product_no','=','product.p_no')
      ->join('store','product.store_no','=','store.st_no')
      ->join('seller','store.seller_no','seller.s_no')
      ->where('s_no','=',$sellerprimary)
      ->where('pm_d_status','like','%배송 완료%')->get()->count();

      // return $pm_status;

      return view('seller/seller_myorderlist',compact('order','pm_wait','d_wait','d_ing','d_complete'));
    }
    else{
      return view('login/login_seller');
    }
  }
  //결제상태 변경
  public function payment_status(Request $request){

    //check된 row의 배열값
    $pm_no = $request->get("check_on");
    for($i=0; $i<count($pm_no); $i++){
      // 각 값과 pm_no이 일치하는 값의 pm_status만 결제완료로 변경
      DB::table('payment')->where('pm_no',$pm_no[$i])
      ->update([
        'pm_status' => '결제 완료',
        'pm_d_status' => '배송 준비중']);
      }
      return response()->json($pm_no);
    }

  //배송정보 입력
  public function delivery_status(Request $request){
    // $now = Carbon::now();
    // console.log($now);
    //check된 index값을 담은 배열
    $pm_no = $request->get("check_on");
    //송장번호를 담은 배열
    $invoice = $request->get("invoice");
    //배송업체명을 담은 배열
    $delivery = $request->get("delivery");
    //배송업체 코드를 담은 배열
    $delivery_code = $request->get("delivery_code");

    for($i=0; $i<count($pm_no); $i++){
      //체크된 값과 동일한 결제 ,
      DB::table('payment')->where('pm_no',$pm_no[$i])
      ->update([
        'pm_invoice_num' => $invoice[$i],
        'pm_company' => $delivery[$i],
        'delivery_code' => $delivery_code[$i],
        'pm_complete_date' => Carbon::now(),
        'pm_status' => '결제 완료',
        'pm_d_status' => '배송중'
      ]);
    }
    return response()->json($invoice);
    //return redirect('/sellermyorderlist');
  }

  public function update_invoice(Request $request){
    $pm_no = $request->get("pm_no");
    $invoice_val = $request->get("invoice_val");

    $db_pm = DB::table('payment')->where('pm_no',$pm_no)->first()->pm_invoice_num;

    //변경값과 DB에 존재하는 값이 다를 때만 업데이트
    if(!($db_pm==$invoice_val)){
      DB::table('payment')->where('pm_no',$pm_no)
      ->update([
        'pm_invoice_num' => $invoice_val
      ]);
      return response()->json(1);
    }
    else{
      return response()->json(0);
    }
  }

  public function update_delivery(Request $request){

    $pm_no = $request->get("pm_no");
    $option_val = $request->get("option_val");
    $code_val = $request->get("code_val");

    $db_pm = DB::table('payment')->where('pm_no',$pm_no)->first()->pm_company;

    //변경값과 DB에 존재하는 값이 다를 때만 업데이트
    if(!($db_pm==$option_val)){
      DB::table('payment')->where('pm_no',$pm_no)
      ->update([
        'pm_company' => $option_val,
        'delivery_code' => $code_val
      ]);
      return response()->json(1);
    }
    else{
      return response()->json(0);
    }
  }

}
