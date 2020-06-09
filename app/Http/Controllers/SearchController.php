<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

//어지수
class SearchController extends Controller
{
  public function result(Request $request)
  {

    //search data
    $search_data = $request->input('query');
    //input data의 문자가 포함된 product name 찾기
    $result_data = DB::table('product')->where('p_name','like','%'.$search_data.'%')->get();
    //input data의 문자가 포함된 product 개수
    $result_count = $result_data->count();

    if($result_count>0){
      return view('search_result', compact('result_data'));
    }
    //결과가 없을 때 ---(수정필요)
    else{
      //return view('search_result', )
    }
  }
}
