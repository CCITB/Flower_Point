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

  // $("#registeration_num1").blur(function() {
  //   // input
  //   var registeration_num1 = $('registeration_num1').val();
  //   var registeration_num2 = $('registeration_num2').val();
  //   var registeration_num3 = $('registeration_num3').val();
  //   //숫자 정규식
  //   var numJ = /^[0-9]*$/;
  //   //예외처리 -- 공백
  //   if(registeration_num1==''){
  //     $('#stnum_check').text("필수항목 입니다.");
  //     $('#stnum_check').css('color', 'red');
  //   }
  //   //공백X
  //   else{
  //     if(numJ.test(registeration_num1)){
  //       $('#stnum_check').text("");
  //     }
  //     else {
  //       $('#stnum_check').text("숫자만 입력해주세요.");
  //       $('#stnum_check').css('color', 'red');
  //     }
  //   }
  // });//blur

  $("#registeration_num").on('keyup', function() {
    var num = $('#registeration_num').val();
            num.trim();  // 스페이스바 제거
            this.value = AutoHypen(num) ;
  });

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

  //전화번호
  $("#st_tel").blur(function() {
    //input data
    var st_tel = $("#st_tel").val();

    var numJ = /^[0-9]*$/;
    //예외처리 -- 공백
    if(st_tel==''){
      $('#staddress_num').text('필수 정보입니다.');
      $('#staddress_num').css('color', 'red');
    }
    else if(!numJ.test(st_tel)){
      $('#staddress_num').text('숫자만 입력해주세요.');
      $('#staddress_num').css('color', 'red');
    }
    else{
      $('#staddress_num').text('');
      $('#staddress_num').css('color', 'red');
    }
  });//blur
});

function AutoHypen(companyNum){
      companyNum = companyNum.replace(/[^0-9]/g, '');
      var tempNum = '';

      if(companyNum.length < 4){
        return companyNum;
      }
      else if(companyNum.length < 6){
        tempNum += companyNum.substr(0,3);
        tempNum += '-';
        tempNum += companyNum.substr(3,2);
        return tempNum;
      }
      else if(companyNum.length < 11){
        tempNum += companyNum.substr(0,3);
        tempNum += '-';
        tempNum += companyNum.substr(3,2);
        tempNum += '-';
        tempNum += companyNum.substr(5);
        return tempNum;
      }
      else{
        tempNum += companyNum.substr(0,3);
        tempNum += '-';
        tempNum += companyNum.substr(3,2);
        tempNum += '-';
        tempNum += companyNum.substr(5);
        return tempNum;
      }
    }
//******************onsubmit -- 어지수
function checkIt(){
  var numJ = /^[0-9]*$/;

  //--------------------매장 이름
  if($('#st_name').val() == ""){
    $('#stname_check').text("필수 정보입니다.");
    $('#stname_check').css('color', 'red');
    $("#st_name").focus();
    return false;
  }
  //--------------------사업자 등록 번호
  if($('#registeration_num').val() == ""){
    $('#stname_check').text("필수 정보입니다.");
    $('#stname_check').css('color', 'red');
    $("#registeration_num").focus();
    return false;
  }


  //--------------------매장 주소
  if($('#postcode').val() == ""){
    $('#staddress_check').text("우편번호가 비어있습니다.");
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

  if($('#extraAddress').val() == ""){
    $('#staddress_check').text("필수 정보입니다.");
    $('#staddress_check').css('color', 'red');
    $("#extraAddress").focus();
    return false;
  }

  //--------------------매장 전화번호
  if($('#st_tel').val() == ""){
    $('#staddress_num').text("필수 정보입니다.");
    $('#staddress_num').css('color', 'red');
    $("#st_tel").focus();
    return false;
  }
  if(!numJ.test($('#st_tel').val())){
    $('#staddress_num').text("숫자만 입력해주세요.");
    $('#staddress_num').css('color', 'red');
    $("#st_tel").focus();
    return false;
  }

  else{
    return true;
  }
}
