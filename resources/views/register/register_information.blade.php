<!--어지수-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/sign_up.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <title>매장 정보 기입</title>
</head>

<body>
  <div id="all">
    <div class="text">
      <div class="id_title">Store Information</div> <hr>
    </div>

    <div class="st_if">
      <form action = '/RegisterControllerSeller' method='post' name="insertstore" >
        @csrf
        <input type="hidden" name="s_id" value="<?php echo $_POST['s_id']?>">
        <input type="hidden" name="s_password" value="<?php echo $_POST['s_password']?>">
        <input type="hidden" name="s_name" value="<?php echo $_POST['s_name']?>">
        <input type="hidden" name="s_phonenum" value="<?php echo $_POST['s_phonenum']?>">
        <input type="hidden" name="s_email" value="<?php echo $_POST['s_email']?>">
        <input type="hidden" name="s_gender" value="<?php echo $_POST['s_gender']?>">
        <input type="hidden" name="s_birth_y" value="<?php echo $_POST['s_birth_y']?>">
        <input type="hidden" name="s_birth_m" value="<?php echo $_POST['s_birth_m']?>">
        <input type="hidden" name="s_birth_d" value="<?php echo $_POST['s_birth_d']?>">

        <div class="paragraph">
          <div class="sign_name">매장 이름</div>
          <input class="shop_info" type="text" placeholder="store name" id="st_name" name="st_name" >
          <div class="check_div" id="stname_check" value=""></div>
        </div>

        <div class="paragraph">
          <div class="sign_name">사업자 등록번호</div>
          <input class="shop_info2" type="text" id="registeration_num1" name="registeration_num1">
          -
          <input class="shop_info2" type="text" id="registeration_num2" name="registeration_num2">
          -
          <input class="shop_info2" type="text" id="registeration_num3" name="registeration_num3">
          <div class="check_div" id="stnum_check" value=""></div>
        </div>

        <div class="paragraph">
          <div class="sign_name">매장 주소</div>
          <input class="shop_info" type="text" placeholder="Shop Address" id="st_address" name="st_address">
          <div class="check_div" id="staddress_check" value=""></div>
        </div>

        <div class="paragraph">
          <div class="sign_name">고객센터 번호</div>
          <input class="shop_info" type="text" placeholder="Service Number" id="st_tel" name="st_tel">
          <div class="check_div" id="staddress_num" value=""></div>
        </div>

        <div class="paragraph">
          <div class="sign_name">매장 소개</div>
          <textarea placeholder="introduce" id="st_introduce" name="st_introduce" ></textarea>
        </div>
        <div class="under">
          <input class="lg_bt" type='submit' id="login" value="가입하기">
        </div>
      </form>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){

  $("#st_name").blur(function() {
    //input data
    var st_name = $("#st_name").val();
    //예외처리 -- 공백
    if(st_name==''){
      $('#stname_check').text('필수 정보입니다.');
      $('#stname_check').css('color', 'red');
    }
    else{
      $('#stname_check').text('');
      $('#stname_check').css('color', 'red');
    }
  });//blur

  $("#registeration_num1").blur(function() {
    // input
    var registeration_num1 = $('registeration_num1').val();
    var registeration_num2 = $('registeration_num2').val();
    var registeration_num3 = $('registeration_num3').val();
    //숫자 정규식
    var numJ = /^[0-9]*$/;
    //예외처리 -- 공백
    if(registeration_num1==''||registeration_num2==''||registeration_num3==''){
      $('#stnum_check').text("필수항목 입니다.");
      $('#stnum_check').css('color', 'red');
    }
    //공백X
    else{

    }
  });//blur

  $("#st_address").blur(function() {
    //input data
    var st_address = $('st_address').val();
    //공백
    if(st_address=''){
      $('#staddress_check').text("필수항목 입니다.");
      $('#staddress_check').css('color', 'red');
    }
    else{
      $('#staddress_check').text("");
    }
  });//blur

  $("#st_tel").blur(function() {
    //Input
    var st_tel = $('st_tel').val();
    //공백
    if(st_tel=''){
      $('#staddress_num').text("필수항목 입니다.");
      $('#staddress_num').css('color', 'red');
    }
    else{
      $('#staddress_num').text("");
    }
  });//blur
});

//onsubmit -- 어지수
function validatate(){
  var st_name = document.getElementById("st_name");
  var registeration_num = document.getElementById("registeration_num");
  var st_address = document.getElementById("st_address");
  var st_tel = document.getElementById("st_tel");
  var st_introduce = document.getElementById("st_introduce");

  if((st_name.value)==""){
    alert('매장명을 입력해주세요.');
    return false;
  }
  if((registeration_num.value)==""){
    alert('사업자등록번호를 입력해주세요.');
    return false;
  }
  if((st_address.value)==""){
    alert('매장주소를 입력해주세요.');
    return false;
  }
  if((st_tel.value)==""){
    alert('고객센터 번호를 입력해주세요.');
    return false;
  }
  if((st_introduce.value)==""){
    alert('매장소개를 입력해주세요.');
    return false;
  }

  else {
    return true;
  }
}
</script>
