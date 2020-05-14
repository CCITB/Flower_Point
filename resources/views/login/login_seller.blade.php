<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <title>로그인</title>
  <script>
  </script>
</head>
<body>
  <div id="all">
    <div class="text">
      <h1> 판매자 로그인 </h1>
      <hr class = way>
    </div>

    <div class ="login">
      <form action = 'url' method='post'>
        <p>
          <input class="lg" type="text" autofocus placeholder="ID" name="id" required ><br><br>
          <input class="lg" type="password" autofocus placeholder="Password" name="pw" required>
        </p>
        <div class="go">
          <a href="/find_id">아이디/비밀번호 찾기</a><br><br>
        </div>
        <button class="lg_bt" type="button" id="login" value="로그인">로그인</button>
        <p>
          <button class="sel_sign_bt" type="button" onclick="location.href = '/seller'">판매자 회원가입</button>
        </p>
      </form>
    </div>
  </div>
  <!-- <body>
  <h1>로그인</h1>

  <form class="form-horizontal">
  <div class="form-group">
  <div class="col-sm-10">
  <input type="id" class="form-control" id="inputEmail3" placeholder="ID">
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
</div>
</div>

<div class="form-group">
<div class="col-sm-10">
<button type="button" class="btn btn-default" onclick="location.href='http://laravel.site/register'">회원가입</button>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-default">로그인</button>
</div>
</div>
</form> -->
</body>
</html>
