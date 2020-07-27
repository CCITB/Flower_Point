<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>꽃갈피 관리자</title>
  <link rel="stylesheet" href="/css/ad_coupon.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>

</head>
<body style="font-size:1em;">
  <div class="calculate_total">
    <div class="cal_title">
      @foreach ($st_name as $cal)
        "<strong style="color: #6B9900;">{{$cal->st_name}}</strong>" 정산 내역
      @endforeach
    </div>
    <div class="ca_table">
      <table id="cal" class="display">
        <thead>
          <tr>
            <th>주문 번호</th>
            <th>결제 번호</th>
            <th>상품 번호</th>
            <th>판매 개수</th>
            <th>판매 가격</th>
            <th>판매 날짜</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($calculate as $cal)
            <tr>
              <td>{{$cal->o_no}}</td>
              <td>{{$cal->pm_no}}</td>
              <td>{{$cal->p_no}}</td>
              <td>{{$cal->pm_count}}</td>
              <td>{{$cal->pm_pay}}</td>
              <td>{{$cal->cre}}</td>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="price_total">
      <span class="prices">판매 총 금액 : <strong style="color: #4374D9;">{{number_format($pm_pay_sum)}}</strong>원</span>
      <span class="prices">실제 판매 총 금액 : <strong style="color: #4374D9;">{{number_format($order_total_price)}}</strong>원</span>
      <span class="prices">최종 정산 금액 : <strong style="color: #F15F5F;">{{number_format($realprice)}}</strong>원</span>
    </div>
    <div class="ad_footer">
      - 판매 총 금액 : 배송비를 제외한 순수한 상품 금액의 총 합<br>
      - 실제 판매 총 금액 : '판매 총 금액' 에서 쿠폰과 적립금 할인을 뺀 금액<br>
      - 최종 정산 금액 : '실제 판매 총 금액' 에서 수수료를 제외한 금액으로, 가게에게 지급할 금액<br>
      <span style="color: #F15F5F;">* 수수료 기준 : 100만원 이하 3% , 100만원 이상 300만원 이하  5%, 300만원 이상  7%</span>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>
  <script type="text/javascript">

  $(document).ready(function(){
    $("#cal").DataTable({
      "language": {
        "emptyTable": "판매한 물품이 없습니다.",
        "lengthMenu": "페이지당 _MENU_ 개씩 보기",
        "info": "현재 _START_ - _END_ /  _TOTAL_건",
        "infoEmpty": "데이터 없음",
        "infoFiltered": "(전체  _MAX_건의 데이터에서 필터링됨 )",
        "search": "검색",
        "zeroRecords": "일치하는 데이터가 없습니다.",
        "loadingRecords": "로딩중...",
        "processing":     "잠시만 기다려 주세요...",
        "paginate": { "next": "다음", "previous": "이전"  }
      }
    });
  });

  </script>
</body>
</html>
