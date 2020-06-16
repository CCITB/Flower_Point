<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class ProductController extends Controller
{
  // protected $a;
  // public function __construct(){
  //
  //   $this->a = DB::table('basket')
  //
  //
  // }

  //
  public function seller_shoppost(){
    if(auth()->guard('seller')->check()){
      return view('seller.seller_shoppost');
    }
    if(auth()->guard('customer')->check()){
      echo "<script>alert('잘못된요청입니다.')</script>";
      return redirect('/');
    }
    else
    return view('login.login_seller');

  }

  public function seller_product_register(Request $request)
  {
    // $picturerow = DB::table('product_image')->where('i_no','=',5)->first();
    // $picture = $picturerow->i_filename;
    // return $picture;
    $storeno = auth()->guard('seller')->user()->s_no;
    $comparison = DB::table('store')->where('seller_no','=', $storeno)->first();
    // 로그확인용 주석

    // echo $comparison->st_no;
    // return $comparison->st_no;

    // 아래코드는 product table 에서 store테이블에 있는 st_no를 store_no와 비교해서  product-image table에 있는 기본값을 찾음

    // $productimage = DB::table('product')->where('store_no','=',$comparison->st_no)-first();
    // return $productimage->p_no;

    $path=$request->file('picture')->store('/','public');
    DB::table('product')->insert([
      'p_name'=>$request->input('productname'),
      'p_title' => $request->input('deliverycharge'),
      'p_contents' => $request->input('ir1'),
      'p_price' => $request->input('sellingprice'),
      'store_no' => $comparison->st_no,
      'p_filename' =>$path
    ]);


    // 이미지 저장경로 public\storage\

    // return $path;
    // 이미지 product 테이블과 연결해서 저장

    return redirect('/');
  }
  public function productpage($id){

    $productinfor = DB::table('product')->where('p_no','=',$id)->get();
    // return $productinfor;

    // $productdata = DB::table('product')->where('p_no','=',$id)->first();
    // return $productdata;
    return view('Buy_information', compact('productinfor'));
  }
  public function basket(){


    if(auth()->guard('customer')->user()){
      $userinfo = auth()->guard('customer')->user()->c_no;
      $data = DB::table('basket')->where('customer_no',$userinfo)->get();
      $price_sum = $data->sum('b_price');
      $delivery_sum = $data->sum('b_delivery');
      $count_sum = $data->sum('b_count');
      $data_sum = $price_sum + $delivery_sum;
      return view('flowercart',compact('data','price_sum','delivery_sum','count_sum','data_sum'));
    }
    if(auth()->guard('seller')->user()){
      return redirect('/');
    }
    else{
      // echo '<script>alert("구매자만 이용가능한 서비스입니다.");</script>';
      return view('login.login_customer');
    }


    //아래코드는 재사용할 것 $id는 url id
    // $pt = DB::table('product')->where('p_no',$id)->first();
    //
    // if($userinfo = auth()->guard('customer')->user()){
    //   $prikey  = $userinfo->c_no;
    //   DB::table('basket')->insert([
    //     'b_price' => $pt->p_price ,
    //     'b_name' => $pt->p_name,
    //     'customer_no' => $prikey,
    //     'product_no' => $id,
    //     'b_count' =>  1,
    //     'b_delivery' => $pt->p_title,
    //     'b_picture' => $pt->p_filename
    //   ]);
    //   $cusdata = DB::table('basket')->where('customer_no',$prikey)->get();
    //   return view('flowercart', compact('cusdata'));
  }
  // $data = DB::table('product')->where('p_no',$id)->get();

  // function(){
  // if(auth()->guard('customer')->check()){
  //   return view('flowercart');
  // }
  // if(auth()->guard('seller')->check()){
  //   return redirect('/');
  // }
  // else
  // return redirect('/login_customer');
  // return view('flowercart');
  // }
  public function basketdelete(Request $request){
    $data =  $request->input('id');
    if(auth()->guard('customer')->user()){
      DB::table('basket')->where('b_no',$data)->delete();
      $userinfo = auth()->guard('customer')->user()->c_no;
      $data1 = DB::table('basket')->where('customer_no',$userinfo)->get();
      $price_sum = $data1->sum('b_price');
      $delivery_sum = $data1->sum('b_delivery');
      $count_sum = $data1->sum('b_count');
      $data_sum = $price_sum + $delivery_sum;
    }
    return response()->json([$data,$price_sum,$delivery_sum,$count_sum,$data_sum]);
  }
  public function basketstore(Request $request){
    $data =  $request->input('id');
    $pt = DB::table('product')->where('p_no',$data)->first();
    if($userinfo = auth()->guard('customer')->user()){
      $prikey  = $userinfo->c_no;
      DB::table('basket')->insert([
        'b_price' => $pt->p_price ,
        'b_name' => $pt->p_name,
        'customer_no' => $prikey,
        'product_no' => $data,
        'b_count' =>  1,
        'b_delivery' => $pt->p_title,
        'b_picture' => $pt->p_filename
      ]);
      return response()->json($data);
    }
    if($seller = auth()->guard('seller')->user()){
      return response()->json(1);
    }
    else{
      return response()->json(0);
    }


  }
  public function basketcount(Request $request){
    $add = $request->input('add');
    $no = $request->input('e');
    $remove = $request->input('remove');
    if(isset($add)){
     $b_no = DB::table('basket')->where('b_no', $no);

      return response()->json($b_no);
    }
      return response()->json(0);
  }
}
