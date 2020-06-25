<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FindController extends Controller
{

  // public function find_pw(){
  //   return view('find_information.find_pw');
  // }
  // public function find_pw_way(){
  //   return view('find_information.find_pw_way');
  // }
  //
  // public function find_pw_reset(){
  //   return view('find_information.find_pw_reset');
  // }
  //
  // public function find_check(){
  //   return view('find_information.find_check');
  // }

  //**************INPUT값(name,email)이 DB에 있는지 -- 어지수**************
  public function check_query(Request $request){
    //name 입력 값
    $input_name = $request->get('input_name');
    $input_email = $request->get('input_email');

    //input한 name값과 동일한 s_name(이름)을 가진 rows
    $query_name = DB::table('seller')->where('s_name',$input_name)->get();
    //input한 name값과 동일한값을 가진 column들 중 input한 email을 가진 column의 수(있으면 1 / 없으면0)
    $query_email = $query_name->where('s_email',$input_email)->pluck('s_email')->count();
    //echo $query_email;
    //(있으면 1 / 없으면 0)
    return response()->json($query_email);
  }
  //박소현
  public function seller_find_id(Request $myid)//seller 아이디 찾기
  {
    //input한 email값
    $input_mail = $myid->get('s_email');

    //input한 name값과 일치하는 DB name 행
    $fd_mail = DB::table('seller')->where('s_email','=',$input_mail)->get();
    $query_mail = $fd_mail[0]->s_email;


    if ( $input_mail  == $query_mail) {
      return view('find_information_seller.find_check', compact('fd_mail'));
    }
    else{
      return redirect('/find_id');
    }
  }
  //**************pw -- 어지수**************
  //find_pw - jquery
  public function seller_id_check(Request $request)
  {
    //find_pw - jquery
    $input = $request->input('id');
    $sellers = DB::table('seller')-> where('s_id','=',$input)->get()->count();
    return response()->json($sellers);
  }

  public function seller_find_pw(Request $request)//seller 비밀번호
  {
    //동일 아이디 확인
    $input_id = trim($_POST['myid']);

    $myinfo = DB::table('seller')->where('s_id','=',$input_id)->get();

    $myno = $myinfo[0]->s_no;
    $mymail = $myinfo[0]->s_email;

    if (($myinfo->count())>0) {
      return view('find_information_seller.find_pw_way',
      ['mymail'=>$mymail,
      'myno'=>$myno]
    );
  }
    else{
      return view('find_information_seller.find_pw');
    }
  }

  public function f_way(Request $request)//seller 비밀번호
  {
    //인증된 이메일(가입된 이메일)
    $certified_email = $request->get('hidden_email');
    //find_pw 에서 입력한 id의 no값
    $myno = $request->get('hidden_no');

    //입력된 이름
    $input_name = $request->input('name');
    //입력된 이메일
    $input_email = $request->input('s_email');

    //find_pw에서 입력된 email의 컬럼
    $email = DB::table('seller')->where('s_email','=',$certified_email)->get();


    //find_pw에서 입력된 id의 email과 find_pw_way에서 입력된 email이 동일할 경우
      if($certified_email == $input_email ){
      //return redirect('/find_pw_reset');
      return view('find_information_seller.find_pw_reset', compact('myno'));
    }
    else{
      return redirect('/find_pw_way');
    }
}


  public function f_reset(Request $request)
  {
    //find_pw 에서 입력한 id의 no값
    $s_no = $request->get('hidden_no');

    DB::table('seller')->where(['s_no'=>$s_no])->update([
      's_password'=>bcrypt($request->input('new_pw'))]);

      return redirect('/login_seller');
  }
}
