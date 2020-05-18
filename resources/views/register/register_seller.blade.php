<!-- EO JI SU -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>꽃갈피 - 판매자 회원가입</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="/css/sign_up.css">
  <!-- <script src="js/jquery.js"></script> -->
</head>

<body>
  <div id="all">
    <div class="text">
      <h1>판매자 회원가입 </h1>
      <hr>
    </div>
    <div class="signup">
      <form action = '/RegisterControllerSeller' method="post" name="registerform" onsubmit='return validatate();'>
        @csrf
        <table>
          <tr>
            <th>아이디</th>
          </tr>
          <tr>
            <td><input class="inf1" type="text" placeholder="ID" id="id" name="s_id" ></td>
          </tr>
          <!-- <tr>
          <th>비밀번호</th>
        </tr>
        <tr>
        <td><input class="inf1" type="password" placeholder="Password" name="s_password" id="new_pw"  ></td>
      </tr>
      <tr>
      <th>비밀번호 확인</th>
    </tr>
    <tr>
    <td><input class="inf1" type="password" placeholder="Password" name="s_re_password" id="check"  ></td>
  </tr>
  <tr>
  <th>이름</th>
</tr>
<tr>
<td><input class="inf1" type="name" placeholder="Name" id="name" name="s_name" ></td>
</tr>
<tr>
<th>연락처</th>
</tr>
<tr>
<td><input class="inf1" type="text" placeholder="Phone Number" id="s_phonenum" name="s_phonenum" ></td>
<td><button type="button" value="인증번호" id="certification">인증번호</button></td>
</tr>
<tr>
<th>
성별
</th>
</tr>
<td>
<select class="form_select" name="s_gender" >
<option value="">성별</option>
<option value="남성">남성</option>
<option value="여성">여성</option>
</select>
</td>
<tr>
<th>
생년월일
</th>
</tr>
<tr>
<td><input class="inf1" type="text" placeholder="ex)200514" id="birth" name="s_birth"></td>
</tr>
<tr>
<th>주소</th>
</tr>
<tr>
<td><input class="inf1" type="text" placeholder="Address" id="address" name="s_address" ></td>
</tr>
<tr>
<th>이메일</th>
</tr>
<tr>
<td><input class="inf1" type="email" placeholder="email "id="email" name="s_email"  ></td>
</tr> -->
<tr>
  <!-- <button type="button" style="border-radius:5px; font-s"/> <a href="http://laravel.site/login">돌아가기</a> </button> </td> -->
  <td><br><button class="end" type='button' onclick="history.back()">돌아가기</button></td>
  <td><br><input class="end" type='submit' value="다음"></td>
</tr>
</table>
</form>
</div>
</body>

<script type="text/javascript">
function validatate(){
  var id = document.getElementById("id");
  var id_validate = RegExp(/^[A-Za-z0-9_\-]{5,20}$/);
  // var id_validate = /^[A-Za-z0-9_\-]{5,20}$/;

  //영어 대,소문자 / 특수문자 (_),(-)가능 / 5~20자
  if(!id_validate.test(id.value)){
    alert('아이디를 잘못 입력하셨습니다.');
    return false;
  }
  else {
    alert('아이디 확인');
    return true;
  }
  // var registerform = document.forms['registerform'];
  //
  // if(registerform['s_id'].value.length<5){
  //   alert('아이디를 5자 이상 입력하세요.');
  //   return false;
  // }
  // if(registerform['s_password'].value.length<5){
  //   alert('비밀번호를 5자 이상 입력하세요.');
  //   return false;
  // }
  // if(registerform['s_password'].value != registerform['s_re_password'].value){
  //   alert('비밀번호가 동일하지 않습니다.');
  //   return false;
  // }
  // if(registerform['s_name'].value.length<1){
  //   alert('이름을 입력하세요.');
  //   return false;
  // }
  // if(registerform['s_phonenum'].value.length<1){
  //   alert('연락처를 입력하세요.');
  //   return false;
  // }
  // if(registerform['s_email'].value.length<1){
  //   alert('이메일을 입력하세요.');
  //   return false;
  // }
}

// function checkSellerId(s_id){
//   var idRegExp = /^[A-Z0-9_-]{5,20}$/); //ID 유효성
//   //공백 오류
//   if(s_id.value==""){
//     alert("아이디를 입력해주세요.");
//     return false;
//   }
//   else if{
//     //정규화 오류
//     if(!idRegExp.test(id)){
//       alert("아이디는 5-20자의 영어 대소문자, 특수문자(-),(_)만 가능합니다.");
//     }
//   }
//   return true;
// }
</script>
