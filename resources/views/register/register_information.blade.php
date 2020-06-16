<!--어지수-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/sign_up.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <title>매장 정보 기입</title>
</head>

<body>
  <div id="all">
    <div class="text">
      <div class="text">
        <span class="id_title"><i>판매자 - 가게정보</i></span>
        <div class="page-sorting">
          <span >step1</span>
          <span>&gt;</span>
          <span >step2</span>
          <span>&gt;</span>
          <span class="current-page">step3</span>
        </div>
      </div>
      <!--<div class="id_title"><i>이용약관 동의</i></div> <hr>-->
    </div>

    <div class="st_if">
      <form action = '/RegisterControllerSeller' method='post' name="insertstore" onsubmit='return checkIt();'>
        @csrf
        <input type="hidden" name="s_id" value="<?php echo $_POST['s_id']?>">
        <input type="hidden" name="s_password" value="<?php echo $_POST['s_password']?>">
        <input type="hidden" name="s_name" value="<?php echo $_POST['s_name']?>">
        <input type="hidden" name="s_email" value="<?php echo $_POST['s_email']?>">
        <input type="hidden" name="s_gender" value="<?php echo $_POST['s_gender']?>">

        <input type="hidden" name="s_birth_y" value="<?php echo $_POST['s_birth_y']?>">
        <input type="hidden" name="s_birth_m" value="<?php echo $_POST['s_birth_m']?>">
        <input type="hidden" name="s_birth_d" value="<?php echo $_POST['s_birth_d']?>">

        <input type="hidden" name="s_tel1" value="<?php echo $_POST['s_tel1']?>">
        <input type="hidden" name="s_tel2" value="<?php echo $_POST['s_tel2']?>">

        <div class="paragraph">
          <div class="sign_name">매장 이름</div>
          <input class="shop_info" type="text" placeholder="store name" id="st_name" name="st_name" >
          <div class="check_div" id="stname_check" value=""></div>
        </div>

        <div class="paragraph">
          <div class="sign_name">사업자 등록번호</div>
          <input class="shop_info2" type="text" id="registeration_num1" name="registeration_num1">
          -
          <input class="shop_info2" type="text" id="registeration_num2" name="registeration_num2">
          -
          <input class="shop_info2" type="text" id="registeration_num3" name="registeration_num3">
          <div class="check_div" id="stnum_check" value=""></div>
        </div>

        <div class="paragraph">
          <div class="sign_name">매장 주소</div>
          <!-- 우편번호 -->
          <input type="text" id="postcode" name="postcode" placeholder="우편번호">
          <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
          <!--주소 -->
          <div class="delivery_wrap2">
            <input type="text"  id="address" name="address" placeholder="주소">

            <div class="delivery_address_detail">
              <input type="text" class="delivery_address_list" id="detailAddress" name="detailAddress" placeholder="상세주소">
              <input type="text" class="delivery_address_list" id="extraAddress" name="extraAddress" placeholder="참고항목">
            </div>
          </div>
          <div class="check_div" id="staddress_check" value=""></div>
        </div>

        <div class="paragraph">
          <div class="sign_name">고객센터 번호</div>
          <input class="shop_info" type="text" placeholder="Service Number" id="st_tel" name="st_tel">
          <div class="check_div" id="staddress_num" value=""></div>
        </div>

        <div class="paragraph">
          <div class="sign_name">매장 소개</div>
          <textarea placeholder="introduce" id="st_introduce" name="st_introduce" ></textarea>
        </div>
        <div class="under">
          <input class="lg_bt" type='submit' id="login" value="가입하기">
        </div>
      </form>
    </div>
  </div>
</body>
</html>

<!--script Link -->
<script type="text/javascript" src="/js/information_register.js" charset="utf-8"></script>
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
