<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<link rel="stylesheet" href="/css/header.css">
{{-- <link rel="stylesheet" href="/css/bootstrap.css"> --}}
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
    <h4>쿠폰</h4>
    고객님께서 보유하고있는 할인쿠폰을 확인하세요! 상품구매시 더욱 저렴하게 구매할 수 있습니다.
    <button type="button" name="button"><a href="/recievecoupon">쿠폰존 바로가기</a></button>
    <div class="supplement_coupon">
      <img id="couponimg"src="imglib/coupon.png" alt="" width="400px">
      <div class="supplement_cnts">
        <p><span class="blindtext"></span></p>
        <dl>
          <dt><span class="bg_bul"></span>나의 보유쿠폰</dt>
          <dd><strong></strong><span>{{$coupon2}}장</span></dd>
        </dl>
      </div>
    </div>
    <div class="coupon_list">
      <table class="table table-striped">
        <tr>
          나의 할인쿠폰 목록
        </tr>
        <tr>
          <th>쿠폰명</th>
          <th>쿠폰내용</th>
          <th>유효기간</th>
        </tr>
        @if(isset($coupon2))
        @foreach ($coupon as $coupon)
          <tr>
            <th>{{$coupon->cp_title}}</th>
            <th>{{$coupon->cp_minimum}}원이상 구매시 {{$coupon->cp_flatrate}}원 할인</th>
            <th>{{$coupon->start_date}}~{{$coupon->end_date}}</th>
          </tr>
        @endforeach
      @else
        <div class="" style="top:180px; position:absolute; left:300px; ">
          보유한 쿠폰이 없습니다.
        </div>
      @endif
      </table>
    </div>
  </div>

</div>
@include('lib.footer')
</body>
</html>
