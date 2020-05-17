<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <title>비밀번호 찾기</title>

</head>
<body>

  <div id="all">
    <div class="text">
      <h1> 비밀번호 찾기 </h1>
      <hr class = way>
      비밀번호를 찾을 방법을 선택해 주세요.
    </div>

    <div class ="find_pw_way">
      <form action = '처리할 주소' method='POST'>
        <p>
          <div class="character">
            이름 : <br><br>
            전화번호 :
          </div>
          <div class="window">
            <input class="find_input" type="name" name="name"required ><br><br>
            <input class="find_input" type="tell" name="tell" required title="000-0000-0000"><input type="submit" value="인증번호받기"><br><br>
            <input class="find_input" type="name" autofocus placeholder="인증번호 입력" name="name" required >
            <input type="submit" value="확인"><br><br>
          </div>

          <div class="under">
            <p>
              <button type="submit" > <a href="/find_pw_reset">다음</a> </button>
            </p>
          </p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
