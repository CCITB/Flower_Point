<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

//jisuEO
class RegisterController extends Controller
{
  public function registerview()
  {
    return view('register');
  }
  #customer register query
  public function customer_store(Request $request)
  {
    DB::table('customer')->insert([
      'c_id'=>$request->input('c_id'),
      'c_password' => $request->input('c_password'),
      'c_name' => $request->input('c_name'),
      'c_phonenum' => $request->input('c_phonenum'),
      'c_email' => $request->input('c_email'),
      'c_gender' => $request->input('c_gender'),
      'c_birth' => $request->input('c_birth')
    ]);
    return redirect('/login');
  }

  //jisuEO 
  #seller register query
  public function seller_store(Request $request)
  {
    //동일 아이디 검사
    $input_id = trim($_POST['s_id']);
    $sellers = DB::table('seller')-> where('s_id','=',$input_id)->get()->count();
    // $sellers = DB::select("SELECT * FROM seller WHERE ['s_id','=',$input_id]")->count();

    //id_cehck
    if($_POST['s_id'] != NULL){

      if($sellers<1){
        echo "존재하지 않는 아이디입니다.";
      }

      else{
        echo "존재하는 아이디입니다.";
      }
    }

    //database insert
    if($sellers<1){
      DB::table('seller')->insert([
        's_id'=>$request->input('s_id'),
        's_password' => $request->input('s_password'),
        's_name' => $request->input('s_name'),
        's_phonenum' => $request->input('s_phonenum'),
        's_email' => $request->input('s_email'),
        's_gender' => $request->input('s_gender'),
        's_birth' => $request->input('s_birth')
      ]);
      return redirect('/information');
    }
    else{
      //code...
    }
  }
}
  //박소현
  // public function login_seller(Request $request)
  // {
  //   header("Content-Type:text/html; charset= UTF-8");
  //   session_start();
  //   $conn = mysqli_connect('ccit2020.cafe24.com','root','ccit200414!!');
  //   mysqli_query($conn,'SET NAMES utf8');
  //   $s_id = $_POST['login_id'];
  //   $s_password = $_POST['login_pw'];
  //   $sql = "select * from seller where login_id = '$s_id' and login_pw = '$s_password'";
  //   $res = $conn->query($sql);
  //   $row = mysqli_fetch_array($res);
  //
  //   if($res -> num_rows >0){
  //     $_SESSION['login_id'] = $s_id;
  //     if(isset($_SESSION['login_id'])){
  //       echo "<script>location.href='/';</script>";
  //     }
  //     else{
  //       echo "<script>alert('다시 로그인해주세요.');</script>";
  //     }
  //     else{echo "<script>alert('다시 로그인해주세요.');</script>";}
  //   }
  //
  //   return ('/');
  // }
