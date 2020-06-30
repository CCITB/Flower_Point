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
}
