<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

//어지수
class SortController extends Controller
{
  //높은 가격순 정렬
  public function Sort_H(){
    $data = DB::table('product')->orderBy('p_price', 'desc')->paginate(12);
    return view('allproductpage',compact('data'));
  }

  //낮은 가격순 정렬
  public function Sort_L(){
    $data = DB::table('product')->orderBy('p_price', 'asc')->paginate(12);
    return view('allproductpage',compact('data'));
  }

}
