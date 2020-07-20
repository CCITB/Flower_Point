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

    //insert data
    $search_query = $request->input('query');

    //input data와 동일한 값을 Product table의 이름을 기준으로 Search
    $result_data = DB::table('product')->join('store','product.store_no','store.st_no')->where('p_name','like','%'.$search_query.'%')->get();
    //input data 결과가 없을 경우 사용할 count
    $result_name = $result_data->count();

    return view('search_result',
    ['result_data'=>$result_data,
    'search_query'=>$search_query,
    'result_cnt'=>$result_name]
  );

}
}
