<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class ReviewController extends Controller
{

  public function my_review(Request $myv){ // 리뷰 등록 -- 박소현

    $custo = auth()->guard('customer')->user()->c_no;
    $rates = $_POST['hidden'];
    $today = date("Ymd");
    $path=$myv->file('picture');
    if($myv->hasFile('picture')){
      $path=$myv->file('picture')->store('/','public');
    }

    DB::table('review')->insert([
      'r_image' => $path,
      'r_contents' => $myv->input('text'),
      'r_score' => $rates,
      'r_date' => $today,
      'customer_no' => $custo
    ]);
    echo "<script>alert('후기가 등록되었습니다.');self.close();</script>";
  }


  public function rev_count(Request $re){ //리뷰 좋아요 증가 -- 박소현

    $pno = $re->input('num');
    // return $pno;
    $count = DB::table('review')->where('r_no',$pno)->get();
    $present = $count[0]->r_good;
    $plus = $present + 1;
    // return $plus;

    $good = DB::table('review')->where('r_no',$pno)->update([
      'r_good' => $plus
    ]);
    return response()->json(1);
  }

  public function myreview(){

    $cno = auth()->guard('customer')->user()->c_no;

    $my = DB::table('customer')->where('c_no',$cno)
    ->join('review', 'customer.c_no','=','review.customer_no')
    ->join('product', 'review.product_no','=','product.p_no')
    ->get();
    return $my;

    return view('mypage/c_mypage',compact('my'));

  }

}
