<!-- 어지수 + css:박소현-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>꽃갈피 - 구매자 회원가입</title>
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
</head>

<body>
  <div id="all">
    <div class="text">
      <div class="text">
        <span class="id_title"><i>판매자 - 회원가입</i></span>
        <div>
          <span >step1</span>
          <span>&gt;</span>
          <span class="current-page">step2</span>
          </div>
        </div>
      <!--<div class="id_title"><i>이용약관 동의</i></div> <hr>-->
    </div>
    <div class="signup">
      <form action = '/RegisterControllerCustomer' method="post" name="f" onsubmit='return checkIt();'>
        @csrf
        <div class="sign_name">아이디</div>
        <input class="inf1" type="text" placeholder="ID" id="id" name="c_id">
        <div class="check_div" id="id_check" value=""></div>

        <div class="sign_name">비밀번호</div>
        <input class="inf1" type="password" placeholder="Password" name="c_password" id="pw" >
        <div class="check_div" id="pw_check" value=""></div>

        <div class="sign_name">비밀번호 확인</div>
        <input class="inf1" type="password" placeholder="Password" name="c_re_password" id="check" >
        <div class="check_div" id="re_pw_check" value=""></div>

        <div class="sign_name">이름</div>
        <input class="inf1" type="name" placeholder="Name" id="name" name="c_name" >
        <div class="check_div" id="name_check" value=""></div>

        <div class="sign_name">연락처</div>
        <input class="inf1" type="text" placeholder="Phone Number" id="c_phonenum" name="c_phonenum" >
        <div class="check_div" id="phonenum_check" value=""></div>

        <div class="sign_name">생년월일</div>
        <input class="inf2" type="text" placeholder="년(4자)" id="c_birth_y" name="c_birth_y" maxlength="4">

        <select class="inf2" id="c_birth_m" name="c_birth_m">
          <option value="">월</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        <input class="inf2" type="int" placeholder="일" id="c_birth_d" name="c_birth_d" maxlength="2">
        <div class="check_div" id="birth_check" value=""></div>

        <div class="gender">
          <div class="sign_name">성별</div>
          <select class="form_select" name="c_gender" id=c_gender >
            <option value="">성별</option>
            <option value="남성">남성</option>
            <option value="여성">여성</option>
          </select>
        </div>
        <div class="check_div" id="gender_check" value=""></div>

        <div class="paragraph">
          <div class="sign_name">주소</div>
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

        <div class="sign_name">이메일</div>
        <input class="inf3" type="email" placeholder="email "id="c_email" name="c_email"  >
        <input class="btn_e" id="btn_email" type="button" value="인증번호 전송">
        <!--인증번호 기입란-->
        <input class="inf1" type="text" placeholder="인증번호 입력하세요. "id="verify_num" name="verify_num" disabled="">
        <div class="check_div" id="email_check" value=""></div>
      </div>
      <!-- <button type="button" style="border-radius:5px; font-s"/> <a href="http://laravel.site/login">돌아가기</a> </button> </td> -->
      <div class="under">
        <button class="lg_bt" type='button' onclick="history.back()">뒤로</button>
        <input class="lg_bt" type='submit' id="btnSubmit" value="다음" >
      </div>
    </form>

  </body>
  </html>

<!--script Link -->
<script type="text/javascript" src="/js/customer_register.js" charset="utf-8"></script>
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
