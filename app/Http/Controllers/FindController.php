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

  //**************INPUT값(name,email)이 DB에 있는지 : 어지수**************
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
    // //input한 name값
    // $input_name = $myid->get('name');
    //
    // //input한 name값과 일치하는 DB name 행
    // $fd_name = DB::table('seller')->where('s_name','=',$input_name)->get();
    // $query_name = $fd_name[0]->s_name;

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

  public function seller_find_pw(Request $pw)//seller 비밀번호
  {
    $input_id = $pw->get('myid');
    // return $input_id;
    //$myid = DB::table('seller')->where(['s_id'=>$input_id])->get();
    $myinfo = DB::table('seller')->where('s_id','=',$input_id)->get();
    $myid = $myinfo[0]->s_no;

    if (count($myinfo)>0) {
      return redirect('/find_pw_way');
    }
    else{
      // echo "<script>alert('존재하지 않는 아이디입니다.')</script>";
      return view('find_information.find_pw');
    }
  }

  public function f_way($id){

    $myno = DB::table('seller')->where('s_no','=',$id)->get();
    // return $productinfor;

    // $productdata = DB::table('product')->where('p_no','=',$id)->first();
    // return $productdata;
    return view('find_information.find_pw_way', compact('myno'));
  }

  // public function f_way(Request $pw)//seller 비밀번호
  // {
  //   $input_id = $pw->get('myid');
  //   $input_name = $pw->get('pw_name');
  //   // $input_tell = $pw->get('pw_tell');
  //
  //   // return $input_name;
  //
  //   $myinfo = DB::table('seller')->where('s_id','=',$input_id)->get();
  //   $myid = $myinfo[0]->s_id;
  //   $myname = $myinfo[0]->s_name;
  //   // $mytell = $myinfo[0]->s_phonenum;
  //
  //   if($input_name == $myname){
  //     return redirect('/find_pw_reset');
  //   }
  //   else{
  //     return redirect('/find_pw_way');
  //   }



  public function find(Request $request)
  {
    // $picturerow = DB::table('product_image')->where('i_no','=',5)->first();
    // $picture = $picturerow->i_filename;
    // return $picture;
    $sellerno =  DB::table('seller')->where('s_id','=',$input_id)->get();
    $comparison = DB::table('store')->where('seller_no','=', $storeno)->first();
  }



  // public function f_way($id){
  //
  //   $productinfor = DB::table('seller')->where('s_no','=',$id)->get();
  //   // return $productinfor;
  //
  //   // $productdata = DB::table('product')->where('p_no','=',$id)->first();
  //   // return $productdata;
  //   return view('find_information.find_pw_way', compact('productinfor'));
  // }







}



// public function f_rese(Request $pw_r)//seller 비밀번호
// {
//   $input_id = $pw_r->get('myid');
//   $input_name = $pw_r->get('pw_name');
//   // return $input_id;
//   //$myid = DB::table('seller')->where(['s_id'=>$input_id])->get();
//   $myid = DB::table('seller')->where('s_id','=',$input_id)->get();
//   // return $myid[0]->s_name;
//   //  $myname = DB::table('seller')->where(['s_name'=>$input_name]);
//   // $myid->s_name;
//   // $myid->
//   // return 0;
//   if (isset($myid)) {
//     return redirect('/find_pw_way');
//   }
//   if (count($myname) > 0) {
//     return redirect('/find_pw_reset');
//   }
//   else{
//     return redirect('/find_pw_way');
//   }
// }
