<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!--어지수-->
  <title>꽃갈피 - 판매자 회원가입</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/sign_up.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body>
  <div id="all">
    <div class="text">
      <div class="id_title">Seller Register</div> <hr>
    </div>
    <div class="signup">
      <form action = '/sto_info' method="post" name="f" onsubmit='return checkIt();'>
        @csrf
        <div class="sign_name">아이디</div>
        <input class="inf1" type="text" placeholder="ID" id="id" name="s_id" >
        <div class="check_div" id="id_check" value=""></div>

        <div class="sign_name">비밀번호</div>
        <input class="inf1" type="password" placeholder="Password" name="s_password" id="pw"  >
        <div class="check_div" id="pw_check" value=""></div>

        <div class="sign_name">비밀번호 확인</div>
        <input class="inf1" type="password" placeholder="Password" name="s_re_password" id="check"  >
        <div class="check_div" id="re_pw_check" value=""></div>

        <div class="sign_name">이름</div>
        <input class="inf1" type="text" placeholder="Name" id="name"  name="s_name" >
        <div class="check_div" id="name_check" value=""></div>

        <div class="sign_name">생년월일</div>
        <input class="inf2" type="text" placeholder="년(4자)" id="s_birth_y" name="s_birth_y" maxlength="4"  >

        <select class="inf2" id="s_birth_m" name="s_birth_m" >
          <option value="" selected>월</option>
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
        <input class="inf2" type="text" placeholder="일" id="s_birth_d" name="s_birth_d" maxlength="2" >
        <div class="check_div" id="birth_check" value=""></div>

        <div class="gender">
          <div class="sign_name">성별</div>
          <select class="form_select" name="s_gender" id=s_gender >
            <option value="">성별</option>
            <option value="남성">남성</option>
            <option value="여성">여성</option>
          </select>
        </div>
        <div class="check_div" id="gender_check" value=""></div>

        <div class="inf2">연락처</div>
        <select name="phone_no1"  id="seller_tel1" name="seller_tel1" class="seller_tel1">
          <option value="010" selected>010</option>
          <option value="011">011</option>
          <option value="016">016</option>
          <option value="017">017</option>
          <option value="018">018</option>
          <option value="019">019</option>
          <option value="02">02</option>
          <option value="031">031</option>
          <option value="032">032</option>
          <option value="033">033</option>
          <option value="041">041</option>
          <option value="042">042</option>
          <option value="043">043</option>
          <option value="044">044</option>
          <option value="051">051</option>
          <option value="052">052</option>
          <option value="053">053</option>
          <option value="054">054</option>
          <option value="055">055</option>
          <option value="061">061</option>
          <option value="062">062</option>
          <option value="063">063</option>
          <option value="064">064</option>
          <option value="070">070</option>
          <option value="080">080</option>
        </select>
        -
        <input type="text" title="휴대폰 중간번호" id="seller_tel2" name="seller_tel2" class="seller_tel2" maxlength="6">
        -
        <input type="text" title="휴대폰 뒷자리" id="seller_tel3" name="seller_tel3" class="seller_tel3" maxlength="6">
        <div class="check_div" id="phonenum_check" value=""></div>

        <div class="verify">
          <div class="sign_name">이메일</div>
          <!--인증번호를 전송할 이메일 기입창과 전송 버튼-->
          <input class="inf3" type="email" placeholder="email "id="s_email" name="s_email"  >
          <input class="btn_e" id="btn_email" type="button" value="인증번호 전송">
          <!--인증번호 기입란-->
          <input class="inf1" type="text" placeholder="인증번호 입력하세요. "id="verify_num" name="verify_num" disabled="">
          <div class="check_div" id="email_check" value=""></div>
        </div>

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
  <script type="text/javascript" src="/js/seller_register.js" charset="utf-8"></script>
