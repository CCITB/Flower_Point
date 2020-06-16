<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FindController extends Controller
{
  public function find_id(){
    return view('find_information.find_id');
  }

  public function find_pw(){
    return view('find_information.find_pw');
  }
  public function find_pw_way(){
    return view('find_information.find_pw_way');
  }

  public function find_pw_reset(){
    return view('find_information.find_pw_reset');
  }

  public function find_check(){
    return view('find_information.find_check');
  }




  public function f_id(Request $myid)//seller 아이디 찾기
  {
    $fd_id = $myid->get('name');

    $fd_name = DB::table('seller')->where(['s_name'=>$fd_id])->get();
    if (count($fd_name) > 0) {
      return redirect('/find_chk');
    }
    else{
      return redirect('/find_id');
    }
  }




  public function f_reset(Request $pw_r)//seller 비밀번호
  {
    $input_id = $pw_r->get('myid');
    $myid = DB::table('seller')->where(['s_id'=>$input_id])->get();
    if (count($myid) > 0) {
      return redirect('/find_pw_way');
    }
    else{
      return redirect('/find_pw');
    }

    $input_name = $pw_r->get('pw_name');
    $myname = DB::table('seller')->where(['s_name'=>$input_name])->get();
    if (count($myname) > 0) {
      return redirect('/find_pw_reset');
    }
    else{
      return redirect('/find_pw_way');
    }

    //
    // $fw_reset = $pw_r->get('name');
    //
    // $hi = DB::table('product')->update([
    //   'p_name'=>$fw_reset->input('new_pw'),
    // ]);
    //
    // return ($hi);
  }

}
