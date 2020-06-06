<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class information_controller extends Controller
{
    publiC function information(Request $request){
      DB::table('seller')->update([
        's_id'=>$request->input('s_id'),
        's_password'=>$request->input('s_password'),
        's_name'=>$request->input('s_name'),
        's_phonenum'=>$request->input('s_phonenum'),
        's_email'=>$request->input('s_email'),
      ]);

      return redirect('/mypage');
    }
}
