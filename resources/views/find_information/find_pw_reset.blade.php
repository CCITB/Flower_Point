<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>비밀번호 재설정</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/find.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">

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
        location.href = "/login_customer";
      }
    });
  });

  </script>

</head>
<body>
  <div id="all">
    <div class="text">
      <div class="id_title">Find Password</div> <hr>
      <div class="text_des">비밀번호 재설정</div>
    </div>

    <div class ="pw_reset">
      <form action = '처리할 주소' method='post'>
        <div class="pw_requirement">영문, 숫자, 특수문자를 조합하여 8~16자로 만들어 주세요.</div>
          <input class="find_input" type="password" autofocus placeholder="새 비밀번호" id="new_pw" required ><br><br>
          <input class="find_input" type="password" autofocus placeholder="새 비밀번호 확인" id="check" required >
          <div class="under_pw">
            <input class="lg_bt" type="submit" id="signup" value="다음">
          </div>
      </form>
    </div>
  </div >
</body>
</html>
