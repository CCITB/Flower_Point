<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class PaymentController extends Controller
{
    //
    public function payment(Request $request){
      if(auth()->guard('customer')->user()){
        // return 0;
        $dbdata = DB::table('customer')->get();
        $ididx = json_decode($request->input('pdidx'));
        // $aa = $request;
        // return $request;

        $data1 = 0;
        $productprice = 0;
        $productdelivery = 0;
        $productsum = 0;
        // return print_r($dbdata[0]);
        // return $ididx[0];
        if(isset($ididx)){
          for($i = 0; $i<count($ididx); $i++){
          $data[] =  DB::table('basket')->where('b_no',$ididx[$i])->get();
          $productsum += $data[$i][0]->b_delivery+$data[$i][0]->b_price*$data[$i][0]->b_count;
          $productdelivery += $data[$i][0]->b_delivery;
          $productprice += $data[$i][0]->b_price*$data[$i][0]->b_count;
          }
          $user = auth()->guard('customer')->user();
          return view('payment.order',compact('data','user','productprice','productdelivery','productsum'));
        }

        // return $data[0][0]->b_price*$data[0][0]->b_count;
        // return $data[0]->b_no;
        // return $productprice;
        $user = auth()->guard('customer')->user();
        // $prodata = DB::table('product')->where('p_no',???)->get();
        $productsum = $prodata[0]->p_title+$prodata[0]->p_price;
        $productdelivery = $prodata[0]->p_title;
        $productprice = $prodata[0]->p_price;
        return view('payment.order',compact('user','productprice','productdelivery','productsum'));

      }
      else
      return redirect('/');
    }
    public function paymentprocess(Request $request){
      // 수령인 이름
      $request->input('recipient');
      // 거래방법
      $request->input('trade');
      // 휴대폰 번호
      $request->input('phone_no1');
      $request->input('phone_no2');
      $request->input('phone_no3');
      //우편번호,주소,상세주소,추가주소
      $request->input('postcode');
      $request->input('address');
      $request->input('detailAddress');
      $request->input('extraAddress');
      //사용자 요청사항
      $request->input('request');
      //장바구니 테이블에서 주문완료상태로 처리하기 위한 넘버 배열로 담겨있음
      $basket_no = json_decode($request->input('getarray'));
      //상품키 받아올 배열 선언
      $proarray = [];
      //장바구니 테이블에 담긴 기본키로 기존 상품번호 찾기
      for($i=0; $i<count($basket_no);$i++){
      $proarray[$i] =  DB::table('basket')->where('b_no',$basket_no[$i])->get();
      }
      // return var_dump($proarray);
      //
      //
      // DB::table('payment')->insert([
      //
      // ]);
      // return 0;
      // return ;

      return redirect('/complete');

    }
    public function paymentcomplete(Request $request){
      // return $request;
      // echo 1;
        return view('payment.complete');
    }
}
