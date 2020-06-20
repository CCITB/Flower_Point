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
          $st_post = $request->input('postcode');
          $st_add = $request->input('address');
          $st_detail = $request->input('detailAddress');
          $st_extra = $request->input('extraAddress');



          $proro = DB::table('product')->select('*')->where('store_no' ,'=', $data[0]->st_no)->get();
          $introduce = DB::table('store')->update(['st_introduce'=>$request->input('newintroduce')]);
          $st_address = '['.$st_post.']'.$st_add.','.$st_detail.$st_extra;
    }
    return redirect('/shop');
  }
}
