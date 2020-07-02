<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class ReviewController extends Controller
{

  public function my_review(Request $myv){

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

    // 이미지 저장경로 public\storage\
    // return $path;
    // 이미지 product 테이블과 연결해서 저장
  }

  public function review(){



  }


  public function rev_count(){


  }



}
