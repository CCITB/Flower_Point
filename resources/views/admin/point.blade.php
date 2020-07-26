<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>꽃갈피 관리자</title>
  <link rel="stylesheet" href="/css/ad_coupon.css">
</head>
<body>
  <div class="total_point">
    @foreach ($customer as $cus)
      <div class="cusinfo">
        <strong>{{$cus->c_name}}</strong> 고객님의 포인트 총 보유액: <strong style="color: #4374D9;">{{number_format($cus->c_point)}}</strong> P
      </div>
      <div class="pointinput">
        <form action="ad_points" method="post">
          @csrf
          <input type="hidden" name="c_no" value="{{$cus->c_no}}">
          <input type="hidden" name="c_point" value="{{$cus->c_point}}">
          <input class="p_input" name="p_input" numberonly="true" onkeyup="removeChar(event)" onkeydown="return onlyNumber(event)"> P
          <button type="submit" class="ad_bt" style="font-size:0.8em; letter-spacing: 1px; padding:7px 20px; ">적립하기</button>
        </form>
      </div>
    @endforeach
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
  <script type="text/javascript">
  
  $(document).on("keyup", "input:text[numberonly]", function() {
    $(this).val( $(this).val().replace(/[^0-9]/gi,"") );
    var regexp = /\B(?=(\d{3})+(?!\d))/g;
    $(this).val( $(this).val().toString().replace(regexp, ',') );
  });

  function removeChar(event) {
    event = event || window.event;
    var keyID = (event.which) ? event.which : event.keyCode;
    if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
    return;
    else
    event.target.value = event.target.value.replace(/[^0-9]/g, "");
  }

  function onlyNumber(event){
    event = event || window.event;
    var keyID = (event.which) ? event.which : event.keyCode;
    if ( (keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 ){
      return;
    }

    else{
      return false;
    }
  }
  </script>
</body>
</html>
