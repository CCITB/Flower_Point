<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/c_mypage.css">
</head>
<body>
  <div class="total_mypoint">
    <div class="p_header">
      <img class="titleimg" src="/imglib/title.png">
    </div>
    <div class="p_history">
      @foreach ($cus as $myinfo)
        <div class="p_title">
          <strong>총 보유 적립금액 : {{number_format($myinfo->c_point)}} 포인트</strong>
        </div>
      @endforeach
      <div class="p_middle">
        <div class="points1">
          <div class="hi_title" onclick="point(1)">
            <div class="his_title">리뷰 적립 내역 <img class="botbt" src="/imglib/bottombtn.png"></div>
          </div>
          <div class="p_detail" id="history1">
            @foreach ($myreview as $myinfo)
              <div>리뷰 작성 {{number_format($myinfo->r_reserve)}}P </div>
            @endforeach
          </div>
        </div>
        <div class="points2">
          <div class="hi_title" onclick="point(2)">
            <div class="his_title">상품 구매 내역  <img class="botbt" src="/imglib/bottombtn.png"></div>
          </div>
          <div class="p_detail" id="history2">
            @foreach ($myorder as $myinfo)
              <div>상품 구매 {{number_format($myinfo->o_reserve)}}P </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript">

  function point(num) {

    if($("#history"+num).hasClass("p_detail_show")){
      $("#history"+num).removeClass("p_detail_show");
    }
    else
    {
      $(".p_detail").removeClass("p_detail_show");
      $("#history"+num).addClass("p_detail_show");
    }
  }
  </script>
</body>
</html>
