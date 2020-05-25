<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>결제</title>
  <link rel="stylesheet" href="/css/payment.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" type="text/css" href="/css/buy_information.css">
</head>
<body>
  <div class="wrapping">
    <div class="topheader">
      <h1 id="title"><a href="/">꽃갈피</a></h1>
    </div>

<div class="text">
  <h2 class="titlepage">Order/Payment</h2>
  <span>주문/결제</span>
  <div class="page-sorting">
					<a href="#"><span>상품선택</span></a>
					<span>&gt;</span>
					<span class="current-page">주문결제</span>
					<span>&gt;</span>
					<span>주문 완료</span>
				</div>
</div>
<div class="containerbox">
<!--정보기입창-->
<div class="infobox">
  <div class="customerbox">
  <table class="customerinfo" cellpadding="5" cellspacing="5" width: 100%>
    <tr>
      <th>주문고객</th>
      <td>곽승지(010-3371-6542)</td>
    </tr>
  </table>
</div>
<div class="customerbox2">
  <form class="info" action="#" method="post">
    @csrf
    <label>수령인</label>
    <input class="recipient" type="text" name="recipient">
    <div class="infodiv"></div>
    <label>전화번호</label>
    <input class="order_tel" type="text" name="order_tel">
    <div class="infodiv"></div>
    <label>주 소</label>
    <input class="order_address" type="text" name="order_address">
    <div class="infodiv"></div>
    <label>요청사항</label>
    <input class="request" type="text" name="request">
    <div class="infodiv"></div>
  </form>
</div>
</div>

<!--주문창-->
      <div class="orderbox">
        <div class="paybox">주문정보
          <hr>
          <table class="tablebox" cellpadding="10" cellspacing="10" width="100%">
            <tr>
              <th>주문자</th>
              <td>곽승지</td>
            </tr>
            <tr>
              <th>연락처</th>
              <td>010-1234-5678</td>
            </tr>
          </table>
          <div class="detail">
            주문자 정보를 정확하게 입력해주세요.
          </div>
        </div>

        <div class="payresult">결제정보
          <hr>
          <div class="paymentbox">
            <table class="tablebox" cellpadding="10" cellspacing="10" width="100%">
              <tr>
                <th>금액</th>
                <td>p_price</td>
              </tr>
              <tr>
                <th>배송비</th>
                <td>o_delivery</td>
              </tr>
              <div class="paypay">
                <tr>
                  <th>결제금액</th>
                  <td>23,500원</td>
                </tr>
              </table>
            </div>
          </div>
        </div><!--결제정보 -->
      </div>
    </div>
  </div>
  @include('footer')
</body>
</html>
