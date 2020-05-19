<!-- EO JI SU -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>꽃갈피 - 판매자 회원가입</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="/css/sign_up.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
          <tr>
            <div class="check_div" id="id_check" value=""></div>
          </tr>
          <tr>
            <th>비밀번호</th>
          </tr>
          <tr>
            <td><input class="inf1" type="password" placeholder="Password" name="s_password" id="new_pw"  ></td>
          </tr>
          <div class="check_div" id="pw_check" value=""></div>
          <tr>
            <th>비밀번호 확인</th>
          </tr>
          <tr>
            <td><input class="inf1" type="password" placeholder="Password" name="s_re_password" id="check"  ></td>
          </tr>

          <div class="check_div" id="re_pw_check" value=""></div>
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
            <td><input class="inf1" type="text" placeholder="Phone Number" id="phonenum" name="s_phonenum" ></td>
            <td><button type="button" value="인증번호" id="certification">인증번호</button></td>
          </tr>
          <tr>
            <th>
              성별
            </th>
          </tr>
          <td>
            <select class="form_select" name="s_gender" id=gender >
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
          </tr>
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
  // jQuery
  //정규식
  // var id_val = /^[A-Za-z0-9_\-]{5,20}$/;
  // var pw_val = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;
  //
  // $(function(){
  //   $('#s_password').keyup(function(){
  //     if(idJ.text($('#s_id').val())){
  //       $('font[name=re_pw_check]').text('');
  //       $('font[name=re_pw_check]').html("아이디를 입력하세요.");
  //     }
  //     else {
  //       $('font[name=re_pw_check]').text('');
  //       $('font[name=re_pw_check]').html("ok.");
  //     }
  //   })
  // })
  //
  // $('#id').blur(function(){
  //   if(idJ.test()){
  //     console.log('true');
  //   }
  //   else{
  //     console.log('false');
  //     $('#id_check').text('5~20자내의 영문 대소문자, 특수문자(-),(-) 입력');
  //     $('#id_check').css('color','red');
  //   }
  // });

  //onsubmit
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

    //정규화
    var id_validate = RegExp(/^[A-Za-z0-9_\-]{5,20}$/);
    var pw_validate = RegExp(/^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/);

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
