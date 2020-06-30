<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InformationController extends Controller
{
  publiC function information(Request $request){
    DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
      's_phonenum'=>$request->input('new_num'),
    ]);

    return redirect('/mypage');
  }
  publiC function c_information(Request $request){
    DB::table('customer')->where(['c_no'=>auth()->guard('customer')->user()->c_no])->update([
      'c_phonenum'=>$request->input('new_num'),
    ]);

    return redirect('/c_mypage');
  }

  publiC function modipw(Request $request){
    DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
      's_password'=>bcrypt($request->input('new_pw')),
    ]);

    return redirect('/mypage');
  }

  publiC function c_modipw(Request $request){
    DB::table('customer')->where(['c_no'=>auth()->guard('customer')->user()->c_no])->update([
      'c_password'=>bcrypt($request->input('new_pw')),
    ]);

    return redirect('/c_mypage');
  }

  publiC function modifyemail(Request $request){
    DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
      's_email'=>$request->input('new_email'),
    ]);

    return redirect('/mypage');
  }

  publiC function c_modifyemail(Request $request){
    DB::table('customer')->where(['c_no'=>auth()->guard('customer')->user()->c_no])->update([
      'c_email'=>$request->input('new_email'),
    ]);

    return redirect('/c_mypage');
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


  publiC function c_storeinfo(Request $request){

    if($customerinfo = auth()->guard('customer')->user()){
      $customerprimary = $customerinfo->c_no;
      // return $sellerprimary;
      $data = DB::table('customer_address')->select('a_post','a_address','a_extra','a_detail')
      ->where('c_no','=',$customerprimary)->get();
      $customer_address = DB::table('customer_address')->where('c_no' ,'=', $customerprimary)->update(['a_post'=>$request->input('postcode'), 'a_address'=>$request->input('address'), 'a_extra'=>$request->input('extraAddress'), 'a_detail'=>$request->input('detailAddress')]);
      return redirect('/c_mypage');
    }
  }

  publiC function storepage($id){
    $shop = DB::table('store')->join('seller', 'store.seller_no', '=', 'seller.s_no')->
    select('*')->where('st_name', '=', $id)->get();
    $shop_address = DB::table('store_address')->join('store', 'store_address.st_no', '=', 'store.st_no')
    ->select('*')->where('st_name', '=', $id)->get();
    $product = DB::table('product')->join('store','product.store_no','=','store.st_no')
    ->select('*')->where('st_name', '=', $id)->get();
    return view('myshop/shop_customer', compact('shop','shop_address','product'));
  }

  publiC function favorite_store($id){
    $favorite = DB::table('store')->where('st_no','=',$id)->get();
    $favorite_store = $favorite[0]->st_no;
    if(auth()->guard('customer')->user()){
      $c_no=auth()->guard('customer')->user()->c_no;
    }
    $store = DB::table('store_favorite')->where('store_no','=',$favorite_store)->get(); //product_favorite테이블에서 product_no랑 현재상품번호랑 같은 product_no를가져옴
    // return $product;
    $count = $store->where('customer_no','=',$c_no)->count();
    // return $count;
    if($count>0){
      return redirect()->back();
    }
    elseif($count == 0){
      DB::table('store_favorite')->insert([
        'store_no'=>$favorite_store,
        'customer_no'=>$c_no]);
        return redirect()->back();
      }
    }
    // publiC function locate(Request $request){
    //   if($sellerinfo = auth()->guard('seller')->user()){
    //     $sellerprimary = $sellerinfo->s_no;
    //     $data = DB::table('seller')
    //     ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
    //     ->where('s_no','=', $sellerprimary )->get();
    //
    //
    //     $store_address = DB::table('store_address')->where('st_no' ,'=', $data[0]->st_no)->get();
    //     return view('/locate', compact('store_address'));
    //   }
    //   elseif($customerinfo = auth()->guard('customer')->user()){
    //     $customerprimary = $customerinfo->c_no;
    //     $data1 = DB::table('customer_address')
    //     ->select('*')->where('c_no','=', $customerprimary )->get();
    //     // $customer_address = DB::table('customer_address')->where('c_no' ,'=', $data1[0]->c_no)->get();
    //     return view('/locate', compact('data1'));
    //
    //   }
    //   else{
    //     return view('login/login_customer');
    //   }
    // }


    public function pd_modify($id) {
      // return $id;

      $pd_db = DB::table('product')->where('p_no',$id)->get();
      // return $pd_db;

      return view('myshop.seller_pd_modify', compact('pd_db'));
    }



  }
