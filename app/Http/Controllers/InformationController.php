<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InformationController extends Controller
{
  publiC function information(Request $request){
    DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
      's_name'=>$request->input('s_name'),
      's_phonenum'=>$request->input('s_phonenum'),
      's_email'=>$request->input('s_email'),
    ]);

    return redirect('/mypage');
  }
  publiC function storeinfo(Request $request){
    if($sellerinfo = auth()->guard('seller')->user()){
      $sellerprimary = $sellerinfo->s_no;
          $data = DB::table('seller')->join('store', 'seller.s_no', '=', 'store.seller_no')
          ->where('s_no','=',$sellerprimary )->get();
          // $data 조인을 해서 갖고온 셀러테이블과 스토어테이블이 합쳐진 데이터
          return view('myshop/shop_seller' , compact('data'));
    }
    else return view('myshop/shop_seller');

    // return view('myshop/shop_seller');

  }
}
