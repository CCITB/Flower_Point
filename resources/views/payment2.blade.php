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
  <span class="title">주문/결제</span>
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
      <td>c_name(c_phonenum)</td>
    </tr>
  </table>
</div>
<div class="customerbox2">
  <form class="info" action="#" method="post">
    @csrf
    <table>
      <tr>
        <td><label>수령인</label></td>
        <td><input class="inputtext" type="text" name="recipient"></td>
      </tr>
      <tr>
        <td><label>전화번호</label></td>
        <td><input class="inputtext" type="text" name="order_tel"></td>
      </tr>
      <tr>
        <td><label>주 소</label></td>
        <td><input class="inputtext" type="text" name="order_address"></td>
      </tr>
      <tr>
        <td><label>요청사항</label></td>
        <td><input class="inputtext" type="text" name="request"></td>
      </tr>
    </table>
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
              <td>c_name</td>
            </tr>
            <tr>
              <th>c_phonenum</th>
              <td>c_tel</td>
            </tr>
          </table>
          <div class="detail">
            주문자 정보를 정확하게 입력해주세요.
          </div>
        </div>

        <div class="payresult">결제정보
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

                <tr id="paypay">
                  <th>결제금액</th>
                  <td>p_price + o_delivery</td>
                </tr>

              </table>
          </div>
        </div><!--결제정보 -->
      </div>
    </div>
  </div>
  @include('footer')
</body>
</html>
