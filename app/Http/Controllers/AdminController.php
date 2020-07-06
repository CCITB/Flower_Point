<?php
// 관리자 컨트롤러 -- 박소현

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
  public function customer(){ //관리자의 구매자 DB 불러오기

    $customer = DB::table('customer')->select('*')->get();

    return view('admin.customer', compact('customer'));
  }

  public function seller(){  // 관리자의 판매자 DB 불러오기

    $sellerall = DB::table('seller')
    ->join('store', 'seller.s_no', '=', 'store.seller_no')
    ->join('store_address','store.st_no', '=', 'store_address.st_no')
    ->select('*')->get();

    $product = DB::table('seller')
    ->join('store', 'seller.s_no', '=', 'store.seller_no')
    ->join('store_address','store.st_no', '=', 'store_address.st_no')
    ->join('product','store.st_no','=','product.store_no')
    ->select('*')->get();

    return view('admin.seller', compact('sellerall','product'));
  }

  public function registraion($id){ // 판매자가 올린 사업자등록증 보여주기
    // return $id;
    $seller = DB::table('store')->where('st_no',$id)->get();

    return view('admin.registration', compact('seller'));
  }

  public function confrim($id){ // 판매자 승인하기
    $seller = DB::table('store')->where('st_no',$id)->update([
      'registration_status' => '승인'
    ]);
    echo "<script>alert('승인되었습니다.');self.close();</script>";
  }

  public function ad_remove($id){ // 상품을 '삭제' 상태로 만들기

    DB::table('product')->where('p_no','=',$id)->update([
      'p_status' => '삭제'
    ]);

    return redirect('/ad_seller');
  }

  public function ad_restore($id){ // 상품을 '등록' 상태로 만들기

    DB::table('product')->where('p_no','=',$id)->update([
      'p_status' => '등록'
    ]);

    return redirect('/ad_seller');
  }

  public function product(){ // 오늘 올라온 상품만 보여주기
    $today = date("Ymd");

    $product = DB::table('seller')
    ->join('store', 'seller.s_no', '=', 'store.seller_no')
    ->join('store_address','store.st_no', '=', 'store_address.st_no')
    ->join('product','store.st_no','=','product.store_no')
    ->select('*')->where('p_date',$today)->get();

    return view('admin.product', compact('product'));
  }
}
