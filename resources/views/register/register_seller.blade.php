<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!--어지수-->
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
      <form action = '/sto_info' method="post" name="registerform" onsubmit='return check_all()'>
        @csrf
        <div class="sign_name">아이디</div>
        <input class="inf1" type="text" placeholder="ID" id="id" name="s_id" required >
        <div class="check_div" id="id_check" value=""></div>

        <div class="sign_name">비밀번호</div>
        <input class="inf1" type="password" placeholder="Password" name="s_password" id="pw" required >
        <div class="check_div" id="pw_check" value=""></div>

        <div class="sign_name">비밀번호 확인</div>
        <input class="inf1" type="password" placeholder="Password" name="s_re_password" id="check" required >
        <div class="check_div" id="re_pw_check" value=""></div>

        <div class="sign_name">이름</div>
        <input class="inf1" type="name" placeholder="Name" id="name" required name="s_name" >
        <div class="check_div" id="name_check" value=""></div>

        <div class="sign_name">생년월일</div>
        <input class="inf2" type="text" placeholder="년(4자)" id="s_birth_y" name="s_birth_y" maxlength="4" required >

        <select class="inf2" id="s_birth_m" name="s_birth_m" required>
          <option value="" selected>월</option>
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
        <input class="inf2" type="int" placeholder="일" id="s_birth_d" name="s_birth_d" maxlength="2" required>
        <div class="check_div" id="birth_check" value=""></div>

        <div class="gender">
          <div class="sign_name">성별</div>
          <select class="form_select" name="s_gender" id=s_gender required>
            <option value="">성별</option>
            <option value="남성">남성</option>
            <option value="여성">여성</option>
          </select>
        </div>
        <div class="check_div" id="gender_check" value=""></div>

        <div class="sign_name">연락처</div>
        <input class="inf1" type="text" placeholder="Phone Number" id="s_phonenum" name="s_phonenum" required >
        <div class="check_div" id="phonenum_check" value=""></div>

        <div class="verify">
          <div class="sign_name">이메일</div>
          <!--인증번호를 전송할 이메일 기입창과 전송 버튼-->
          <input class="inf3" type="email" placeholder="email "id="s_email" name="s_email" required >
          <input class="btn_e" id="btn_email" type="button" value="이메일전송">
          <!--인증번호 기입란-->
          <input class="inf1" type="text" placeholder="인증번호 입력하세요. "id="verify_num" name="verify_num" disabled="">
          <div class="check_div" id="email_check" value=""></div>
        </div>

      </div>
      <!-- <button type="button" style="border-radius:5px; font-s"/> <a href="http://laravel.site/login">돌아가기</a> </button> </td> -->
      <div class="under">
        <button class="lg_bt" type='button' onclick="history.back()">뒤로</button>
        <input class="lg_bt" type='submit' id="btnSubmit" value="다음" >
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

  $(document).ready(function(){
    //***************ID 비교*******************
    $("#id").blur(function() {
      //seller register의 id input
      var seller_val = $('#id').val();
      //정규식
      var idJ = /^[a-z0-9_\-]{5,20}$/;
      //예외처리 -- 공백
      if(seller_val==''){
        //1. ID 공백체크
        $('#id_check').text('필수 정보입니다.');
        $('#id_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',true);
      }
      else if(!idJ.test(seller_val)){
        //2. 정규식 일치X
        $('#id_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능합니다.');
        $('#id_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',true);
      }
      else{
        $.ajax({

          type: 'post',
          url: 'seller_Overlap',
          dataType: 'json',
          data: { "id": seller_val },

          success : function(data) {
            console.log(data);
            //1. ID 중복O
            if(data>0){
              $('#id_check').text('이미 사용중인 아이디입니다.');
              $('#id_check').css('color', 'red');
              //$('#btnSubmit').attr('disabled',true);
            }

            //2. ID 중복X
            if(data<1){
              $("#id_check").text("사용가능한 아이디입니다!");
              $('#id_check').css('color', 'green');
              //$('#btnSubmit').attr('disabled', false);
            }
          }//success
          ,error : function() {   console.log("실패");  }
        }) //ajax
      }
    });//blur

    //pw 비교
    $("#pw").blur(function() {
      //input data
      var pw=$("#pw").val();
      //정규식
      var pwJ = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;

      //1. 정규식 일치 O
      if(pwJ.test(pw)){
        $("#pw_check").text("");
        $('#btnSubmit').attr('disabled',true);
      }
      //2. 공백
      else if(pw==''){
        $('#pw_check').text('비밀번호를 입력해주세요.');
        $('#pw_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',false);
      }
      //3. 정규식 일치 X
      else{
        $('#pw_check').text('8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다. ');
        $('#pw_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',false)
      }
    });//blur

    $("#check").blur(function() {
      //input data
      var pw=$("#pw").val();
      var check=$("#check").val();

      //1. 공백이 아닐 경우
      if(pw != "" || check != "")
      {
        if(pw == check)
        {
          $("#re_pw_check").text('비밀번호가 일치합니다!');
          $('#re_pw_check').css('color', 'green');
          //$("#submit").removeAttr("disabled"); //버튼 비활성화 속성 제거
        }

        else{
          $('#re_pw_check').text('비밀번호가 일치하지 않습니다.');
          $('#re_pw_check').css('color', 'red');
          //$("#submit").attr("disabled", "false"); //버튼 비활성화
        }
      }
      //2. 공백일 경우
      else {
        $('#re_pw_check').text('필수 정보입니다.');
        $('#re_pw_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',false);
      }
    });//blur

    $("#name").blur(function() {
      //input data
      var seller_name = $('#name').val();
      //정규식
      var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

      //1. 공백 -- 빈칸
      if(seller_name == ""){
        $('#name_check').text("필수 정보입니다.");
        $('#name_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',true);
      }
      //2. 공백X 특수기호, 스페이스바 사용
      else if(markJ.test(seller_name)){
        $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
        $('#name_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',true);
      }
      //3. 공백X
      else{
        //4. 특수문자, 공백 미포함시
        if(!markJ.test(seller_name)){
          $("#name_check").text("");
          //$('#btnSubmit').attr('disabled',false);
        }
      }
    });//blur

    $("#s_birth_y").blur(function() {
      checkBirthInput();
    });//blur
    $("#s_birth_m").change(function() {
      checkBirthInput();
    });//blur
    $("#s_birth_d").blur(function() {
      checkBirthInput();
    });

    $("#s_gender").change(function() {
      //Input data
      var s_gender = $('#s_gender').val();
      //공백(빈칸)
      if(!s_gender == ""){
        $('#gender_check').text("");
        $('#gender_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',false);
      }
      else{
        $('#gender_check').text("필수 정보입니다.");
        $('#gender_check').css('color', 'red');
        //$('#btnSubmit').attr('disabled',true);
      }
    });

    $("#btn_email").click(function() {
        verify_email();
    });

    //생년월일 예외처리 함수
    function checkBirthInput(){
      //input data
      var s_birth_y = $('#s_birth_y').val();
      var s_birth_m = $('#s_birth_m').val();
      var s_birth_d = $('#s_birth_d').val();
      //정규식
      var birthJ =  /^[0-9]+$/
      //(년) - 정규식 O , 4자리
      if(birthJ.test(s_birth_y)&&s_birth_y.length==4){
        $("#birth_check").text("");
        $('#birth_check').css('color', 'red');
        //2. 월 - 공백 O
        if(s_birth_m==""){
          $("#birth_check").text('태어난 월을 선택하세요.');
          $('#birth_check').css('color', 'red');
        }
        //2. 월 - 공백 X
        else{
          $('#birth_check').text('');
          $('#birth_check').css('color', 'red');
          //3. 일 - 공백 O
          if(s_birth_d==""){
            $("#birth_check").text('태어난 일(날짜) 2자리를 정확하게 입력하세요.');
            $('#birth_check').css('color', 'red');
          }
          //3. 일 - 공백 O
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
    }

    //*****************이메일*******************
    function verify_email(){
      //  var email = document.getElementById("s_email");
      var seller_val = $('#s_email').val();
      //정규식
      var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/
      //1. 공백 X
      if(!seller_val == ""){
        //2. 정규식 O
        if(verifyJ.test(seller_val)){
          $.ajax({

            type: 'post',
            url: 'mail',
            dataType: 'json',
            data: { "email": seller_val },

            success : function(data) {
              //공백
              $('#email_check').text("인증번호가 전송되었습니다.");
              $('#email_check').css('color', 'green');
              $('#verify_num').attr('disabled', false);
            }//success
            ,error : function() { }
          });
        }
        //3. 정규식 X
        else{
          $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
          $('#email_check').css('color', 'red');
        }
      } //공백조건식

      //2. 공백 O
      else{
        $('#email_check').text("필수 정보입니다.");
        $('#email_check').css('color', 'red');
      }
    }
  });
    </script>
