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
      <form id="pw_ckform" name="repassword" action = '/f_reset' method='post'onsubmit='return check_find_reset()'>
        @csrf
        <div class="pw_requirement">영문, 숫자, 특수문자를 조합하여 8~16자로 만들어 주세요.</div>
        <input type="hidden" name="hidden_no" id="hidden_no" value="">
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

<script type="text/javascript">
var no = '{{$myno}}';
document.repassword.hidden_no.value = no;

</script>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/find.js" charset="utf-8"></script>
