<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{
  public function main(){ // 메인 슬라이드 6개씩 묶어서 나오게 하기 -- 박소현
    $product = DB::table('product')->where('p_status','등록')->limit(6)->get();
    $prod = DB::table('product')->where('p_status','등록')->skip(6)->take(6)->get();
    $pro = DB::table('product')->where('p_status','등록')->skip(12)->take(6)->get();
    return view('main', compact('product','prod','pro'));
  }
  public function registration(){

    if($sno = auth()->guard('seller')->user()){
      $so = $sno->s_no;

      $sell = DB::table('seller')->where('s_no',$so)
      ->join('store','seller.s_no','=','store.seller_no')
      ->get();

    }else{
      $sell = null;
    }

    return view('lib.header',   ['sell'=>$sell]);
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
    $data = DB::table('product')->where('p_status','등록')->paginate(12);
    return view('allproductpage',compact('data'));
  }
}
