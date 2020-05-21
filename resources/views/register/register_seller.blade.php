<!--어지수-->
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
        <label>아이디</label>
        <input class="inf1" type="text" placeholder="ID" id="id" name="s_id">
        <div class="check_div" style="height:45px;"id="id_check" value=""></div>

        <label>비밀번호</label>
        <input class="inf1" type="password" placeholder="Password" name="s_password" id="pw" >
        <div class="check_div" style="height:45px;" id="pw_check" value=""></div>

        <label>비밀번호 확인</label>
        <input class="inf1" type="password" placeholder="Password" name="s_re_password" id="check" >
        <div class="check_div" style="height:45px;" id="re_pw_check" value=""></div>

        <label>이름</label>
        <input class="inf1" type="name" placeholder="Name" id="name" name="s_name" >
        <div class="check_div" id="name_check" style="height:45px;" value=""></div>

        <label>연락처</label>
        <input class="inf1" type="text" placeholder="Phone Number" id="phonenum" name="s_phonenum" >
        <div class="check_div" id="phonenum_check" style="height:45px;" value=""></div>

        <label>생년월일</label>
        <input class="inf1" type="text" placeholder="ex)200514" id="birth" name="s_birth">

        <br>
        <div class="gender">
          <label>성별</label>
          <select class="form_select" name="s_gender" id=gender >
            <option value="">성별</option>
            <option value="남성">남성</option>
            <option value="여성">여성</option>
          </select>
        </div>
        <br>
        <label>이메일</label>
        <input class="inf1" type="email" placeholder="email "id="email" name="s_email"  >

        <!-- <button type="button" style="border-radius:5px; font-s"/> <a href="http://laravel.site/login">돌아가기</a> </button> </td> -->
        <button class="end" type='button' onclick="history.back()">돌아가기</button>
        <input class="end" type='submit' value="다음">

      </form>
    </div>
  </body>
</html>
  <script type="text/javascript">
  // jQuery -- 어지수

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $("#id").blur(function() {
    checkIdInput();
  });//blur
  $("#pw").blur(function() {
    checkPwInput();
  });//blur
  $("#check").blur(function() {
    checkRePwInput();
  });//blur
  $("#name").blur(function() {
    checkNameInput();
  });//blur

  function checkIdInput(){
    var seller_id = $('#id').val();

    //정규식
    var idJ = /^[a-z0-9_\-]{5,20}$/;
    var phoneJ = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;

    console.log(seller_id);
    $.ajax({

      type: 'post',
      url: 'register_OverlapID',
      dataType: 'json',
      data: { "id":seller_id },

      success : function(data) {
        console.log(data);

        //ID 공백체크
        if(seller_id == ""){
          $('#id_check').text('필수 정보입니다.');
          $('#id_check').css('color', 'red');

        }

        //ID 중복O
        if(data>=1){
          $('#id_check').text('이미 사용중인 아이디입니다.');
          $('#id_check').css('color', 'red');

        }

        //ID 중복X
        if(data<1){
          //정규식 일치O
          if(idJ.test(seller_id)){
            $("#id_check").text("사용가능한 아이디입니다!");
            $('#id_check').css('color', 'green');
          }
          //정규식 일치X
          if(!idJ.test(seller_id)){
            $('#id_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능합니다.');
            $('#id_check').css('color', 'red');
          }
        }

      }//success
      ,error : function() {   console.log("실패");  }
    }) //ajax
  }

  function checkPwInput(){

    var seller_pw = $('#pw').val();
    var pwJ = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;

    $.ajax({

      type: 'post',
      url: 'register_OverlapPW',
      dataType: 'json',
      data: { "pw":seller_pw },

      success : function(data) {
        console.log(data);

        //PW 공백 체크
        if (seller_pw == ""){
          $('#pw_check').text('비밀번호를 입력해주세요.');
          $('#pw_check').css('color', 'red');
        }
        //PW 정규식 일치O
        if(pwJ.test(seller_pw)){
          $("#pw_check").text("");
          $('#pw_check').css('color', 'red');
        }
        //PW 정규식 일치X
        if(!pwJ.test(seller_pw)){
          $('#pw_check').text('8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다. ');
          $('#pw_check').css('color', 'red');
        }
      }//success
      ,error : function() {  console.log("pw실패");  }
    }) //ajax
  }

  function checkRePwInput(){
    var seller_re_pw = $('#check').val();
    var seller_pw = $('#pw').val();
    $.ajax({

      type: 'post',
      url: '',
      dataType: 'json',
      data: { },

      success : function(data) {
        console.log(data);

        //PW 공백
        if(seller_re_pw==""){
          $("#re_pw_check").text("필수 정보입니다.");
          $('#re_pw_check').css('color', 'red');
        }

        //PW와 일치O
        if(seller_pw==seller_re_pw){
          $("#re_pw_check").text("");
          $('#re_pw_check').css('color', 'red');
          console.log("일치");
        }

        //PW와 일치X
        else
        {
          $("#re_pw_check").text("비밀번호가 일치하지 않습니다.");
          $('#re_pw_check').css('color', 'red');
          console.log("비일치");
        }

      }//success
      ,error : function() {  console.log("pw실패");  }
    }) //ajax
  }

  function checkNameInput(){
    var seller_name = $('#name').val();

    //정규식 (스페이스바)
    var nameJ = /[가-힣A-Za-z]/g;
    var emptyJ = /[~!@#$%^&*()_+|<>?:{}\s]/g;

    console.log(seller_name);
    $.ajax({

      type: 'post',
      url: 'register_OverlapID',
      dataType: 'json',
      data: {  },

      success : function(data) {
        // 공백체크
        if(seller_name == ""){
          $('#name_check').text('필수 정보입니다.');
          $('#name_check').css('color', 'red');
        }
        //특수문자, 스페이스바 체크
        else if(emptyJ.test(seller_name)){
          $("#name_check").text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용 불가)");
          $('#name_check').css('color', 'red');
        }
        else{
          $("#pw_check").text("");
        }

      }//success
      ,error : function() {  console.log("실패");  }
    }) //ajax
  }

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
      return true;
    }
  }

</script>
