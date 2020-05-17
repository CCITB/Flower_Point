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
      비밀번호를 찾고자 하는 아이디를 입력해 주세요.
    </div>

    <div class ="find_pw">
      <p>
        <form action = '처리할 주소' method='POST'>
          <input class="find_input" type="name" autofocus placeholder="꽃갈피 아이디" name="name" required ><br>
          <p>
            <input type="submit">
            <button type="submit" > <a href="http://laravel.site/find_pw_way">다음</a> </button>
          </p>
        </form>
      </p>
    </div>

  </div>
</body>
</html>
