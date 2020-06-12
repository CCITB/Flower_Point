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
    $search_query = $request->input('query');

    //input data의 문자가 포함된 product name 찾기
    $result_data = DB::table('product')->where('p_name','like','%'.$search_query.'%')->get();
    $result_name = $result_data->count();
    //echo $result_name;

    //compact('result_data')
    return view('search_result',
    ['result_data'=>$result_data,
    'search_query'=>$search_query,
    'result_cnt'=>$result_name]
  );

}
}
