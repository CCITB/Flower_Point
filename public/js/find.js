var global_random;
var check;
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){
  $("#name").blur(function() {
    check_name();
  });

  $("#btn_email").click(function() {
    verify_email();
  });

  $("#btn_email_way").click(function() {
    verify_email_way();
  });
  // $("#id_bt").click(function() {
  //   verify_check();
  // });

  //********************이름*****************
  function check_name(){
    //input data
    var seller_name = $('#name').val();
    //정규식
    var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

    //1. 공백 -- 빈칸
    if(seller_name == ""){
      $('#name_check').text("필수 정보입니다.");
      $('#name_check').css('color', 'red');
      $("#name").focus();
    }
    //2. 공백X 특수기호, 스페이스바 사용
    else if(!markJ.test(seller_name)){
      $("#name_check").text("");
    }
    //3. 공백X
    else{
      $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
      $('#name_check').css('color', 'red');
      $("#name").focus();
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
        if($('#name').val() != "" && $('#s_email').val() != ""){
          input_name =$('#name').val();
          input_email =$('#s_email').val();

          $('#email_check').text("인증번호가 전송되었습니다.");
          $('#email_check').css('color', 'green');

          //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
          $.ajax({

            type: 'post',
            url: 'check_query',
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
                $('#verify_num').attr('disabled', false);

                //존재할 경우 email로 인증번호 발송
                $.ajax({

                  type: 'post',
                  url: 'mail',
                  async:false,
                  dataType: 'json',
                  data: { "email": seller_val },

                  success : function(randomNum) {
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
});

function checkfunction(){
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

//********find_pw_way onsubmit button************
function verify_email_way(){
  //  var email = document.getElementById("s_email");
  var seller_val = $('#s_email').val();
  //정규식
  var verifyJ= /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/

  //1. 공백 X
  if(!seller_val == ""){
    //2. 정규식 O
    if(verifyJ.test(seller_val)){
      if($('#name').val() != "" && $('#s_email').val() != ""){
        input_name =$('#name').val();
        input_email =$('#s_email').val();
        input_hidden =$('#hidden').val();

        $('#email_check').text("인증번호가 전송되었습니다.");
        $('#email_check').css('color', 'green');

        //입력한 database table상에 name과 email이 동일한값이 존재하는자 검사
        $.ajax({

          type: 'post',
          url: 'check_query',
          async:false,
          dataType: 'json',
          data:{
            "input_name" : input_name,
            "input_email" : input_email
          },

          success : function(data) {
            check=data;
            console.log(data);
            if(data>0&&input_hidden==input_email){
              $('#verify_num').attr('disabled', false);

              //존재할 경우 email로 인증번호 발송
              $.ajax({

                type: 'post',
                url: 'mail',
                async:false,
                dataType: 'json',
                data: { "email": seller_val },

                success : function(randomNum) {
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

function check_pw_way(){
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
