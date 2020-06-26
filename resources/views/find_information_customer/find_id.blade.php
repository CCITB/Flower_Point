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
      <div class="text_des">회원정보에 등록한 이메일로 인증</div>
    </div>

    <div class ="find_id">
      <form action = '/customer_find_id' method='post' name="fin_id" onsubmit="return checkfunction_customer()">
        @csrf
        <div class="fd_id">
          <div class="character"> </div>
          <div class="window">
            <div class="ip_name">이름</div>
            <input class="find_input" placeholder="이름을 입력하세요." name="name" id='name'>
            <div class="check_div" id="name_check" value=""></div>

            <div class="verify">
              <div class="sign_name">이메일</div>
              <div class="massage">* 회원가입시 사용한 이메일 주소와 입력한 이메일이 같아야 인증번호를 받을 수 있습니다. </div>
              <!--인증번호를 전송할 이메일 기입창과 전송 버튼-->
              <input class="inf3" type="email" placeholder="email "id="c_email" name="c_email"  >
              <input class="btn_e" id="btn_email_c" type="button" value="인증번호 전송">
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

<!--*************************<<예외처리 및 클릭 이벤트 : 어지수>>***********************-->
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/find.js" charset="utf-8"></script>
