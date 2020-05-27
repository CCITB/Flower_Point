<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>주문내역</title>
  </head>
  <body>
    @include('header')
    <div class="">
    <h3 class="orderlist" float="left">주문내역</h3>
    <div class="searchlist">

    </div>
  </div>
    <table class="orderinfo" cellpadding="10" cellspacing="10" width="100%">
      <tr>
        <th>배송예정일</th>
        <th>상품명</th>
        <th>수량</th>
        <th>금액</th>
        <th>합계</th>
        <th>수정/취소</th>
      </tr>
      <tr>
        <td>2020-05-27</td>
        <td>리시안셔스</td>
        <td>2</td>
        <td>2,5000</td>
        <td>2,5000</td>
        <td><button class="cancellist">결제취소</button></td>
      </tr>
      <tr>
        <td>2020-05-27</td>
        <td>장미</td>
        <td>1</td>
        <td>5,000</td>
        <td>5,000</td>
        <td><button class="cancellist">결제취소</button></td>
      </tr>
      <tr>
        <td>2020-05-27</td>
        <td>안개꽃</td>
        <td>1</td>
        <td>7,0000</td>
        <td>7,0000</td>
        <td><button class="cancellist">결제취소</button></td>
      </tr>
    </table>
  </body>
  @include('footer')
</html>
