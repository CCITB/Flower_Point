<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <title>아이디 찾기</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/find.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body>

  <div id="all">
    <div class="text">
      <div class="id_title">Find ID</div> <hr>
      <div class="text_des">회원정보에 등록한 휴대전화로 인증</div>
    </div>

    <div class ="find_id">
      <form action = '/f_id' method='post' name="fin_id" onsubmit="return check()">
        @csrf
        <div class="fd_id">
          <div class="character"> </div>
          <div class="window">
            <div class="ip_name">이름</div>
            <input class="find_input" placeholder="이름을 입력하세요." name="name" id='name'>
            <div class="check_div" id="name_check" value=""></div>
            {{-- <div class="ip_name">전화번호</div>
            <input class="find_input" placeholder="전화번호를 입력하세요" name="tell"> --}}
            {{-- <input type="submit" value="인증"><br><br>
            <input class="find_input" placeholder="인증번호">
            <input type="submit" value="확인"><br><br> --}}
            <div class="verify">
              <div class="sign_name">이메일</div>
              <!--인증번호를 전송할 이메일 기입창과 전송 버튼-->
              <input class="inf3" type="email" placeholder="email "id="s_email" name="s_email"  >
              <input class="btn_e" id="btn_email" type="button" value="인증번호 전송">
              <!--인증번호 기입란-->
              <input class="inf1" type="text" placeholder="인증번호 입력하세요. "id="verify_num" name="verify_num" disabled="">
              <div class="check_div" id="email_check" value=""></div>
            </div>
          </div>
        </div>
        <div class="under">
          <input class="lg_bt" id='id_bt' type="submit" value="찾기">
        </div>
      </form>
    </div>
    <div class="bottom">
      <a href = "/find_pw">비밀번호 찾기</a>
    </div>
    <div class="home">
      <a href = "/">홈으로</a>
    </div>
  </div>
</body>
</html>

<!--지수-->
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
var global_random;
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){
  $("#name").blur(function() {
    check_name();
  });

  $("#btn_email").click(function() {
    verify_email();
  });

  //********************이름*****************
  function check_name(){
    //input data
    var seller_name = $('#name').val();
    //정규식
    var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

    //1. 공백 -- 빈칸
    if(seller_name == ""){
      $('#name_check').text("필수 정보입니다.");
      $('#name_check').css('color', 'red');

    }
    //2. 공백X 특수기호, 스페이스바 사용
    else if(markJ.test(seller_name)){
      $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
      $('#name_check').css('color', 'red');
    }
    //3. 공백X
    else{
      //4. 특수문자, 공백 미포함시
      if(!markJ.test(seller_name)){
        $("#name_check").text("");
      }
    }
  }
  //*****************이메일*******************
  function verify_email(){
    //  var email = document.getElementById("s_email");
    var input_name = $('#name').val();
    var seller_val = $('#s_email').val();
    //정규식
    var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/

    //1. 공백 X
    if(!seller_val == ""){
      //2. 정규식 O
      if(verifyJ.test(seller_val)){

        $('#email_check').text("인증번호가 전송되었습니다.");
        $('#email_check').css('color', 'green');
        $('#verify_num').attr('disabled', false);

        $.ajax({

          type: 'post',
          url: 'mail',
          async:false,
          dataType: 'json',
          data: { "email": seller_val },

          success : function(randomNum) {
            global_random = randomNum;
            console.log(randomNum);
          }//success
          ,error : function() { }
        });
      }
      //3. 정규식 X
      else{
        $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
        $('#email_check').css('color', 'red');
      }
    } //공백조건식

    //2. 공백 O
    else{
      $('#email_check').text("필수 정보입니다.");
      $('#email_check').css('color', 'red');
    }
  }
});

function check(){
  global_random;
  var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/
  //--------------------이름
  if($('#name').val() == ""){
    $('#name_check').text("필수 정보입니다.");
    $('#name_check').css('color', 'red');.
    $("#name").focus();
    return false;
  }
  // 공백X 특수기호, 스페이스바 사용
  if(markJ.test($('#name').val())){
    $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
    $('#name_check').css('color', 'red');
    $("#name").focus();
  }
  //-------------------이메일
  if($('#s_email').val() == ""){
    $('#email_check').text("필수 정보입니다.");
    $('#email_check').css('color', 'red');
    $("#s_email").focus();
    return false;
  }

  if(!verifyJ.test($('#s_email').val())){
    $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
    $('#email_check').css('color', 'red');
    $("#s_email").focus();
    return false;
  }
  //-------------------이메일 인증
  //인증 칸 공백
  if($('#verify_num').val() == ""){
    $('#email_check').text("인증이 필요합니다.");
    $('#email_check').css('color', 'red');
    $("#verify_num").focus();
    return false;
  }
  if(global_random != $('#verify_num').val()){
    $('#email_check').text("인증번호를 다시 확인해주세요.");
    $('#email_check').css('color', 'red');
    $("#verify_num").focus();
    return false;
  }
  else{
    return true;
  }
}
</script>
