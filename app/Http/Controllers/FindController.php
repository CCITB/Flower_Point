<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// << 어지수 >>
class FindController extends Controller
{
  //--------------------------------customer-------------------------------
  //find_id의 ajax에서 id 존재 유무 판단을 위한 함수
  public function customer_email_query(Request $request){
    //name 입력 값
    $input_name = $request->get('input_name');
    $input_email = $request->get('input_email');

    //input한 name값과 동일한 s_name(이름)을 가진 rows
    $query_name = DB::table('customer')->where('c_name',$input_name)->get();
    //input한 name값과 동일한값을 가진 column들 중 input한 email을 가진 column의 수(있으면 1 / 없으면0)
    $query_email = $query_name->where('c_email',$input_email)->count();

    return response()->json($query_email);
  }

  //find_id에서 "phone"값으로 존재유무 판별 -- ajax사용
  public function customer_sms_query(Request $request){
    //name 입력 값
    $input_name = $request->get('input_name');
    //phone number 입력 값
    $input_phone_num = $request->get('input_tel');

    //input한 name값과 동일한 s_name(이름)을 가진 rows
    $query_name = DB::table('customer')->where('c_name',$input_name)->get();
    //input한 name값과 동일한값을 가진 column들 중 input한 email을 가진 column의 수(있으면 1 / 없으면0)
    $query_phone = $query_name->where('c_phonenum',$input_phone_num)->count();

    return response()->json($query_phone);
  }

  //customer 아이디 찾기 --email 인증
  public function customer_email_check(Request $request)
  {
    //input 값
    $input_mail = $request->get('input_email');
    $input_name = $request->get('name');

    //input한 email값과 일치하는 DB name 행
    $fd_mail = DB::table('customer')->where('c_email','=',$input_mail)->get();

    //입력한 Email과 일치하는 값을 가진 row 중, 입력한 name과 일치하는 id의 행의 개수.
    $query_result = $fd_mail->where('c_name',$input_name)->pluck('c_id');

    //input name과 테이블 상의 email 행의 name이 일치할 경우
    if ( $query_result->count() > 0 ) {
      return view('find_information_customer.find_check', compact('query_result'));
    }
    else{
      return redirect('/customer_find_id');
    }
  }

  //customer 아이디 찾기 --sms 인증
  public function customer_sms_check(Request $request)
  {
    //input 값
    $input_name = $request->get('name');
    $input_tel1 = $request->get('input_tel1');
    $input_tel2 = $request->get('input_tel2');
    $input_tel3 = $request->get('input_tel3');

    $input_tel = $input_tel1.'-'.$input_tel2.'-'.$input_tel3;

    //input한 phonenumber 값과 일치하는 DB 행
    $fd_phone = DB::table('customer')->where('c_phonenum','=',$input_tel)->get();

    $query_result = $fd_phone->where('c_name',$input_name)->pluck('c_id');

    //input name과 테이블 상의 email 행의 name이 일치할 경우
    if ( $query_result->count() >0 ) {
      return view('find_information_customer.find_check', compact('query_result'));
    }
    else{
      return redirect('/customer_find_id');
    }
  }

  //[[find_pw]] 아이디 비교  - jquery
  public function customer_id_check(Request $request)
  {
    //find_pw - jquery
    $input = $request->input('id');
    $sellers = DB::table('customer')-> where('c_id','=',$input)->get()->count();
    return response()->json($sellers);
  }

