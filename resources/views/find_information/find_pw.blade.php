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
        <form action = '처리할 주소' method='post'>
          <div class="intervel"></div>
          <input class="find_input" type="name" autofocus placeholder="꽃갈피 아이디" name="name"><br>
          <div class="under_pw">
            <input class="lg_bt" type="submit" onclick="location.href = '/find_pw_way'" value="다음">
          </div>
        </form>
    </div>
    <div class="home">
      <a href = "/">홈으로</a>
    </div>
  </div>
</body>
</html>
