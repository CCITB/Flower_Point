<!DOCTYPE html> <!--박소현+어지수 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>로그인</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/login.css">

  <script>
  </script>

</head>
<body>
  <div id="all">
    <div class="text">
      Customer Login
      <hr>
    </div>

    <div class ="login">
      <form action = '/login_c' method="post" name="customer_login">
        @csrf
        <p>
          <input class="lg" type="text"  placeholder="ID" name="login_id" required ><br><br>
          <input class="lg" type="password"  placeholder="Password" name="login_pw" required>
        </p>
        <div class="go">
          <a href="/find_id">아이디</a> ·
          <a href="/find_pw">비밀번호 찾기</a>
        </div><br>
        <p><br>
          <input class="btn btn-outline-secondary" type="submit" value="로그인 ">
        </p>
        <p>
          <button class="btn btn-outline-danger" type="button" onclick="location.href = '/register_customer'">구매자 회원가입</button>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
