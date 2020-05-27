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
        <span class="current-page">
          <i class="fas fa-credit-card fa-2x"></i>
          주문/결제</span>
          <span>&gt;</span>
          <i class="fas fa-gift fa-2x"></i>
          <span>주문 완료</span>
        </div>
      </div>

      <div class="wrapping_complete">
        <div class="product_info">결제정보
          <hr class="dotted_line">
          <img class="complete_image" src="dummy.jpg" alt="Flower Image"
          width="100px" height="125px">
          <div class="product_data">
            <label>상품명 :</label>p_name <br>
            <label>가격 :</label> <br>
            <label>수량 :</label> <br>
            <label>옵션 :</label> <br>
            <label>주문일 :</label> <br>
            <label>주문번호 :</label> <br>
          </div>
        </div>
        <br>
        <div class="product_info">받는사람 정보
          <hr class="dotted_line">
          <div class="product_data">
            <label>수령인 :</label>p_name <br>
            <label>연락처 :</label> <br>
            <label>배송지 :</label> <br>
          </div>
        </div>

        
        <div class="recv_info">
        </div>
      </div> <!--wrapping_complete-->
    </div>
    @include('footer')
  </body>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  </html>
