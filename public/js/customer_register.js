//전역변수 random
var global_random;
// jQuery -- 어지수
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){
  //***************ID 비교*******************
  $("#id").blur(function() {
    check_id();
  });//blur

  //pw 비교
  $("#pw").blur(function() {
    check_pw();
  });//blur

  $("#check").blur(function() {
    check_re_pw();
  });//blur

  $("#name").blur(function() {
    check_name();
  });//blur

  $("#c_birth_y").blur(function() {
    checkBirthInput();
  });//blur
  $("#c_birth_m").change(function() {
    checkBirthInput();
  });//blur
  $("#c_birth_d").blur(function() {
    checkBirthInput();
  });

  $("#c_gender").change(function() {
    check_gender();
  });

  $("#c_phonenum").blur(function() {
    check_phonenum();
  });

  $("#btn_email").click(function() {
    verify_email();
  });
  //이메일 확인
  $("#verify_num").blur(function() {
    email_check();
  });//blur


//*************************************check******************************************
function check_id(){
  var customer_val = $('#id').val();
  //정규식
  var idJ = /^[a-z0-9_\-]{5,20}$/;
  //예외처리 -- 공백
  if(customer_val==''){
    //1. ID 공백체크
    $('#id_check').text('필수 정보입니다.');
    $('#id_check').css('color', 'red');
  }
  else if(!idJ.test(customer_val)){
    //2. 정규식 일치X
    $('#id_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능합니다.');
    $('#id_check').css('color', 'red');
  }
  else{
    $.ajax({

      type: 'post',
      url: 'customer_Overlap',
      dataType: 'json',
      data: { "id": customer_val },

      success : function(data) {
        console.log(data);
        //1. ID 중복O
        if(data>0){
          $('#id_check').text('이미 사용중인 아이디입니다.');
          $('#id_check').css('color', 'red');
        }

        //2. ID 중복X
        if(data<1){
          $("#id_check").text("사용가능한 아이디입니다!");
          $('#id_check').css('color', 'green');
        }
      }//success
      ,error : function() {   console.log("실패");  }
    }) //ajax
  }
}

function check_pw(){
  //input data
  var pw=$("#pw").val();
  //정규식
  var pwJ = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;

  //1. 정규식 일치 O
  if(pwJ.test(pw)){
    $("#pw_check").text("");
  }
  //2. 공백
  else if(pw==''){
    $('#pw_check').text('비밀번호를 입력해주세요.');
    $('#pw_check').css('color', 'red');
  }
  //3. 정규식 일치 X
  else{
    $('#pw_check').text('8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다. ');
    $('#pw_check').css('color', 'red');
  }
}

function check_re_pw(){
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
    }

    else{
      $('#re_pw_check').text('비밀번호가 일치하지 않습니다.');
      $('#re_pw_check').css('color', 'red');
    }
  }
  //2. 공백일 경우
  else {
    $('#re_pw_check').text('필수 정보입니다.');
    $('#re_pw_check').css('color', 'red');
  }
}

function check_name(){
  //input data
  var customer_name = $('#name').val();
  //정규식
  var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

  //1. 공백 -- 빈칸
  if(customer_name == ""){
    $('#name_check').text("필수 정보입니다.");
    $('#name_check').css('color', 'red');
  }
  //2. 공백X 특수기호, 스페이스바 사용
  else if(markJ.test(customer_name)){
    $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
    $('#name_check').css('color', 'red');
  }
  //3. 공백X
  else{
    //4. 특수문자, 공백 미포함시
    if(!markJ.test(customer_name)){
      $("#name_check").text("");
    }
  }
}

function check_gender(){
  //Input data
  var c_gender = $('#c_gender').val();
  //공백(빈칸)
  if(c_gender == ""){
    $('#gender_check').text("필수 정보입니다.");
    $('#gender_check').css('color', 'red');
  }
  else{
    $('#gender_check').text("");
    $('#gender_check').css('color', 'red');
  }
}

