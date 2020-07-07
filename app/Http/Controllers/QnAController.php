<?php

namespace App\Http\Controllers;
use DB;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
class QnAController extends Controller
{
  //
  public function question_answer(Request $request,$q_no){
    // return $q_no;
    $exist = DB::table('answer')->where('question_no',$q_no)->get();
    if(auth()->guard('seller')->user()){

      DB::table('answer')->insert([
        'a_answer' => $request->input('a_text'),
        'question_no' => $q_no
      ]);
      DB::table('question')->where('q_no',$q_no)->update([
        'an_state' => '답변완료'
      ]);
    }
    echo "<script>alert('답변이 등록되었습니다.');self.close();</script>";
  }


  public function answer($id){

    $answer = DB::table('question')->where('q_no',$id)
    ->join('customer','question.customer_no','=','customer.c_no')
    ->join('product','question.product_no','=','product.p_no')->get();
    
    return view('qna_answer', compact('answer'));

  }
}
