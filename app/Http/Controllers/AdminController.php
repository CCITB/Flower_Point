<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
  public function customer(){
    // $data = DB::table('product')->get();
    // // $alldata = [$data,$imagepath];
    // // return $data;
    // return view('main',compact('data'));
    $customer = DB::table('customer')->select('*')->get();

    return view('admin.customer', compact('customer'));
  }

  public function seller(){
    // $data = DB::table('product')->get();
    // // $alldata = [$data,$imagepath];
    // // return $data;
    // return view('main',compact('data'));
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
  public function registraion(Request $request){

    $st_no= $_POST['hidden'];
    $seller = DB::table('store')->where('st_no',$st_no)->get();
    $s_img=$seller[0]->st_no;



    return view('admin.registration', compact('seller'));
  }

  public function ad_remove($id){

    DB::table('product')->where('p_no','=',$id)->update([
      'p_status' => '삭제'
    ]);

    return redirect('/ad_seller');
  }

  public function ad_restore($id){

    DB::table('product')->where('p_no','=',$id)->update([
      'p_status' => '등록'
    ]);

    return redirect('/ad_seller');
  }

  public function product(){
    $product = DB::table('seller')
    ->join('store', 'seller.s_no', '=', 'store.seller_no')
    ->join('store_address','store.st_no', '=', 'store_address.st_no')
    ->join('product','store.st_no','=','product.store_no')
    ->select('*')->get();

    return view('admin.product', compact('product'));
  }
}
