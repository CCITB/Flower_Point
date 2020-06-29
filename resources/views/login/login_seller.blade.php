<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>로그인</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
  <script>
  </script>
</head>

<body>

  <div id="all">
    <div class="text">
      Seller Login
      <hr>
    </div>

    <div class ="login">

        @csrf
        <p>
          <input class="lg" type="text" id="login_id" onkeydown="enterkey()" placeholder="ID" name="login_id" required >
            <div class="error" id="login_check1" display="none" value=""></div>
          <input class="lg" type="password" id="login_pw" onkeydown="enterkey()" placeholder="Password" name="login_pw" required>
            <div class="check_div" id="login_check" display="none" value=""></div>
        </p>
        <div class="go">
          <a href="/seller_find_id">아이디</a> ·
          <a href="/seller_find_pw">비밀번호 찾기</a>
        </div><br>
        <br>
        <input class="lg_bt" type="button" onclick="jaljomhaja()" value="로그인">
    </div>
    <div class="bottom">
      <a href = "/terms_sellers">판매자 회원가입</a>
    </div>
    <div class="home">
      <a href = "/">홈으로</a>
    </div>
  </div>
</body>
</html>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function jaljomhaja(){

  var a = document.getElementById("login_id");
  var b = document.getElementById("login_pw");

  if((a.value)==""){

        $('#login_check1').text("ID를 입력해주세요.");
        $('#login_check1').css('color', 'red');
        $("#login_id").focus();
        return false;
  }
if((b.value)==""){
  $('#login_check').text("Password를 입력해주세요.");
  $('#login_check').css('color', 'red');
  $("#login_pw").focus();
  document.getElementById('login_check1').style.display="none";
  return false;
}
  var login_id= $('#login_id').val(); //html에서 login_id라는 id값을 가진 태그를 가져와서 그태그에 쓰여있는값을 login_id라는 변수로 선언
  var login_pw= $('#login_pw').val(); //html에서 login_pw라는 id값을 가진 태그를 가져와서 그태그에 쓰여있는값을 login_pw라는 변수로 선언

  $.ajax({

    type: 'post',
    url: 'check_sellerlogin',
    dataType: 'json',
    data:{
      "input_id" : login_id,  //input_id는 key값 컨트롤러에서 사용되는 값, login_id는 value값 var login_id로 선언된 값
      "input_pw" : login_pw
    },

    success : function(data) {
      console.log(data);
      if(data==0){
        $('#login_check').text("가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.");
        $('#login_check').css('color', 'red');
        $("#login_id").focus();

      }
      else if(data==1){
        location.href="/";
      }

    }//success
    ,error : function() { }
  });
}

function enterkey() {
        if (window.event.keyCode == 13) {
             // 엔터키가 눌렸을 때 실행할 내용
             jaljomhaja();
        }
        // else return false;
}


</script>
