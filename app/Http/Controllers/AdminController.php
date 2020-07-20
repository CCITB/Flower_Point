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

    return view('admin.seller', compact('sellerall'));
  }

  public function registraion($id){ // 판매자가 올린 사업자등록증 보여주기
    // return $id;
    $seller = DB::table('store')->where('st_no',$id)
    ->join('seller','store.seller_no','=','seller.s_no')
    ->get();

    return view('admin.registration', compact('seller'));
  }

  public function confrim($id){ // 판매자 승인하기
    $seller = DB::table('store')->where('st_no',$id)
    ->join('seller','store.seller_no','=','seller.s_no')
    ->update([
      's_approval' => '승인'
    ]);
    echo "<script>alert('승인되었습니다.');opener.parent.location.reload();
    window.close();</script>";
  }

  public function ad_remove($id){ // 상품을 '삭제' 상태로 만들기

    DB::table('product')->where('p_no','=',$id)->update([
      'p_status' => '삭제'
    ]);

    return redirect('/ad_product');
  }

  public function ad_restore($id){ // 상품을 '등록' 상태로 만들기

    DB::table('product')->where('p_no','=',$id)->update([
      'p_status' => '등록'
    ]);

    return redirect('/ad_product');
  }

  public function product(){ // 오늘 올라온 상품만 보여주기
    $today = date("Ymd");

    $product = DB::table('seller')
    ->join('store', 'seller.s_no', '=', 'store.seller_no')
    ->join('store_address','store.st_no', '=', 'store_address.st_no')
    ->join('product','store.st_no','=','product.store_no')
    ->select('*')->where('p_date',$today)->get();

    $products = DB::table('seller')
    ->join('store', 'seller.s_no', '=', 'store.seller_no')
    ->join('store_address','store.st_no', '=', 'store_address.st_no')
    ->join('product','store.st_no','=','product.store_no')
    ->select('*')->get();

    return view('admin.product', compact('product','products'));
  }

  public function add_coupon(Request $request){

    DB::table('coupon')->insert([
      'cp_title'=>$request->input('c_title'),
      'cp_minimum' => $request->input('c_minimum'),
      'cp_flatrate' => $request->input('c_flat'),
      'start_date' =>$request->input('start'),
      'end_date' =>$request->input('end')
    ]);

    return redirect()->back();
  }

  public function show_coupon(){

    $coupon = DB::table('coupon')->select('*')->get();

    return view('admin.coupon', compact('coupon'));
  }

  public function issue($id){

    $coupon = DB::table('coupon')->where('cp_no',$id)
    ->update([
      'cp_status' => '발급'
    ]);
    return redirect()->back();
  }

  public function noissue($id){

    $coupon = DB::table('coupon')->where('cp_no',$id)
    ->update([
      'cp_status' => '미발급'
    ]);
    return redirect()->back();
  }
  public function login(){
    return view('admin.login');
  }
  public function login_a(Request $request){
    //
    // DB::table('admin')->insert([
    //   'admin_id' => $request->ID,
    //   'admin_pw'  => bcrypt($request->Password)
    // ]);
    // return auth()->guard('admin')->attempt(['admin_id' => $request->ID,'password' => $request->Password]);
    if(!auth()->guard('admin')->attempt(['admin_id' => $request->ID,'password' => $request->Password])){
      return back();
    }
    return redirect('/ad_customer');
  }
  public function adminpage(){
    if(auth()->guard('admin')->check()){
      return view('admin.index');
    }
    return redirect('/');
  }
  public function logout(){
    auth()->logout();
    session()->flush();
    return redirect(url()->previous());
  }

}
