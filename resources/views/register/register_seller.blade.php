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
      <div class="text">
        <span class="id_title"><i>판매자 - 회원가입</i></span>
        <div class="page-sorting">
          <span >step1</span>
          <span>&gt;</span>
          <span class="current-page">step2</span>
            <span>&gt;</span>
            <span >step3</span>
          </div>
        </div>
      <!--<div class="id_title"><i>이용약관 동의</i></div> <hr>-->
    </div>
    <div class="signup">
      <form action = '/sto_info' method="post" name="f" onsubmit='return checkIt();'>
        @csrf
        <div class="sign_name">아이디<span class="a">*</span></div>
        <input class="inf1" type="text" placeholder="ID" id="id" name="s_id" >
        <div class="check_div" id="id_check" value=""></div>

        <div class="sign_name">비밀번호<span class="a">*</span></div>
        <input class="inf1" type="password" placeholder="Password" name="s_password" id="pw"  >
        <div class="check_div" id="pw_check" value=""></div>

        <div class="sign_name">비밀번호 확인<span class="a">*</span></div>
        <input class="inf1" type="password" placeholder="Password" name="s_re_password" id="check"  >
        <div class="check_div" id="re_pw_check" value=""></div>

        <div class="sign_name">이름<span class="a">*</span></div>
        <input class="inf1" type="text" placeholder="Name" id="name"  name="s_name" >
        <div class="check_div" id="name_check" value=""></div>

        <div class="sign_name">생년월일<span class="a">*</span></div>
        <input class="inf2" type="text" placeholder="년(4자)" id="s_birth_y" name="s_birth_y" maxlength="4"  >

        <select class="inf2" id="s_birth_m" name="s_birth_m" >
          <option value="" selected>월</option>
          <option value="01">1</option>
          <option value="02">2</option>
          <option value="03">3</option>
          <option value="04">4</option>
          <option value="05">5</option>
          <option value="06">6</option>
          <option value="07">7</option>
          <option value="08">8</option>
          <option value="09">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        <input class="inf2" type="text" placeholder="일" id="s_birth_d" name="s_birth_d" maxlength="2" >
        <div class="check_div" id="birth_check" value=""></div>

        <div class="gender">
          <div class="sign_name">성별<span class="a">*</span></div>
          <select class="form_select" name="s_gender" id=s_gender >
            <option value="">성별</option>
            <option value="남성">남성</option>
            <option value="여성">여성</option>
          </select>
        </div>
        <div class="check_div" id="gender_check" value=""></div>

        <div class="inf2">연락처<span class="a">*</span></div>
        <select class="inf2" id="s_tel1" name="s_tel1" >
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
        <input type="text" class="inf_tel" id="s_tel2" name="s_tel2"  maxlength="4">
        -
        <input type="text" class="inf_tel" id="s_tel3" name="s_tel3"  maxlength="4">

        <input class="inf_v" type="text" placeholder="인증번호 입력하세요. "id="verify_p_num" name="verify_p_num" disabled="">
        <input class="btn_e" id="btn_phone" type="button" value="인증번호 전송">
        <div class="check_div" id="phonenum_check" value=""></div>
        <div class="verify">
          <div class="sign_name">이메일<span class="a">*</span></div>
          <!--인증번호를 전송할 이메일 기입창과 전송 버튼-->
          <input class="inf1" type="email" placeholder="email "id="s_email" name="s_email"  >
          <!-- <input class="btn_e" id="btn_email" type="button" value="인증번호 전송"> -->
          <!--인증번호 기입란-->
          <!-- <input class="inf1" type="text" placeholder="인증번호 입력하세요. "id="verify_num" name="verify_num" disabled=""> -->
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
