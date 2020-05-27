<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>아이디 찾기</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/find.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
  <script>


  </script>

</head>
<body>

  <div id="all">
    <div class="text">
      <div class="id_title">Find ID</div> <hr>
      <div class="text_des">아이디  찾는 방법을 선택해 주세요.</div>
    </div>

    <div class ="find_id">
      <form action = 'url' method='POST'>
        <div class="fd_id">
          <div class="character">
              <br><br>

          </div>
          <div class="window">
            <input class="find_input" type="name" autofocus placeholder="이름을 입력하세요." name="name" required ><br><br>
            <input class="find_input" type="tell" autofocus placeholder="전화번호를 입력하세요" name="tell" required title="000-0000-0000">
            <input type="submit" value="인"><br><br>
            <input class="find_input" type="name" autofocus placeholder="인증번호 입력" name="name" required >
            <input type="submit" value="확인"><br><br>
          </div>
        </div>
        <div class="under">
          <p><br>
            <button type="submit" value="찾기">찾기</button>
          </p>
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
