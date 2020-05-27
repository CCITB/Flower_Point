<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>결제</title>
  <link rel="stylesheet" href="/css/payment2.css">
  <link rel="stylesheet" href="/css/header.css">
</head>
<body>
  <div class="wrapping">
    <div class="topheader">
      <h1 class="titles"><a id="title" href="/">꽃갈피</a></h1>
    </div>
    <div class="text">
      <span class="title">주문/결제</span>
      <div class="page-sorting">
        <span>상품선택</span>
        <span>&gt;</span>
        <span class="current-page">주문/결제</span>
        <span>&gt;</span>
        <span>주문 완료</span>
      </div>
    </div>
<div class="groupbox">

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
          <!--결제 정보 창-->
          <form class="info" action="#" method="post">
            @csrf
            <table>
              <tr>
                <th>수령인</th>
                <td><input class="inputtext" type="text" name="recipient"></td>
              </tr>
              <tr>
                <th>전화번호</th>
                <td><input class="inputtext" type="text" name="order_tel"></td>
              </tr>
              <tr>
                <th>주 소</th>
                <td><input class="inputtext" type="text" name="order_address"></td>
              </tr>
              <tr>
                <th>요청사항</th>
                <td><input class="inputtext" type="text" name="request"></td>
              </tr>
            </table>
          </div>

          <!--상품 정보창-->
          <div class="product_data">
            <!--product_imabe Table에서 product_no에 맞는 i_filename 가져오기-->
            <table cellpadding="10" cellspacing="10" width="300px">
              <tr>
                <td><img class="product_image" src="dummy.jpg" alt="Flower Image" width="100px" height="100px"></td>
                <td>상품명 : p_name</td>
              </tr>
            </table>
          </div>

          <!--결제창-->
          <div class="pay_data">
            <table cellpadding="5" cellspacing="5" width="100%">
              <label>무통장 입금</label>
              <th><li>은행 선택</li></th>
              <td>
              <select name=bank margin-left:10px;>
                <option value="">은행을 선택해주세요</option>
                <option value="농협">농협</option>
                <option value="국민은행">국민은행</option>
                <option value="우리은행">우리은행</option>
                <option value="하나은행">하나은행</option>
                <option value="신한은행">신한은행</option>
                <option value="외한은행">외한은행</option>
                <option value="씨티은행">씨티은행</option>
                <option value="기업은행">기업은행</option>
                <option value="우체국">우체국</option>
                <option value="부산은행">부산은행</option>
                <option value="SC은행">SC은행</option>
              </select>
              </td>
            </table>
          </div>
        </div>
        <!--주문창-->
        <div class="orderbox">
          <div class="paybox">
            <div class="orderinfo">
              주문정보
            </div>
            <hr class="line1">
            <table class="tablebox" cellpadding="10" cellspacing="10" width="100%">
              <tr>
                <th>주문자</th>
                <td>c_name</td>
              </tr>
              <tr>
                <th>연락처</th>
                <td>c_phonenum</td>
              </tr>
            </table>
            <div class="detail">
              주문자 정보를 정확하게 입력해주세요.
            </div>
          </div>

          <div class="payresult">
            <div class="payinfo">결제정보
            </div>
            <hr class="line1">
            <div class="paymentbox">
              <table class="tablebox" cellpadding="10" cellspacing="10" width="100%">
                <tr>
                  <th>금액</th>
                  <td>p_price</td>
                </tr>
                <tr>
                  <th>배송비</th>
                  <td>p_delivery</td>
                </tr>
                <tr id="paypay">
                  <th>결제금액</th>
                  <td>p_price + p_delivery</td>
                </tr>
              </table>
              <hr class="line2">
            </form>
            <div class="line"><input class="check" type="checkbox" name="ck" id="ck"> 주문내역 확인 동의(필수)</div>
            <div class="line"><input class="end" type='submit' value="다음"></div>
          </div>
        </div><!--결제정보 -->
      </div><!--오른쪽 주문정보 박스 -->
  <!--컨테이너박스-->
  </div>
  </div>
</div>
@include('footer')
</body>
</html>
