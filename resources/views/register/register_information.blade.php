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
  <title>매장 정보 기입</title>
</head>

<body>
  <div id="all">
    <div class="text">
      <div class="id_title">Store Information</div> <hr>
    </div>

    <div class="st_if">
      <form action = '/RegisterControllerSeller' method='post' name="insertstore" >
        @csrf
        <input type="hidden" name="s_id" value="<?php echo $_POST['s_id']?>">
        <input type="hidden" name="s_password" value="<?php echo $_POST['s_password']?>">
        <input type="hidden" name="s_name" value="<?php echo $_POST['s_name']?>">
        <input type="hidden" name="s_email" value="<?php echo $_POST['s_email']?>">
        <input type="hidden" name="s_gender" value="<?php echo $_POST['s_gender']?>">
        
        <input type="hidden" name="s_birth_y" value="<?php echo $_POST['s_birth_y']?>">
        <input type="hidden" name="s_birth_m" value="<?php echo $_POST['s_birth_m']?>">
        <input type="hidden" name="s_birth_d" value="<?php echo $_POST['s_birth_d']?>">

        <input type="hidden" name="seller_tel1" value="<?php echo $_POST['seller_tel1']?>">
        <input type="hidden" name="seller_tel2" value="<?php echo $_POST['seller_tel2']?>">
        <input type="hidden" name="seller_tel3" value="<?php echo $_POST['seller_tel3']?>">

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
          <input class="shop_info" type="text" placeholder="Shop Address" id="st_address" name="st_address">
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
