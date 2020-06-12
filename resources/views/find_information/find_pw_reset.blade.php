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


</head>
<body>
  <div id="all">
    <div class="text">
      <div class="id_title">Find Password</div> <hr>
      <div class="text_des">비밀번호 재설정</div>
    </div>

    <div class ="pw_reset">
      <form id="pw_ckform" action = '/find_chk' onsubmit='return pw_check()'>
        <div class="pw_requirement">영문, 숫자, 특수문자를 조합하여 8~16자로 만들어 주세요.</div>

        <input class="find_input" type="password" placeholder="새 비밀번호" id="new_pw" name="new_pw"><br>
        <div id="pw_re" class="pw_re" value=""></div>

        <input class="find_input" type="password" placeholder="새 비밀번호 확인" id="check" >
        <div id="pw_re_ck" class="pw_re_ck" value=""></div>

        <div class="under_pw">
          <input class="lg_bt" type="submit" id="signup" value="다음">
        </div>
      </form>
    </div>
  </div >
</body>
</html>

<script>

window.onload=function(){
  document.getElementById('pw_ckform').onsubmit=function(){
    var pass=document.getElementById('new_pw').value;
    var passCheck=document.getElementById('check').value;

    if (pass != passCheck){
      alert('비밀번호가 일치하지 않습니다.');
      // document.getElementById("pw_re_ck").innerHTML = "비밀번호가 일치하지 않습니다.";
      return false;
    } if (pass == ''){
      alert('비밀번호를 입력해주세요.')
      // document.getElementById("pw_re").innerHTML = "비밀번호를 입력해주세요.";
      return false;
    }
    var pw=$("#new_pw").val();
    var pwJ = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;
    if (!check.test('pw')){
      alert("8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다.");
      // document.getElementById("pw_re").innerHTML = "8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다.";
      return false;
    }
  }
}
// window.addEventListener('load', function() {
//   var signup = document.querySelector('#signup');
//
//   signup.addEventListener('click', function() {
//     var new_pw = document.querySelector('#new_pw');
//     var check = document.querySelector('#check');
//
//     if (new_pw.value != check.value) {
//       alert('비밀번호가 일치하지 않습니다.');
//       check.focus();
//     } else if (new_pw.value == ''){
//       alert('비밀번호를 입력해주세요.')
//       new_pw.focus();
//     }
//   });
// });
//
</script>
