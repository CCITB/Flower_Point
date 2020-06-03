<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>꽃갈피 - 판매자 회원가입</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/sign_up.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body>
  <div id="all">
    <div class="text">
      <div class="id_title">Seller Register</div> <hr>
    </div>
    <div class="signup">
      <form action = '/RegisterControllerSeller' method="post" name="registerform" onsubmit='return check_all()'>
        @csrf
        <div class="sign_name">아이디</div>
        <input class="inf1" type="text" placeholder="ID" id="id" name="s_id" >
        <div class="check_div" id="id_check" value=""></div>

        <div class="sign_name">비밀번호</div>
        <input class="inf1" type="password" placeholder="Password" name="s_password" id="pw" >
        <div class="check_div" id="pw_check" value=""></div>

        <div class="sign_name">비밀번호 확인</div>
        <input class="inf1" type="password" placeholder="Password" name="s_re_password" id="check" >
        <div class="check_div" id="re_pw_check" value=""></div>

        <div class="sign_name">이름</div>
        <input class="inf1" type="name" placeholder="Name" id="name" name="s_name"  >
        <div class="check_div" id="name_check" value=""></div>

        <div class="sign_name">생년월일</div>
        <input class="inf2" type="text" placeholder="년(4자)" id="s_birth_y" name="s_birth_y" maxlength="4" >

        <select class="inf2" id="s_birth_m" name="s_birth_m">
          <option value="">월</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        <input class="inf2" type="int" placeholder="일" id="s_birth_d" name="s_birth_d" maxlength="2">
        <div class="check_div" id="birth_check" value=""></div>

        <div class="gender">
          <div class="sign_name">성별</div>
          <select class="form_select" name="s_gender" id=s_gender >
            <option value="">성별</option>
            <option value="남성">남성</option>
            <option value="여성">여성</option>
          </select>
        </div>
        <div class="check_div" id="gender_check" value=""></div>

        <div class="sign_name">연락처</div>
        <input class="inf1" type="text" placeholder="Phone Number" id="s_phonenum" name="s_phonenum" >
        <div class="check_div" id="phonenum_check" value=""></div>

        <div class="sign_name">이메일  </div>
        <input class="inf3" type="email" placeholder="email "id="s_email" name="s_email" required>
        <a href="#" class="inf4" id="btnSend" role="button"><span>인증번호 받기</span></a>
        <div class="check_div" id="email_check" value=""></div>
      
      </div>
      <!-- <button type="button" style="border-radius:5px; font-s"/> <a href="http://laravel.site/login">돌아가기</a> </button> </td> -->
      <div class="under">
        <button class="lg_bt" type='button' onclick="history.back()">뒤로</button>
        <input class="lg_bt" type='submit' id="btnSubmit" value="다음" disabled="">
      </div>
    </form>

  </body>
  </html>
  <script type="text/javascript">
  // jQuery -- 어지수

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $("#id").keyup(function() {
    checkIdInput();
  });//blur
  $("#pw").blur(function() {
    checkPwInput();
  });//blur
  $("#check").keyup(function() {
    checkRePwInput();
  });//blur
  $("#name").blur(function() {
    checkNameInput();
  });//blur
  $("#s_birth_y").blur(function() {
    checkBirthInput()});//blur

    $("#s_birth_m").change(function() {
      checkBirthInput()
    });//blur

    $("#s_birth_d").blur(function() {
      checkBirthInput();
    });
    $("#s_gender").change(function() {
      checkGender();
    });
    $("#s_email").change(function() {
      checkEmail();
    });

    function checkIdInput(){
      var seller_id = $('#id').val();

      //정규식
      var idJ = /^[a-z0-9_\-]{5,20}$/;

      //var phoneJ = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;

      console.log(seller_id);
      $.ajax({

        type: 'post',
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "id":seller_id },

        success : function(data) {
          console.log(data);
          //ID 중복O
          if(data>=1){
            $('#id_check').text('이미 사용중인 아이디입니다.');
            $('#id_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',true);
          }

          //ID 중복X
          if(data<1){
            //정규식 일치O
            if(idJ.test(seller_id)){
              $("#id_check").text("사용가능한 아이디입니다!");
              $('#id_check').css('color', 'green');
              $('#btnSubmit').attr('disabled',false);
            }
            //정규식 일치X
            if(!idJ.test(seller_id)){
              $('#id_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능합니다.');
              $('#id_check').css('color', 'red');
              $('#btnSubmit').attr('disabled',true);
            }
          }
          //ID 공백체크
          if(seller_id == ""){
            $('#id_check').text('필수 정보입니다.');
            $('#id_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',true);
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
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "pw":seller_pw },

        success : function(data) {
          console.log(data);
          //PW 정규식 일치O
          if(pwJ.test(seller_pw)){
            $("#pw_check").text("");
            $('#pw_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',true);
          }
          //PW 공백 체크
          else if(seller_pw == ""){
            $('#pw_check').text('비밀번호를 입력해주세요.');
            $('#pw_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',false);
          }
          //PW 정규식 일치X
          else{
            $('#pw_check').text('8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다. ');
            $('#pw_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',false);
          }

        }//success
        ,error : function() {  console.log("pw실패");  }
      }) //ajax
    }

    function checkRePwInput(){
      var check = $('#check').val();
      var seller_pw = $('#pw').val();
      $.ajax({

        type: 'post',
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "pw":seller_pw
        ,"check":check },

        success : function(data) {
          console.log(data);

          //PW 공백
          if(check == ""){
            $('#re_pw_check').text('필수 정보입니다.');
            $('#re_pw_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',false);
          }
          //PW 공백 체크
          else if(seller_pw==check){
            $("#re_pw_check").text('비밀번호가 일치합니다!');
            $('#re_pw_check').css('color', 'green');
            $('#btnSubmit').attr('disabled',true);
          }
          //PW 정규식 일치X
          else{
            $('#re_pw_check').text('비밀번호가 일치하지 않습니다.');
            $('#re_pw_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',false);
          }
        }//success
        ,error : function() {  console.log("pw실패");  }
      }) //ajax
    }

    function checkNameInput(){
      var seller_name = $('#name').val();
      var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
      var empty = /\s/gi;

      $.ajax({
        type: 'post',
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "name" : seller_name },

        success : function(data) {
          console.log(data);
          //공백(빈칸)
          if(seller_name == ""){
            $('#name_check').text("필수 정보입니다.");
            $('#name_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',true);
          }
          else if(!markJ.test(seller_name)){
            $("#name_check").text("");
            $('#btnSubmit').attr('disabled',false);
          }
          //특수기호, 공백(space) 사용불가
          else{
            $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
            $('#name_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',true);
          }
        }
        ,error : function() {console.log("name실패");}
      })
    }

    function checkBirthInput(){

      var s_birth_y = $('#s_birth_y').val();
      var s_birth_m = $('#s_birth_m').val();
      var s_birth_d = $('#s_birth_d').val();
      var birthJ =  /^[0-9]+$/
      $.ajax({

        type: 'post',
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "s_birth_y":s_birth_y },

        success : function(data) {
          console.log(s_birth_m);
          //년도
          if(birthJ.test(s_birth_y)&&s_birth_y.length>3){
            $("#birth_check").text("");
            $('#birth_check').css('color', 'red');
            //월
            if(s_birth_m==""){
              $("#birth_check").text('태어난 월을 선택하세요.');
              $('#birth_check').css('color', 'red');
            }
            else{
              $('#birth_check').text('');
              $('#birth_check').css('color', 'red');
              //일
              if(s_birth_d==""){
                $("#birth_check").text('태어난 일(날짜) 2자리를 정확하게 입력하세요.');
                $('#birth_check').css('color', 'red');
              }
              else{
                $('#birth_check').text('');
                $('#birth_check').css('color', 'red');
                $('#btnSubmit').attr('disabled',false);
              }
            }
          }
          else{
            $('#birth_check').text(' 태어난 년도 4자리를 정확하게 입력하세요. ');
            $('#birth_check').css('color', 'red');
          }

        }//success
        ,error : function() {  console.log("실패");  }
      }) //ajax
    }

    function checkGender(){
      var s_gender = $('#s_gender').val();

      $.ajax({
        type: 'post',
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "s_gender" : s_gender },

        success : function(data) {
          console.log(data);
          //공백(빈칸)
          if(!s_gender == ""){
            $('#gender_check').text("");
            $('#gender_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',false);
          }
          else{
            $('#gender_check').text("필수 정보입니다.");
            $('#gender_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',true);
          }
        }
        ,error : function() {console.log("실패");}
      })
    }

    function checkEmail(){
      var s_email = $('#s_email').val();

      $.ajax({
        type: 'post',
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "s_email" : s_email },

        success : function(data) {
          console.log(data);
          //공백(빈칸)
          if(!s_email == ""){
            $('#email_check').text("");
            $('#btnSubmit').attr('disabled',false);
          }
          else{
            $('#email_check').text("필수 정보입니다.");
            $('#email_check').css('color', 'red');
            $('#btnSubmit').attr('disabled',true);
          }
        }
        ,error : function() {console.log("실패");}
      })
    }

    function check_all(){
      var id = document.getElementById("id");
      var password = document.getElementById("pw");
      var re_password = document.getElementById("check");
      var name = document.getElementById("name");
      var phonenum = document.getElementById("phonenum");
      var s_gender = document.getElementById("s_gender");
      var s_email = document.getElementById("s_email");
      if((id.value)==""){
        alert('아이디 입력해주세요.');
        return false;
      }
      if(password.value.length==0){
        alert('비밀번호를 확인해주세요.');
        return false;
      }
      if(re_password.value.length==0){
        alert('비밀번호를 확인해주세요.');
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
      if((s_email.value)==""){
        alert('휴대폰 번호를 입력해주세요.');
        return false;
      }
      else {
        alert('회원가입되었습니다.');
        return true;
      }
    }


    </script>
