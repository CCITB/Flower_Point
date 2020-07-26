<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>꽃갈피 관리자</title>
  </head>
  <body>
    @foreach ($calculate as $cal)
      상품명 : {{$cal->p_name}}
      주문번호 : {{$cal->o_no}}
      결제번호 : {{$cal->pm_no}}
      개수 : {{$cal->pm_count}}
      상품가격 : {{$cal->pm_pay}}
      o_tatal : {{$cal->o_dcnt_totalprice}}<br>
    @endforeach
    @foreach ($calculat as $cal)
      -------------------------------<br>
      주문번호 : {{$cal->o_no}}
      o_tatal : {{$cal->o_dcnt_totalprice}}<br>
    @endforeach
      총 : {{$order_total_price}}
  </body>
</html>
