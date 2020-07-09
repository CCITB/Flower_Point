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

    return redirect('/mypage');
  }

  //정경진
  //판매자 비밀번호변경
    publiC function modipw(Request $request){
      DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
        's_password'=>bcrypt($request->input('new_pw')),
      ]);

      return redirect('/mypage');
    }
    //정경진
    //판매자 이메일 변경
    publiC function modifyemail(Request $request){
      DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
        's_email'=>$request->input('new_email'),
      ]);

      return redirect('/mypage');
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
    $shop = DB::table('store')->join('seller', 'store.seller_no', '=', 'seller.s_no')->
    select('*')->where('st_name', '=', $id)->get();
    $shop_address = DB::table('store_address')->join('store', 'store_address.st_no', '=', 'store.st_no')
    ->select('*')->where('st_name', '=', $id)->get();
    $product = DB::table('product')->join('store','product.store_no','=','store.st_no')
    ->select('*')->where('st_name', '=', $id)->get();
    return view('myshop/shop_customer', compact('shop','shop_address','product'));
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

      return redirect('/shop');
    }


    public function myqna(){
      if ($cust = auth()->guard('customer')->user()){
        $cus = $cust->c_no;
        $myqna = DB::table('customer')
        ->join('question','customer.c_no','=','question.customer_no')
        ->where('c_no',$cus)->paginate(5);

        return view('myQna', ['myqn' => $myqna]);
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
            ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
            ->where('s_no','=', $sellerprimary )->get();
            $proro = DB::table('product')
            ->leftjoin('payment','payment.product_no','product.p_no')
            ->join('store','product.store_no','=','store.st_no')
            ->select('*')->where('st_no' ,'=', $data[0]->st_no)->get();
            $introduce = DB::table('store')->select('st_introduce')->where('st_no' ,'=' , $data[0]->st_no )->get();
            $store_address = DB::table('store_address')->select('*')->where('st_no' ,'=', $data[0]->st_no)->get();
            $detail_address = DB::table('store_address')->select('a_detail')->where('st_no' ,'=', $data[0]->st_no)->get();

            return view('myshop/shop_seller' , compact('data', 'proro','introduce', 'store_address', 'detail_address'));
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
            $data2 = DB::table('customer')
            ->join('payment','customer.c_no','payment.customer_no')
            ->join('delivery','payment.delivery_no','=','delivery.d_no')
            ->join('product','payment.product_no','product.p_no')->select('*')->where('c_no','=',$customerprimary)->get();

            $my = DB::table('customer')
            ->join('review', 'customer.c_no', '=', 'review.customer_no')
            ->join('product', 'review.product_no','=','product.p_no')
            ->where('c_no', $customerprimary)->get();
            return view('mypage/c_mypage',compact('data','data2','my'));
    }
    else{
    return view('login/login_customer');
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

}
