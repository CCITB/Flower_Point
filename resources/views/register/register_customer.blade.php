<!-- 어지수 + css:박소현-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>꽃갈피 - 구매자 회원가입</title>
  <link rel="stylesheet" type="text/css" href="/css/sign_up.css">
</head>

<body>
  <div id="all">
    <div class="text">
      <h1>구매자 회원가입 </h1>
      <hr>
    </div>
    <div class="signup">
      <form action = '/RegisterControllerCustomer' method="post" name="registerform" onsubmit='return validatate();'>
        @csrf
        <label>아이디</label>
        <input class="inf1" type="text" placeholder="ID" id="id" name="c_id">
        <div class="check_div" style="height:45px;"id="id_check" value=""></div>

        <label>비밀번호</label>
        <input class="inf1" type="password" placeholder="Password" name="c_password" id="pw" >
        <div class="check_div" style="height:45px;" id="pw_check" value=""></div>

        <label>비밀번호 확인</label>
        <input class="inf1" type="password" placeholder="Password" name="c_re_password" id="check" >
        <div class="check_div" style="height:45px;" id="re_pw_check" value=""></div>

        <label>이름</label>
        <input class="inf1" type="name" placeholder="Name" id="name" name="c_name" >
        <div class="check_div" id="name_check" style="height:45px;" value=""></div>

        <label>연락처</label>
        <input class="inf1" type="text" placeholder="Phone Number" id="phonenum" name="c_phonenum" >
        <div class="check_div" id="phonenum_check" style="height:45px;" value=""></div>

        <label>주소</label>
        <input class="inf1" type="text" placeholder="address" id="address" name="c_address" >

        <label>생년월일</label>
        <input class="inf1" type="text" placeholder="ex)200514" id="birth" name="c_birth">

        <br>
        <div class="gender">
          <label>성별</label>
          <select class="form_select" name="c_gender" id=gender >
            <option value="">성별</option>
            <option value="남성">남성</option>
            <option value="여성">여성</option>
          </select>
        </div>
        <br>
        <label>이메일</label>
        <input class="inf1" type="email" placeholder="email "id="email" name="c_email"  >

        <!-- <button type="button" style="border-radius:5px; font-s"/> <a href="http://laravel.site/login">돌아가기</a> </button> </td> -->
        <button class="end" type='button' onclick="history.back()">돌아가기</button>
        <input class="end" type='submit' value="다음">

      </form>
    </div>
  </body>

    <script type="text/javascript">
    //onsubmit -- 어지수
    function validatate(){
      //Input
      var id = document.getElementById("id");
      var password = document.getElementById("new_pw");
      var re_password = document.getElementById("check");
      var name = document.getElementById("name");
      var phonenum = document.getElementById("phonenum");
      var gender = document.getElementById("gender");
      //var birth
      var address = document.getElementById("address");
      var email = document.getElementById("email");

      //정규식
      var id_validate = RegExp(/^[A-Za-z0-9_\-]{5,20}$/);
      var pw_validate = RegExp(/^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/);
      var phone_balidate = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;
      //유효성
      if(!id_validate.test(id.value)){
        alert('5~20자리의 영문 대소문자와 특수기호 (-),(_)만 사용가능합니다.');
        return false;
      }
      if((id.value)==""){
        alert('아이디 입력해주세요.');
        id.focus();
        return false;
      }
      if(!pw_validate.test(password.value)){
        alert('8~16자리의 영문 대소문자와 특수기호만 사용가능합니다.');
        return false;
      }
      if(password.value!=re_password.value){
        alert('비밀번호가 일치하지 않습니다.');
        return false;
      }
      if((name.value)==""){
        alert('이름을 입력해주세요.');
        return false;
      }
      if((phonenum.value)==""){
        alert('휴대폰 번호를 입력해주세요.');
        return false;
      }
      if((address.value)==""){
        alert('주소를 입력해주세요.');
        return false;
      }
      else {
        alert('회원가입되었습니다.');
        return true;
      }
    }
    </script>
