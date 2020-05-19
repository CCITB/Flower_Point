<?php

$conn = mysqli_connect("ccit2020.cafe24.com","root","ccit200414!!","flower_point") or die ("실패"); //db연결
$dbconn =  mysqli_select_db("seller",$conn);

mysqli_close($conn);//접속종료


?>
