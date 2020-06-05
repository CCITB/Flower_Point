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
            <p class="order_label">주문번호 : o_no</p>
            <p class="order_label">상품명 : p_name</p>
            <p class="order_label">결제금액 : p_price</p>
          </div>
        </div>
      </div> <!--wrapping_complete-->
    </div>
    @include('lib.footer')
  </body>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  </html>