  public function customer_find_pw(Request $request)
  {
    //동일 아이디 확인
    $input_id = trim($_POST['myid']);

    //입력한 id의 no값
    $myinfo = DB::table('customer')->where('c_id','=',$input_id)->get();

    $myno = $myinfo[0]->c_no;
    $mymail = $myinfo[0]->c_email;
    $mytel = $myinfo[0]->c_phonenum;
    if (($myinfo->count())>0) {
      return view('find_information_customer.find_pw_way',
      ['mymail'=>$mymail,
      'mytel'=>$mytel,
      'myno'=>$myno]
    );
  }
  else{
    return view('find_information_customer.find_pw');
  }
}

//find_way 에서 인증
public function customer_eamil_way(Request $request)
{
  //인증된 이메일(가입된 이메일)
  $certified_email = $request->get('hidden_email');

  //find_pw 에서 입력한 id의 no값
  $myno = $request->get('hidden_no');

  //입력된 이름
  $input_name = $request->input('name');
  //입력된 이메일
  $input_email = $request->input('input_email');

  //find_pw에서 입력된 email의 컬럼
  $email = DB::table('customer')->where('c_email','=',$certified_email)->get();


  //find_pw에서 입력된 id의 email과 find_pw_way에서 입력된 email이 동일할 경우
  if($certified_email == $input_email ){
    //return redirect('/find_pw_reset');
    return view('find_information_customer.find_pw_reset', compact('myno'));
  }
  else{
    return redirect('/find_pw_way_customer');
  }
}

public function customer_sms_way(Request $request)
{
  //입력한 ID의 Phone (DB상에 실제 존재하는 번호)
  $certified_tel = $request->get('hidden_tel');

  //find_pw 에서 입력한 id의 no값
  $myno = $request->get('hidden_no');

  //입력된 이름
  $input_name = $request->input('name');
  //입력된 이메일
  $input_tel1 = $request->input('input_tel1');
  $input_tel2 = $request->input('input_tel2');
  $input_tel3 = $request->input('input_tel3');
  $input_tel = $input_tel1.'-'.$input_tel2.'-'.$input_tel3;


  //find_pw에서 입력된 email의 컬럼
  $email = DB::table('customer')->where('c_phonenum','=',$certified_tel)->get();


  //find_pw에서 입력된 id의 email과 find_pw_way에서 입력된 email이 동일할 경우
  if($certified_tel == $input_tel ){
    //return redirect('/find_pw_reset');
    return view('find_information_customer.find_pw_reset', compact('myno'));
  }
  else{
    return redirect('/find_pw_way_customer');
  }
}

public function customer_f_reset(Request $request)
{
  //find_pw 에서 입력한 id의 no값
  $c_no = $request->get('hidden_no');

  DB::table('customer')->where(['c_no'=>$c_no])->update([
    'c_password'=>bcrypt($request->input('new_pw'))]);

    return redirect('/login_customer');
  }


  //---------------------------------seller--------------------------------
  public function seller_email_query(Request $request){
    //name 입력 값
    $input_name = $request->get('input_name');
    $input_email = $request->get('input_email');

    //input한 name값과 동일한 s_name(이름)을 가진 rows
    $query_name = DB::table('seller')->where('s_name',$input_name)->get();
    //input한 name값과 동일한값을 가진 column들 중 input한 email을 가진 column의 수(있으면 1 / 없으면0)
    $query_email = $query_name->where('s_email',$input_email)->count();

    return response()->json($query_email);
  }
  //find_id에서 "phone"값으로 존재유무 판별 -- ajax사용
  public function seller_sms_query(Request $request){
    //name 입력 값
    $input_name = $request->get('input_name');
    //phone number 입력 값
    $input_phone_num = $request->get('input_tel');

    //input한 name값과 동일한 s_name(이름)을 가진 rows
    $query_name = DB::table('seller')->where('s_name',$input_name)->get();
    //input한 name값과 동일한값을 가진 column들 중 input한 email을 가진 column의 수(있으면 1 / 없으면0)
    $query_phone = $query_name->where('s_phonenum',$input_phone_num)->count();

    return response()->json($query_phone);
  }
  // 아이디 찾기 --sms 인증
  public function seller_email_check(Request $request)
  {
    //input 값
    $input_mail = $request->get('input_email');
    $input_name = $request->get('name');

    //input한 email값과 일치하는 DB name 행
    $fd_mail = DB::table('seller')->where('s_email','=',$input_mail)->get();

    //입력한 Email과 일치하는 값을 가진 row 중, 입력한 name과 일치하는 id의 행의 개수.
    $query_result = $fd_mail->where('s_name',$input_name)->pluck('s_id');

    //input name과 테이블 상의 email 행의 name이 일치할 경우
    if ( $query_result->count() > 0 ) {
      return view('find_information_seller.find_check', compact('query_result'));
    }
    else{
      return redirect('/seller_find_id');
    }
  }
  public function seller_sms_check(Request $request)
  {
    //input 값
    $input_name = $request->get('name');
    $input_tel1 = $request->get('input_tel1');
    $input_tel2 = $request->get('input_tel2');
    $input_tel3 = $request->get('input_tel3');

    $input_tel = $input_tel1.'-'.$input_tel2.'-'.$input_tel3;

    //input한 phonenumber 값과 일치하는 DB 행
    $fd_phone = DB::table('seller')->where('s_phonenum','=',$input_tel)->get();

    $query_result = $fd_phone->where('s_name',$input_name)->pluck('s_id');

    //input name과 테이블 상의 email 행의 name이 일치할 경우
    if ( $query_result->count() >0 ) {
      return view('find_information_seller.find_check', compact('query_result'));
    }
    else{
      return redirect('/seller_find_id');
    }
  }
  //find_pw - jquery
  public function seller_id_check(Request $request)
  {
    //find_pw - jquery
    $input = $request->input('id');
    $sellers = DB::table('seller')-> where('s_id','=',$input)->get()->count();
    return response()->json($sellers);
  }

