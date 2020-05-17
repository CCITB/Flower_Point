<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>상품</title>
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" type="text/css" href="/css/buy_information.css">
</head>
<body>
  @include('header')

  <div id="total">
    <div class = "pd_image"> <!--이미지 틀 -->
      이미지
    </div>

    <div class= "pd_option"> <!-- 상품정보와 옵션선택 -->

      <span>리시안셔스</span>
      <button class="convenience" type="button">관심매장등록</button>
      <button class="convenience" type="button" onclick="location.href = '/myqna'">문의하기</button>
      <hr class = way>

      <div class = "shop_name">
        <a href="/해당매장">ccit 1</a> <!-- 해당 매장 테이블에서 불러와 링크걸기 -->
      </div>
      <div claas="shop_lacation">
        서울시 종로구
      </div>

      <div class="pd_price">
        <br><strong>10000원</strong> <!-- 상품 가격 불러오기 -->
      </div>
      <p>
        <div class="pd_deliver1">
          배송비<br>
          2500원
        </div>
        <div class="pd_deliver2">
          배송기간<br>
          2일 이내
        </div>
        <div class="pd_deliver3">
          적립금<br>
          최대 2%
        </div>
      </p>
      <p>
        <div class="total_price_text">
          총 금액
        </div>
        <div class="total_price">
          ~원
        </div>
        <div class="order_bt">
          <button class="convenience" type="button" onclick="location.href = '/결제창'">주문</button>
        </div>
      </p>

      


    </div>


    <div class = "pd_detail"> <!-- 상품설명 디테일 -->
      설명
    </div>
  </div>
  @include('footer')
</body>
</html>
