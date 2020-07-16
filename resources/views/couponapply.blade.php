<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/coupon.css">
  </head>
  <body>
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
        @if(isset($coupon))
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
  </body>
</html>
