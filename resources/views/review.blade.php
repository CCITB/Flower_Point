<!DOCTYPE html> <!-- 박소현 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>후기작성</title>
  <link rel="stylesheet" type="text/css" href="/css/review.css">
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

    <form action = "{{url('rev')}}" method="post" name="myrv" id="create_form"  enctype="multipart/form-data">
      @csrf
      <div class="rev_detail">
        <div class="pd_satis">
          <strong class="satis_que">상품은 만족하셨나요?</strong>
          <div class="star_total">
            <div class="choice_star" name="stars">
              <button name="rate1" class="hi" id="st1" onclick="star_text(1)" value="1">★</button>
              <button name="rate2" class="hi" id="st2" onclick="star_text(2)" value="2">★</button>
              <button name="rate3" class="hi" id="st3" onclick="star_text(3)" value="3">★</button>
              <button name="rate4" class="hi" id="st4" onclick="star_text(4)" value="4">★</button>
              <button name="rate5" class="hi" id="st5" onclick="star_text(5)" value="5">★</button>
              <input type="hidden" id="hidden" name="hidden" value="">
            </div>
            <br><br><div class="star_detail" id="st_detail">별점을 눌러주세요.</div>
          </div>
        </div>

        <div class="satis_text">
          <div class="satis_how">
            만족도 <span id="satis_nu">5</span>점을 주셨네요.<br>
            어떤 점이 <span id="satis_nu2">좋았나요?</span>
          </div>
          <div class="satis_detail">
            <textarea class="satis_detail_window" id="review_text" name="text" maxlength="250" placeholder="후기를 입력해주세요."></textarea>
            <br><span class="counter" id="counter">###</span>
          </div>
        </div>
      </div>

      <div class="rev_img">
        <div class="file_upload">
          <input type="file" onchange="checkFile(this);" id="real-input" name="picture" class="my_img" accept="image/*" >
        </div>
        <div class="preview">
          <img src="#" alt="" id="image-session">
          <div class="preview-image">
            <!-- 이미지 미리보기 -->
          </div>
        </div>
      </div>


      <div class="under">
        <input class="rev_bt" type="button" value="취소" onclick="self.close();" />
        <input class="rev_bt" id="sub" type='submit' value="확인">
      </div>
    </form>
  </div>


  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>

 // 별점 색 on
  $( ".choice_star button" ).click(function() {
    $(this).parent().children("button").removeClass("on");
    $(this).addClass("on").prevAll("button").addClass("on");
    return false;
  });

  // 별점 숫자로 바꾸기
  function star_text(st_nu){
    console.log(st_nu);

    var rate;
    if(st_nu == 1){
      $('#st_detail').text('1점 (별로예요)');
      $('#satis_nu').text('1');
      $('#satis_nu2').text('아쉬웠나요?');
      rate = 1;
      document.myrv.hidden.value = rate;
    }
    if(st_nu == 2){
      $('#st_detail').text('2점 (그저그래요)');
      $('#satis_nu').text('2');
      $('#satis_nu2').text('아쉬웠나요?');
      rate = 2;
      document.myrv.hidden.value = rate;
    }
    if(st_nu == 3){
      $('#st_detail').text('3점 (괜찮아요)');
      $('#satis_nu').text('3');
      $('#satis_nu2').text('좋았나요?');
      rate = 3;
      document.myrv.hidden.value = rate;
    }
    if(st_nu == 4){
      $('#st_detail').text('4점 (좋아요)');
      $('#satis_nu').text('4');
      $('#satis_nu2').text('좋았나요?');
      rate = 4;
      document.myrv.hidden.value = rate;
    }
    if(st_nu == 5){
      $('#st_detail').text('5점 (최고예요)');
      $('#satis_nu').text('5');
      $('#satis_nu2').text('좋았나요?');
      rate = 5;
      document.myrv.hidden.value = rate;
    }
  }

  //리뷰 예외처리
  $(document).ready(function(){
    $("#sub").click(function(){
      if($("#hidden").val() == 0){
        alert("별점을 눌러주세요.");
        $("#hidden").focus();
        return false;
      }
      if($("#review_text").val().length == 0){
        alert("본문을 입력하세요.");
        $("#review_text").focus();
        return false;
      }
    });
  });
  $(function() {
        $('#review_text').keyup(function (e){
            var content = $(this).val();
            $(this).height(((content.split('\n').length + 1) * 1.5) + 'em');
            $('#counter').html(content.length + '/250');
        });
        $('#review_text').keyup();
  });




  function checkFile(el){
    $('#image-session').attr('src', '#');
    var file = el.files;
    if(file[0].size > 1024 * 1024 * 2){
      alert('2MB 이하 파일만 등록할 수 있습니다.\n\n' +
      '현재파일 용량 : ' + (Math.round(file[0].size / 1024 / 1024 * 100) / 100) + 'MB');
      el.outerHTML = el.outerHTML;
    }
    else chk_file_type(el);

  }
  function chk_file_type(el) {
    var file_kind = el.value.lastIndexOf('.');
    var file_name = el.value.substring(file_kind+1,el.length);
    var file_type = file_name.toLowerCase();
    // console.log(file_name)
    // console.log(file_kind)

    var check_file_type=new Array();
    check_file_type=['jpg','gif','png','jpeg','bmp','tif'];
    if(check_file_type.indexOf(file_type)==-1) {
      alert('이미지 파일만 업로드 가능합니다.');
      var parent_Obj=el.parentNode;
      console.log(parent_Obj);
      var node=parent_Obj.replaceChild(el.cloneNode(true),el);
      document.getElementById("real-input").value = "";    //초기화를 위한 추가 코드
      document.getElementById("real-input").select();        //초기화를 위한 추가 코드                                               //일부 브라우저 미지원
    }
    else{readURL(el);
      $("#real-input").change(function(){
        readURL(this);
      });
    }
  }
  // 사진을 올릴때마다 파일을 새로 변경시켜주는 함수입니다.
  function readURL(el) {
    if (el.files && el.files[0]) {
      var reader = new FileReader();
      // 이미지 미리보기해주는 jquery
      reader.onload = function (e) {
        $('#image-session').attr('src', e.target.result);
      }

      reader.readAsDataURL(el.files[0]);
    }
  }

  </script>

</body>
</html>
