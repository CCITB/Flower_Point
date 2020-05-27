<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
  @include('header')
  <div class="myoderlist-wrap">
    <div class="hr-line">
      <div id="line">
        <h2>나의 주문관리</h2>
        <hr>
      </div>
    </div>
    <div class="myorderlist">
      <div class="myorderlist-top">
        <div class="myorderlist-infor">
          <!-- <table> 보류중
          <tr>
          <td rowspan="3" class="orderpicture">사진</td>
          <td class="orderblink">입금대기</td>
          <td class="ordercount">0</td>
          <td class="orderspace">건</td>
          <td rowspan="3" class="orderpicture">사진</td>
          <td class="orderblink">배송준비</td>
          <td class="ordercount">0</td>
          <td class="orderspace">건</td>
          <td rowspan="3" class="orderpicture">사진</td>
          <td class="orderblink">취소요청</td>
          <td class="ordercount">0</td>
          <td class="orderspace">건</td>
        </tr>
        <tr>
        <td>신규주문</td>
        <td>0</td>
        <td>건</td>
        <td>배송중</td>
        <td>0</td>
        <td>건</td>
        <td>반품요청</td>
        <td>0</td>
        <td>건</td>
      </tr>
      <tr>
      <td>오늘출발</td>
      <td>0</td>
      <td>건</td>
      <td>배송완료</td>
      <td>0</td>
      <td>건</td>
      <td>교환요청</td>
      <td>0</td>
      <td>건</td>
    </tr>
  </table> -->
  <div class="sellerorderlist">
    <form class="" action="index.html" method="post" name="mycheck">
      <table name="">
        <tr>
          <th> <input type="checkbox" name="checkAll" id="th_checkAll"  value=""> </th>
          <th>상품 주문번호</th>
          <th>상품명</th>
          <th>송장번호</th>
          <th>택배사</th>
          <th>발송일</th>
          <th>주문일시</th>
          <th>고객명</th>
          <th>가격</th>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkRow" class="checkf" value=""></td>
          <td>202000000</td>
          <td>프리지아 꽃</td>
          <td></td>
          <td>우체국택배</td>
          <td>2020.04.16</td>
          <td>2020.04.15</td>
          <td>ccit3</td>
          <td>0</td>
        </tr>
        <tr>
          <td><input type="checkbox" class="checkf" name="checkRow" value=""></td>
          <td>202000000</td>
          <td>프리지아 꽃</td>
          <td></td>
          <td>우체국택배</td>
          <td>2020.04.16</td>
          <td>2020.04.15</td>
          <td>ccit3</td>
          <td>0</td>
        </tr>
        <tr>
          <td><input type="checkbox" class="checkf" name="checkRow" value=""></td>
          <td>202000000</td>
          <td>프리지아 꽃</td>
          <td></td>
          <td>우체국택배</td>
          <td>2020.04.16</td>
          <td>2020.04.15</td>
          <td>ccit3</td>
          <td>0</td>
        </tr>
        <tr>
          <td><input type="checkbox" class="checkf" name="checkRow" value=""></td>
          <td>202000000</td>
          <td>프리지아 꽃</td>
          <td></td>
          <td>우체국택배</td>
          <td>2020.04.16</td>
          <td>2020.04.15</td>
          <td>ccit3</td>
          <td>0</td>
        </tr>
      </table>
    </form>
  </div>

</div>
</div>
</div>
</div>
<style media="screen">
.sellerorderlist{
  width: 70%;
  margin: 0 auto;
}
.orderspace{
  width: 3%;
}
.ordercount{
  width: 6%;
}
.orderblink{
  width: 8%;
}
.orderpicture{
  width: 140px;
  height: 140px;
}
.myorderlist{
  width: 1130px;
  margin: 0 auto;
  padding: 0 30px;
  border: 5px solid pink;
}

table{
  border-collapse: collapse;
  display: inline-block;
  width: 100%;
  font-size: 14px;
}
td{

  width: 10%;
}
.myorderlist-top{


}
tr{
  height: 40px;
  border-bottom: 1px solid #e5e5e5;
}
.myorderlist-infor{

  margin: 0 auto;
  text-align: center;
}
th{
  background-color: #f5f5f5;
  font-weight: normal;
  border-top: 1px solid gray;
}
</style>
@include('footer')
</body>
</html>
<script>
var selectAll = document.querySelector("#th_checkAll");
selectAll.addEventListener('click', function(){
    var objs = document.querySelectorAll(".checkf");
    for (var i = 0; i < objs.length; i++) {
      objs[i].checked = selectAll.checked;
    };
}, false);

var objs = document.querySelectorAll(".checkf");
for(var i=0; i<objs.length ; i++){
  objs[i].addEventListener('click', function(){
    var selectAll = document.querySelector("#th_checkAll");
    for (var j = 0; j < objs.length; j++) {
      if (objs[j].checked === false) {
        selectAll.checked = false;
        return;
      };
    };
    selectAll.checked = true;
}, false);
}
</script>
