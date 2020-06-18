<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InformationController extends Controller
{
  publiC function information(Request $request){
    DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
      's_phonenum'=>$request->input('s_phonenum'),
    ]);

      return redirect('/mypage');
    }

    publiC function modifyemail(Request $request){
      DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
        's_email'=>$request->input('s_email'),
      ]);

        return redirect('/mypage');
      }


  publiC function storeinfo(Request $request){

    if($sellerinfo = auth()->guard('seller')->user()){
      $sellerprimary = $sellerinfo->s_no;
      // return $sellerprimary;
          $data = DB::table('seller')
          ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
          ->where('s_no','=', $sellerprimary )->get();
          // $data2 = 1;
          // return $data2;
          // return 0;
          // echo $data;
          $proro = DB::table('product')->select('*')->where('store_no' ,'=', $data[0]->st_no)->get();


           // $data 조인을 해서 갖고온 셀러테이블과 스토어테이블이 합쳐진 데이터
          // return $proro;
          return redirect('/shop');
    }
    else return view('myshop/shop_seller');

    // return view('myshop/shop_seller');

  }
}
