<!--jisuEO-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>꽃갈피-주문완료</title>
  <link rel="stylesheet" href="/css/payment2.css">
  <link rel="stylesheet" href="/css/header.css">
</head>
<body>
  <div class="topheader">
    <h1 class="titles"><a id="title" href="/">꽃갈피</a></h1>
  </div>
  <div class="wrapping2">
    <div class="text">
      <span class="title">주문/결제</span>
      <div class="page-sorting">
        <span>상품선택</span>
        <span>&gt;</span>
        <span>
          <i class="fas fa-credit-card fa-2x"></i>
          주문/결제</span>
          <span>&gt;</span>
          <span class="current-page">
            <i class="fas fa-gift fa-2x"></i>
            주문 완료</span>
          </div>
        </div>
        @if (isset($paymentID))
          @foreach ($paymentID as $paymentID)
            <div class="wrapping_complete">
              <br>
              <div class="order_result"><b>주문 정보</b>
                <hr class="dotted_line">
                <div class="order_data">
                  <p class="order_label">주문번호 : {{$orderNO}}</p>
                  <p class="order_label">상품명 : {{$paymentID->p_name}}</p>
                  <p class="order_label">결제금액 : {{$paymentID->pm_pay}}</p>
                </div>
              </div>
            </div> <!--wrapping_complete-->
          @endforeach
        @elseif (isset($paymentIDarray))
          {{-- @foreach ($paymentIDarray as $key => $value) --}}
          <div class="wrapping_complete">
            <div class="order_result"><b>결제 정보</b>
              <hr class="dotted_line">

              <div class="order_data">
                <p class="order_label">입금 은행 : bank</p>
                <p class="order_label">입금 계좌 : account number</p>
                <p class="order_label">예금주 : name</p>
              </div>
            </div>
            <br>
            <div class="order_result"><b>주문 정보</b>
              <hr class="dotted_line">
              <div class="order_data">
                <p class="order_label">주문번호 : {{$orderNO}}</p>
                <p class="order_label">상품명 :
                  @foreach ($paymentIDarray as $paymentIDarray)
                    <p>{{$paymentIDarray[0]->p_name}}</p>
                  @endforeach
                </p>
                <p class="order_label">결제금액 : {{$pricesum}}</p>
              </div>
            </div>
          </div> <!--wrapping_complete-->
          {{-- @endforeach --}}
        @else
          <div class="order_data">
            요청하신 페이지를 찾을 수 없습니다.
          </div>
        @endif
        <div class="" style="text-align:center; margin: 30px 0px;">
          <button type="button" onclick="location.href='/'" name="button" style="width:200px;height:50px;">메인으로</button>
          {{-- <a href="/">메인으로</a> --}}
        </div>
      </div>
      @include('lib.footer')
      <button type="button" onclick="alert(getCookie('paymentcookie'))" name="button">쿠키확인용</button>
    </body>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
    // $(document).ready(function(){
    //   console.log(document.cookie);
    //   console.log(setCookie('paymentcookie','','-1'));
    // });
    // function getCookie(cookie_name) {
    //   var x, y;
    //   var val = document.cookie.split(';');
    //
    //   for (var i = 0; i < val.length; i++) {
    //     x = val[i].substr(0, val[i].indexOf('='));
    //     y = val[i].substr(val[i].indexOf('=') + 1);
    //     x = x.replace(/^\s+|\s+$/g, ''); // 앞과 뒤의 공백 제거하기
    //     if (x == cookie_name) {
    //       return unescape(y); // unescape로 디코딩 후 값 리턴
    //     }
    //   }
    // }
    //
    // function setCookie(cookie_name, value, days) {
    //   var exdate = new Date();
    //   exdate.setDate(exdate.getDate() + days);
    //   // 설정 일수만큼 현재시간에 만료값으로 지정
    //
    //   var cookie_value = escape(value) + ((days == null) ? '' : ';    expires=' + exdate.toUTCString());
    //   document.cookie = cookie_name + '=' + cookie_value+';path=/';
    //   console.log(document.cookie);
    //   // $('input[name=token_payment]').val(document.cookie);
    //   // console.log($('input[name=token_payment]').val());
    // }
    </script>
    </html>
