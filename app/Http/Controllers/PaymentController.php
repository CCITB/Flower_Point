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
        //장바구니에 담긴 물품중 선택해서 주문을 눌렀을때 받는 상품테이블의 인덱스와 장바구니 인덱스
        $ididx = json_decode($request->input('pdidx'));
        $productnoidx = json_decode($request->input('productnoidx'));
        // 상품페이지에서 바로 주문을 눌렀을때 받는 상품테이블의 인덱스
        $proidx = $request->Pro;
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
          $data[] =  DB::table('basket')->where('b_no',$ididx[$i])->join('product','basket.product_no','=','product.p_no')->get();
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
        $prodata = DB::table('product')->where('p_no',$proidx)->get();
        $productsum = $prodata[0]->p_title+$prodata[0]->p_price;
        $productdelivery = $prodata[0]->p_title;
        $productprice = $prodata[0]->p_price;
        // echo $prodata;
        return view('payment.order',compact('user','productprice','productdelivery','productsum','prodata'));

      }
      else
      return redirect('/');
    }
    public function paymentprocess(Request $request){
      // 수령인 이름
      $recipient = $request->input('recipient');
      // 거래방법
      $request->input('trade');
      // 휴대폰 번호
      $customerphone1 = $request->input('phone_no1');
      $customerphone2 = $request->input('phone_no2');
      $customerphone3 = $request->input('phone_no3');
      //우편번호,주소,상세주소,추가주소
      $postcode = $request->input('postcode');
      $address = $request->input('address');
      $detailAddress = $request->input('detailAddress');
      $extraAddress = $request->input('extraAddress');
      //사용자 요청사항
      $request->input('request');
      //장바구니 테이블에서 주문완료상태로 처리하기 위한 넘버 배열로 담겨있음
      $product_no = json_decode($request->input('getarray'));
      $basket_no = json_decode($request->input('basketarray'));
      //상품키 받아올 배열 선언
      $proarray = [];
      //로그인 유저 기본키 추출
      if(auth()->guard('customer')->check()){
        $customerprimary = auth()->guard('customer')->user()->c_no;
      }
      // return $basket_no;
      // return 0;
      //주문한 사람의 주소 저장
      DB::table('delivery')->insert([
        'd_name' => $recipient,
        'd_post' => $postcode,
        'd_address' => $address,
        'd_detailaddress' => $detailAddress,
        'd_extraaddress' => $extraAddress,
        'd_phonenum' => $customerphone1.'-'.$customerphone2.'-'.$customerphone3,
        'customer_no' => $customerprimary
      ]);
      //delivery테이블에서 기본키를 가져오기위해 $deliverytable변수 선언
      $deliverytable = DB::table('delivery')->where('customer_no',$customerprimary)->get();

      //장바구니 테이블에 담긴 기본키로 기존 상품번호 찾기
      //만약 존재하면 장바구니에서 선택한 상품 기준으로 결제 진행
      // return $proarray;
      if(isset($basket_no)){
        //반복문으로 여러상품 찾고 장바구니에서 선택한 물품을 제거
        for($i=0; $i<count($basket_no);$i++){
        $proarray[$i] = DB::table('basket')->where('b_no',$basket_no[$i])->get();
        DB::table('basket')->where('b_no',$basket_no[$i])->delete();
        //장바구니에서 제거한 물품을 payment테이블로 데이터 이전 deliver_no은 유저가 배송받는 주소가 매번 다를 수 있으므로 변수$deliverytable[0] 수정 필요함
        DB::table('payment')->insert([
          'pm_count' => $proarray[$i][0]->b_count,
          'pm_pay' => $proarray[$i][0]->b_count*$proarray[$i][0]->b_price+$proarray[$i][0]->b_delivery,
          'customer_no' => $customerprimary,
          'delivery_no' => $deliverytable[0]->d_no,
          'product_no' => $proarray[$i][0]->product_no,
        ]);
        }
        // return $proarray[1][0]->b_no;
        return redirect('/complete');
        // return $proarray;
      }
      // 상품테이블 정보 가져오기
      $prodata = DB::table('product')->where('p_no',$product_no[0])->get();
      //상품페이지에서 단품 결제시에 사용되는 코드, 칼럼 pm_count는 임시용으로 1이지만 상품페이지에 수량선택 기능이 추가되면 수정이 필요함.
      // return $deliverytable[0]->d_no;
      DB::table('payment')->insert([
        'pm_count' => 1,
        'pm_pay' => $prodata[0]->p_price+$prodata[0]->p_title,
        'customer_no' => $customerprimary,
        'delivery_no' => $deliverytable[0]->d_no,
        'product_no' => $product_no[0],
      ]);
      // return 0;
      return redirect('/complete');

    }
    public function paymentcomplete(Request $request){
      // return $request;
      // echo 1;
        return view('payment.complete');
    }
}
