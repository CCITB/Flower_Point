<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <title>비밀번호 재설정</title>
  <script>
  window.addEventListener('load', function() {
    var signup = document.querySelector('#signup');

    signup.addEventListener('click', function() {
      var new_pw = document.querySelector('#new_pw');
      var check = document.querySelector('#check');

      if (new_pw.value != check.value) {
        alert('비밀번호가 일치하지 않습니다.');
        check.focus();
      } else if (new_pw.value == ''){
        alert('비밀번호를 입력해주세요.')
        new_pw.focus();
      }else {
        location.href = "http://laravel.site/login";
      }
    });
  });

  </script>

</head>
<body>
  <div id="all">
    <div class="text">
      <h1> 비밀번호 재설정 </h1>
      <hr class = way>
      비밀번호를 변경해주세요.<br>
    </div>

    <div class ="pw_reset">
      <p>
        다른 아이디나 사이트에서 사용한 적 없는 안전한 비밀번호로 변경해 주세요.
      </p>

      <div class="my_id">
        꽃갈피 아이디 : <!-- 아이디 불러올 곳 -->
      </div>

      <form action = '처리할 주소' method='POST'>
        <p>
          <input type="password" autofocus placeholder="새 비밀번호" id="new_pw" required ><br>
          <input type="password" autofocus placeholder="새 비밀번호 확인" id="check" required >
        </p>
        영문, 숫자, 특수문자를 조합하여 8~16자로 만들어 주세요.
        <p>
          <input type="button" id="signup" value="확인" style="border-radius:5px; font-s"/>
        </p>
      </form>
    </div>
  </div >
</body>
</html>
