<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/header.css">
  <title>장바구니</title>
</head>
<body>
  @include('lib.header')
  <div class="flowercart-wrap">
    장바구니
    <div class="flowercart-table-wrap">
      <table class="flowercart-table">
        <tr class="table-head">
          <th>상품 / 옵션정보</th>
          <th> 수량 </th>
          <th> 상품금액 </th>
          <th> 할인금액 </th>
          <th> 할인적용금액 </th>
          <th> 배송비 </th>
          <th> 주문 </th>
        </tr>
        <tr>
          <td>상품 정보 </td>
          <td> 2 </td>
          <td> 30000 원</td>
          <td> 1000 원</td>
          <td> 29000 원</td>
          <td> 3000원 </td>
          <td>
            <div class="">
              <a href="#">주문하기</a>
            </div>
            <div class="">
              <a href="#">삭제하기</a>
            </div>
          </td>
        </tr>
        <tr>
          <td>상품 정보 </td>
          <td> 2 </td>
          <td> 30000 원</td>
          <td> 1000 원</td>
          <td> 29000 원</td>
          <td> 3000원 </td>
          <td>
            <div class="">
              <a href="#">주문하기</a>
            </div>
            <div class="">
              <a href="#">삭제하기</a>
            </div>
          </td>
        </tr>
        <tr>
          <td>상품 정보 </td>
          <td> 2 </td>
          <td> 30000 원</td>
          <td> 1000 원</td>
          <td> 29000 원</td>
          <td> 3000원 </td>
          <td>
            <div class="">
              <a href="#">주문하기</a>
            </div>
            <div class="">
              <a href="#">삭제하기</a>
            </div>
          </td>
        </tr>
        <tr>
          <td>상품 정보 </td>
          <td> 2 </td>
          <td> 30000 원</td>
          <td> 1000 원</td>
          <td> 29000 원</td>
          <td> 3000원 </td>
          <td>
            <div class="">
              <a href="#">주문하기</a>
            </div>
            <div class="">
              <a href="#">삭제하기</a>
            </div>
          </td>
        </tr>
        <tr>
          <td>아무것도없을때 공간</td>
        </tr>
      </table>
      <div class="flowercart-list">

      </div>
    </div>
  </div>
  <style media="screen">
  .flowercart-wrap{
    overflow: hidden;
    width: 900px;
    margin: 0 auto;
  }
  .flowercart-table{
    border: 1px solid gray;
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
  }
  td{
    border: 1px solid gray;
    text-align: center;
  }
  tr.table-head{
    background-color: #f5f5f5;
    height: 59.6px;
  }
  </style>
  @include('lib.footer')
</body>
</html>
