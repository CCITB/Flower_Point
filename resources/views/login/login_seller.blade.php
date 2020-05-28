<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>로그인</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
  <script>
  </script>
</head>

<body>

  <div id="all">
    <div class="text">
      Seller Login
      <hr>
    </div>

    <div class ="login">
      <form action = '/login_s' method='post' name="seller_login">
        @csrf
        <p>
          <input class="lg" type="text"  placeholder="ID" name="login_id" required ><br><br>
          <input class="lg" type="password"  placeholder="Password" name="login_pw" required>
        </p>
        <div class="go">
          <a href="/find_id">아이디</a> ·
          <a href="/find_pw">비밀번호 찾기</a>
        </div><br>
        <br>
        <input class="lg_bt" type="submit" value="로그인">
      </form>
    </div>
    <div class="bottom">
      <a href = "/terms_sellers">판매자 회원가입</a>
    </div>
    <div class="home">
      <a href = "/">홈으로</a>
    </div>
  </div>
</body>
</html>
