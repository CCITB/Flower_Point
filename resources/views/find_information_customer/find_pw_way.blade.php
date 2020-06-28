<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>비밀번호 찾기</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/find.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">

</head>
<body>
  <div id="all">
    <div class="text">
      <div class="id_title">Find Password</div> <hr>
    </div>
    <div class ="find_pw_way">
      <input type="radio" name="chk" checked="checked" id="chk_email" value="1"> 본인확인 이메일로 인증({{$mymail}})
      <div class="fd_id" id="find_email" value="a" style="display:block;">
        <div class="massage">*본인확인 이메일 주소와 입력한 이메일 주소가 같아야, 인증번호를 받을 수 있습니다</div>
        <form action = '/f_way_customer' name='emailform' method='post' onsubmit="return check_pw_way_customer()">
          @csrf
          <div class="fd_id">
            <input type="hidden" name="hidden_email" id="hidden_email" value="">
            <input type="hidden" name="hidden_no" id="hidden_no" value="">

            <div class="character"></div>
            <div class="window">
              <div class="ip_name">이름</div>
              <input class="find_input" placeholder="이름을 입력하세요." name="name" id='name1'>
              <div class="check_div" id="name_check" value=""></div>
              <div class="verify">
                <!--이메일 : 어지수-->
                <div class="sign_name">이메일</div>
                <!--인증번호를 전송할 이메일 기입창과 전송 버튼-->
                <input class="inf3" type="email" placeholder="email "id="c_email" name="c_email"  >
                <input class="btn_e" id="btn_email_way_c" type="button" value="인증번호 전송">
                <!--인증번호 기입란-->
                <input class="inf1" type="text" placeholder="인증번호 입력하세요. "id="verify_num1" name="verify_num" disabled="">
                <div class="check_div" id="email_check" value=""></div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <br>
      <!--SMS 인증-->
      <input type="radio" name="chk" id="chk_sms" value="2"> 회원정보에 등록한 휴대전화로 인증
      <div class="find_phone" id="find_phone" value="b" style="display:none;">
        <div class="massage">* 회원가입시 사용한 휴대전화 번호와 입력한 휴대전화 번호가 같아야 인증번호를 받을 수 있습니다. </div>
        <form action="/customer_sms_check" method="post" name="fin_id" id="sms_form" onsubmit="return check_smsform_customer()">
          @csrf
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
        <input class="lg_bt" type="submit" value="다음">
      </div>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">
//find_pw에서 입력한 ID가 가진 email값 (find_pw_way page에서 입력하는 email과 동일한지 검사를 위해 가져옴)
var email = '{{$mymail}}';
var no = '{{$myno}}';
document.emailform.hidden_email.value = email;
document.emailform.hidden_no.value = no;
</script>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/find.js" charset="utf-8"></script>
