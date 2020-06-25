<?php

namespace App\Http\Controllers;
use DB;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QnAController extends Controller
{
  //
  public function question_answer(Request $request,$q_no){
    // return $q_no;
    $today = new datetime();
    if(auth()->guard('seller')->user()){
      DB::table('answer')->insert([
        'a_answer' => $request->input('name'),
        'a_date' => $today,
        'question_no' => $q_no
      ]);
    }
    return redirect('/');
  }
}
