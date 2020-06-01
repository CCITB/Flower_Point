<!DOCTYPE html> <!-- 박소현 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>후기작성</title>
  <link rel="stylesheet" type="text/css" href="/css/buy_information.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
</head>
<body>
  <div class="review_total">
    <div class="pd_info">

    </div>

    <div class="rev_detail">
      <div class="pd_satis">
        <strong class="satis_que">상품은 만족하셨나요?</strong>
        <div class="star_total">
          <div class="choice_star">
            <a href="#" class="on">★</a>
            <a href="#" class="on">★</a>
            <a href="#" class="on">★</a>
            <a href="#" class="on">★</a>
            <a href="#" class="on">★</a>
          </div>
          <div class="star_detail">
            몇 점
          </div>
        </div>
      </div>

      <div class="satis_text">
        <div class="satis_how">
          어떤 점이 좋았나요?
        </div>
        <div class="satis_detail">
          <textarea class="satis_detail_window" placeholder="최소 10자 이상 입력해주세요."></textarea>
        </div>
        <div class="satis_img">
          <button class="img_bt" type="button" onclick="location.href = '/'"><span><i class="fas fa-images"></i></span> 사진 첨부하기</button>
        </div>
      </div>
    </div>

    <div class="under">
      <input class="rev_bt" type="button" value="취소" onclick="self.close();" />
      <input class="rev_bt" type='submit' value="확인">
    </div>
  </div>
</body>
</html>

<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$( ".choice_star a" ).click(function() {
  $(this).parent().children("a").removeClass("on");
  $(this).addClass("on").prevAll("a").addClass("on");
  return false;
});

</script>
