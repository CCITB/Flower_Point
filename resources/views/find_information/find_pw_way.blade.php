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
      <div class="text_des">회원정보에 등록한 휴대전화로 인증</div>
    </div>

    <div class ="find_pw_way">
      <form action = '/find_pw_reset' method='POST'>
        <div class="fd_id">
          <div class="character">

          </div>
          <div class="window">
            <div class="ip_name">이름</div>
            <input class="find_input" type="name" placeholder="이름을 입력하세요." name="name"><br><br>
            <div class="ip_name">전화번호</div>
            <input class="find_input" type="tell" placeholder="전화번호를 입력하세요" name="tell" title="000-0000-0000">
            <input type="submit" value="인증"><br><br>
            <input class="find_input" type="name" placeholder="인증번호" name="name">
            <input type="submit" value="확인"><br><br>
          </div>
        </div>

        <div class="under">
          <input class="lg_bt" type="submit" onclick="location.href = '/find_pw_reset'" value="다음">
        </div>
      </form>
    </div>

  </div>
</body>
</html>
