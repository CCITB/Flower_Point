<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title></title>
  <link rel="stylesheet" href="/css/coupon.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
      @else
        <div class="" style="top:180px; position:absolute; left:300px; ">
          보유한 쿠폰이 없습니다.
        </div>
      @endif
    </table>
  </div>
</body>
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
function apply(e){
  console.log(e);
  // return false;
  $.ajax({
    url:'/couponapply', //request 보낼 서버의 경로
    type:'post', // 메소드(get, post, put 등)
    data:{'id':e}, //보낼 데이터
    success: function(data) {
      console.log(data);
      alert('적용되었습니다!');
      return false;
        //서버로부터 정상적으로 응답이 왔을 때 실행
    },
    error: function(data) {
      console.log(data);
        //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
    }
});
  return false;
  self.close();
}
</script>
</html>
