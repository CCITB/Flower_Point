<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" type="text/css" href="/css/orderlist.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
  @include('lib.header')
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
    <!-- <form class="" action="index.html" method="post" name="mycheck"> -->
      <div class="orderlist-bottom">
        <button type="submit" name="button" id="check" class="ordercheck" form="order_list">발주확인</button>
        <button type="submit" name="button" id="send" class="sendmessage" form="order_list">발송처리</button>
      </div>

      <!--button에 따라 action값 변경 -->
      <form class="order_list" id="order_list" action="" method="post">
        @csrf

        <table id="myTable"name="">
          <tr>
            <th class="title"> <input type="checkbox" name="checkAll" id="th_checkAll"  value=""> </th>
            <th class="title">주문번호</th>
            <th class="title">상품번호</th>
            <th class="title">상품명</th>
            <th class="title">송장번호</th>
            <th class="title">택배사</th>
            <!-- <th class="title">발송일</th> -->
            <th class="title">주문일시</th>
            <th class="title">고객명</th>
            <th class="title">가격</th>
            <th class="title">결제상태</th>
            <th class="title">배송상태</th>
            <!-- <th class="title"></th> -->
          </tr>
          @foreach ($order as $order)
            <tr>
              <td><input type="checkbox" class="checkf" id="ordercheck{{$order->pm_no}}" name="checkRow" value=""></td>
              <td>{{$order->pm_no}}</td>
              <td>{{$order->p_no}}</td>
              <td id="p_name">{{$order->p_name}}</td>
              <td><input type="text" class="num" id="invoice_num" name="" value=""></td>
              <td><select id="bank" name=bank margin-left:10px;>
                <option value="">택배사를 선택해주세요</option>
                <option value="우체국택배">우체국택배</option>
                <option value="CJ대한통운">CJ대한통운</option>
                <option value="로젠택배">로젠택배</option>
                <option value="한진택배">한진택배</option>
                <option value="현대택배">현대택배</option>
                <option value="경동택배">경동택배</option>
                <option value="KG로지스">KG로지스</option>
                <option value="대신택배">대신택배</option>
                <option value="합동택배">합동택배</option>
                <option value="천일택배">천일택배</option>
              </select></td>
              <!-- <td>2020.04.16</td> -->
              <td>{{$order->created_at}}</td>
              <td>{{$order->c_name}}</td>
              <td>{{$order->pm_pay}}</td>
              <td>{{$order->pm_status}}</td>
              <td>{{$order->d_status}}</td>
            <!-- <td><button type="submit" name="button">저장</button></td> -->
          </tr>
        @endforeach
        </table>
      </form>
  <!-- </form> -->
  </div>

</div>
</div>
</div>
</div>
@include('lib.footer')
</body>
</html>


<script>
var selectAll = document.querySelector("#th_checkAll");+

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

$('#check').click(function () {
    $('#order_list').attr("action", "/payment_status");
});
$('#send').click(function () {
    $('#order_list').attr("action", "/delivery_status");
});

</script>