function check_phonenum(){
  //seller register의 id input
  var c_phonenum_val = $('#c_phonenum').val();
  var regex= /^[0-9]+$/;

  //1. 정규식 일치 O
  if(c_phonenum_val==""){
    $("#phonenum_check").text("필수 정보입니다.");
    $('#phonenum_check').css('color', 'red');
  }
  //2. 공백
  else if(regex.test(c_phonenum_val)){
    $('#phonenum_check').text('');
  }
  //3. 정규식 일치 X
  else{
    $('#phonenum_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능합니다.');
    $('#phonenum_check').css('color', 'red');
  }
}

//*******************생년월일 예외처리 함수***********************
function checkBirthInput(){
  //input data
  var c_birth_y = $('#c_birth_y').val();
  var c_birth_m = $('#c_birth_m').val();
  var c_birth_d = $('#c_birth_d').val();
  //정규식
  var birthJ =  /^[0-9]+$/
  //(년) - 정규식 O , 4자리
  if(birthJ.test(c_birth_y)&&c_birth_y.length==4){
    $("#birth_check").text("");
    $('#birth_check').css('color', 'red');

    //2. 월 - 공백 O
    if(c_birth_m==""){
      $("#birth_check").text('태어난 월을 선택하세요.');
      $('#birth_check').css('color', 'red');

    }
    //2. 월 - 공백 X
    else{
      $('#birth_check').text('');
      $('#birth_check').css('color', 'red');


      //3. 일 - 공백 O
      if(c_birth_d==""){
        $("#birth_check").text('태어난 일(날짜) 2자리를 정확하게 입력하세요.');
        $('#birth_check').css('color', 'red');

      }
      //3. 일 -공백 x
      else{
        $('#birth_check').text('');
        $('#birth_check').css('color', 'red');
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
  var customer_val = $('#c_email').val();
  //정규식
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/

  //1. 공백 X
  if(!customer_val == ""){
    //2. 정규식 O
    if(verifyJ.test(customer_val)){
      //일부러 success에 안넣었어요!!!!
      $('#email_check').text("인증번호가 전송되었습니다.");
      $('#email_check').css('color', 'green');
      $('#verify_num').attr('disabled', false);

      $.ajax({

        type: 'post',
        url: 'mail',
        dataType: 'json',
        data: { "email": customer_val },

        success : function(randomNum) {
            global_random = randomNum;
          //공백
          console.log(randomNum);
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

//이메일 확인
function email_check(){
//input data
var verify = $('#verify_num').val();
//1. 공백 -- 빈칸
if(verify == ""){
  $('#email_check').text("인증이 필요합니다.");
  $('#email_check').css('color', 'red');
}
//2. 빈칸 X
//랜덤값과 맞을 때
else if(global_random==verify){
  $('#email_check').text("");
}
else{
  $('#email_check').text("인증번호를 다시 확인해주세요.");
  $('#email_check').css('color', 'red');
}
}


function checkIt(){
  global_random;
  //공백 alert
  if(document.f.c_id.value==""){
    document.f.c_id.focus();
    return false;
  }
  if(document.f.c_password.value==""){
    document.f.c_password.focus();
    return false;
  }
  if(document.f.c_re_password.value==""){
    document.f.c_re_password.focus();
    return false;
  }
  if(document.f.c_name.value==""){
    document.f.c_name.focus();
    return false;
  }
  if(document.f.c_birth_y.value==""){
    document.f.c_birth_y.focus();
    return false;
  }
  if(document.f.c_gender.value==""){
    document.f.c_gender.focus();
    return false;
  }
  if(document.f.c_phonenum.value==""){
    document.f.c_phonenum.focus();
    return false;
  }
  if(document.f.c_email.value==""){
    document.f.c_email.focus();
    return false;
  }
  if(document.f.verify_num.value==""){
    document.f.verify_num.focus();
    return false;
  }
  if(document.f.verify_num.value!=global_random){
    document.f.verify_num.focus();
    return false;
  }
  else{
    return true;
  }
}
