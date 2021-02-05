<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use DateTime;
use Illuminate\Support\Str;
class PaymentController extends Controller
{
  //곽승지
  // 주문페이지
  public function payment(Request $request){
    if(auth()->guard('customer')->user()){
      // return json_decode(urldecode($request->pdidx));
      //랜덤 토큰 생성
      $token = str::random(32);
      // return session()->get('coupon');
      // return session()->all();
      session()->put('c_token',$token);
      // return request()->cookie();
      //장바구니에 담긴 물품중 선택해서 주문을 눌렀을때 받는 상품테이블의 인덱스와 장바구니 인덱스
      $ididx = json_decode(urldecode($request->input('pdidx')));
      // $productnoidx = json_decode(urldecode($request->input('productnoidx')));
      // 상품페이지에서 바로 주문을 눌렀을때 받는 상품테이블의 인덱스
      $proidx = $request->Pro;
      $productcount = $request->count;

      $data1 = 0;
      $productprice = 0;
      $productdelivery = 0;
      $productsum = 0;
      // 장바구니에서 넘겼을때
      if(isset($ididx)){
        $user = auth()->guard('customer')->user();
        $useraddress = DB::table('customer_address')->where('c_no',$user->c_no)->get();
        $latestaddress = DB::table('delivery')->where('customer_no',$user->c_no)->orderBy('d_no','desc')->first();
        $point = $user->c_point;
        $basketcheck = 0;
        for($i=0;$i<count($ididx);$i++){
          $basketcheck += count(DB::table('basket')->select('customer_no')->where('b_no', $ididx[$i])->where('customer_no',$user->c_no)->get());
          $test = DB::table('basket')->where('b_no', $ididx[$i])->where('customer_no',$user->c_no)->get();
        }
        if($basketcheck==0){
          return redirect()->back();
        }
        // if($user->c_no==)
        for($i = 0; $i<count($ididx); $i++){
          $data[] =  DB::table('basket')->where('b_no',$ididx[$i])->join('product','basket.product_no','=','product.p_no')->get();
          $productsum += $data[$i][0]->b_delivery+$data[$i][0]->b_price*$data[$i][0]->b_count;
          $productdelivery += $data[$i][0]->b_delivery;
          $productprice += $data[$i][0]->b_price*$data[$i][0]->b_count;
        }
        return view('payment.order',compact('data','user','useraddress','latestaddress','productprice','productdelivery','productsum','token','point'));
      }
      // 주문페이지에서 바로 주문하기 눌렀을때
      $user = auth()->guard('customer')->user();
      $useraddress = DB::table('customer_address')->where('c_no',$user->c_no)->get();
      $latestaddress = DB::table('delivery')->where('customer_no',$user->c_no)->orderBy('d_no','desc')->first();
      $prodata = DB::table('product')->where('p_no',$proidx)->get();
      $productsum = $prodata[0]->p_delivery+$prodata[0]->p_price*$productcount;
      $productdelivery = $prodata[0]->p_delivery;
      $productprice = $prodata[0]->p_price*$productcount;
      $point = $user->c_point;
      // return $point;
      // echo $prodata;
      return view('payment.order',compact('user','productcount','productprice','useraddress','latestaddress','productdelivery','productsum','prodata','token','point'));

    }
    else
    return redirect('/login_customer');
  }
  // 결제진행 함수
  public function paymentprocess(Request $request){
    //세션변수로 중복제출 막기(임시)
    // if(session()->get('c_token')==$request->input('c_token')){
    //   session()->forget('c_token');
    //   // return 0;
    // }
    // else{
    //   return "<script>alert('요청이 실행중입니다!');</script>";
    // }
    // 유저포인트
    $user_use_point = $request->userpoint;
    if($user_use_point == null){
      $user_use_point = 0;
    }
    else if(auth()->guard('customer')->user()->c_point<$user_use_point){
      return "<script>alert('비정상적인 접근 방법입니다.')</script>";
    }
    DB::beginTransaction();
    //현재날짜 및 시간
    $now = new DateTime();
    // 수령인 이름
    $recipient = $request->input('recipient');
    // 거래방법
    $request->input('trade');
    // 배송지
    $request->input('delivery');
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
    $user_request = $request->input('request');
    //단일주문 상품번호
    $product_no = json_decode($request->input('getarray'));
    //장바구니 테이블에서 주문완료상태로 처리하기 위한 넘버 배열로 담겨있음
    $basket_no = json_decode($request->input('basketarray'));
    //상품키 받아올 배열 선언
    $proarray = [];
    //쿠폰할인가격 선언
    $flatrate = 0;
    //로그인 유저 기본키 추출
    if(auth()->guard('customer')->check()){
      $customer_primary = auth()->guard('customer')->user()->c_no;
      //유저 기본배송지 추출
      $useraddress = DB::table('customer_address')->where('c_no',$customer_primary)->get();
    }
    // 사용한 쿠폰번호
    $coupon_no = $request->coupon_no;
    $getcoupon = DB::table('couponbox')->where('cpb_no',$coupon_no)->where('customer_no',$customer_primary)->join('coupon','couponbox.coupon_no','coupon.cp_no')->get();
    // 주문한 사람의 주소 저장
    if($request->delivery=='신규배송지'){
      DB::table('delivery')->insert([
        'd_name' => $recipient,
        'd_phonenum'=> $customerphone1.'-'.$customerphone2.'-'.$customerphone3,
        'd_post' => $postcode,
        'd_address' => $address,
        'd_detailaddress' => $detailAddress,
        'd_extraaddress' => $extraAddress,
        'customer_no' => $customer_primary,
      ]);
    }
    //delivery테이블에서 기본키를 가져오기위해 $deliverytable변수 선언
    $deliverytable[] = DB::table('delivery')->where('customer_no',$customer_primary)->orderBy('d_no','desc')->first();
    //주문번호
    $orderNO = DB::table('order')->insertGetid([            //$orderNO = 주문번호
      'customer_no' => $customer_primary,                   //$customer_primary = 유저 기본키
      'o_request' => $user_request,                         //$user_request = 유저 요청사항
      'created_at' => $now->format('yy-m-d H:i:s'),         //$now->format('yy-m-d H:i:s') = ex)2000-01-01 12:05:09
      'o_point' => $user_use_point,                         //$user_use_point = 결제시 사용된 포인트
      'couponbox_no' => $coupon_no,                         //$coupon_no = 결제시 사용된 쿠폰
    ]);
    //장바구니 테이블에 담긴 기본키로 기존 상품번호 찾기
    //만약 존재하면 장바구니에서 선택한 상품 기준으로 결제 진행
    if(isset($basket_no)){
      // $data = [];
      // 전체합계를 위한 $sum
      $sum = 0;
      // 각 payment행마다 넣기위한 변수
      $eachprice = 0;
      // 상품+포인트 결제시 상품에서 포인트를 뺀 후 2%포인트적립을 하기 위한 변수
      $pricesum = 0;
      for($i=0; $i<count($basket_no);$i++){
        $proarray[$i] = DB::table('basket')->where('b_no',$basket_no[$i])->get();
        DB::table('basket')->where('b_no',$basket_no[$i])->delete();
        $sum += $proarray[$i][0]->b_count*$proarray[$i][0]->b_price+$proarray[$i][0]->b_delivery;
        $eachprice = $proarray[$i][0]->b_count*$proarray[$i][0]->b_price;
        $deliveryprice = $proarray[$i][0]->b_delivery;
        $pricesum += $proarray[$i][0]->b_count*$proarray[$i][0]->b_price;
        $insertid[] = DB::table('payment')->insertGetid([
          'pm_count' => $proarray[$i][0]->b_count,
          'pm_pay' => $eachprice,
          'pm_deliverypay' => $deliveryprice,
          'customer_no' => $customer_primary,
          'product_no' => $proarray[$i][0]->product_no,
          'created_at' => $now->format('yy-m-d H:i:s'),
          'pm_date' =>  $today = date("Ymd")
        ]);
      }
      if($request->delivery=='최근배송지'||$request->delivery=='신규배송지'){
        //반복문으로 여러상품 찾고 장바구니에서 선택한 물품을 제거 + 주문번호 하나
        for($i=0; $i<count($basket_no);$i++){
          DB::table('payment')->where('pm_no',$insertid[$i])->update([
            'delivery_no' => $deliverytable[0]->d_no,
          ]);
        }
      }
      elseif($request->delivery=='기본배송지'){
        for($i=0; $i<count($basket_no);$i++){
          DB::table('payment')->where('pm_no',$insertid[$i])->update([
            'c_address_no' => $useraddress[0]->a_no,
          ]);
        }
      }
      // 쿠폰사용시에
      if(isset($coupon_no)){
        // 클라이언트 쿠폰 위조하는지 검사
        if($getcoupon->isEmpty()){
          return "<script>alert('비정상적인 접근 방법입니다.')</script>";
        }
        //정률 쿠폰일 경우
        if($getcoupon[0]->cp_percent>0){
          //최대 할인적용시
          if($pricesum * $getcoupon[0]->cp_percent / 100 > $getcoupon[0]->cp_flatrate){
            $flatrate = $getcoupon[0]->cp_flatrate;
          }
          //최대 할인 미적용시
          else {
            $flatrate = $pricesum * $getcoupon[0]->cp_percent / 100;
          }
        }
        // 정액 쿠폰일 경우
        else{
          $flatrate = $getcoupon[0]->cp_flatrate;
        }
        // 최종적으로 쿠폰상태 칼럼 사용으로 업데이트
        DB::table('couponbox')->where('cpb_no',$coupon_no)->update([
          'cpb_state' => '사용'
        ]);
      }
      // 적립포인트 계산
      $reserve = ($pricesum-$user_use_point-$flatrate) * 2 / 100;
      if(auth()->guard('customer')->user()->c_cash+$user_use_point+$flatrate-$sum<0){
        DB::rollBack();
        return "<script>alert('알 수 없는 오류입니다.')</script>";
      }
      // 장바구니에서 구입한 물품들 가격을 구해 유저의 재화 차감하기
      DB::table('customer')->where('c_no',$customer_primary)->update([
        'c_cash' => DB::raw('c_cash'.'-'.($sum-$user_use_point-$flatrate)),
        'c_point'=> DB::raw('c_point'.'-'.($user_use_point).'+'.($reserve))
      ]);
      DB::table('order')->where('o_no',$orderNO)->update([
        'o_totalprice' => $sum,
        'o_reserve' => $reserve,
        'o_dcnt_coupon' => $flatrate,
        'o_dcnt_totalprice' => $sum-$user_use_point-$flatrate
      ]);
      for($i=0; $i<count($basket_no);$i++){
        DB::table('paymentjoin')->insert([
          'payment_no' => $insertid[$i],
          'order_no' => $orderNO
        ]);
        $arraydata[] = DB::table('payment')->where('pm_no',$insertid[$i])
        ->join('product','payment.product_no','=','product.p_no')
        ->join('paymentjoin','payment.pm_no','paymentjoin.payment_no')
        ->join('order','paymentjoin.order_no','order.o_no')->get();
      }
      DB::commit();
      return Redirect::route('complete')->with([
        'arraydata'=>$arraydata,
        'orderNO'=>$orderNO
      ]);
      // return $proarray;
    }
    // 상품테이블 정보 가져오기
    $prodata = DB::table('product')->where('p_no',$product_no[0])->get();
    // 상품수량
    $product_count = $request->productcount;
    // 상품 가격
    $product_price = $prodata[0]->p_price;
    // 상품 배송비
    $product_delivery = $prodata[0]->p_delivery;
    // 결제테이블
    $insertid =  DB::table('payment')->insertGetid([
      'pm_count' => $product_count,
      'pm_pay' => $product_count * $product_price,
      'pm_deliverypay' => $product_delivery,
      'customer_no' => $customer_primary,
      'product_no' => $product_no[0],
      'created_at' => $now->format('yy-m-d H:i:s'),
      'pm_date' =>  $today = date("Ymd")
    ]);

    if($request->delivery=='최근배송지'||$request->delivery=='신규배송지'){
      DB::table('payment')->where('pm_no',$insertid)->update([
        'delivery_no' => $deliverytable[0]->d_no,
      ]);
    }
    elseif($request->delivery=='기본배송지'){
      DB::table('payment')->where('pm_no',$insertid)->update([
        'c_address_no' => $useraddress[0]->a_no,
      ]);
    }
    DB::table('paymentjoin')->insert([
      'payment_no' => $insertid,
      'order_no' => $orderNO
    ]);
    // 쿠폰사용시에
    if(isset($coupon_no)){
      //클라이언트 쿠폰 위조하는지 검사
      if($getcoupon->isEmpty()){
        return "<script>alert('비정상적인 접근 방법입니다.')</script>";
      }
      //정률 쿠폰일 경우
      if($getcoupon[0]->cp_percent>0){
        //최대 할인적용시
        if($product_count * $product_price * $getcoupon[0]->cp_percent / 100 > $getcoupon[0]->cp_flatrate){
          $flatrate = $getcoupon[0]->cp_flatrate;
        }
        //최대 할인 미적용시
        else {
          $flatrate = $product_count * $product_price * $getcoupon[0]->cp_percent / 100;
        }
      }
      // 정액 쿠폰일 경우
      else{
        $flatrate = $getcoupon[0]->cp_flatrate;
      }
      // 최종적으로 쿠폰상태 칼럼 사용으로 업데이트
      DB::table('couponbox')->where('cpb_no',$coupon_no)->update([
        'cpb_state' => '사용'
      ]);
    }
    $reserve = ($product_price * $product_count - $user_use_point - $flatrate) * 2 / 100;
    // return $user_use_point;
    DB::table('order')->where('o_no',$orderNO)->update([
      'o_totalprice' => $product_count * $product_price + $product_delivery,
      'o_reserve' => $reserve,
      'o_dcnt_coupon' => $flatrate,
      'o_dcnt_totalprice' => $product_count * $product_price + $product_delivery - $flatrate - $user_use_point
    ]);

    $data = DB::table('payment')->where('pm_no',$insertid)
    ->join('product','payment.product_no','=','product.p_no')
    ->join('paymentjoin','payment.pm_no','paymentjoin.payment_no')
    ->join('order','paymentjoin.order_no','order.o_no')->get();
    DB::table('customer')->where('c_no',$customer_primary)->update([
      'c_cash' => DB::raw('c_cash'.'-'.($data[0]->pm_pay-$user_use_point-$flatrate)),
      'c_point'=> DB::raw('c_point'.'-'.($user_use_point).'+'.($reserve))
    ]);

    if(auth()->guard('customer')->user()->c_cash + $user_use_point + $flatrate - $data[0]->pm_pay<0){
      DB::rollBack();
      return "<script>alert('알 수 없는 오류입니다.')</script>";
    }
    DB::commit();

    return Redirect::route('complete')->with([
      'data'=>$data,
      'orderNO'=>$orderNO
    ]);

  }
  // 결제완료시에 유저에게 보여지는 창
  public function paymentcomplete(Request $request){
    $paymentID = $request->session()->get('data');
    $orderNO = $request->session()->get('orderNO');
    $paymentIDarray = $request->session()->get('arraydata');
    $pricesum = 0;
    $test = DB::table('paymentjoin')->where('order_no',250)->join('payment','paymentjoin.payment_no','payment.pm_no')->join('order','paymentjoin.order_no','order.o_no')->get();
    // return dd($test);
    // 주소 보내주기
    // $delivery = DB::table('paymentjoin')->where('order_no',$orderNO)
    // ->select('delivery_no','c_address_no','pm_no')
    // ->join('payment','paymentjoin.payment_no','payment.pm_no')
    // ->orderBy('pm_no','desc')->take(1)->get();
    if(isset($paymentIDarray)){
      $pricesum = $paymentIDarray[0][0]->o_dcnt_totalprice;
      // for($i=0;$i<count($paymentIDarray);$i++){
      //   $pricesum += $paymentIDarray[$i][0]->pm_pay;
      // }
    }
    // return $delivery[0]->delivery_no;
    // if($delivery[0]->delivery_no==null){
    //   $address = DB::table('customer_address')->where('a_no',$delivery[0]->c_address_no)->get();
    // }
    // else{
    //   $address = DB::table('delivery')->where('d_no',$delivery[0]->delivery_no)->get();
    // }
    // return $address;
    return view('payment.complete',compact('paymentID','paymentIDarray','pricesum','orderNO',));
  }
  public function layerpopup(Request $request){
    session()->put('productprice',$request->price);
    $customer_primary = auth()->guard('customer')->user()->c_no;
    $coupon = DB::table('coupon_box')->where('customer_no',$customer_primary)->where('cpb_state','미사용')->join('coupon','coupon_box.coupon_no','coupon.cp_no')->where('cp_expiration','N')->get();
    $returnHTML = view('couponapply',compact('coupon'))->render();
    return response()->json($returnHTML);
  }
}
