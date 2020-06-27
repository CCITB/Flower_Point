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

  $("#c_tel2").blur(function() {
    check_phonenum();
  });

  $("#c_birth_y").blur(function() {
    checkBirthInput();
  });//blur
  $("#c_birth_m").change(function() {
    checkBirthInput();
  });//blur
  $("#c_birth_d").blur(function() {
    checkBirthInput();
  });

  $("#postcode").blur(function(){
    var postJ= /^[0-9]+$/;
    //input data
    var postcode = $("#postcode").val();
    //예외처리 -- 공백
    if(postcode==''){
      $('#staddress_check').text('필수 정보입니다.');
      $('#staddress_check').css('color', 'red');
    }
    else if(postJ.test(postcode)){
      $('#staddress_check').text('');
    }
    else{
      $('#staddress_check').text('올바른 우편번호 형식이 아닙니다.');
      $('#staddress_check').css('color', 'red');
    }
  })
  // 주소
  $("#address").blur(function() {
    //input data
    var address = $("#address").val();
    //예외처리 -- 공백
    if(address==''){
      $('#staddress_check').text('필수 정보입니다.');
      $('#staddress_check').css('color', 'red');
    }
    else{
      $('#staddress_check').text('');
      $('#staddress_check').css('color', 'red');
    }
  });//blur

  $("#detailAddress").blur(function() {
    //input data
    var detailAddress = $("#detailAddress").val();
    //예외처리 -- 공백
    if(detailAddress==''){
      $('#staddress_check').text('필수 정보입니다.');
      $('#staddress_check').css('color', 'red');
    }
    else{
      $('#staddress_check').text('');
      $('#staddress_check').css('color', 'red');
    }
  });//blur

  $("#extraAddress").blur(function() {
    //input data
    var extraAddress = $("#extraAddress").val();
    //예외처리 -- 공백
    if(extraAddress==''){
      $('#staddress_check').text('필수 정보입니다.');
      $('#staddress_check').css('color', 'red');
    }
    else{
      $('#staddress_check').text('');
      $('#staddress_check').css('color', 'red');
    }
  });//blur

  //이메일 인증
  $("#c_email").blur(function() {
    verify_email();
  });
  // $("#btn_email").click(function() {
  //   verify_email();
  // });
  // //이메일 확인
  // $("#verify_num").blur(function() {
  //   email_check();
  // });//blur

  //휴대폰 인증

  $("#btn_phone").click(function() {
    verify_phone();
  });

  $("#verify_p_num").blur(function() {
    phone_check();
  });//blur

  //*************************************check******************************************
  function check_id(){
    //seller register의 id input
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
        url: 'seller_Overlap',
        dataType: 'json',
        data: { "id": customer_val },

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
    var customer_name = $('#name').val();
    //정규식
    var markJ = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;

    //1. 공백 -- 빈칸
    if(customer_name == ""){
      $('#name_check').text("필수 정보입니다.");
      $('#name_check').css('color', 'red');

    }
    //2.
    else if(!markJ.test(customer_name)){
      $("#name_check").text("");
    }
    //2. 공백X 특수기호, 스페이스바 사용
    else{
      $('#name_check').text("한글과 영문 대 소문자를 사용하세요.(특수기호, 공백 사용불가)");
      $('#name_check').css('color', 'red');
    }
  }

  function check_phonenum(){
    //seller register의 id input
    var c_phonenum_val1 = $('#c_tel1').val();
    var c_phonenum_val2 = $('#c_tel2').val();
    var c_phonenum_val3 = $('#c_tel3').val();
    var phone= /^[0-9]+$/;

    //1. 공백
    if((c_phonenum_val1=="")||(c_phonenum_val2=="")||(c_phonenum_val3=="")){
      $("#phonenum_check").text("필수 정보입니다.");
      $('#phonenum_check').css('color', 'red');
    }
    //2. 공백x 정규식o
    else if(phone.test(c_phonenum_val1)||phone.test(c_phonenum_val2)||phone.test(c_phonenum_val3)){
      $("#phonenum_check").text("");
      $('#phonenum_check').css('color', 'red');
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
    var c_birth_y = $('#c_birth_y').val();
    var c_birth_m = $('#c_birth_m').val();
    var c_birth_d = $('#c_birth_d').val();
    //정규식
    var birthJ =  /^[0-9]+$/;

    var today = new Date();
    var yyyy = today.getFullYear();
    var mm = today.getMonth()+1;
    var dd = today.getDate();

    if((mm+"").length < 2){
      var today = yyyy+'0'+mm+''+dd;
      date = parseInt(today);
    }
    else{
      var today = yyyy+''+mm+''+dd;
      date = parseInt(today);
    }

    //input data --- day
    if(c_birth_d.length!=0&&c_birth_d.length < 2){
      var c_birth = c_birth_y+c_birth_m+'0'+c_birth_d;
      input_birth = parseInt(c_birth);
    }
    else{
      var c_birth = c_birth_y+c_birth_m+c_birth_d;
      input_birth = parseInt(c_birth);
    }

    console.log(typeof date, typeof input_birth);
    console.log(date, input_birth);

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
        //3. 일 - 공백 O
        if(c_birth_d==""){
          $("#birth_check").text('태어난 일(날짜) 2자리를 정확하게 입력하세요.');
          $('#birth_check').css('color', 'red');
        }
        //3. 일 -공백 x
        else{
          if(c_birth_d>31){
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

  //*****************전화인증*******************
  function verify_phone(){
    //  var email = document.getElementById("s_email");
    var customer_val1 = $('#c_tel1').val();
    var customer_val2 = $('#c_tel2').val();
    var customer_val3 = $('#c_tel3').val();

    var customer_tel = customer_val1+'-'+customer_val2+'-'+customer_val3;

    //정규식
    var phone= /^[0-9]+$/;

    //1. 공백 X
    if(customer_val1 != "" && customer_val2 != "" && customer_val3 != ""){
      //2. 정규식 O
      if(phone.test(customer_val1)&&phone.test(customer_val2)&&phone.test(customer_val3)){

        $.ajax({

          type: 'post',
          url: 'sms',
          async:false,
          dataType: 'json',
          data: { "tel": customer_tel },

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
      console.log(global_random);
      console.log(verify);

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
  });
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
        $('#email_check').text("");
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
        //   data: { "email": customer_val },
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
  // //이메일 확인
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
    //-------------------핸드폰 인증
    if($('#c_tel1').val()=="" || $('#c_tel2').val()==""){
      $("#phonenum_check").text("필수 정보입니다.");
      $('#phonenum_check').css('color', 'red');
      $("#c_tel2").focus();
      return false;
    }
    if($('#c_tel3').val()==""){
      $("#phonenum_check").text("필수 정보입니다.");
      $('#phonenum_check').css('color', 'red');
      $("#c_tel3").focus();
      return false;
    }
    if(!num.test($('#c_tel1').val())||!num.test($('#c_tel2').val())){
      $('#phonenum_check').text('형식에 맞지 않는 번호입니다.');
      $('#phonenum_check').css('color', 'red');
      $("#c_tel2").focus();
      return false;
    }
    if(!num.test($('#c_tel3').val())){
      $('#phonenum_check').text('형식에 맞지 않는 번호입니다.');
      $('#phonenum_check').css('color', 'red');
      $("#c_tel3").focus();
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
    //-------------------생년월일(필수는 data는 아니지만 잘못된 값 넣는 것을 방지)
    if(!num.test($('#c_birth_y').val())){
      $("#birth_check").text(' 태어난 년도 4자리를 정확하게 입력하세요.');
      $('#birth_check').css('color', 'red');
      $("#c_birth_y").focus();
      return false;
    }
    if($('#c_birth_m').val()==""){
      $("#birth_check").text('태어난 월을 선택하세요.');
      $('#birth_check').css('color', 'red');
      $("#c_birth_m").focus();
      return false;
    }
    if($('#c_birth_d').val()==""){
      $("#birth_check").text('태어난 일(날짜) 2자리를 정확하게 입력하세요.');
      $('#birth_check').css('color', 'red');
      $("#c_birth_d").focus();
      return false;
    }
    if(!num.test($('#c_birth_d').val())){
      $("#birth_check").text('생년월일을 다시 확인해주세요.');
      $('#birth_check').css('color', 'red');
      $("#c_birth_d").focus();
      return false;
    }
    if($('#c_birth_d').val()>31){
      $("#birth_check").text('생년월일을 다시 확인해주세요.');
      $('#birth_check').css('color', 'red');
      $("#c_birth_d").focus();
      return false;
    }
    if(date<input_birth){
      $("#birth_check").text('미래에서 오셨나요?');
      $('#birth_check').css('color', 'red');
      $("#c_birth_y").focus();
      return false;
    }
    //------------------주소
    if($('#postcode').val() == ""){
      $('#staddress_check').text("필수 정보입니다.");
      $('#staddress_check').css('color', 'red');
      $("#postcode").focus();
      return false;
    }
    if(!num.test($('#postcode').val())){
      $('#staddress_check').text("알맞지 않은 우편번호 입니다.");
      $('#staddress_check').css('color', 'red');
      $("#postcode").focus();
      return false;
    }
    if($('#address').val() == ""){
      $('#staddress_check').text("필수 정보입니다.");
      $('#staddress_check').css('color', 'red');
      $("#address").focus();
      return false;
    }
    if($('#detailAddress').val() == ""){
      $('#staddress_check').text("필수 정보입니다.");
      $('#staddress_check').css('color', 'red');
      $("#detailAddress").focus();
      return false;
    }
    //-------------------이메일
    if($('#c_email').val()==""){
      $('#email_check').text("필수 정보입니다.");
      $('#email_check').css('color', 'red');
      $("#c_email").focus();
      return false;
    }
    //정규식 일치xx
    if(!verifyJ.test($('#c_email').val())){
      $('#email_check').text("알맞는 이메일 유형이 아닙니다.");
      $('#email_check').css('color', 'red');
      $("#c_email").focus();
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
