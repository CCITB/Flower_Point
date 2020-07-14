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
          @if(count($coupon2)>0)
            <form class="" action="/givecoupon" method="post">
              @csrf
              <tr>
                <th>{{$coupon->cp_title}}</th>
                <th>{{$coupon->cp_minimum}}</th>
                <th>{{$coupon->cp_flatrate}}</th>
                <th>{{$coupon->start_date}}</th>
                <th>{{$coupon->end_date}}</th>
                <th><button type="submit" id="cpbutton{{$coupon->cp_no}}" name="cpbutton{{$coupon->cp_no}}"  disabled>쿠폰받기</button></th>
              </tr>
            </form>
          @else

              <tr>
                <th>{{$coupon->cp_no}}</th>
                <th>{{$coupon->cp_title}}</th>
                <th>{{$coupon->cp_minimum}}</th>
                <th>{{$coupon->cp_flatrate}}</th>
                <th>{{$coupon->start_date}}</th>
                <th>{{$coupon->end_date}}</th>
                <th><input type="button" class="cpbutton" name="cpbutton{{$coupon->cp_no}}" value="쿠폰받기"></></th>
              </tr>

          @endif
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

  var str = ""
  var tdArr = new Array();    // 배열 선언
  var checkBtn = $(this);
  var tr = checkBtn.parent().parent();
  var td = tr.children();
  var number = td.eq(0).text();
  var couponname = td.eq(1).text();
  var couponminimum = td.eq(2).text();
  var coupondis = td.eq(3).text();
  var couponstart = td.eq(4).text();
  var couponend = td.eq(5).text();
  $.ajax({
    type: 'post',
    url: '/givecoupon',
    dataType: 'json',
    data: { "number" : number,
            "couponname" : couponname,
            "couponminimum" : couponminimum,
            "coupondis"  : coupondis,
            "couponstart" : couponstart,
            "couponend" : couponend,
   },
    success: function(data) {
      console.log(data);
      alert('발급받았습니다.');
      // document.getElementById('pm_status').innerHTML="data";
    },
    error: function() {
    }
  });

});

</script>
