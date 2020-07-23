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
    @include('lib.header')
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
            {{-- <div class="" style="text-align:center;">
              주소
            </div>
            <div class="" style="text-align:center;">
              (으)로 보내실 주문이 완료 되었습니다.
            </div> --}}
            <div class="wrapping_complete">
              <br>
              <div class="order_result"><b>주문 정보</b>
                <hr class="dotted_line">
                <div class="order_data">
                  <p class="order_label">주문번호 : {{$orderNO}}</p>
                  <p class="order_label">상품명 : {{$paymentID->p_name}}</p>
                  <p class="order_label">결제금액 : {{$paymentID->o_dcnt_totalprice}}</p>
                </div>
              </div>
            </div> <!--wrapping_complete-->
          @endforeach
        @elseif (isset($paymentIDarray))
          {{-- @foreach ($paymentIDarray as $key => $value) --}}
          {{-- <div class="" style="text-align:center;">
            주소{{}}
          </div>
          <div class="" style="text-align:center;">
            (으)로 보내실 주문이 완료 되었습니다.
          </div> --}}
          <div class="wrapping_complete">
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
                <p class="order_label">결제금액 : {{number_format($pricesum)}}</p>
              </div>
            </div>
          </div> <!--wrapping_complete-->
          {{-- @endforeach --}}
        @else
          <div class="wrapping_complete">
            <br>
            <div class="order_result"><b>주문 정보</b>
              <hr class="dotted_line">
              <div class="order_data" style="height:400px;">
                <div class="" style="text-align:center;font-size:30px;padding:180px;">
                  요청하신 페이지를 찾을 수 없습니다.
                </div>
              </div>
            </div>
          </div>
        @endif
        <div class="" style="text-align:center; margin: 30px 0px;">
          <button type="button" onclick="location.href='/'" name="button" style="width:200px;height:50px;">메인으로</button>
          {{-- <a href="/">메인으로</a> --}}
        </div>
      </div>
      @include('lib.footer')

    </body>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
    </script>
    </html>
