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
      <div class="rev_thumbnail">

      </div>
      <div class="rev_pd_name">

      </div>
    </div>

    <div class="rev_detail">
      <div class="pd_satis">
        <strong class="satis_que">상품은 만족하셨나요?</strong>
        <div class="star_total">
          <div class="choice_star">
            <a href="#" class="on" id="st1" onclick="star_text(1)">★</a>
            <a href="#" class="on" id="st2" onclick="star_text(2)">★</a>
            <a href="#" class="on" id="st3" onclick="star_text(3)">★</a>
            <a href="#" class="on" id="st4" onclick="star_text(4)">★</a>
            <a href="#" class="on" id="st5" onclick="star_text(5)">★</a>
          </div>
          <div class="star_detail" id="st_detail">5점 (최고예요)</div>
        </div>
      </div>

      <div class="satis_text">
        <div class="satis_how">
          만족도 <span id="satis_nu">5</span>점을 주셨네요.<br>
          어떤 점이 <span id="satis_nu2">좋았나요?</span>
        </div>
        <div class="satis_detail">
          <textarea class="satis_detail_window" placeholder="후기를 입력해주세요."></textarea>
        </div>
        <div class="satis_img">
          <button class="img_bt" type="button" onclick="location.href = '/rev2'"><span><i class="fas fa-images"></i></span> 사진 첨부하기</button>
        </div>
      </div>
    </div>

    <div class="under">
      <input class="rev_bt" type="button" value="취소" onclick="self.close();" />
      <input class="rev_bt" type='submit' value="확인">
    </div>
  </div>


  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
  $( ".choice_star a" ).click(function() {
    $(this).parent().children("a").removeClass("on");
    $(this).addClass("on").prevAll("a").addClass("on");
    return false;
  });

  function star_text(st_nu){
    console.log(st_nu);

    switch (st_nu) {
      case 1:
      document.getElementById("st_detail").innerHTML = "1점 (별로예요)";
      document.getElementById("satis_nu").innerHTML = "1";
      document.getElementById("satis_nu2").innerHTML = "아쉬웠나요?";
      break;
      case 2:
      document.getElementById("st_detail").innerHTML = "2점 (그저그래요)";
      document.getElementById("satis_nu").innerHTML = "2";
      document.getElementById("satis_nu2").innerHTML = "아쉬웠나요?";
      break;
      case 3:
      document.getElementById("st_detail").innerHTML = "3점 (괜찮아요)";
      document.getElementById("satis_nu").innerHTML = "3";
      document.getElementById("satis_nu2").innerHTML = "좋았나요?";
      break;
      case 4:
      document.getElementById("st_detail").innerHTML = "4점 (좋아요)";
      document.getElementById("satis_nu").innerHTML = "4";
      document.getElementById("satis_nu2").innerHTML = "좋았나요?";
      break;
      case 5:
      document.getElementById("st_detail").innerHTML = "5점 (최고예요)";
      document.getElementById("satis_nu").innerHTML = "5";
      document.getElementById("satis_nu2").innerHTML = "좋았나요?";
      break;
      default:
      break;
    }
    // if(st_nu == 1){
    //   $('#st_detail').text('1점 (별로예요)');
    //   $('#satis_nu').text('1');
    //   $('#satis_nu2').text('아쉬웠나요?');
    // }
    // if(st_nu == 2){
    //   $('#st_detail').text('2점 (그저그래요)');
    //   $('#satis_nu').text('2');
    //   $('#satis_nu2').text('아쉬웠나요?');
    // }
    // if(st_nu == 3){
    //   $('#st_detail').text('3점 (괜찮아요)');
    //   $('#satis_nu').text('3');
    //   $('#satis_nu2').text('좋았나요?');
    // }
    // if(st_nu == 4){
    //   $('#st_detail').text('4점 (좋아요)');
    //   $('#satis_nu').text('4');
    //   $('#satis_nu2').text('좋았나요?');
    // }
    // if(st_nu == 5){
    //   $('#st_detail').text('5점 (최고예요)');
    //   $('#satis_nu').text('5');
    //   $('#satis_nu2').text('좋았나요?');
    // }
  }


  </script>

</body>
</html>
