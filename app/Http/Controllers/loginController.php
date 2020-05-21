<?php

$conn = mysqli_connect("ccit2020.cafe24.com","root","ccit200414!!","flower_point") or die ("실패"); //db연결
$dbconn =  mysqli_select_db("seller",$conn);

mysqli_close($conn);//접속종료

// header("Content-Type:text/html; charset= UTF-8");
// session_start();
// $conn = mysqli_connect('ccit2020.cafe24.com','root','ccit200414!!');
// mysqli_query($conn,'SET NAMES utf8');
// $s_id = $_POST['login_id'];
// $s_password = $_POST['login_pw'];
// $sql = "select * from seller where login_id = '$s_id' and login_pw = '$s_password'";
// $res = $conn->query($sql);
// $row = mysqli_fetch_array($res);
//
// if($res -> num_rows >0){
//   $_SESSION['login_id'] = $s_id;
//   if(isset($_SESSION['login_id'])){
//     echo "<script>location.href='/';</script>";
//   }
//   else{
//     echo "<script>alert('다시 로그인해주세요.');</script>";
//   }
//   else{echo "<script>alert('다시 로그인해주세요.');</script>";}
// }
//
// return ('/');
?>
