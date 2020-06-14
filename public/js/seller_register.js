//전역변수 random
var global_random;
var global_id_check;
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
    check_gender();
  });

  $("#s_phonenum").blur(function() {
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
    //seller register의 id input
    var seller_val = $('#id').val();
    //정규식
    var idJ = /^[a-z0-9_\-]{5,20}$/;

    //예외처리 -- 공백
    if(seller_val==''){
      //1. ID 공백체크
      $('#id_check').text('필수 정보입니다.');
      $('#id_check').css('color', 'red');
    }
    else if(!idJ.test(seller_val)){
      //2. 정규식 일치X
      $('#id_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능합니다.');
      $('#id_check').css('color', 'red');
    }
    else{
      $.ajax({

        type: 'post',
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "id": seller_val },

        success : function name(data) {
          console.log(data);

          global_id_check=data;
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
    var seller_name = $('#name').val();
    //정규식
    var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

    //1. 공백 -- 빈칸
    if(seller_name == ""){
      $('#name_check').text("필수 정보입니다.");
      $('#name_check').css('color', 'red');

    }
    //2. 공백X 특수기호, 스페이스바 사용
    else if(markJ.test(seller_name)){
      $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
      $('#name_check').css('color', 'red');
    }
    //3. 공백X
    else{
      //4. 특수문자, 공백 미포함시
      if(!markJ.test(seller_name)){
        $("#name_check").text("");
      }
    }
  }

  function check_gender(){
    //Input data
    var s_gender = $('#s_gender').val();
    //공백(빈칸)
    if(s_gender == ""){
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
    var s_phonenum_val1 = $('#seller_tel1').val();
    var s_phonenum_val2 = $('#seller_tel2').val();
    var s_phonenum_val3 = $('#seller_tel3').val();
    var phone= /^[0-9]+$/;

    //1. 정규식 일치 O
    if(s_phonenum_val1==""||s_phonenum_val2==""||s_phonenum_val3==""){
      $("#phonenum_check").text("필수 정보입니다.");
      $('#phonenum_check').css('color', 'red');
    }
    //2. 공백
    else if(phone.test(s_phonenum_val1=="")||phone.test(s_phonenum_val2=="")||phone.test(s_phonenum_val3=="")){
      $('#phonenum_check').text('');
    }
    //3. 정규식 일치 X
    else{
      $('#phonenum_check').text('형식에 맞지 않는 번호입니다.');
      $('#phonenum_check').css('color', 'red');
    }
  }

  //*******************생년월일 예외처리 함수***********************
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
      return false;
      //2. 월 - 공백 O
      if(s_birth_m==""){
        $("#birth_check").text('태어난 월을 선택하세요.');
        $('#birth_check').css('color', 'red');
        return false;
      }
      //2. 월 - 공백 X
      else{
        //3. 일 - 공백 O
        if(s_birth_d==""){
          $("#birth_check").text('태어난 일(날짜) 2자리를 정확하게 입력하세요.');
          $('#birth_check').css('color', 'red');
          return false;
        }
        //3. 일 -공백 x
        else{
          $('#birth_check').text('');
          $('#birth_check').css('color', 'red');
          return true;
        }
      }
    }
    else{
      $('#birth_check').text(' 태어난 년도 4자리를 정확하게 입력하세요. ');
      $('#birth_check').css('color', 'red');
      return false;
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
        //일부러 success에 안넣었어요!!!!
        $('#email_check').text("인증번호가 전송되었습니다.");
        $('#email_check').css('color', 'green');
        $('#verify_num').attr('disabled', false);

        $.ajax({

          type: 'post',
          url: 'mail',
          async:false,
          dataType: 'json',
          data: { "email": seller_val },
          //random": random },

          // //난수
          // $randoms = Math.floor(Math.random() * 10000)+1;
          success : function(randomNum) {
            global_random = randomNum;
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

//**********************<<<<onsubmit>>>>********************
function checkIt(){
  global_random;

  //정규식
  var idJ = /^[a-z0-9_\-]{5,20}$/;
  var pwJ = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;
  var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var phone= /^[0-9]+$/;
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/;

  // if(document.f.s_id.value==""){
  //   document.f.s_id.focus();
  //   return false;
  // }
  //-------------------ID 예외처리
  if($('#id').val()==''){
    $('#id_check').text('필수 정보입니다.');
    $('#id_check').css('color', 'red');
    $("#id").focus();
    return false;
  }
  if(!idJ.test($('#id').val())){
    //2. 정규식 일치X
    $('#id_check').text('5~20자리의 영문 소문자, 숫자와 특수기호 (-),(_)만 사용 가능합니다.');
    $('#id_check').css('color', 'red');
    $("#id").focus();
    return false;
  }
  //id중복
  if(global_id_check>0){
    $('#id_check').text('이미 사용중인 아이디입니다.');
    $('#id_check').css('color', 'red');
    $("#id").focus();
    return false;
  }
  //-------------------PW 예외처리
  //2. 공백
  if($("#pw").val()==''){
    $('#pw_check').text('비밀번호를 입력해주세요.');
    $('#pw_check').css('color', 'red');
    $("#pw").focus();
    return false;
  }
  //3. 정규식 일치 X
  if(!pwJ.test($("#pw").val())){
    $('#pw_check').text('8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다. ');
    $('#pw_check').css('color', 'red');
    $("#pw").focus();
    return false;
  }
  //-------------------PW 확인 예외처리
  //1. 공백이 아닐 경우
  if($("#pw").val() != "" || $("#check").val() != "")
  {
    if($("#pw").val() != $("#check").val()){
      $('#re_pw_check').text('비밀번호가 일치하지 않습니다.');
      $('#re_pw_check').css('color', 'red');
      $("#check").focus();
      return false;
    }
  }
  //2. 공백일 경우
  if($("#pw").val() == "" || $("#check").val() == ""){
    $('#re_pw_check').text('필수 정보입니다.');
    $('#re_pw_check').css('color', 'red');
    $("#check").focus();
    return false;
  }
  //-------------------이름
  //1. 공백 -- 빈칸
  if($('#name').val() == ""){
    $('#name_check').text("필수 정보입니다.");
    $('#name_check').css('color', 'red');
    $("#name").focus();
    return false;
  }
  //2. 공백X 특수기호, 스페이스바 사용
  if(markJ.test($('#name').val())){
    $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
    $('#name_check').css('color', 'red');
    $("#name").focus();
    return false;
  }
  //-------------------성별
  if($('#s_gender').val() == ""){
    $('#gender_check').text("필수 정보입니다.");
    $('#gender_check').css('color', 'red');
    $("#s_gender").focus();
    return false;
  }
  //-------------------핸드폰
  //1. 정규식 일치 O
  if($('#seller_tel1').val()==""||$('#seller_tel2').val()==""){
    $("#phonenum_check").text("필수 정보입니다.");
    $('#phonenum_check').css('color', 'red');
    $("#seller_tel2").focus();
    return false;
  }
  if($('#seller_tel3').val()==""){
    $("#phonenum_check").text("필수 정보입니다.");
    $('#phonenum_check').css('color', 'red');
    $("#seller_tel3").focus();
    return false;
  }
  //3. 정규식 일치 X
  if(!phone.test($('#seller_tel1').val())||!phone.test($('#seller_tel2').val())){
    $('#phonenum_check').text('형식에 맞지 않는 번호입니다.');
    $('#phonenum_check').css('color', 'red');
    $("#seller_tel2").focus();
    return false;
  }
  if(!phone.test($('#seller_tel3').val())){
    $('#phonenum_check').text('형식에 맞지 않는 번호입니다.');
    $('#phonenum_check').css('color', 'red');
    $("#seller_tel3").focus();
    return false;
  }
  //-------------------이메일
  //공백
  if($('#s_email').val()==""){
    $('#email_check').text("필수 정보입니다.");
    $('#email_check').css('color', 'red');
    $("#s_email").focus();
    return false;
  }
  //정규식 일치xx
  if(!verifyJ.test($('#s_email').val())){
    $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
    $('#email_check').css('color', 'red');
    $("#s_email").focus();
    return false;
  }
  //-------------------이메일 인증
  //인증 칸 공백
  if($('#verify_num').val() == ""){
    $('#email_check').text("인증이 필요합니다.");
    $('#email_check').css('color', 'red');
    $("#verify_num").focus();
    return false;
  }
  else if(global_random != $('#verify_num').val()){
    $('#email_check').text("인증번호를 다시 확인해주세요.");
    $('#email_check').css('color', 'red');
    $("#verify_num").focus();
    return false;
  }
  else{
    return true;
  }
}
