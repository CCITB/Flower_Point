<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{
  public function main(){ // 메인 슬라이드 6개씩 묶어서 나오게 하기 -- 박소현
    //조인추가 : 어지수
    $product = DB::table('product')->where('p_status','등록')
    ->orderBy('product.created_at', 'desc')
    ->join('store', 'product.store_no', '=', 'store.st_no')
    ->limit(6)->get();
    $prod = DB::table('product')->where('p_status','등록')
    ->orderBy('product.created_at', 'desc')
    ->join('store', 'product.store_no', '=', 'store.st_no')
    ->skip(6)->take(6)->get();

    $pro = DB::table('product')->where('p_status','등록')
    ->orderBy('product.created_at', 'desc')
    ->join('store', 'product.store_no', '=', 'store.st_no')
    ->skip(12)->take(6)->get();

    $popularity = DB::table('product')->where('p_status','등록')
               ->select('p_no',DB::raw("count(*)"))
               ->orderBy(DB::raw("count(*)"), 'desc')
                  ->join('payment', 'product.p_no','=','payment.product_no')
                  ->join('paymentjoin', 'payment.pm_no','=','paymentjoin.payment_no')
                  ->join('order', 'paymentjoin.order_no', '=', 'order.o_no')
                  ->groupBy('p_no')
                  ->get();
                  // return $product;
                  // return $popularity;
                  for($i=0;$i<count($popularity);$i++){
                  $popularityArray[] =  DB::table('product')->where('p_status','등록')->where('p_no',$popularity[$i]->p_no)
                    ->join('store', 'product.store_no', '=', 'store.st_no')
                    ->limit(6)->get();
                  }
                  // return $popularityArray;
                  // return $popularity[0]->p_no;
                  // return dd($popularity);


    return view('main', compact('product','prod','pro','popularityArray'));
  }
  public function login_customer(){
    if(auth()->guard('seller')->check()){
      return redirect('/');
    }
    if(auth()->guard('customer')->check()){
      return redirect('/');
    }
    return view('login.login_customer');
  }
  public function login_seller(){
    if(auth()->guard('customer')->check()){
      return redirect('/');
    }
    if(auth()->guard('seller')->check()){
      return redirect('/');
    }
    return view('login.login_seller');
  }
  public function register_costomer(){
    return view('register.register_customer');
  }
  public function register_seller(){
    return view('register.register_seller');
  }
  public function register_terms_customers(){
    return view('register.register_terms_customers');
  }
  public function register_terms_sellers(){
    return view('register.register_terms_sellers');
  }
  public function register_information(){
    return view('register.register_information');
  }
  public function showall(){ // 전체 상품 12개씩 한 페이지처리
    // $data = DB::table('product')->where('p_status','등록')->paginate(12);
    $data  = DB::table('product')->where('p_status','등록')
    ->orderBy('product.created_at', 'desc')
    ->join('store', 'product.store_no', '=', 'store.st_no')
    ->paginate(12);
    return view('allproductpage',compact('data'));
  }
}
