<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InformationController extends Controller
{
    publiC function information(Request $request){
      DB::table('seller')->where(['s_no'=>auth()->guard('seller')->user()->s_no])->update([
        's_name'=>$request->input('s_name'),
        's_phonenum'=>$request->input('s_phonenum'),
        's_email'=>$request->input('s_email'),
      ]);

      return redirect('/mypage');
    }
}
