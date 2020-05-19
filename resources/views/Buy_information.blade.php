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

    <!-- 상품정보와 옵션선택 -->
    <div class= "pd_option">

      <form action = 'url' method='post'>

        <div class="pd_basic">
          <div class="pd_name">리시안셔스</div>
          <div class="star">
            <button class="convenience" type="button">관심매장등록</button>
            <button class="convenience" type="button" onclick="location.href = '/myqna'">문의하기</button>
          </div>
        </div>
        <hr>

        <div class="shop_basic">
          <div class = "shop_name">
            <a href="/해당매장">ccit 1</a> <!-- 해당 매장 테이블에서 불러와 링크걸기 -->
          </div>
          <div claas = "shop_location">
            서울시 종로구
          </div>
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

        <div class="total_price_text">
          총 금액
        </div>
        <div class="total_price">
          ~원
        </div>
        <div class="order_bt">
          <button class="convenience" type="button" onclick="location.href = '/결제창'">주문</button>
        </div>

        <select class="select_option" name="select_option">
          <option value="option 1">옵션 1</option>
          <option value="option 2">옵션 2</option>
        </select><br><br>

        <select class="select_option" name="select_pack">
          <option value="pack 1">포장 1</option>
          <option value="pack 2">포장 2</option>
        </select>

      </form>
    </div>


    <div class = "pd_detail"> <!-- 상품설명 디테일 -->
      <pre>
        상품 본문 글 입니다.

        쓰는 만큼 늘어납니다.

        아시겠습니까?
      </pre>
    </div>
  </div>
  @include('footer')
</body>
</html>
