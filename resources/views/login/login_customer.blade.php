<!DOCTYPE html> <!--박소현+어지수 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>로그인</title>
  <link rel="stylesheet" type="text/css" href="/css/login.css">

  <script>
  </script>

</head>
<body>
  <div id="all">
    <div class="text">
      <h1> 구매자 로그인 </h1>
      <hr>
    </div>

    <div class ="login">
      <form action = '/' method="post">
        <p>
          <input class="lg" type="text"  placeholder="ID" name="id" required ><br><br>
          <input class="lg" type="password"  placeholder="Password" name="pw" required>
        </p>
        <div class="go">
          <a href="/find_id">아이디</a> ·
          <a href="/find_pw">비밀번호 찾기</a>
        </div><br>
        <p>
          <input class="lg_bt" type="submit" value="로그인">
        </p>
        <p><p>
          <button class="user_sign_bt" type="button" onclick="location.href = '/register_customer'">구매자 회원가입</button>
        </p></p>
      </form>
    </div>
  </div>
</body>
</html>
