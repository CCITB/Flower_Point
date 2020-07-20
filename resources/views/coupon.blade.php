<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<link rel="stylesheet" href="/css/header.css">
<link rel="stylesheet" href="/css/coupon.css">

<body>
  @include('lib.header')
  <div class="couponwrap">
    <div class="czone">
      <div class="mytitle">쿠폰</div>
      <span style="font-size:1.3em;" class="coinfo">고객님께서 보유하고있는 할인쿠폰을 확인하세요! 상품구매시 더욱 저렴하게 구매할 수 있습니다.<span>
        <div class="supplement_coupon">
          <img id="couponimg"src="imglib/coupon.png" alt="" width="400px">
          <div class="supplement_cnts">
            <div class="hi">
              <div style="font-size:1.3em; margin-bottom:30px; text-align:center;"><span class="bg_bul">나의 보유쿠폰</span></div>
              <div style="color: #4374D9; font-size:1.2em; padding-left:15px; text-align:center;"><strong><span>{{$coupon2}} 장</span></strong></div>
            </div>
            <div class="hi1" style="padding-top:25px;">
              <button type="button" class="co_bt" name="button"><a class="coupon_text" href="/recievecoupon">쿠폰존 바로가기</a></button>
            </div>
          </div>
        </div>
      </div>
      <div class="coupon_list">
        <div class="mytitle">나의 할인쿠폰 목록</div>
        <table class="type09">
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
                <th>{{$coupon->start_date}} ~ {{$coupon->end_date}}</th>
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

    @include('lib.footer')
  </body>
  </html>
