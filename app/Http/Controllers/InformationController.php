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


          // $sum_address = Arr::collapse([['a_post'], ['a_address'], ['a_detail'], ['a_extra']]);
          $proro = DB::table('product')->select('*')->where('store_no' ,'=', $data[0]->st_no)->get();
          $introduce = DB::table('store')->where('st_no' ,'=' , $data[0]->st_no )->update(['st_introduce'=>$request->input('newintroduce')]);
    return redirect('/shop');
  }
}
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

publiC function storepage($id){
  // return $id;

      // if($sellerinfo = auth()->guard('seller')->user()){
      //   $sellerprimary = $sellerinfo->s_no;
      //   // return $sellerprimary;
      //       $data = DB::table('seller')
      //       ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
      //       ->where('s_no','=', $sellerprimary )->get();


            // $sum_address = Arr::collapse([['a_post'], ['a_address'], ['a_detail'], ['a_extra']]);
            // $productinfor = DB::table('product')->select('*')->where('p_name','=',$id)->get();
            // $store = DB::table('store')->select('st_name','st_no')->where('st_no', '=', $productinfor[0]->store_no)->get();

            $shop = DB::table('store')->join('seller', 'store.seller_no', '=', 'seller.s_no')->
            select('*')->where('st_name', '=', $id)->get();
            $shop_address = DB::table('store_address')->join('store', 'store_address.st_no', '=', 'store.st_no')
            ->select('*')->where('st_name', '=', $id)->get();
            return view('myshop/shop_customer', compact('shop','shop_address'));
}

}
