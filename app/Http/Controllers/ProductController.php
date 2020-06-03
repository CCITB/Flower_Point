<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ProductController extends Controller
{
  //
  public function seller_product_register(Request $request)
  {
    $picturerow = DB::table('product_image')->where('i_no','=',1)->first();
    $picture = $picturerow->i_filename;
    return $picture;
    DB::table('product_image')->insert([
      'i_filename' =>$request->input('picture')
      // 'product_no' => $productimage->p_no
    ]);
    return 1;

    $storeno = auth()->guard('seller')->user()->store_no;
    $comparison = DB::table('store')->where('st_no','=', $storeno)->first();
    // 로그확인용 주석
    // echo $comparison->st_no;
    // return $comparison->st_no;
    // 아래코드는 product table 에서 store테이블에 있는 st_no를 store_no와 비교해서  product-image table에 있는 기본값을 찾음
    // $productimage = DB::table('product')->where('store_no','=',$comparison->st_no)-first();
    // return $productimage->p_no;


    DB::table('product')->insert([
      'p_name'=>$request->input('productname'),
      'p_title' => $request->input('deliverycharge'),
      'p_contents' => $request->input('ir1'),
      'p_price' => $request->input('sellingprice'),
      'store_no' => $comparison->st_no
    ]);

    // $productimage = DB::table('product')->where('store_no','=',$comparison->st_no)-first();

    // 이미지 product 테이블과 연결해서 저장
    // DB::table('product_image')->insert([
    //   'i_filename' =>$request->input('product_image'),
    //   'product_no' => $productimage->p_no
    // ]);

    return redirect('/');
  }
}
