<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <?php
  // 변수에 함수를 통해 생성된 난수를 저장함
  $randomNum = mt_rand(1000, 10000);
  ?>
  <!-- 이메일 인증코드는 {{{$randomNum}}}  입니다. -->
  <h1>꽃갈피</h1>
  <hr>
  이메일 인증코드는 {{$randomNum}}입니다.
</body>
</html>

<script type="text/javascript">
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
</script>
