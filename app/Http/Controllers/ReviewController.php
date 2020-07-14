<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class ReviewController extends Controller
{

  public function pd_review($re){

    $mypd = DB::table('payment')->where('pm_no',$re)
    ->join('product','payment.product_no','=','product.p_no')
    ->join('store','product.store_no','=','store.st_no')
    ->get();

    return view('review', compact('mypd'));
  }

  public function my_review(Request $myv,$id){ // 리뷰 등록 -- 박소현

    $custo = auth()->guard('customer')->user()->c_no;

    $pm_no = $_POST['pm_no'];
    $mypd = DB::table('payment')->where('pm_no',$pm_no)
    ->join('product','payment.product_no','=','product.p_no')
    ->leftjoin('review','payment.pm_no','=','review.payment_no')
    ->get();
    $review_pm = $mypd[0]->r_no;

    if(isset($review_pm)){
      echo "<script>alert('이미 등록된 후기입니다.');self.close();</script>";
    } else{

      $price = $_POST['price']; // 상품가격
      $point = $price * 2 / 100; // point (2%)
      $myinfo = DB::table('customer')->where('c_no',$custo)->get();
      $myp = $myinfo[0]->c_point;
      $total_p = $point + $myp; // 내 포인트 + 2%

      $rates = $_POST['hidden']; //별점 개수
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
        'customer_no' => $custo,
        'product_no' => $id,
        'payment_no' => $pm_no
      ]);
      DB::table('customer')->where('c_no',$custo)->update([
        'c_point'=>$total_p
      ]);
      return "<script>alert('후기가 등록되었습니다.');opener.parent.location.reload();
      window.close();</script>";
    }
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


}
