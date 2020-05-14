<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <title>아이디 찾기</title>
  <script>


  </script>
</head>
<body>

  <div id="all">
    <div class="text">
      <h1> 아이디 찾기 </h1>
      <hr class = way>
      아이디  찾는 방법을 선택해 주세요.
    </div>

    <div class ="find_id">
      <div class="text1">
        회원 정보에 등록한 휴대전화로 인증
      </div>
      <div class="text2">
        회원 정보에 등록한 휴대전화 번호와 입력한 휴대전화 번호가 일치해야 인증번호를 받을 수 있습니다.
      </div>
      <form action = 'url' method='POST'>
<div class="text1">
        이름 :
</div>
        <input class="find_input" type="name" autofocus placeholder="이름을 입력하세요." name="name" required ><br>
<div class="text1">
        전화번호 :
</div>
        <input class="find_input" type="tell" autofocus placeholder="전화번호를 입력하세요" name="tell" required title="000-0000-0000"><input type="submit" value="인증번호받기"><br>
        <input type="name" autofocus placeholder="인증번호 입력" name="name" required >
        <input type="submit" value="확인"><br>
        <p>
          <button type="button" > <a href="http://laravel.site/">홈으로</a> </button>
          <input type="submit">
          <button type="button" > <a href="/find_pw">비밀번호 찾기</a> </button>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