  //입력한 id의 정보를 가져옴 --- find_pw seller에서 사용
  public function seller_find_pw(Request $request)
  {
    //동일 아이디 확인
    $input_id = trim($_POST['myid']);

    //입력한 id의 no값
    $myinfo = DB::table('seller')->where('s_id','=',$input_id)->get();

    $myno = $myinfo[0]->s_no;
    $mymail = $myinfo[0]->s_email;
    $mytel = $myinfo[0]->s_phonenum;
    if (($myinfo->count())>0) {
      return view('find_information_seller.find_pw_way',
      ['mymail'=>$mymail,
      'mytel'=>$mytel,
      'myno'=>$myno]
    );
  }
  else{
    return view('find_information_seller.find_pw');
  }
}

public function seller_eamil_way(Request $request)//seller 비밀번호
{
  //인증된 이메일(가입된 이메일)
  $certified_email = $request->get('hidden_email');
  //find_pw 에서 입력한 id의 no값
  $myno = $request->get('hidden_no');
  //입력된 이름
  //$input_name = $request->input('name');
  //입력된 이메일
  $input_email = $request->input('input_email');

  //find_pw에서 입력된 email의 컬럼
  $email = DB::table('seller')->where('s_email','=',$certified_email)->get();


  //find_pw에서 입력된 id의 email과 find_pw_way에서 입력된 email이 동일할 경우
  if($certified_email == $input_email ){
    //return redirect('/find_pw_reset');
    return view('find_information_seller.find_pw_reset', compact('myno'));
  }
  else{
    return redirect('/find_pw_way_seller');
  }
}
//find_way 에서 인증
public function seller_sms_way(Request $request)//seller 비밀번호
{
  //입력한 ID의 Phone (DB상에 실제 존재하는 번호)
  $certified_tel = $request->get('hidden_tel');

  //find_pw 에서 입력한 id의 no값
  $myno = $request->get('hidden_no');

  //입력된 이름
  // $input_name = $request->input('name');
  //입력된 이메일
  $input_tel1 = $request->input('input_tel1');
  $input_tel2 = $request->input('input_tel2');
  $input_tel3 = $request->input('input_tel3');
  $input_tel = $input_tel1.'-'.$input_tel2.'-'.$input_tel3;


  //find_pw에서 입력된 email의 컬럼
  $email = DB::table('seller')->where('s_phonenum','=',$certified_tel)->get();


  //find_pw에서 입력된 id의 email과 find_pw_way에서 입력된 email이 동일할 경우
  if($certified_tel == $input_tel ){
    //return redirect('/find_pw_reset');
    return view('find_information_seller.find_pw_reset', compact('myno'));
  }
  else{
    return redirect('/find_pw_way_seller');
  }
}

public function seller_f_reset(Request $request)
{
  //find_pw 에서 입력한 id의 no값
  $s_no = $request->get('hidden_no');

  DB::table('seller')->where(['s_no'=>$s_no])->update([
    's_password'=>bcrypt($request->input('new_pw'))]);

    return redirect('/login_seller');
  }
}
