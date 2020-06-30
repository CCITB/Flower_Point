
var global_random;
var check;

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){

  //find_id 이름 입력란
  $("#name1").blur(function() {
    check_name_email();
  });
  //find_id 이름 입력란
  $("#name2").blur(function() {
    check_name_sms();
  });
  //<<<find_id>>>
  // find_id 이메일 전송 -- customer
  $("#btn_email_c").click(function() {
    verify_email_customer();
  });
  // find_id sms 전송 -- customer
  $("#btn_phone_c").click(function() {
    verify_sms_customer();
  });
  // find_id 이메일 전송 -- seller
  $("#btn_email_s").click(function() {
    verify_email_seller();
  });
  // find_id sms 전송 -- customer
  $("#btn_phone_s").click(function() {
    verify_sms_seller();
  });

  //<<<find_pw_way>>> -- customer
  //find_pw에서 email 인증 버튼
  $("#btn_email_way_c").click(function() {
    verify_email_way_c();
  });
  //find_pw에서 sms 인증 버튼
  $("#btn_email_way_s").click(function() {
    verify_email_way_s();
  });
  //<<<find_pw_way>>> -- seller
  //find_pw에서 email 인증 버튼
  $("#btn_email_way_sel_sms").click(function() {
    verify_sms_way_seller();
  });
  //find_pw에서 sms 인증 버튼
  $("#btn_email_way_sel_email").click(function() {
    verify_email_way_seller();
  });

  //비밀번호 재설정 (find_pw_reset)
  $("#new_pw").blur(function() {
    verify_new_pw();
  });
  $("#check").blur(function() {
    verify_re_pw();
  });

  // << radio box 이벤트 customer/seller 공용>>
  //이메일 인증 클릭시
  $('#chk_email').click(function () {
    //이메일 인증내용이 안보이면 활성화
    if($("#find_email").css("display") == "none"){
      $('#find_email').css("display", "block");
      $('#find_phone').css("display", "none");
      $('#id_bt').attr("form", "email_form");
    }
  });

  //휴대전화 인증 클릭시
  $('#chk_sms').click(function () {
    if($("#find_phone").css("display") == "none"){
      $('#find_phone').css("display", "block");
      $('#find_email').css("display", "none");
      $('#id_bt').attr("form", "sms_form");
    }
  });


  //********************이름*****************
  function check_name_email(){
    //input data
    var name = $('#name1').val();
    //정규식
    var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

    //1. 공백 -- 빈칸
    if(name == ""){
      $('#name_check1').text("필수 정보입니다.");
      $('#name_check1').css('color', 'red');
      $("#name").focus();
    }
    //2. 공백X 특수기호, 스페이스바 사용
    else if(!markJ.test(name)){
      $("#name_check1").text("");
    }
    //3. 공백X
    else{
      $('#name_check1').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
      $('#name_check1').css('color', 'red');
      $("#name").focus();
    }
  }

  function check_name_sms(){
    //input data
    var name = $('#name2').val();
    //정규식
    var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

    //1. 공백 -- 빈칸
    if(name == ""){
      $('#name_check2').text("필수 정보입니다.");
      $('#name_check2').css('color', 'red');
      $("#name").focus();
    }
    //2. 공백X 특수기호, 스페이스바 사용
    else if(!markJ.test(name)){
      $("#name_check2").text("");
    }
    //3. 공백X
    else{
      $('#name_check2').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
      $('#name_check2').css('color', 'red');
      $("#name").focus();
    }
  }
  //*****************find_id 이메일  -- customer *******************
  function verify_email_customer(){
    var input_name =$('#name1').val();
    var input_email =$('#input_email').val();
    //정규식
    var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/

    //1. 공백 X
    if(!input_email == ""){
      //2. 정규식 O
      if(verifyJ.test(input_email)){
        if($('#name1').val() != "" && $('#input_email').val() != ""){

          //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
          $.ajax({

            type: 'post',
            url: 'customer_email_query',
            async:false,
            dataType: 'json',
            data:{
              "input_name" : input_name,
              "input_email" : input_email
            },

            success : function(data) {
              console.log(data);
              if(data>0){
                $('#email_check').text("인증번호가 전송되었습니다.");
                $('#email_check').css('color', 'green');
                $('#verify_num1').attr('disabled', false);

                //존재할 경우 email로 인증번호 발송
                $.ajax({

                  type: 'post',
                  url: 'mail',
                  async:false,
                  dataType: 'json',
                  data: { "email": input_email },

                  success : function(randomNum) {
                    global_random = randomNum;
                    console.log(randomNum);
                  }//success
                  ,error : function() { }
                });
              }

              if(data<1){
                $('#verify_num1').attr('disabled', true);

                //존재하지 않을 경우 이메일 발송x
              }
            }//success
            ,error : function() { }
          });
        }

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
  //find_id sms -- customer
  function verify_sms_customer(){
    var input_name =$('#name2').val();
    var input_tel1 = $('#input_tel1').val();
    var input_tel2 = $('#input_tel2').val();
    var input_tel3 = $('#input_tel3').val();

    var input_tel = input_tel1+'-'+input_tel2+'-'+input_tel3;
    //정규식
    var phoneJ = /^[0-9]+$/;

    //1. tel 값이 공백 X
    if(!(input_tel1 == "") && !(input_tel2=="") && !(input_tel3=="")){
      //2. tel 값 정규식 일치 어차피 input_tel1값은 고정된 값이어서 제외함
      if(phoneJ.test(input_tel2)&&phoneJ.test(input_tel3)){
        //tel이 예외처리를 거치고 name또한 공백이 아닐 경우
        if(input_name != ""){
          console.log(input_tel);

          //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
          $.ajax({

            type: 'post',
            url: 'customer_sms_query',
            async:false,
            dataType: 'json',
            data:{
              "input_name": input_name,
              "input_tel" : input_tel
            },

            success : function(data) {
              console.log(data);
              if(data>0){
                //존재할 경우 SMS로 인증번호 발송
                $('#phonenum_check').text("인증번호가 전송되었습니다.");
                $('#phonenum_check').css('color', 'green');

                $.ajax({

                  type: 'post',
                  url: 'sms',
                  async:false,
                  dataType: 'json',
                  data: { "tel": input_tel },

                  success : function(randomNum) {
                    $('#verify_num2').attr('disabled', false);
                    global_random = randomNum;
                    console.log(randomNum);
                  }//success
                  ,error : function() { }
                });
              }

              if(data<1){
                $('#verify_num2').attr('disabled', true);

                //존재하지 않을 경우 이메일 발송x
              }
            }//success
            ,error : function() { }
          });
        }

      }
      //3. 정규식 X
      else{
        $('#phonenum_check').text("알맞는 유형이 아닙니다.");
        $('#phonenum_check').css('color', 'red');
      }
    } //공백조건식

    //2. 공백 O
    else{
      $('#phonenum_check').text("필수 정보입니다.");
      $('#phonenum_check').css('color', 'red');
    }
  }

  //*****************find_id 이메일 -- seller
  function verify_email_seller(){
    var input_name = $('#name1').val()
    var input_email = $('#input_email').val();
    //정규식
    var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/

    //1. 공백 X
    if(!input_email == ""){
      //2. 정규식 O
      if(verifyJ.test(input_email)){
        if($('#name1').val() != ""){

          //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
          $.ajax({

            type: 'post',
            url: 'seller_email_query',
            async:false,
            dataType: 'json',
            data:{
              "input_name" : input_name,
              "input_email" : input_email
            },

            success : function(data) {
              check=data;
              console.log(data);
              if(data>0){
                $('#email_check').text("인증번호가 전송되었습니다.");
                $('#email_check').css('color', 'green');
                $('#verify_num1').attr('disabled', false);

                //존재할 경우 email로 인증번호 발송
                $.ajax({

                  type: 'post',
                  url: 'mail',
                  async:false,
                  dataType: 'json',
                  data: { "email": input_email },

                  success : function(randomNum) {
                    global_random = randomNum;
                    console.log(randomNum);
                  }//success
                  ,error : function() { }
                });
              }

              if(data<1){
                $('#verify_num1').attr('disabled', true);

                //존재하지 않을 경우 이메일 발송x
              }
            }//success
            ,error : function() { }
          });
        }

      }
      //3. 정규식 X
      else{
        $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
        $('#email_check').css('color', 'red');
        $("#input_email").focus();
      }
    } //공백조건식

    //2. 공백 O
    else{
      $('#email_check').text("필수 정보입니다.");
      $('#email_check').css('color', 'red');
      $("#input_email").focus();
    }
  }

  function verify_sms_seller(){
    var input_name =$('#name2').val();
    var input_tel1 = $('#input_tel1').val();
    var input_tel2 = $('#input_tel2').val();
    var input_tel3 = $('#input_tel3').val();

    var input_tel = input_tel1+'-'+input_tel2+'-'+input_tel3;
    //정규식
    var phoneJ = /^[0-9]+$/;

    //1. tel 값이 공백 X
    if(!(input_tel1 == "") && !(input_tel2=="") && !(input_tel3=="")){
      //2. tel 값 정규식 일치 어차피 input_tel1값은 고정된 값이어서 제외함
      if(phoneJ.test(input_tel2)&&phoneJ.test(input_tel3)){
        //tel이 예외처리를 거치고 name또한 공백이 아닐 경우
        if(input_name != ""){
          console.log(input_tel);

          //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
          $.ajax({

            type: 'post',
            url: 'customer_sms_query',
            async:false,
            dataType: 'json',
            data:{
              "input_name": input_name,
              "input_tel" : input_tel
            },

            success : function(data) {
              console.log(data);
              if(data>0){
                //존재할 경우 SMS로 인증번호 발송
                $('#phonenum_check').text("인증번호가 전송되었습니다.");
                $('#phonenum_check').css('color', 'green');

                $.ajax({

                  type: 'post',
                  url: 'sms',
                  async:false,
                  dataType: 'json',
                  data: { "tel": input_tel },

                  success : function(randomNum) {
                    $('#verify_num2').attr('disabled', false);
                    global_random = randomNum;
                    console.log(randomNum);
                  }//success
                  ,error : function() { }
                });
              }

              if(data<1){
                $('#verify_num2').attr('disabled', true);

                //존재하지 않을 경우 이메일 발송x
              }
            }//success
            ,error : function() { }
          });
        }

      }
      //3. 정규식 X
      else{
        $('#phonenum_check').text("알맞는 유형이 아닙니다.");
        $('#phonenum_check').css('color', 'red');
      }
    } //공백조건식

    //2. 공백 O
    else{
      $('#phonenum_check').text("필수 정보입니다.");
      $('#phonenum_check').css('color', 'red');
    }
  }

  function verify_new_pw(){
    //input data
    var pw=$("#new_pw").val();
    //정규식
    var pwJ = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;

    //1. 정규식 일치 O
    if(pwJ.test(pw)){
      $("#pw_re").text("");
    }
    //2. 공백
    else if(pw==''){
      $('#pw_re').text('비밀번호를 입력해주세요.');
      $('#pw_re').css('color', 'red');
    }
    //3. 정규식 일치 X
    else{
      $('#pw_re').text('8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다. ');
      $('#pw_re').css('color', 'red');
    }
  }

  function verify_re_pw(){
    //input data
    var pw=$("#new_pw").val();
    var check=$("#check").val();

    //1. 공백이 아닐 경우
    if(pw != "" || check != "")
    {
      if(pw == check)
      {
        $("#pw_re_ck").text('비밀번호가 일치합니다!');
        $('#pw_re_ck').css('color', 'green');
      }

      else{
        $('#pw_re_ck').text('비밀번호가 일치하지 않습니다.');
        $('#pw_re_ck').css('color', 'red');
      }
    }
    //2. 공백일 경우
    else {
      $('#pw_re_ck').text('필수 정보입니다.');
      $('#pw_re_ck').css('color', 'red');
    }
  }
});

// find id [[email]] onsubmit -- customer/seller
function check_emailform(){
  check;
  global_random;
  var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/;

  //--------------------이름
  if($('#name1').val() == ""){
    $('#name_check1').text("필수 정보입니다.");
    $('#name_check1').css('color', 'red');
    $("#name1").focus();
    return false;
  }
  // 공백X 특수기호, 스페이스바 사용
  if(markJ.test($('#name1').val())){
    $('#name_check1').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
    $('#name_check1').css('color', 'red');
    $("#name1").focus();
    return false;
  }
  //-------------------이메일(seller)
  if($('#input_email').val() == ""){
    $('#email_check').text("필수 정보입니다.");
    $('#email_check').css('color', 'red');
    $("#input_email").focus();
    return false;
  }

  if(!verifyJ.test($('#input_email').val())){
    $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
    $('#email_check').css('color', 'red');
    $("#input_email").focus();
    return false;
  }
  //-------------------이메일 인증
  //인증 칸 공백
  if($('#verify_num1').val() == ""){
    $('#email_check').text("인증이 필요합니다.");
    $('#email_check').css('color', 'red');
    $("#verify_num1").focus();
    return false;
  }
  if(global_random != $('#verify_num1').val()){
    $('#email_check').text("인증번호를 다시 확인해주세요.");
    $('#email_check').css('color', 'red');
    $("#verify_num1").focus();
    return false;
  }

  else{
    alert('이동합니다.');
    return true;
  }
}
// find id [[sms]] onsubmit -- customer/seller
function check_smsform(){
  check;
  global_random;
  var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var phoneJ = /^[0-9]+$/;

  //--------------------이름
  if($('#name2').val() == ""){
    $('#name_check2').text("필수 정보입니다.");
    $('#name_check2').css('color', 'red');
    $("#name2").focus();
    return false;
  }
  // 공백X 특수기호, 스페이스바 사용
  if(markJ.test($('#name2').val())){
    $('#name_check2').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
    $('#name_check2').css('color', 'red');
    $("#name2").focus();
    return false;
  }
  //-------------------휴대폰번호
  if($('#input_tel2').val() == ""){
    $('#phonenum_check').text("필수 정보입니다.");
    $('#phonenum_check').css('color', 'red');
    $("#input_tel2").focus();
    return false;
  }
  if($('#input_tel3').val() == ""){
    $('#phonenum_check').text("필수 정보입니다.");
    $('#phonenum_check').css('color', 'red');
    $("#input_tel3").focus();
    return false;
  }

  if(!phoneJ.test($('#input_tel2').val())){
    $('#phonenum_check').text("알맞는 유형이 아닙니다.");
    $('#phonenum_check').css('color', 'red');
    $("#input_tel2").focus();
    return false;
  }
  if(!phoneJ.test($('#input_tel3').val())){
    $('#phonenum_check').text("알맞는 유형이 아닙니다.");
    $('#phonenum_check').css('color', 'red');
    $("#input_tel3").focus();
    return false;
  }
  //-------------------이메일 인증
  //인증 칸 공백
  if($('#verify_num2').val() == ""){
    $('#phonenum_check').text("인증이 필요합니다.");
    $('#phonenum_check').css('color', 'red');
    $("#verify_num2").focus();
    return false;
  }
  if(global_random != $('#verify_num2').val()){
    $('#phonenum_check').text("인증번호를 다시 확인해주세요.");
    $('#phonenum_check').css('color', 'red');
    $("#verify_num2").focus();
    return false;
  }
  else{
    alert('이동합니다.');
    return true;
  }
}


//********find_pw_way sms 인증 button / customer ************
function verify_email_way_s(){
  var input_name = $('#name2').val();
  var hidden_tel =$('#hidden_tel').val();

  var input_tel1 =$('#input_tel1').val();
  var input_tel2 =$('#input_tel2').val();
  var input_tel3 =$('#input_tel3').val();

  var phoneJ = /^[0-9]+$/;

  var input_tel = input_tel1+'-'+input_tel2+'-'+input_tel3;


  //1. 공백 X
  if(!(input_tel2 == "") && !(input_tel3 == "")){
    //2. 정규식 O
    if(phoneJ.test(input_tel2)&&phoneJ.test(input_tel3)){
      if(input_name != ""){

        //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
        $.ajax({

          type: 'post',
          url: 'customer_sms_query',
          async:false,
          dataType: 'json',
          data:{
            "input_name" : input_name,
            "input_tel" : input_tel
          },

          success : function(data) {
            check=data;
            console.log(data);
            console.log(hidden_tel);
            console.log(input_tel);
            if(data>0 && hidden_tel==input_tel){

              //존재할 경우 email로 인증번호 발송
              $.ajax({

                type: 'post',
                url: 'sms',
                async:false,
                dataType: 'json',
                data: { "tel": input_tel },

                success : function(randomNum) {
                  $('#phonenum_check').text("인증번호가 전송되었습니다.");
                  $('#phonenum_check').css('color', 'green');
                  $('#name2').attr('readonly', true);
                  $('#input_tel1').attr('readonly', true);
                  $('#input_tel2').attr('readonly', true);
                  $('#input_tel3').attr('readonly', true);
                  $('#verify_num2').attr('disabled', false);
                  global_random = randomNum;
                  console.log(randomNum);
                }//success
                ,error : function() { }
              });
            }


            if(data<1){
              $('#verify_num').attr('disabled', true);

              //존재하지 않을 경우 이메일 발송x
            }
          }//success
          ,error : function() { }
        });
      }

    }
    //3. 정규식 X
    else{
      $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
      $('#email_check').css('color', 'red');
      $("#s_email").focus();
    }
  } //공백조건식

  //2. 공백 O
  else{
    $('#email_check').text("필수 정보입니다.");
    $('#email_check').css('color', 'red');
    $("#s_email").focus();
  }
}

//********find_pw_way email 인증 button / customer ************
function verify_email_way_c(){
  var input_email = $('#input_email').val();

  var input_name =$('#name1').val();
  var input_email =$('#input_email').val();
  var hidden_email =$('#hidden_email').val();
  //정규식
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/

  //1. 공백 X
  if(!input_email == ""){
    //2. 정규식 O
    if(verifyJ.test(input_email)){
      if($('#name1').val() != "" && $('#input_email').val() != ""){

        //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
        $.ajax({

          type: 'post',
          url: 'customer_email_query',
          async:false,
          dataType: 'json',
          data:{
            "input_name" : input_name,
            "input_email" : input_email
          },

          success : function(data) {
            console.log(data);
            if(data>0 && hidden_email==input_email){

              //존재할 경우 email로 인증번호 발송
              $.ajax({

                type: 'post',
                url: 'mail',
                async:false,
                dataType: 'json',
                data: { "email": hidden_email },

                success : function(randomNum) {
                  $('#email_check').text("인증번호가 전송되었습니다.");
                  $('#email_check').css('color', 'green');
                  $('#input_email').attr('readonly', true);
                  $('#name1').attr('readonly', true);
                  $('#verify_num1').attr('disabled', false);
                  global_random = randomNum;
                  console.log(randomNum);
                }//success
                ,error : function() { }
              });
            }

            if(data<1){
              $('#verify_num1').attr('disabled', true);

              //존재하지 않을 경우 이메일 발송x
            }
          }//success
          ,error : function() { }
        });
      }

    }
    //3. 정규식 X
    else{
      $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
      $('#email_check').css('color', 'red');
      $("#input_email").focus();
    }
  } //공백조건식

  //2. 공백 O
  else{
    $('#email_check').text("필수 정보입니다.");
    $('#email_check').css('color', 'red');
    $("#input_email").focus();
  }
}

//********find_pw_way sms 인증 button / seller ************
function verify_sms_way_seller(){
  var input_name = $('#name2').val();
  var hidden_tel =$('#hidden_tel').val();

  var input_tel1 =$('#input_tel1').val();
  var input_tel2 =$('#input_tel2').val();
  var input_tel3 =$('#input_tel3').val();

  var phoneJ = /^[0-9]+$/;

  var input_tel = input_tel1+'-'+input_tel2+'-'+input_tel3;


  //1. 공백 X
  if(!(input_tel2 == "") && !(input_tel3 == "")){
    //2. 정규식 O
    if(phoneJ.test(input_tel2)&&phoneJ.test(input_tel3)){
      if(input_name != ""){

        //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
        $.ajax({

          type: 'post',
          url: 'seller_sms_query',
          async:false,
          dataType: 'json',
          data:{
            "input_name" : input_name,
            "input_tel" : input_tel
          },

          success : function(data) {
            check=data;
            console.log(data);
            console.log(hidden_tel);
            console.log(input_tel);
            if(data>0 && hidden_tel==input_tel){

              //존재할 경우 email로 인증번호 발송
              $.ajax({

                type: 'post',
                url: 'sms',
                async:false,
                dataType: 'json',
                data: { "tel": input_tel },

                success : function(randomNum) {
                  $('#phonenum_check').text("인증번호가 전송되었습니다.");
                  $('#phonenum_check').css('color', 'green');
                  $('#verify_num2').attr('disabled', false);
                  // $('#name2').attr('readonly', true);
                  // $('#input_tel1').attr('readonly', true);
                  // $('#input_tel2').attr('readonly', true);
                  // $('#input_tel3').attr('readonly', true);
                  global_random = randomNum;
                  console.log(randomNum);
                }//success
                ,error : function() { }
              });
            }


            if(data<1){
              $('#verify_num').attr('disabled', true);

              //존재하지 않을 경우 이메일 발송x
            }
          }//success
          ,error : function() { }
        });
      }

    }
    //3. 정규식 X
    else{
      $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
      $('#email_check').css('color', 'red');
      $("#s_email").focus();
    }
  } //공백조건식

  //2. 공백 O
  else{
    $('#email_check').text("필수 정보입니다.");
    $('#email_check').css('color', 'red');
    $("#s_email").focus();
  }
}

//********find_pw_way email 인증 button / seller ************
function verify_email_way_seller(){
  var input_name =$('#name1').val();
  var input_email =$('#input_email').val();
  var hidden_email =$('#hidden_email').val();
  //정규식
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/

  //1. 공백 X
  if(!input_email == ""){
    //2. 정규식 O
    if(verifyJ.test(input_email)){
      if($('#name1').val() != ""){

        //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
        $.ajax({

          type: 'post',
          url: 'seller_email_query',
          async:false,
          dataType: 'json',
          data:{
            "input_name" : input_name,
            "input_email" : input_email
          },

          success : function(data) {
            console.log(data);
            if(data>0 && hidden_email==input_email){

              //존재할 경우 email로 인증번호 발송
              $.ajax({

                type: 'post',
                url: 'mail',
                async:false,
                dataType: 'json',
                data: { "email": hidden_email },

                success : function(randomNum) {
                  global_random = randomNum;
                  $('#email_check').text("인증번호가 전송되었습니다.");
                  $('#email_check').css('color', 'green');
                  $('#verify_num1').attr('disabled', false);
                  // $('#input_email').attr('readonly', true);
                  // $('#name1').attr('readonly', true);
                  console.log(randomNum);
                }//success
                ,error : function() { }
              });
            }

            if(data<1){
              $('#verify_num1').attr('disabled', true);

              //존재하지 않을 경우 이메일 발송x
            }
          }//success
          ,error : function() { }
        });
      }

    }
    //3. 정규식 X
    else{
      $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
      $('#email_check').css('color', 'red');
      $("#input_email").focus();
    }
  } //공백조건식

  //2. 공백 O
  else{
    $('#email_check').text("필수 정보입니다.");
    $('#email_check').css('color', 'red');
    $("#input_email").focus();
  }
}

//find_pw_way onsubmit
function check_pw_way_seller(){
  check;
  global_random;
  var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/

  //--------------------이름
  if($('#name').val() == ""){
    $('#name_check').text("필수 정보입니다.");
    $('#name_check').css('color', 'red');
    $("#name").focus();
    return false;
  }
  // 공백X 특수기호, 스페이스바 사용
  if(markJ.test($('#name').val())){
    $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
    $('#name_check').css('color', 'red');
    $("#name").focus();
  }
  //-------------------이메일
  if($('#s_email').val() == ""){
    $('#email_check').text("필수 정보입니다.");
    $('#email_check').css('color', 'red');
    $("#s_email").focus();
    return false;
  }

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
  if(global_random != $('#verify_num').val()){
    $('#email_check').text("인증번호를 다시 확인해주세요.");
    $('#email_check').css('color', 'red');
    $("#verify_num").focus();
    return false;
  }

  else{
    alert('이동합니다.');
    return true;
  }
}

//find_pw_reset onsubmit
function check_find_reset(){
  var pwJ = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;
  //-------------------PW 예외처리
  //2. 공백
  if($("#new_pw").val()==''){
    $('#pw_re').text('비밀번호를 입력해주세요.');
    $('#pw_re').css('color', 'red');
    $("#new_pw").focus();
    return false;
  }
  //3. 정규식 일치 X
  if(!pwJ.test($("#new_pw").val())){
    $('#pw_re').text('8~16자리의 영문 대소문자, 숫자와 특수기호만 사용가능합니다. ');
    $('#pw_re').css('color', 'red');
    $("#new_pw").focus();
    return false;
  }
  //-------------------PW 확인 예외처리
  //1. 공백이 아닐 경우
  if($("#new_pw").val() != "" || $("#check").val() != "")
  {
    if($("#new_pw").val() != $("#check").val()){
      $('#pw_re_ck').text('비밀번호가 일치하지 않습니다.');
      $('#pw_re_ck').css('color', 'red');
      $("#check").focus();
      return false;
    }
  }
  //2. 공백일 경우
  if($("#new_pw").val() == "" || $("#check").val() == ""){
    $('#pw_re_ck').text('필수 정보입니다.');
    $('#pw_re_ck').css('color', 'red');
    $("#check").focus();
    return false;
  }
  else{
    return true;
  }
}
