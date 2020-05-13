<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/sohyun.css">
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
      <p>
        <form action = '처리할 주소' method='POST'>
          이름 : <input type="name" name="name"required ><br>
          전화번호 : <input type="tell" name="tell" size=20 required title="000-0000-0000"><input type="submit" value="인증번호받기"><br>
          <input type="name" autofocus placeholder="인증번호 입력" name="name" required >
          <input type="submit" value="확인"><br>
          <p>
            <button type="submit" > <a href="http://laravel.site/pw_reset">다음</a> </button>
          </p>
        </form>
      </p>
    </div>

  </div>

  @include('footer')
</body>
</html>
