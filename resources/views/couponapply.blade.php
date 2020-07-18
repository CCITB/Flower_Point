
<link rel="stylesheet" href="/css/coupon.css">
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<div class="coupon_list">
  <table class="table table-striped" style="margin:0 auto;">
    <tr>
      나의 할인쿠폰 목록
    </tr>
    <tr>
      <th>쿠폰명</th>
      <th>쿠폰내용</th>
      <th>유효기간</th>
      <th></th>
    </tr>
    @if(isset($coupon))
      @foreach ($coupon as $coupon)
        <tr>
          <th>{{$coupon->cp_title}}</th>
          <th>{{$coupon->cp_minimum}}원이상 구매시 {{$coupon->cp_flatrate}}원 할인</th>
          <th>{{$coupon->start_date}}~{{$coupon->end_date}}</th>
          <th><button type="button" onclick="apply({{$coupon->cpb_no}});" name="button">쿠폰적용</button></th>
        </tr>
      @endforeach
    </table>
  @else
  </table>
  <div class="" style="">
    보유한 쿠폰이 없습니다.
  </div>
@endif
<div class="coupon_cancel" style="cursor:pointer;">
  사용취소
</div>
</div>
<div class="btn-r">
  <a class="btn-layerClose">Close</a>
</div>
