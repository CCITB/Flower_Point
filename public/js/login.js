$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$.ajax({

  type: 'post',
  url: 'check_login',
  async:false,
  dataType: 'json',
  data:{
    "input_id" : login_id,
    "input_pw" : login_pw
  },

  success : function(data) {
    console.log(data);
    if(data<0){
      $('#login_check').text("알맞는 이메일 유형이 아닙니다.");
      $('#login_check').css('color', 'red');
      $("#login_id").focus();

    }


  }//success
  ,error : function() { }
});
