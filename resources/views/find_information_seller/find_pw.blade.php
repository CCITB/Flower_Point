<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>비밀번호 찾기</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/find.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">

</head>
<body>

  <div id="all">
    <div class="text">
      <div class="id_title">Find Password</div> <hr>
      <div class="text_des">비밀번호를 찾고자 하는 아이디를 입력해 주세요.</div>
    </div>

    <div class ="find_pw">
        {{-- <form action = "{{url('find')}}" method='post'> --}}
        <form action="/seller_find_pw" method="post">
          @csrf
          <div class="intervel"></div>
          <input class="find_input" autofocus placeholder="꽃갈피 아이디" name="myid" id="s_id"><br>
          <div class="check_div" id="id_check" value=""></div>
          <div class="under_pw">
            <input class="lg_bt" type="submit" value="다음">
          </div>
        </form>
    </div>
    <div class="home">
      <a href = "/">홈으로</a>
    </div>
  </div>
</body>
</html>

<!--******************************<<예외처리 및 클릭 이벤트 : 어지수>>*****************************************-->
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
var markJ;
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){
  $("#s_id").blur(function() {
    //정규식
    mark = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

    if($("#s_id").val != ""){
      $('#id_check').text("필수 정보입니다.");
      $('#id_check').css('color', 'red');
      $("#s_id").focus();
    }
    else if(!mark.test($("#s_id").val)){
      $('#id_check').text("필수 정보입니다.");
    }
  });

});

function checkfunction(){
  if($("#s_id").val != ""){
    $('#id_check').text("필수 정보입니다.");
    $('#id_check').css('color', 'red');
    $("#s_id").focus();
  }
}
</script>
