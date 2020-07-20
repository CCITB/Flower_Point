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
          <strong>총 보유 적립금액 : <span style="color: #F15F5F;">{{number_format($myinfo->c_point)}}</span> 포인트</strong>
        </div>
      @endforeach
      <div class="p_middle">
        <div class="points">
          <div class="hi_title" onclick="point(1)" style="background: #FBDFDF;">
            <div class="his_title">리뷰 적립 내역 <img class="botbt" src="/imglib/bottombtn.png"></div>
          </div>
          <div class="p_detail" id="history1">
            @foreach ($myreview as $myinfo)
              <div class="point_history">
                <div class="h_title">리뷰 작성 <div class="h_date">{{$myinfo->created_at}}</div></div>
                <div class="h_ono">{{$myinfo->p_name}}</div>
                <div class="h_point" style="color: #4374D9;"><strong>(+) {{number_format($myinfo->r_reserve)}}P </strong></div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="points">
          <div class="hi_title" onclick="point(2)"  style="background-color: #C8DBCD;">
            <div class="his_title">상품 구매 내역  <img class="botbt" src="/imglib/bottombtn.png"></div>
          </div>
          <div class="p_detail" id="history2">
            @foreach ($myorder as $myinfo)
              @if(! $myinfo->o_point == 0)
                <div class="point_history">
                  <div class="h_title">구매 시 포인트 할인 <div class="h_date">{{$myinfo->created_at}}</div></div>
                  <div class="h_ono">주문번호 : {{$myinfo->o_no}}</div>
                  <div class="h_point" style="color: #F15F5F;"><strong>(-) {{number_format($myinfo->o_point)}}P </strong></div>
                </div>
                <div class="point_history">
                  <div class="h_title">상품 구매 <div class="h_date">{{$myinfo->created_at}}</div></div>
                  <div class="h_ono">주문번호 : {{$myinfo->o_no}}</div>
                  <div class="h_point" style="color: #4374D9;"><strong>(+) {{number_format($myinfo->o_reserve)}}P </strong></div>
                </div>
              @elseif($myinfo->o_point == 0)
                <div class="point_history">
                  <div class="h_title">상품 구매 <div class="h_date">{{$myinfo->created_at}}</div></div>
                  <div class="h_ono">주문번호 : {{$myinfo->o_no}}</div>
                  <div class="h_point" style="color: #4374D9;"><strong>(+) {{number_format($myinfo->o_reserve)}}P </strong></div>
                </div>
              @endif
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
      // $(".p_detail").removeClass("p_detail_show");
      $("#history"+num).addClass("p_detail_show");
    }
  }
  </script>
</body>
</html>
