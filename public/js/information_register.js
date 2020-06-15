$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){

  $("#st_name").blur(function() {
    //input data
    var st_name = $("#st_name").val();
    //예외처리 -- 공백
    if(st_name==''){
      $('#stname_check').text('필수 정보입니다.');
      $('#stname_check').css('color', 'red');
    }
    else{
      $('#stname_check').text('');
      $('#stname_check').css('color', 'red');
    }
  });//blur

  $("#registeration_num1").blur(function() {
    // input
    var registeration_num1 = $('registeration_num1').val();
    var registeration_num2 = $('registeration_num2').val();
    var registeration_num3 = $('registeration_num3').val();
    //숫자 정규식
    var numJ = /^[0-9]*$/;
    //예외처리 -- 공백
    if(registeration_num1==''){
      $('#stnum_check').text("필수항목 입니다.");
      $('#stnum_check').css('color', 'red');
    }
    //공백X
    else{
      if(numJ.test(registeration_num1)){
        $('#stnum_check').text("");
      }
      else {
        $('#stnum_check').text("숫자만 입력해주세요.");
        $('#stnum_check').css('color', 'red');
      }
    }
  });//blur

  $("#st_address").blur(function() {
    //input data
    var st_address = $("#st_address").val();
    //예외처리 -- 공백
    if(st_address==''){
      $('#staddress_check').text('필수 정보입니다.');
      $('#staddress_check').css('color', 'red');
    }
    else{
      $('#staddress_check').text('');
      $('#staddress_check').css('color', 'red');
    }
  });//blur

  $("#st_tel").blur(function() {
    //input data
    var st_tel = $("#st_tel").val();
    //예외처리 -- 공백
    if(st_tel==''){
      $('#staddress_num').text('필수 정보입니다.');
      $('#staddress_num').css('color', 'red');
    }
    else{
      $('#staddress_num').text('');
      $('#staddress_num').css('color', 'red');
    }
  });//blur
});
//onsubmit -- 어지수
function validatate(){
  var st_name = document.getElementById("st_name");
  var registeration_num = document.getElementById("registeration_num");
  var st_address = document.getElementById("st_address");
  var st_tel = document.getElementById("st_tel");
  var st_introduce = document.getElementById("st_introduce");

  if((st_name.value)==""){
    alert('매장명을 입력해주세요.');
    return false;
  }
  if((registeration_num.value)==""){
    alert('사업자등록번호를 입력해주세요.');
    return false;
  }
  if((st_address.value)==""){
    alert('매장주소를 입력해주세요.');
    return false;
  }
  if((st_tel.value)==""){
    alert('고객센터 번호를 입력해주세요.');
    return false;
  }
  if((st_introduce.value)==""){
    alert('매장소개를 입력해주세요.');
    return false;
  }

  else {
    return true;
  }
}
