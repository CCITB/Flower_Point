<!DOCTYPE html> <!--박소현+어지수 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>로그인</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">

  <script>
  </script>

</head>
<body>
  <div id="all">
    <div class="text">
      Customer Login
      <hr>
    </div>

    <div class ="login">
      {{-- <form action = '/login_c' method="post" name="customer_login"> --}}
        {{-- @csrf --}}
        <p>
          <input class="lg" type="text"  id="login_id" onkeypress="enterkey()" placeholder="ID" name="login_id" value="" required >
          <div class="check_div" id="login_check1" value=""></div>
          <input class="lg" type="password" id="login_pw" onkeypress="enterkey()" placeholder="Password" name="login_pw" required>
          <div class="check_div" id="login_check" value=""></div>
        </p>

        <div class="go">
          <a href="/customer_find_id">아이디</a> ·
          <a href="/customer_find_pw">비밀번호 찾기</a>
        </div><br>
        <br>
        <input class="lg_bt" type="button" onclick="jaljomhaja()" value="로그인 ">
      {{-- </form> --}}
    </div>
    <div class="bottom">
      <a href = "/terms_customers">구매자 회원가입</a>
    </div>
    <div class="home">
      <a href = "/">홈으로</a>
    </div>
  </div>
</body>
</html>

<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">


// console.log(1);
// var a= 0;
// // console.log(a);
//
// $('#login_id').blur(function(){
// var  a = $('#login_id').val();
// // var a = 1;
// console.log(a);
// });
//
// $('#login_pw').blur(function(){
//   var a = $('#login_pw').val();
//   console.log(a);
//   // console.log($('#login_pw').val());
// });
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function jaljomhaja(){

  var login_id= $('#login_id').val(); //html에서 login_id라는 id값을 가진 태그를 가져와서 그태그에 쓰여있는값을 login_id라는 변수로 선언
  var login_pw= $('#login_pw').val(); //html에서 login_pw라는 id값을 가진 태그를 가져와서 그태그에 쓰여있는값을 login_pw라는 변수로 선언

  $.ajax({

    type: 'post',
    url: 'check_login',
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
      if(data==2){
        $('#login_check1').text("아이디를 입력해주세요");
        $('#login_check1').css('color', 'red');
        $("#login_id").focus();

      }

      if(data==3){
        $('#login_check').text("비밀번호를 입력해주세요");
        $('#login_check').css('color', 'red');
        $("#login_pw").focus();

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
{{-- <script type="text/javascript" src="/js/login.js" charset="utf-8"></script> --}}
