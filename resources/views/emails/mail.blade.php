<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
</head>

<!--어지수-->
<!--인증 메일 내용-->
<body>
  <h1>꽃갈피</h1>
  <hr>
  이메일 인증코드는 <h2>{{$order}}</h2> 입니다.
</body>
</html>

{{-- <script type="text/javascript">
// jQuery -- 어지수
var randomNum = $randomNum.value();

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$.ajax({

  type: 'post',
  url: '',
  dataType: 'json',
  data: { "random": randomNum },

  success : function(data) {
    console.log(data);

  }

}//success
,error : function() {   console.log("실패");  }
}) //ajax
</script> --}}
