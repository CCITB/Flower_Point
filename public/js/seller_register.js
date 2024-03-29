//전역변수 random
var global_random;
var global_id_check;
//현재날짜
var date;
//input 날짜
var input_birth;

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

  $('#s_bankname').blur(function(){
    check_bank();
  })
  $('#s_account_num').blur(function(){
    check_bank();
  })

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

  //이메일 인증
  $("#s_email").blur(function() {
    verify_email();
  });
  // $("#btn_email").click(function() {
  //   verify_email();
  // });
  // //이메일 확인
  // $("#verify_num").blur(function() {
  //   email_check();
  // });//blur

  //phone
  $("#btn_phone").click(function() {
    verify_phone();
  });

  $("#verify_p_num").blur(function() {
    phone_check();
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
          // console.log(data);

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

  function check_bank(){
    var s_bankname = $('#s_bankname').val();
    var s_account = $('#s_account_num').val();
    var no= /^[0-9]+$/;

    if(s_bankname == ""){
      $('#bank_check').text('수익금 반환 은행은 필수항목입니다.')
      $('#bank_check').css('color','red');
    }
    else{
      if(s_account == ""){
        $('#bank_check').text("수익금 반환 계좌번호는 필수항목입니다.");
        $('#bank_check').css('color','red');
      }
      else if(!no.test(s_account)){
        $('#bank_check').text("하이픈(-)을 제외한 숫자만 입력해주세요.");
        $('#bank_check').css('color','red');
      }
      else{
        //보통 은행 계좌는 최소 11자리~13자리 (11자리가 SC제일은행)
        if(s_account.length<11){
          console.log(s_account.length);
          $('#bank_check').text("계좌번호가 알맞지 않습니다.");
          $('#bank_check').css('color','red');
        }
        else{
          $('#bank_check').text("");
        }
      }
    }
  }

  // function check_account(){
  //   var s_account = $('#s_account_num').val();
  //   var no= /^[0-9]+$/;
  //
  //   if(s_account == ""){
  //     $('#bank_check').text("수익금 반환계좌는 필수항목입니다.");
  //     $('#bank_check').css('color','red');
  //   }
  //   else if(!no.test(s_account)){
  //     $('#bank_check').text("하이픈(-)을 제외한 숫자만 입력해주세요.");
  //     $('#bank_check').css('color','red');
  //   }
  //   else{
  //     //보통 은행 계좌는 최소 11자리~13자리 (11자리가 SC제일은행)
  //     if(s_account.length<11){
  //       $('#bank_check').text("계좌번호가 알맞지 않습니다.");
  //       $('#bank_check').css('color','red');
  //     }
  //     else{
  //       $('#bank_check').text("");
  //     }
  //   }
  // }

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

  //*****************전화인증*******************
  function verify_phone(){
    //  var email = document.getElementById("s_email");
    var seller_val1 = $('#s_tel1').val();
    var seller_val2 = $('#s_tel2').val();
    var seller_val3 = $('#s_tel3').val();

    var seller_val = seller_val1+'-'+seller_val2+'-'+seller_val3;

    //정규식
    var phone= /^[0-9]+$/;

    //1. 공백 X
    if(seller_val1 != "" && seller_val2 != "" && seller_val3 != ""){
      //2. 정규식 O
      if(phone.test(seller_val1)&&phone.test(seller_val2)&&phone.test(seller_val3)){

        $.ajax({

          type: 'post',
          url: 'sms',
          async:false,
          dataType: 'json',
          data: { "tel": seller_val },

          // //난수
          success : function(randomNum) {
            $('#phonenum_check').text("인증번호가 전송되었습니다.");
            $('#phonenum_check').css('color', 'green');
            $('#verify_p_num').attr('disabled', false);

            global_random = randomNum;
            console.log(randomNum);
          }//success
          ,error:function(randomNum,status,error){
            alert("code:"+randomNum.status+"\n"+"message:"+randomNum.responseText+"\n"+"error:"+error);}
          });
        }
        //3. 정규식 X
        else{
          $('#phonenum_check').text("알맞는 이메일 유형이 아닙니다.");
          $('#phonenum_check').css('color', 'red');
        }
      } //공백조건식

      //2. 공백 O
      else{
        $('#phonenum_check').text("필수 정보입니다.");
        $('#phonenum_check').css('color', 'red');
      }
    }
    //전화 인증 확인
    function phone_check(){
      global_random;
      //input data
      var verify = $('#verify_p_num').val();
      // console.log(global_random);
      // console.log(verify);

      //1. 공백 -- 빈칸
      if(verify == ""){
        $('#phonenum_check').text("인증이 필요합니다.");
        $('#phonenum_check').css('color', 'red');
      }
      //2. 빈칸 X
      //랜덤값과 맞을 때
      else if(global_random==verify){
        $('#phonenum_check').text("");
      }
      else{
        $('#phonenum_check').text("인증번호를 다시 확인해주세요.");
        $('#phonenum_check').css('color', 'red');
      }
    }
  //*******************생년월일 예외처리 함수***********************
  function checkBirthInput(){
    //input data
    var s_birth_y = $('#s_birth_y').val();
    var s_birth_m = $('#s_birth_m').val();
    var s_birth_d = $('#s_birth_d').val();
    //
    var today = new Date();
    var yyyy = today.getFullYear();
    var mm = today.getMonth()+1;
    var dd = today.getDate();

    if((mm+"").length < 2 && (""+dd).length < 2 ){
      var today = yyyy+'0'+mm+'0'+dd;
      date = parseInt(today);
    }
    else if((mm+"").length < 2){
      var today = yyyy+'0'+mm+''+dd;
      date = parseInt(today);
    }
    else if((dd+"").length < 2){
      var today = yyyy+''+mm+'0'+dd;
      date = parseInt(today);
    }
    else{
      var today = yyyy+''+mm+''+dd;
      date = parseInt(today);
    }

    //input data --- day
    if(s_birth_d.length!=0&&s_birth_d.length < 2){
      var s_birth = s_birth_y+s_birth_m+'0'+s_birth_d;
      input_birth = parseInt(s_birth);
    }
    else{
      var s_birth = s_birth_y+s_birth_m+s_birth_d;
      input_birth = parseInt(s_birth);
    }

    // console.log(typeof date, typeof input_birth);
    // console.log(date, input_birth);

    //정규식
    var birthJ =  /^[0-9]+$/;
    //(년) - 정규식 O , 4자리
    if(birthJ.test(s_birth_y)){
      $("#birth_check").text("");
      $('#birth_check').css('color', 'red');
      //2. 월 - 공백 O
      if(s_birth_m==""){
        $("#birth_check").text('태어난 월을 선택하세요.');
        $('#birth_check').css('color', 'red');
      }
      //2. 월 - 공백 X
      else{
        //3. 일 - 공백 O
        if(s_birth_d==""){
          $("#birth_check").text('태어난 일(날짜) 2자리를 정확하게 입력하세요.');
          $('#birth_check').css('color', 'red');
        }
        //3. 일 -공백 x
        else{
          if(s_birth_d>31){
            $("#birth_check").text('생년월일을 다시 확인해주세요.');
            $('#birth_check').css('color', 'red');
          }
          else if(date<input_birth){
            $("#birth_check").text('미래에서 오셨나요?');
            $('#birth_check').css('color', 'red');
          }
          else{
          $('#birth_check').text('');
          $('#birth_check').css('color', 'red');
          }
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
        $('#email_check').text("");
        //일부러 success에 안넣었어요!!!!
        // $('#email_check').text("인증번호가 전송되었습니다.");
        // $('#email_check').css('color', 'green');
        // $('#verify_num').attr('disabled', false);
        //
        // $.ajax({
        //
        //   type: 'post',
        //   url: 'mail',
        //   async:false,
        //   dataType: 'json',
        //   data: { "email": seller_val },
        //   //random": random },
        //
        //   // //난수
        //   // $randoms = Math.floor(Math.random() * 10000)+1;
        //   success : function(randomNum) {
        //     global_random = randomNum;
        //     console.log(randomNum);
        //   }//success
        //   ,error : function() { }
        // });
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
// function email_check(){
//   //input data
//   var verify = $('#verify_num').val();
//   //1. 공백 -- 빈칸
//   if(verify == ""){
//     $('#email_check').text("인증이 필요합니다.");
//     $('#email_check').css('color', 'red');
//   }
//   //2. 빈칸 X
//   //랜덤값과 맞을 때
//   else if(global_random==verify){
//     $('#email_check').text("");
//   }
//   else{
//     $('#email_check').text("인증번호를 다시 확인해주세요.");
//     $('#email_check').css('color', 'red');
//   }
// }

//**********************<<<<onsubmit>>>>********************
function checkIt(){
  global_random;

  //정규식
  var idJ = /^[a-z0-9_\-]{5,20}$/;
  var pwJ = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;
  var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var num= /^[0-9]+$/;
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/;
  // if(document.f.s_id.value==""){
  //   document.f.s_id.focus();
  //   return false;
  // }
  //-------------------계좌번호

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

  //은행 계좌
  if($('#s_bankname').val()==""){
    $('#bank_check').text('수익금 반환 은행은 필수항목입니다.');
    $('#bank_check').css('color','red');
    $("#s_bankname").focus();
    return false;
  }

  if($('#s_account_num').val()==""){
    $('#bank_check').text('수익금 반환 계좌번호는 필수항목입니다.');
    $('#bank_check').css('color','red');
    $("#s_account_num").focus();
    return false;
  }

  if(!num.test($('#s_account_num').val())){
    $('#bank_check').text("하이픈(-)을 제외한 숫자만 입력해주세요.");
    $('#bank_check').css('color','red');
    $("#s_account_num").focus();
    return false;
  }

  if($('#s_account_num').val().length<11){
    $('#bank_check').text('계좌번호가 알맞지 않습니다.');
    $('#bank_check').css('color','red');
    $("#s_account_num").focus();
    return false;
  }
  //-------------------생년월일(필수는 data는 아니지만 잘못된 값 넣는 것을 방지)
  if(!num.test($('#s_birth_y').val())){
    $("#birth_check").text(' 태어난 년도 4자리를 정확하게 입력하세요.');
    $('#birth_check').css('color', 'red');
    $("#s_birth_y").focus();
    return false;
  }
  if($('#s_birth_m').val()==""){
    $("#birth_check").text('태어난 월을 선택하세요.');
    $('#birth_check').css('color', 'red');
    $("#s_birth_m").focus();
    return false;
  }
  if($('#s_birth_d').val()==""){
    $("#birth_check").text('태어난 일(날짜) 2자리를 정확하게 입력하세요.');
    $('#birth_check').css('color', 'red');
    $("#s_birth_d").focus();
    return false;
  }
  if(!num.test($('#s_birth_d').val())){
    $("#birth_check").text('생년월일을 다시 확인해주세요.');
    $('#birth_check').css('color', 'red');
    $("#s_birth_d").focus();
    return false;
  }
  if(!num.test($('#s_birth_d').val())){
    $("#birth_check").text('생년월일을 다시 확인해주세요.');
    $('#birth_check').css('color', 'red');
    $("#s_birth_d").focus();
    return false;
  }
  if(date<input_birth){
    $("#birth_check").text('미래에서 오셨나요?');
    $('#birth_check').css('color', 'red');
    $("#s_birth_y").focus();
    return false;
  }
  //-------------------핸드폰 인증
  if($('#s_tel1').val()=="" || $('#s_tel2').val()==""){
    $("#phonenum_check").text("필수 정보입니다.");
    $('#phonenum_check').css('color', 'red');
    $("#s_tel2").focus();
    return false;
  }
  if($('#s_tel3').val()==""){
    $("#phonenum_check").text("필수 정보입니다.");
    $('#phonenum_check').css('color', 'red');
    $("#s_tel3").focus();
    return false;
  }
  if(!num.test($('#s_tel1').val())||!num.test($('#s_tel2').val())){
    $('#phonenum_check').text('형식에 맞지 않는 번호입니다.');
    $('#phonenum_check').css('color', 'red');
    $("#s_tel2").focus();
    return false;
  }
  if(!num.test($('#s_tel3').val())){
    $('#phonenum_check').text('형식에 맞지 않는 번호입니다.');
    $('#phonenum_check').css('color', 'red');
    $("#s_tel3").focus();
    return false;
  }
  //-------------------핸드폰 인증번호 칸
  if($('#verify_p_num').val() == ""){
    $('#phonenum_check').text("인증이 필요합니다.");
    $('#phonenum_check').css('color', 'red');
    return false;
  }
  if(global_random!=$('#verify_p_num').val()){
    $('#phonenum_check').text("인증번호를 다시 확인해주세요.");
    $('#phonenum_check').css('color', 'red');
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
  // if($('#verify_num').val() == ""){
  //   $('#email_check').text("인증이 필요합니다.");
  //   $('#email_check').css('color', 'red');
  //   $("#verify_num").focus();
  //   return false;
  // }
  // if(global_random != $('#verify_num').val()){
  //   $('#email_check').text("인증번호를 다시 확인해주세요.");
  //   $('#email_check').css('color', 'red');
  //   $("#verify_num").focus();
  //   return false;
  // }
  else{
    return true;
  }
}
