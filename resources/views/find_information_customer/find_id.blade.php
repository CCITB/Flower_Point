<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr"><head>
  <title>아이디 찾기</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/find.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&amp;display=swap" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

  <!--ID Email, SMS인증 : 어지수-->
<body>
  <div id="all">
    <div class="text">
      <div class="id_title">Find ID</div> <hr>
    </div>

    <div class="find_id">
      <!--Email 인증-->
      <input type="radio" name="chk" checked="checked" id="chk_email" value="1"> 회원정보에 등록한 이메일로 인증
        <div class="fd_id" id="find_email" value="a" style="display:block;">
          <div class="massage">* 회원가입시 사용한 이메일 주소와 입력한 이메일이 같아야 인증번호를 받을 수 있습니다. </div>
          <form action="/customer_email_check" method="post" name="fin_id" onsubmit="return checkfunction_customer()">
          <div class="character"> </div>
          <div class="window">
            <div class="name_size">이름</div>
            <input class="find_input" placeholder="이름을 입력하세요." name="name" id="name1">
            <div class="check_div" id="name_check1" value=""></div>

            <br>
            <div class="verify">
              <div class="name_size">이메일</div>
              <!--인증번호를 전송할 이메일 기입창과 전송 버튼-->
              <input class="inf3" type="email" placeholder="email " id="c_email" name="c_email">
              <input class="btn_e" id="btn_email_c" type="button" value="인증번호 전송">
              <!--인증번호 기입란-->
              <input class="inf1" type="text" placeholder="인증번호 입력하세요. " id="verify_num1" name="verify_num" disabled="">
              <div class="check_div" id="email_check" value=""></div>
            </div>
          </div>
        </div>
      </form>

      <br>
      <!--SMS 인증-->
      <input type="radio" name="chk" id="chk_sms" value="2"> 회원정보에 등록한 휴대전화로 인증
      <div class="find_phone" id="find_phone" value="b" style="display:none;">
        <div class="massage">* 회원가입시 사용한 휴대전화 번호와 입력한 휴대전화 번호가 같아야 인증번호를 받을 수 있습니다. </div>
        <form action="/customer_sms_check" method="post" name="fin_id" onsubmit="return checkfunction_customer()">
          <div class="name_size">이름</div>
          <input class="find_input" placeholder="이름을 입력하세요." name="name" id="name2">
          <div class="check_div" id="name_check2" value=""></div>

          <div class="name_size">연락처</div>
          <select class="inf_tel" id="c_tel1" name="c_tel1" >
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
          <input type="text" class="inf_tel" id="c_tel2" name="c_tel2"  maxlength="4">
          -
          <input type="text" class="inf_tel" id="c_tel3" name="c_tel3"  maxlength="4">
          <input class="btn_e" id="btn_phone_c" type="button" value="인증번호 전송">
          <!--인증번호 기입란-->
          <input class="inf1" type="text" placeholder="인증번호 입력하세요. " id="verify_num2" name="verify_num" disabled="">
          <div class="check_div" id="phonenum_check" value=""></div>
        </form>
      </div>

      <div class="under">
        <input class="lg_bt" id="id_bt" type="submit" value="찾기">
      </div>
  </div>


  <div class="bottom">
    <a href="/find_pw">비밀번호 찾기</a>
  </div>
  <div class="home">
    <a href="/">홈으로</a>
  </div>
</div>
<!--*************************<<예외처리 및 클릭 이벤트 : 어지수>>***********************-->
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/find.js" charset="utf-8"></script>
