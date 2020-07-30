<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InformationController extends Controller
{
  //정경진
  //판매자 마이페이지에 들어가는 전화번호
  publiC function information(Request $request){
    $s_tel1 = $request->input('phone_no1');
    $s_tel2 = $request->input('delivery_tel_no2');
    $s_tel3 = $request->input('delivery_tel_no3');

    $s_tel = $s_tel1.'-'.$s_tel2.'-'.$s_tel3;

    DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
      's_phonenum'=>$s_tel
    ]);

    return redirect('/s_mypage');
  }

  //정경진
  //판매자 비밀번호변경
  publiC function modipw(Request $request){
    DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
      's_password'=>bcrypt($request->input('new_pw')),
    ]);

    return redirect('/s_mypage');
  }
  //정경진
  //판매자 이메일 변경
  publiC function modifyemail(Request $request){
    DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
      's_email'=>$request->input('new_email'),
    ]);

    return redirect('/s_mypage');
  }

  //정경진
  //판매자 내꽃집가기 화면
  publiC function storeinfo(Request $request){

    if($sellerinfo = auth()->guard('seller')->user()){
      $sellerprimary = $sellerinfo->s_no;
      // return $sellerprimary;
      $data = DB::table('seller')
      ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
      ->where('s_no','=', $sellerprimary )->get();
      $proro = DB::table('product')->select('*')->where('store_no' ,'=', $data[0]->st_no)->get();
      $introduce = DB::table('store')->where('st_no' ,'=' , $data[0]->st_no )->update(['st_introduce'=>$request->input('newintroduce')]);
      return redirect('/shop');
    }
  }

  //정경진
  //판매자 가게주소변경
  publiC function newaddress(Request $request){

    if($sellerinfo = auth()->guard('seller')->user()){
      $sellerprimary = $sellerinfo->s_no;
      // return $sellerprimary;
      $data = DB::table('seller')
      ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
      ->where('s_no','=', $sellerprimary )->get();
      $store_address = DB::table('store_address')->where('st_no' ,'=', $data[0]->st_no)->update(['a_post'=>$request->input('postcode'), 'a_address'=>$request->input('address'), 'a_extra'=>$request->input('extraAddress'), 'a_detail'=>$request->input('detailAddress')]);
      return redirect('/shop');
    }
  }

  //정경진
  //구매자 마이페이지에 들어가는 전화번호
  publiC function c_information(Request $request){
    $c_tel1 = $request->input('phone_no1');
    $c_tel2 = $request->input('delivery_tel_no2');
    $c_tel3 = $request->input('delivery_tel_no3');

    $c_tel = $c_tel1.'-'.$c_tel2.'-'.$c_tel3;

    DB::table('customer')->where(['c_no'=>auth()->guard('customer')->user()->c_no])->update([
      'c_phonenum'=>$c_tel
    ]);

    return redirect('/c_mypage');
  }

  //정경진
  //구매자 비밀번호변경
  publiC function c_modipw(Request $request){
    DB::table('customer')->where(['c_no'=>auth()->guard('customer')->user()->c_no])->update([
      'c_password'=>bcrypt($request->input('new_pw')),
    ]);

    return redirect('/c_mypage');
  }
  //정경진
  //구매자 이메일변경
  publiC function c_modifyemail(Request $request){
    DB::table('customer')->where(['c_no'=>auth()->guard('customer')->user()->c_no])->update([
      'c_email'=>$request->input('new_email'),
    ]);

    return redirect('/c_mypage');

  }
  //정경진
  //구매자가 보는 꽃집화면
  publiC function c_storeinfo(Request $request){

    if($customerinfo = auth()->guard('customer')->user()){
      $customerprimary = $customerinfo->c_no;
      // return $sellerprimary;
      $data = DB::table('customer_address')->select('a_post','a_address','a_extra','a_detail')
      ->where('c_no','=',$customerprimary)->get();
      $customer_address = DB::table('customer_address')->where('c_no' ,'=', $customerprimary)->update(['a_post'=>$request->input('postcode'), 'a_address'=>$request->input('address'), 'a_extra'=>$request->input('extraAddress'), 'a_detail'=>$request->input('detailAddress')]);
      return redirect('/c_mypage');
    }
  }

  //정경진
  publiC function storepage($id){
    $shop = DB::table('store')->join('seller', 'store.seller_no', '=', 'seller.s_no')
    ->join('store_address', 'store.st_no', '=', 'store_address.st_no')
    ->select('*')->where('st_name', '=', $id)->get();
    $product = DB::table('product')->join('store','product.store_no','=','store.st_no')
    ->select('*')->where('st_name', '=', $id)->paginate(9);
    return view('myshop/shop_customer', compact('shop','product'));
  }
  //정경진
  //꽃집 즐겨찾기 버튼 클릭시 일어나는일
  publiC function favorite_store($id){
    $favorite = DB::table('store')->where('st_no','=',$id)->get();
    $favorite_store = $favorite[0]->st_no;
    if(auth()->guard('customer')->user()){
      $c_no=auth()->guard('customer')->user()->c_no;
    }
    $store = DB::table('store_favorite')->where('store_no','=',$favorite_store)->get();
    //product_favorite테이블에서 product_no랑 현재상품번호랑 같은 product_no를가져옴
    $count = $store->where('customer_no','=',$c_no)->count();
    if($count>0){
      return redirect()->back();
    }
    elseif($count == 0){
      DB::table('store_favorite')->insert([
        'store_no'=>$favorite_store,
        'customer_no'=>$c_no]);
        return redirect()->back();
      }
    }

    public function pd_modify($id) { // 상품수정 -- 박소현

      $pd_db = DB::table('product')->where('p_no',$id)->get();
      return view('myshop.seller_pd_modify', compact('pd_db'));
    }


    public function registration(Request $request) { // 사업자등록 -- 박소현

      $sel = auth()->guard('seller')->user()->s_no;

      $st_no = DB::table('seller')->join('store', 'seller.s_no', '=', 'store.seller_no')
      ->where('s_no',$sel)->pluck('st_no');

      $path=$request->file('registration');


      if($request->hasFile('registration')){
        $path=$request->file('registration')->store('/','public');
      }

      DB::table('store')->where('st_no',$st_no)->update([
        'registration_img' => $path
      ]);

      return redirect('/s_mypage');
    }


    public function myqna(){
      if ($cust = auth()->guard('customer')->user()){
        $cus = $cust->c_no;
        $myqna = DB::table('customer')
        ->join('question','customer.c_no','=','question.customer_no')
        ->join('product','question.product_no','=','product.p_no')
        ->join('store','product.store_no','=','store.st_no')
        ->where('c_no',$cus)->get();

        return view('myQnA', ['myqn' => $myqna]);
      } else{
        return redirect('/login_customer');
      }
    }

    public function image(Request $request){
      if($sellerinfo = auth()->guard('seller')->user()){
        $sellerprimary = $sellerinfo->s_no;
        $data = DB::table('seller')
        ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
        ->where('s_no','=', $sellerprimary )->get();
        $proro = DB::table('product')->select('*')->where('store_no' ,'=', $data[0]->st_no)->paginate(2);
        $introduce = DB::table('store')->select('st_introduce')->where('st_no' ,'=' , $data[0]->st_no )->get();
        $store_address = DB::table('store_address')->select('*')->where('st_no' ,'=', $data[0]->st_no)->get();
        $detail_address = DB::table('store_address')->select('a_detail')->where('st_no' ,'=', $data[0]->st_no)->get();

        return view('image_popup' , compact('data', 'proro','introduce', 'store_address', 'detail_address'));
      }
    }
    public function shop(){
      if($sellerinfo = auth()->guard('seller')->user()){
        $sellerprimary = $sellerinfo->s_no;
        // return $sellerprimary;
        $data = DB::table('seller')
        ->join('store', 'seller.s_no', '=', 'store.seller_no')
        ->join('store_address', 'store.st_no', '=', 'store_address.st_no')
        ->select('*')->where('s_no', '=', $sellerprimary)->get();
        $proro = DB::table('product')
        ->join('store','product.store_no','=','store.st_no')
        ->select('*','product.created_at')->where('st_no' ,'=', $data[0]->st_no)->where('p_status','등록')->get();
        $introduce = DB::table('store')->select('st_introduce')->where('st_no' ,'=' , $data[0]->st_no )->get();
        $detail_address = DB::table('store_address')->select('a_detail')->where('st_no' ,'=', $data[0]->st_no)->get();
        return view('myshop/shop_seller' , compact('data', 'proro','introduce','detail_address'));
      }
      else{
        return view('login/login_seller');
      }
    }
    public function c_mypage(){
      if($customerinfo = auth()->guard('customer')->user()){
        $customerprimary = $customerinfo->c_no;
        // return $sellerprimary;
        $data = DB::table('customer_address')->select('a_post','a_address','a_extra','a_detail')
        ->where('c_no','=',$customerprimary)->get();

        // $data2 = DB::table('customer')
        // ->join('payment','customer.c_no','payment.customer_no')
        // ->leftjoin('delivery','payment.delivery_no','=','delivery.d_no')
        // ->join('product','payment.product_no','product.p_no')
        // ->leftjoin('review','payment.pm_no','=','review.payment_no')
        // ->select('*')->where('c_no','=',$customerprimary)
        // ->get();

        $data2 = DB::table('customer')
        ->join('payment','customer.c_no','payment.customer_no')
        ->join('paymentjoin','payment.pm_no','paymentjoin.payment_no')
        ->join('order','paymentjoin.order_no','order.o_no')
        ->leftjoin('delivery','payment.delivery_no','=','delivery.d_no')
        ->join('product','payment.product_no','product.p_no')
        ->leftjoin('review','payment.pm_no','=','review.payment_no')
        ->select('*')->where('c_no','=',$customerprimary)
        ->get();


        $data3 = DB::table('customer')->select('*')->where('c_no','=',$customerprimary)->get();
        $my = DB::table('customer')
        ->join('review', 'customer.c_no', '=', 'review.customer_no')
        ->join('product', 'review.product_no','=','product.p_no')
        ->where('c_no', $customerprimary)->get();
        return view('mypage/c_mypage',compact('data','data2','my', 'data3'));
      }
      else{
        return view('login/login_customer');
      }
    }

    public function myorderlist(){
      if($customerinfo = auth()->guard('customer')->user()){
        $customerprimary = $customerinfo->c_no;

        $data2 = DB::table('customer')
        ->join('payment','customer.c_no','payment.customer_no')
        ->join('paymentjoin','payment.pm_no','paymentjoin.payment_no')
        ->join('order','paymentjoin.order_no','order.o_no')
        ->leftjoin('delivery','payment.delivery_no','=','delivery.d_no')
        ->join('product','payment.product_no','product.p_no')
        ->leftjoin('review','payment.pm_no','=','review.payment_no')
        ->select('*')->where('c_no','=',$customerprimary)
        ->get();
        return view('mypage/myorderlist',compact('data2'));
      }
      else{
        return redirect('/');
      }
    }
    public function s_mypage(){
      if($sellerinfo = auth()->guard('seller')->user()){
        // return 0;
        $sellerprimary = $sellerinfo->s_no;
        $sellerstore = DB::table('seller')
        ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
        ->where('s_no','=', $sellerprimary )->get();

        return view('mypage/s_mypage', compact('sellerstore'));
      }
      else{
        return view('login/login_seller');
      }

    }

    publiC function check_password(Request $request){
      if(auth()->guard('customer')->check()){
        $userID = DB::table('customer')->where('c_no',auth()->guard('customer')->user()->c_no)->get();
        if(!auth() ->guard('customer')->attempt(['c_id' => $userID[0]->c_id, 'password' => $request->input_password]))
        {
          return response()->json(0);
        }
        else{
          return response()->json(1);
        }
      }
      if(auth()->guard('seller')->check()){
        $userID = DB::table('seller')->where('s_no',auth()->guard('seller')->user()->s_no)->get();
        if(!auth() ->guard('seller')->attempt(['s_id' => $userID[0]->s_id, 'password' => $request->input_password]))
        {
          return response()->json(0);
        }
        else{
          return response()->json(1);
        }
      }
    }

    public function charge(Request $request){
      if($customerinfo = auth()->guard('customer')->user()){
        // return 0;
        $customerprimary = $customerinfo->c_no;
        $chargecash = preg_replace("/[^0-9]/", "", $request->input('money2'));
        $cash = DB::table('customer')->where('c_no','=',$customerprimary)->get();
        $totalcash = DB::table('customer')->where('c_no','=',$customerprimary)->update([
          'c_cash'=> $cash[0]->c_cash+$chargecash
        ]);
        return redirect('/charge_popup');
      }
    }

    public function charge_popup(Request $request){
      if($customerinfo = auth()->guard('customer')->user()){
        // return 0;
        $customerprimary = $customerinfo->c_no;
        $data3 = DB::table('customer')->select('*')->where('c_no','=',$customerprimary)->get();
        return view('charge_popup', compact('data3'));
      }
    }

    public function pd_point($id){

      $customerinfo = auth()->guard('customer')->user();
      $customerprimary = $customerinfo->c_no;

      $point = $id * 3 / 100; // point (2%)
      $myinfo = DB::table('customer')->where('c_no',$customerprimary)->get();
      $myp = $myinfo[0]->c_point;
      $total_p = $point + $myp;

      $pm_no = $_POST['hidden'];

      DB::table('customer')->where('c_no','=',$customerprimary)
      ->update([
        'c_point'=>$total_p
      ]);

      DB::table('payment')->where('pm_no','=',$pm_no)
      ->update([
        'pm_status'=>'구매 확정',
        'pm_d_status' => '배송 완료'
      ]);

      return redirect()->back();
    }



    public function refund(Request $request){
      if($customerinfo = auth()->guard('customer')->user()){
        $customerprimary = $customerinfo->c_no;
        $number = $request->get("number");


        $data = DB::table('paymentjoin')
        ->join('payment','payment.pm_no','paymentjoin.payment_no')
        ->join('order','paymentjoin.order_no','order.o_no')
        ->join('customer','order.customer_no','customer.c_no','left outer')
        ->join('couponbox','order.couponbox_no','couponbox.cpb_no')
        ->join('coupon','couponbox.coupon_no','coupon.cp_no')
        ->select('*')->where('pm_no','=',$number)->where('c_no',$customerprimary)->where('pm_d_status','결제 완료')
        ->get();
        //쿠폰안썻을때
        if($data->isEmpty()){
          $data = DB::table('paymentjoin')
          ->join('payment','payment.pm_no','paymentjoin.payment_no')
          ->join('order','paymentjoin.order_no','order.o_no')
          ->join('customer','order.customer_no','customer.c_no','left outer')
          ->select('*')->where('pm_no','=',$number)->where('c_no',$customerprimary)->where('pm_d_status','결제 완료')
          ->get();
          $total = preg_replace("/[^0-9]/", "", $data[0]->o_totalprice);
          $point = preg_replace("/[^0-9]/", "", $data[0]->o_point);
          $customer_point = preg_replace("/[^0-9]/", "", $data[0]->c_point);
          $delivery = preg_replace("/[^0-9]/", "", $data[0]->pm_deliverypay);
          $price = $total-$point-$delivery;
          $currentcash = $data[0]->c_cash;

          $updateprice = DB::table('customer')->where('c_no','=',$customerprimary)->update([
            'c_cash'=>$price+$currentcash,
            'c_point'=>$customer_point-($price* 2 / 100)
          ]);
          DB::table('payment')->where('pm_no',$number)->
          update(['pm_status'=>'결제 취소','pm_d_status' => '결제 취소']);
          return response()->json(1);
        }

        // return response()->json($data);
        $total = preg_replace("/[^0-9]/", "", $data[0]->o_totalprice);
        $point = preg_replace("/[^0-9]/", "", $data[0]->o_point);
        $customer_point = preg_replace("/[^0-9]/", "", $data[0]->c_point);
        $coupon = preg_replace("/[^0-9]/", "", $data[0]->cp_flatrate);
        $delivery = preg_replace("/[^0-9]/", "", $data[0]->pm_deliverypay);
        $price = $total-$point-$coupon-$delivery;
        $currentcash = $data[0]->c_cash;

        $updateprice = DB::table('customer')->where('c_no','=',$customerprimary)->update([
          'c_cash'=>$price+$currentcash,
          'c_point'=>$customer_point-($price* 2 / 100)
        ]);
        DB::table('payment')->where('pm_no',$number)->
        update(['pm_status'=>'결제 취소','pm_d_status' => '결제 취소']);
        return response()->json(1);
      }
    }

    public function couponpage(Request $request){
      if($customerinfo = auth()->guard('customer')->user()){
        $customerprimary = $customerinfo->c_no;
        $coupon = DB::table('couponbox')->join('coupon','coupon.cp_no','couponbox.coupon_no')
<<<<<<< HEAD
        ->select('*')->where('customer_no','=',$customerprimary)->where('cp_status','발급')->where('cpb_state','=','미사용')->get();
=======
        ->select('*')->where('customer_no','=',$customerprimary)->where('cp_expiration','=','N')->where('cpb_state','=','미사용')->get();
>>>>>>> c169346c029610307f05d0bce5b1cdc9cb052797
        $coupon2 = count($coupon);
        return view('coupon',compact('coupon','coupon2'));
      }
      else{
        return redirect('/');
      }
    }

    public function recievecoupon(Request $request){
      // if($customerinfo = auth()->guard('customer')->user()){
      //    $customerprimary = $customerinfo->c_no;
      $coupon = DB::table('coupon')->select('*')->where('cp_status','발급')->where('cp_expiration','=','N')->get();
      // $coupon2 = DB::table('coupon')->select('*')->where('customer_no','=',$customerprimary)->get();
      return view('recievecoupon',compact('coupon'));
      // }
    }
    public function givecoupon(Request $request){
      if($customerinfo = auth()->guard('customer')->user()){
        $number = $request->get("number");
        $customerprimary = $customerinfo->c_no;
        // $cp = DB::table('coupon')->select('cp_no')->where('cp_no',$number)->first()->cp_no;
        $cp2 = DB::table('couponbox')->select('coupon_no')->where('coupon_no',$number)->where('customer_no',$customerprimary)->first();
        // return response()->json($cp2);
        if(!isset($cp2)){
          $data = DB::table('couponbox')->insert([
            'coupon_no' => $number,
            'customer_no' => $customerprimary
          ]);
          return response()->json(1);
        }
        else{
          return response()->json(0);
        }
      }
    }
    public function couponapplycheck(Request $request){
      $id = $request->id;
      $productprice = (int)session()->get('productprice');
      $coupon = DB::table('couponbox')
      ->select('cp_title','cp_flatrate','cp_minimum','cp_percent')->where('cpb_no',$id)
      ->join('coupon','couponbox.coupon_no','coupon.cp_no')->get();
      // 정률쿠폰 계산식
      $discount = $productprice*$coupon[0]->cp_percent/100;
      // return response()->json($productprice);
      // return response()->json();
      // 정률 쿠폰을 사용했을 때
      if((int)$coupon[0]->cp_percent > 0 && $productprice >=(int)$coupon[0]->cp_minimum){
        // 최대할인 적용
        if($coupon[0]->cp_flatrate<$discount){
          return response()->json($coupon);
        }
        //최대할인 미적용
        else{
          $coupon[0]->cp_flatrate=$discount;
          return response()->json($coupon);
        }
      }

      // 정액 쿠폰을 사용했을 때
      if($productprice>=(int)$coupon[0]->cp_minimum){
        // 사용가능
        return response()->json($coupon);
      }
      //사용불가능
      return response()->json(0);
    }


    public function mypoint($id){

      $cus = DB::table('customer')->where('c_no',$id)->get();

      $myreview = DB::table('customer')->where('c_no',$id)
      ->leftjoin('review','customer.c_no','=','review.customer_no')
      ->join('product','review.product_no','=','product.p_no')
      ->orderBy('review.created_at', 'desc')
      ->get();

      $myorder = DB::table('customer')->where('c_no',$id)
      ->join('order','customer.c_no','=','order.customer_no')
      ->orderBy('order.created_at', 'desc')
      ->get();

      return view('mypage.mypoint',compact('cus','myreview','myorder'));
    }
  }
