<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
      <div class="text_des">본인확인 이메일로 인증({{$mymail}})</div>
    </div>
    <div class ="find_pw_way">
      <form action = '/f_way' name='emailform' method='post' onsubmit="return check_pw_way()">
        @csrf
        <div class="fd_id">
          <input type="hidden" name="hidden_email" id="hidden_email" value="">
          <input type="hidden" name="hidden_no" id="hidden_no" value="">

          <div class="character"></div>
          <div class="window">
            <div class="massage">*본인확인 이메일 주소와 입력한 이메일 주소가 같아야, 인증번호를 받을 수 있습니다</div>
            <div class="ip_name">이름</div>
            <input class="find_input" placeholder="이름을 입력하세요." name="name" id='name'>
            <div class="check_div" id="name_check" value=""></div>
            <div class="verify">
              <!--이메일 : 어지수-->
              <div class="sign_name">이메일</div>
              <!--인증번호를 전송할 이메일 기입창과 전송 버튼-->
              <input class="inf3" type="email" placeholder="email "id="s_email" name="s_email"  >
              <input class="btn_e" id="btn_email_way" type="button" value="인증번호 전송">
              <!--인증번호 기입란-->
              <input class="inf1" type="text" placeholder="인증번호 입력하세요. "id="verify_num" name="verify_num" disabled="">
              <div class="check_div" id="email_check" value=""></div>
            </div>
          </div>
        </div>

        <div class="under">
          <input class="lg_bt" type="submit" value="다음">
        </div>
      </form>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">
//find_pw에서 입력한 ID가 가진 email값 (find_pw_way page에서 입력하는 email과 동일한지 검사를 위해 가져옴)
var email = '{{$mymail}}';
var no = '{{$myno}}';
document.emailform.hidden_email.value = email;
document.emailform.hidden_no.value = no;
</script>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/find.js" charset="utf-8"></script>
