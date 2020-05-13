<!-- [jisuEO] -->

<!--NO CSS -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @csrf
        <title>꽃갈피 - 판매자 회원가입</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    </head>

  <body>
  <h1>회원가입</h1>

  <form action="/RegisterController" name='registerform' method="post" class="form-horizontal" onsubmit="return check_signup();">
  @csrf
    <div class="form-group">
      <label class="col-sm-2 control-label">아이디</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="s_id" placeholder="ID">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">비밀번호</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" name="s_password" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">이름</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="s_name" placeholder="name">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">연락처</label>
      <div class="col-sm-5">
        <input type="tel" class="form-control" name="s_phonenum" placeholder="Phone Number">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">이메일</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" name="s_email" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" class="btn btn-default" onclick="history.back()">돌아가기</button>
        <button type="submit" class="btn btn-default">가입하기</button>
      </div>
    </div>
</form>

<script type="text/javascript">
    function check_signup(){
    var registerform = document.forms['registerform'];

      	  if(registerform['s_id'].value.length<5){
      	   return
           alert('아이디를 5자 이상 입력하세요.');
      	   }
      	  if(registerform['s_password'].value.length<5){
      	   alert('비밀번호를 5자 이상 입력하세요.');
      	   return false;
           }
          if(registerform['s_name'].value.length<1){
       	   alert('이름을 입력하세요.');
       	   return false;
          }
          if(registerform['s_phonenum'].value.length<5){
        	 alert('연락처를 입력하세요.');
        	   return false;
            }
          if(registerform['s_email'].value.length<5){
           alert('이메일을 입력하세요.');
          return false;
              }
        	else {
          alert('가입 완료');
          return true;
          }
    }
</script>

</body>
</html>
