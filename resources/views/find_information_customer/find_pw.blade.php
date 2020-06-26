<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>꽃갈피 : 비밀번호 찾기</title>
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
      <form action="/customer_find_pw_controller" method="post" onsubmit="return check_find_pw()">
        @csrf
        <div class="intervel"></div>
        <input class="find_input" autofocus placeholder="꽃갈피 아이디" name="myid" id="c_id"><br>
        <div class="check_div" id="id_check" value=""></div>
        <div class="under_pw">
          <input class="lg_bt" type="submit" id="btn_submit" value="다음">
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
<script type="text/javascript" src="/js/find.js" charset="utf-8"></script>

<script>
var check;
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){
  var idJ= /^[a-z0-9_\-]{5,20}$/;
  $("#s_id").blur(function() {
    if(!idJ.test($("#c_id").val)){
      $('#id_check').text("");
    }
    else if($("#c_id").val==""){
      $('#id_check').text("필수 정보입니다.");
      $('#id_check').css('color', 'red');
      $("#c_id").focus();
    }
    else{
      $('#id_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능합니다.');
      $('#id_check').css('color', 'red');
      $("#c_id").focus();
    }
  });
});
function check_find_pw(){
  var idJ= /^[a-z0-9_\-]{5,20}$/;
  check;

  if($('#c_id').val()==''){
    $('#id_check').text("필수 정보입니다.1");
    $('#id_check').css('color', 'red');
    $("#c_id").focus();
    return false;
  }
  if(!idJ.test($('#c_id').val())){
    //2. 정규식 일치X
    $('#id_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능.');
    $('#id_check').css('color', 'red');
    $("#c_id").focus();
    return false;
  }

  else{
    input_id = $('#c_id').val();
    $.ajax({

      type: 'post',
      url: 'customer_id_check',
      dataType: 'json',
      data: { "id": input_id },

      success : function(data) {
        //console.log(data);
        if(data<1){
          alert("입력하신 아이디를 찾을 수 없습니다.");
          location.reload();
          return false;
        }
        if(data>0){
          console.log(check);
          alert("성공 check");
          return true;
        }
      }//success
      ,error : function() {   console.log("실패");  }
    }) //ajax
  }
};
</script>
