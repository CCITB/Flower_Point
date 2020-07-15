<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <title></title>
</head>
<link rel="stylesheet" href="/css/header.css">
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/coupon.css">

<body>
  <style media="screen">
  footer{
    position:relative;
    left:0px;
    bottom:0px;
    width:100%;
    margin-top: 50px;
  }
  </style>
  @include('lib.header')
  <div class="couponwrap">
    <h4>이달의 쿠폰</h4>


    <div class="coupon_back">
      <table class="table table-striped">
        <tr>
          <th>쿠폰번호</th>
          <th>쿠폰명</th>
          <th>최소주문금액</th>
          <th>할인금액</th>
          <th>시작날짜</th>
          <th>종료날짜</th>
          <th></th>
        </tr>
        @foreach ($coupon as $coupon)
              <tr>
                <th>{{$coupon->cp_no}}</th>
                <th>{{$coupon->cp_title}}</th>
                <th>{{$coupon->cp_minimum}}</th>
                <th>{{$coupon->cp_flatrate}}</th>
                <th>{{$coupon->start_date}}</th>
                <th>{{$coupon->end_date}}</th>
                <th><input type="button" class="cpbutton" name="cpbutton{{$coupon->cp_no}}" value="쿠폰받기"></></th>
              </tr>
        @endforeach
      </table>
    </div>

  </div>
</div>
@include('lib.footer')
</body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.cpbutton').click(function(){
  // $(this);
  var str = ""
  var tdArr = new Array();    // 배열 선언
  var checkBtn = $(this);
  var tr = checkBtn.parent().parent();
  var td = tr.children();
  var number = td.eq(0).text();
  $.ajax({
    type: 'post',
    url: '/givecoupon',
    dataType: 'json',
    data: { "number" : number,
   },
    success: function(data) {
      console.log(data);
      if(data==1){
      alert('발급받았습니다.');
    }
    else if(data==0){
      alert('이미 발급받은 쿠폰입니다.');
    }
  },
    error: function() {
      // console.log('1');
    }
  });
});

</script>
