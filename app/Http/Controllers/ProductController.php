<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class ProductController extends Controller
{
  public function __construct(Request $request)
  {
    // $this->a = 2;
    // $this->a12 = 1;
    // $this->middleware('user');
    // $this->middleware(function ($request, $next) {
    //   $this->user = Auth::user();
    //
    //   return $next($request);
    // });
    //
    // $this->userinfo = auth()->guard('customer')->user()->c_no;
    // $this->data = DB::table('basket')->where('customer_no',$this->userinfo)->get();
    // $this->price_sum = $this->data->sum('b_price');
    // $this->dz = 0;
    // $this->price_sum1 = 0;
    // $this->count_sum1 = 0;
    // $this->delivery_sum1 = 0;
    // for($i=0; $i<count($this->data); $i++){
    //   $this->dz+=($this->data[$i]->b_price+$this->data[$i]->b_delivery)*$this->data[$i]->b_count;
    //   $this->price_sum1+=$this->data[$i]->b_price*$this->data[$i]->b_count;
    //   $this->count_sum1+=$this->data[$i]->b_count;
    //   $this->delivery_sum1+=$this->data[$i]->b_delivery*$this->data[$i]->b_count;
    // }


  }

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
      // return $data;
      $price_sum = $data->sum('b_price');
      $dz = 0;
      $price_sum1 = 0;
      $count_sum1 = 0;
      $delivery_sum1 = 0;
      for($i=0; $i<count($data); $i++){
        $dz+=($data[$i]->b_price+$data[$i]->b_delivery)*$data[$i]->b_count;
        $price_sum1+=$data[$i]->b_price*$data[$i]->b_count;
        $count_sum1+=$data[$i]->b_count;
        $delivery_sum1+=$data[$i]->b_delivery*$data[$i]->b_count;
      }
      $delivery_sum = $data->sum('b_delivery');
      $count_sum = $data->sum('b_count');
      $data_sum = ($price_sum + $delivery_sum);
      return view('flowercart',compact('data','dz','price_sum1','count_sum1','delivery_sum1'));
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
    $data1 =  $request->input('id');
    if(auth()->guard('customer')->user()){
      DB::table('basket')->where('b_no',$data1)->delete();
      $userinfo = auth()->guard('customer')->user()->c_no;
      $data = DB::table('basket')->where('customer_no',$userinfo)->get();
      $price_sum = $data->sum('b_price');
      $delivery_sum = $data->sum('b_delivery');
      $count_sum = $data->sum('b_count');
      $data_sum = ($price_sum + $delivery_sum);
      $dz = 0;
      $price_sum1 = 0;
      $count_sum1 = 0;
      $delivery_sum1 = 0;
      for($i=0; $i<count($data); $i++){
        $dz+=($data[$i]->b_price+$data[$i]->b_delivery)*$data[$i]->b_count;
        $price_sum1+=$data[$i]->b_price*$data[$i]->b_count;
        $count_sum1+=$data[$i]->b_count;
        $delivery_sum1+=$data[$i]->b_delivery*$data[$i]->b_count;
      }
    }
    return response()->json([$data,$price_sum,$delivery_sum,$count_sum,$data_sum,$dz,$price_sum1,$count_sum1,$delivery_sum1]);
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
    $no = $request->input('no');
    $remove = $request->input('remove');
    $userinfo = auth()->guard('customer')->user()->c_no;

    if(isset($add)){
      // $b_no = DB::table('basket')->where('b_no', $no)->get();
      $b_no = DB::table('basket')->where('b_no',$no)->update([
        'b_count' => $add
      ]);
      $basket = DB::table('basket')->where('b_no',$no)->first();
      $price = $basket->b_price * $basket->b_count;
      $delivery = $basket->b_delivery* $basket->b_count;
      $sum = $price + $delivery;
      $data = DB::table('basket')->where('customer_no',$userinfo)->get();
      $dz = 0;
      $price_sum1 = 0;
      $count_sum1 = 0;
      $delivery_sum1 = 0;
      for($i=0; $i<count($data); $i++){
        $dz+=($data[$i]->b_price+$data[$i]->b_delivery)*$data[$i]->b_count;
        $price_sum1+=$data[$i]->b_price*$data[$i]->b_count;
        $count_sum1+=$data[$i]->b_count;
        $delivery_sum1+=$data[$i]->b_delivery*$data[$i]->b_count;
      }
      return response()->json([$price,$delivery,$sum,$dz,$price_sum1,$count_sum1,$delivery_sum1]);
    }
    else {
      DB::table('basket')->where('b_no',$no)->update([
        'b_count' => $remove
      ]);
      $basket = DB::table('basket')->where('b_no',$no)->first();
      $price = $basket->b_price * $basket->b_count;
      $delivery = $basket->b_delivery* $basket->b_count;
      $sum = $price + $delivery;
      $data = DB::table('basket')->where('customer_no',$userinfo)->get();
      $dz = 0;
      $price_sum1 = 0;
      $count_sum1 = 0;
      $delivery_sum1 = 0;
      for($i=0; $i<count($data); $i++){
        $dz+=($data[$i]->b_price+$data[$i]->b_delivery)*$data[$i]->b_count;
        $price_sum1+=$data[$i]->b_price*$data[$i]->b_count;
        $count_sum1+=$data[$i]->b_count;
        $delivery_sum1+=$data[$i]->b_delivery*$data[$i]->b_count;
      }
      return response()->json([$price,$delivery,$sum,$dz,$price_sum1,$count_sum1,$delivery_sum1]);
    }

  }
}
