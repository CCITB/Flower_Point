<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/sohyun.css">
  <title>로그인</title>
  <script>


  </script>

</head>
<body>

  <div id="all">
    <div class="text">
      <h1> 로그인 </h1>
      <hr class = way>
    </div>
    <div class ="login">
      <form action = 'url' method='POST'>
        <p>
          <input type="text" autofocus placeholder="ID" name="id" style="width:350px; height:30px; font-size:20px;" required ><br><br>
          <input type="password" autofocus placeholder="Password" name="pw" style="width:350px; height:30px; font-size:20px;" required>
        </p>
        <div class="go">
          <a href="http://laravel.site/find_id">아이디/비밀번호 찾기</a><br><br>
        </div>
        <div class="lg_bt">
          <button type="submit" style="width:100px; height:30px; font-size:15px;" id="login" value="로그인">
        </div>
        <br><button class="user_sign_bt" type="button" onclick="location.href = 'http://laravel.site/user'">구매자 회원가입</button><br><br>
        <button class="sel_sign_bt" type="button" onclick="location.href = 'http://laravel.site/seller'">판매자 회원가입</button>

      </form>
    </div>
  </div>

  @include('footer')
