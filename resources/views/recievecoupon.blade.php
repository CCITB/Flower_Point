<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
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
          <th>쿠폰명</th>
          <th>쿠폰내용</th>
          <th>유효기간</th>
          <th></th>
        </tr>
        @foreach ($coupon as $coupon)
        @if(count($coupon2)>0)
            <form class="" action="/givecoupon" method="post">
              @csrf
              <tr>
                <th>{{$coupon->cp_title}}</th>
                <th>{{$coupon->cp_minimum}}원이상 구매시{{$coupon->cp_flatrate}}원 할인</th>
                <th>{{$coupon->start_date}}~{{$coupon->end_date}}</th>
                <th><button type="submit" id="cpbutton{{$coupon->cp_no}}" name="cpbutton{{$coupon->cp_no}}"  disabled>쿠폰받기</button></th>
              </tr>
            </form>
          @else
            <form class="" action="/givecoupon" method="post">
              @csrf
              <tr>
                <th>{{$coupon->cp_title}}</th>
                <th>{{$coupon->cp_minimum}}원이상 구매시{{$coupon->cp_flatrate}}원 할인</th>
                <th>{{$coupon->start_date}}~{{$coupon->end_date}}</th>
                <th><button type="submit" id="cpbutton{{$coupon->cp_no}}" name="button">쿠폰받기</button></th>
              </tr>
            </form>

        @endif
      @endforeach
        </table>
      </div>

    </div>
  </div>
  @include('lib.footer')
</body>
</html>
