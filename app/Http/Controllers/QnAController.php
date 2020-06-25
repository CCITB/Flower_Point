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
    return $q_no;
    $today = new datetime();
    $exist = DB::table('answer')->where('question_no',$q_no)->get();
    return $exist;
    if(auth()->guard('seller')->user()){
      // if(){
      //
      // }
      DB::table('answer')->insert([
        'a_answer' => $request->input('name'),
        'a_date' => $today,
        'question_no' => $q_no
      ]);
    }
    return redirect(url()->previous());
  }
}
