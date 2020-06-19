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
    $input_tell = $myid->get('tell');

    $fd_name = DB::table('seller')->where('s_name','=',$fd_id)->get();
    $myid = $fd_name[0]->s_name;
    $mytell = $fd_name[0]->s_phonenum;


    if($input_tell == $mytell){
        return view('find_information.find_check', compact('fd_name'));
      }
      else{
        return redirect('/find_id');
      }
    // $myfname = $fd_name->s_id;
    // if (count($fd_name)>0) {
    //   return view('find_information.find_check', compact('fd_name'));
    // }
    // else{
    //   return redirect('/find_id');
    // }
  }




  public function f_pw(Request $pw)//seller 비밀번호
  {
    $input_id = $pw->get('myid');
    // return $input_id;
    //$myid = DB::table('seller')->where(['s_id'=>$input_id])->get();
    $myinfo = DB::table('seller')->where('s_id','=',$input_id)->get();
    $myid = $myinfo[0]->s_no;

    // if (count($myinfo)>0) {
    //   return redirect('/find_pw_way');
    // }
    // else{
    //   // echo "<script>alert('존재하지 않는 아이디입니다.')</script>";
    //   return view('find_information.find_pw');
    // }
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
