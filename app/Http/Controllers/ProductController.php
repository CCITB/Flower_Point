<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class ProductController extends Controller
{
  //곽승지
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
    $answer = DB::table('answer')->get();
    $productinfor = DB::table('product')->where('p_no','=',$id)->get();
    $pro_no = $productinfor[0]->p_no;
    // return $pro_no;

    // DB::table('question')->insert([
    //   'product_no'=>$pro_no
    // ]);
    $store = DB::table('store')->select('st_name','st_no')->where('st_no', '=', $productinfor[0]->store_no)->get();
    // $qnaq = DB::table('question')->where('product_no', $pro_no)->paginate(5);

    // $c_n = $qnaq[0]->customer_no;
    // return $c_n;
    $qnaq = DB::table('customer')
     ->join('question', 'customer.c_no', '=', 'question.customer_no')->select('*')
     ->where('product_no', $pro_no)->paginate(5);
     // return $customer;

    // return $productinfor;

    // $productdata = DB::table('product')->where('p_no','=',$id)->first();
    // return $productdata;
    return view('Buy_information', compact('productinfor','qnaq', 'store','answer'));
  }

  // 박소현
  public function pd_qna (Request $qna,$id){
    // return $id;
    $productinfor = DB::table('product')->where('p_no',$id)->get();
    $pro_no = $productinfor[0]->p_no; // id(url)로 p_no 받아옴

    $today = date("Ymd"); //현재날짜 받아옴

    if($cinfo = auth()->guard('customer')->user()){
      // return 0;
      $cprimary = $cinfo->c_no; //사용자의 c_no
      $customer = DB::table('customer')
      ->join('question', 'customer.c_no', '=', 'question.customer_no')->select('*')
      ->where('customer_no','=', $cprimary)->get();

      // return view('mypage/mypage', compact('sellerstore'));

    }


    // $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['/product/{id}'];
    // return $url;

    DB::table('question')->insert([
      'q_title'=>$qna->input('qna_title'),
      'q_contents' => $qna->input('name'),
      'q_date' =>$today,
      'product_no'=>$pro_no,
      'customer_no'=>$cprimary
    ]);


    return redirect('/');
  }

  public function my_review(Request $myv){

    $custo = auth()->guard('customer')->user()->get();
    $cu1 = $custo[0]->c_no;
    $cu2 = $custo[0]->c_name;
    $today = date("Ymd");
    // echo $comparison->st_no;
    // return $comparison->st_no;

    // 아래코드는 product table 에서 store테이블에 있는 st_no를 store_no와 비교해서  product-image table에 있는 기본값을 찾음

    // $productimage = DB::table('product')->where('store_no','=',$comparison->st_no)-first();
    // return $productimage->p_no;

    // $path=$myv->file('picture')->store('/','public');
    DB::table('review')->insert([
      'r_title' => $cu2,
      'r_contents' => $myv->input('text'),
      'r_score' => $cu1,
      'created_at' => $today,
      'customer_no' => $cu1
    ]);


    // 이미지 저장경로 public\storage\

    // return $path;
    // 이미지 product 테이블과 연결해서 저장

    return redirect('/mypage');


  }



  public function basket(){
    if(auth()->guard('customer')->user()){
      $userinfo = auth()->guard('customer')->user()->c_no;
      $data = DB::table('basket')->where('customer_no',$userinfo)->get();
      // return $data;
      return view('flowercart',compact('data'));
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
    $checkdata = $request->input('check');
    $no =  $request->input('id');
    if(auth()->guard('customer')->user()){
      if(!isset($no)){

      }
      else{
        DB::table('basket')->where('b_no',$no)->delete();
        $userinfo = auth()->guard('customer')->user()->c_no;
        $data = DB::table('basket')->where('customer_no',$userinfo)->get();
        return response()->json($no);
      }
      if(!isset($checkdata)){

      }
      else{
        for($i=0; $i<count($checkdata); $i++){
          DB::table('basket')->where('b_no',$checkdata[$i])->delete();
        }
        return response()->json($checkdata);
      }

    }
    return response()->json(1234);
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
      $data = DB::table('basket')->where('customer_no',$userinfo)->get();

      return response()->json([$basket->b_count,$basket->b_price,$basket->b_delivery]);
    }
    else {
      DB::table('basket')->where('b_no',$no)->update([
        'b_count' => $remove
      ]);
      $basket = DB::table('basket')->where('b_no',$no)->first();
      $data = DB::table('basket')->where('customer_no',$userinfo)->get();

      return response()->json([$basket->b_count,$basket->b_price,$basket->b_delivery]);
    }

  }
  public function basketcondition(Request $request){
    // return response()->json(1);
    $checkdata = $request->input('check');
    $checkcondition = $request->input('checkcondition');
    $uncheckcondition = $request->input('uncheckcondition');
    $individualcheck = $request->input('individualcheck');
    $b_no = $request->input('no');
    $userinfo = auth()->guard('customer')->user()->c_no;
    // $basket = DB::table('basket')->where('b_no',$no)->first();
    if(isset($checkcondition)){
      for($i=0; $i<count($checkdata); $i++){
        DB::table('basket')->where('b_no',$checkdata[$i])->update([
          'b_condition' => '선택'
        ]);
      }
      $result = DB::table('basket')->where('customer_no',$userinfo)->where('b_condition','선택')->get();
      // return response()->json($result);
    }
    else{

    }
    if(isset($uncheckcondition)){
      for($i=0; $i<count($checkdata); $i++){
        DB::table('basket')->where('b_no',$checkdata[$i])->update([
          'b_condition' => '선택해제'
        ]);
      }
      $result = DB::table('basket')->where('customer_no',$userinfo)->where('b_condition','선택해제')->get();
      for($i = 0; $i<count($result); $i++){

      }
      // return response()->json($result);
      // return response()->json(2);
    }
    else{

    }
    if(isset($individualcheck)){
      if(filter_var($individualcheck,FILTER_VALIDATE_BOOLEAN)){
        DB::table('basket')->where('b_no',$b_no)->update([
          'b_condition' => '선택'
        ]);
        return response()->json(1);
      }
      else{
        DB::table('basket')->where('b_no',$b_no)->update([
          'b_condition' => '선택해제'
        ]);
        return response()->json(0);
      }
    }
    // if($individualcheck == '1'){
    //   return response()->json($b_no);
    // }
    // elseif($individualcheck == 0){
    //   return response()->json();
    // }
    return response()->json(0);
  }

}
