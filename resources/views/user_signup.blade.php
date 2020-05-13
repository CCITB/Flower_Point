<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/css/sign_up.css">
  <title>회원가입</title>
  <!--<script>
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
}
});
});

</script>-->

</head>
<body>
  <div id="all">
    <div class="text">
      <h1> 구매자 회원가입 </h1>
      <hr class = way>
    </div>
    <div class="signup">
      <form action = '처리할 주소' method='GET or POST'>
        <table>
          <tr>
            <td>아이디</td>
          </tr>
          <tr>
            <td><input class="inf1" type="text" autofocus placeholder="ID" id="id" name="id"></td>
          </tr>
          <tr>
            <td>비밀번호</td>
          </tr>
          <tr>
            <td><input class="inf1" type="password" autofocus placeholder="Password" id="new_pw" size=30 required ></td>
          </tr>
          <tr>
            <td>비밀번호 확인</td>
          </tr>
          <tr>
            <td><input class="inf1" type="password" autofocus placeholder="Password" id="check" size=30 required ></td>
          </tr>
          <tr>
            <td>이름</td>
          </tr>
          <tr>
            <td><input class="inf1" type="name" autofocus placeholder="Name" id="name" name="name" size=30 ></td>
          </tr>
          <tr>
            <td>연락처</td>
          </tr>
          <tr>
            <td><input class="inf2" type="number" autofocus placeholder="Phone Number" id="phone" name="phone" size=20>인증번호</td>
          </tr>
          <tr>
            <td>주소</td>
          </tr>
          <tr>
            <td><input class="inf1" type="text" autofocus placeholder="Address" id="address" name="address" size=30></td>
          </tr>
          <tr>
            <td>이메일</td>
          </tr>
          <tr>
            <td><input class="inf1" type="text" autofocus placeholder="email "id="email" name="email" size=30></td>
          </tr>
          <tr>
            <td><button class="back" type="button" onclick="location.href = '/login'">돌아가기</button>
              <button class="signup" type="formenctype">회원가입</button></td>
            </tr>
          </table>
        </form>
      </div>
    </div>

    @include('footer')
