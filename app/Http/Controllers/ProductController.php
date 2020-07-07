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

    // return $picture;
    $storeno = auth()->guard('seller')->user()->s_no;
    $comparison = DB::table('store')->where('seller_no','=', $storeno)->first();
    // 로그확인용 주석
    // echo $comparison->st_no;
    // return $comparison->st_no;

    // 아래코드는 product table 에서 store테이블에 있는 st_no를 store_no와 비교해서  product-image table에 있는 기본값을 찾음

    // $productimage = DB::table('product')->where('store_no','=',$comparison->st_no)-first();
    // return $productimage->p_no;
    // return $request->input('sellingprice');
    $path=$request->file('picture')->store('/','public');
    DB::table('product')->insert([
      'p_name'=>$request->input('productname'),
      'p_title' => preg_replace("/[^0-9]/", "",$request->input('deliverycharge')),
      'p_contents' => $request->input('ir1'),
      'p_price' =>preg_replace("/[^0-9]/", "", $request->input('sellingprice')),
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
    $pro_no = $productinfor[0]->p_no;
    // return $pro_no;


    $store = DB::table('store')->select('st_name','st_no')->where('st_no', '=', $productinfor[0]->store_no)->get();
    // $qnaq = DB::table('question')->where('product_no', $pro_no)->paginate(5);
    // $c_n = $qnaq[0]->customer_no;
    // return $c_n;
    $qnaq = DB::table('customer')
    ->join('question', 'customer.c_no', '=', 'question.customer_no')->leftjoin('answer','question.q_no', '=', 'answer.question_no')->select('*')
    ->where('product_no', $pro_no)->paginate(5);

    $review= DB::table('customer')
    ->join('review', 'customer.c_no', '=', 'review.customer_no')
    ->join('product', 'review.product_no','=','product.p_no')
    ->where('product_no', $pro_no)->paginate(3);

    //나의 소중한 주석입니다 지우지 말아주세요
    if(auth()->guard('seller')->user()){
      $s_no =  auth()->guard('seller')->user()->s_no;
      $SellerAllInfor = DB::table('seller')->where('s_no',$s_no)
      ->join('store','seller.s_no','=','store.seller_no')
      ->join('product','store.st_no','=','product.store_no')
      ->join('question','product.p_no','=','question.product_no','left outer')
      ->join('answer','question.q_no','=','answer.question_no','left outer')->get();
      // return var_dump($aa);
    }
    // return $qnaq;
    //나의 소중한 주석입니다 지우지 말아주세요
    return view('Buy_information', compact('productinfor','qnaq', 'store','review'));
  }

  // 상품 수정하기 박소현
  public function pd_modify(Request $request, $id){

    $storeno = auth()->guard('seller')->user()->s_no;

    $p_name = $_POST['productname'];
    $p_deli = $_POST['deliverycharge'];
    $p_contents = $_POST['ir1'];
    $p_price = $_POST['sellingprice'];

    if(isset($p_name)){
      $pd_name = $p_name;
    } else {
      $pd_name = $request->input('productname');
    }
    // return $pd_name;

    if(isset($p_deli)){
      $pd_deli = preg_replace("/[^0-9]/", "",$p_deli);
    } else{
      $pd_deli = preg_replace("/[^0-9]/", "",$request->input('deliverycharge'));
    }
    // return $pd_deli;

    if(isset($p_contents)){
      $pd_contents = $p_contents;
    }
    else {
      $pd_contents = $request->input('ir1');
    }
    // return $pd_contents;

    if(isset($p_price)){
      $pd_price = preg_replace("/[^0-9]/", "",$p_price);
    } else {
      $pd_price = preg_replace("/[^0-9]/", "", $request->input('sellingprice'));
    }
    // return $pd_price;


    $path=$request->file('picture')->store('/','public');
    DB::table('product')->where('p_no',$id)->update([
      'p_name'=>$pd_name,
      'p_contents' => $pd_contents,
      'p_filename' =>$path,
      'p_title' => $pd_deli,
      'p_price' => $pd_price
    ]);

    return redirect('/');
  }

  // 상품 삭제 박소현
  public function pd_remove($id){

    DB::table('product')->where('p_no','=',$id)->update([
      'p_status' => '삭제'
    ]);

    return redirect()->back();
  }


  //즐겨찾기 중복막기 코드 정경진
  public function favorite($id){

    $productinfor = DB::table('product')->select('p_no')->where('p_no','=',$id)->get(); //현재 페이지 상품번호와 product테이블의 p_no이같은 값을 가져옴
    $pro_no = $productinfor[0]->p_no;
    // $productinfor의 첫번째 배열의 p_no ex)40
    if(auth()->guard('customer')->user()){
      $c_no = auth()->guard('customer')->user()->c_no;
    }


    $product = DB::table('product_favorite')->where('product_no','=',$pro_no)->get(); //product_favorite테이블에서 product_no랑 현재상품번호랑 같은 product_no를가져옴
    $count = $product->where('customer_no','=',$c_no)->count();

    if($count>0){
      return redirect()->back();
    }
    elseif($count == 0){
      DB::table('product_favorite')->insert([
        'customer_no'=>$c_no,
        'product_no'=>$pro_no]);
        return redirect()->back();
      }
    }

    //customer 즐겨찾기 화면 정경진
    public function star(Request $request){
      if(auth()->guard('customer')->user()){
        $c_no = auth()->guard('customer')->user()->c_no;
        $pro = DB::table('product_favorite')->join('product','product_favorite.product_no','product.p_no')
        ->select('*')->where('customer_no','=',$c_no)->get();

        $pro2 = DB::table('store_favorite')->join('store','store_favorite.store_no','store.st_no')
        ->select('*')->where('customer_no','=',$c_no)->get();
        $data = DB::table('product_favorite')->join('product','product_favorite.product_no','=','product.p_no')
        ->select('*')->where('p_status','=','등록')->paginate(4);
        return view('star', compact('pro','pro2','data'));
      }
      else{
        return redirect('/');
      }
    }

    //내상품 삭제코드 정경진
    public function star2($id){
      if(auth()->guard('customer')->user()){
        $c_no = auth()->guard('customer')->user()->c_no;
      }
      $productinfor = DB::table('product')->select('*')->where('p_no','=',$id)->get();
      $delete = DB::table('product_favorite')->where('product_no','=',$productinfor[0]->p_no)->delete();
      return redirect()->back();
    }

    //꽃집 즐겨찾기 삭제코드 정경진
    public function store_star($id){
      if(auth()->guard('customer')->user()){
        $c_no = auth()->guard('customer')->user()->c_no;
      }
      $storeinfor = DB::table('store')->select('*')->where('st_name','=',$id)->get();
      $delete = DB::table('store_favorite')->where('store_no','=',$storeinfor[0]->st_no)->delete();
      return redirect()->back();
    }


    // 문의하기에서 상품정보 불러오기
    public function pd_info ($id){
      $cus = auth()->guard('customer')->user();
      $product = DB::table('product')->where('p_no',$id)->get();

      return view('pd_qna', compact('product','cus'));
    }



    // 문의하기 박소현
    public function pd_qna (Request $qna,$id){

      $productinfor = DB::table('product')->where('p_no',$id)->get();
      $pro_no = $productinfor[0]->p_no; // id(url)로 p_no 받아옴

      $today = date("Ymd"); //현재날짜 받아옴
      $state = $_GET['state']; //공개 비공개 여부

      if($cinfo = auth()->guard('customer')->user()){
        // return 0;
        $cprimary = $cinfo->c_no; //사용자의 c_no
        $customer = DB::table('customer')
        ->join('question', 'customer.c_no', '=', 'question.customer_no')->select('*')
        ->where('customer_no','=', $cprimary)->get();
      }

      DB::table('question')->insert([
        'q_title'=>$qna->input('qna_title'),
        'q_contents' => $qna->input('name'),
        'q_date' =>$today,
        'product_no'=>$pro_no,
        'customer_no'=>$cprimary,
        'q_state'=> $state
      ]);
      return redirect()->back();
    }


    //장바구니 페이지
    public function basket(){
      if(auth()->guard('customer')->user()){
        $userinfo = auth()->guard('customer')->user()->c_no;
        $data = DB::table('basket')->where('customer_no',$userinfo)->join('product','basket.product_no','=','product.p_no')->get();
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
    }
    //장바구니 상품삭제
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
    //장바구니에 상품 추가
    public function basketstore(Request $request){
      // return response()->json(1);
      $data =  $request->input('id');
      $pt = DB::table('product')->where('p_no',$data)->first();

      // return response()->json($test);
      if($userinfo = auth()->guard('customer')->user()){

        $prikey  = $userinfo->c_no;
        $test = DB::table('basket')->where('customer_no',$prikey)->where('product_no',$data)->get();
        if(count($test)>0){
          DB::table('basket')->where('product_no',$data)->update([
            'b_count' => $test[0]->b_count+1
          ]);
          return response()->json(11);
        }
        else{
          DB::table('basket')->insert([
            'b_price' => $pt->p_price ,
            'b_name' => $pt->p_name,
            'customer_no' => $prikey,
            'product_no' => $data,
            'b_count' =>  1,
            'b_delivery' => $pt->p_title,
            'b_picture' => $pt->p_filename
          ]);
          return response()->json(12);
        }
        return response()->json(13);
      }
      elseif($seller = auth()->guard('seller')->user()){
        return response()->json(1);
      }
      else{
        return response()->json(0);
      }


    }
    // 장바구니에 있는 상품에대해 수량 추가 삭제
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
    // 장바구니 선택 상태
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

    public function store_img_register(Request $request){
      {     $storeno = auth()->guard('seller')->user()->s_no; //현재 접속한 seller의 기본키
        $comparison = DB::table('store')->select('*')->where('seller_no','=', $storeno)->get(); //store 테이블에서 접속한 seller와 s_no이같은 행을 가져옴
        $path=$request->file('picture')->store('/','public');
        // return $path;
        DB::table('store')-> where('seller_no','=',$storeno) -> update([
          'st_img'=>$path
        ]);

    }
  }
}
