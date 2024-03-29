<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/c_mypage.css">
  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

</head>
<!-- 정경진 -->
<body>
  @include('lib.header')
  <div class="myinfo">
    <div class="privacy">
      <div class="mytitle">내 정보 관리</div>
      <table border="0" table class="table" id="shopinfo">
        @if($seller = auth()->guard('seller')->user())

          <tbody>
            <tr class="tr1">
              <th class="th1">아이디</th>
              <td>
                <div class="tdcell"><p class="contxt.tit">{{$seller->s_id}}</p></div>
              </td>
            </tr>
            <tr class="tr1">
              <th class="th1">비밀번호</th>
              <td>
                <div class="tdcell"><p class="contxt.tit"><input class="pw" type="password" id="origin_password" name="origin_password"  placeholder="기존 비밀번호를 입력해주세요.">
                  <input class="lg_bt" type="button" onclick="check_password()" value="확인"></div>
                  <div class="check_div" id="password_check" value=""></div>

                  <form action="modipw" method="post" onsubmit="return pw_checkform()">
                    @csrf
                    <div class="tdcell"><input class="pw" type="password" id="new_pw" name="new_pw" disabled  placeholder="새 비밀번호">
                      <button type="submit" name="button">수정완료</button>
                      <p class="contxt.tit"></p>
                    </div>
                  </form>
                </td>
              </tr>

              <tr class="tr1">
                <th class="th1">이름</th>
                <td>
                  <div class="tdcell"><p class="contxt.tit">{{$seller->s_name}}</p></div>
                </td>
              </tr>
              <form action="information_controller"  onsubmit="return s_phonenum_checkform()" method="post">
                @csrf
                <tr class="tr1">
                  <th class="th1">연락처</th>
                  <td>
                    <div class="tdcell"><p class="contxt.tit">{{$seller->s_phonenum}}<input type="button" id=modinum value="연락처수정" name="modi" display="block" onclick="info_modification(this.value,'p_num' );"></button></p></div>

                    <div id="p_num" style="display:none;">
                      <strong class="info">전화번호</strong>
                      <select name="phone_no1"  id="delivery_tel_no1" class="delivery_tel">
                        <option value="010">010</option>
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
                      <input type="text" title="휴대폰 중간번호" name="delivery_tel_no2" id="delivery_tel_no2" class="delivery_tel" maxlength="4">
                      -
                      <input type="text" title="휴대폰 뒷자리" name="delivery_tel_no3" id="delivery_tel_no3" class="delivery_tel" maxlength="4">
                      <button type="submit" name="button">수정완료</button>
                    </div>
                  </td>
                </tr>
              </form>

              <form action="modiemail"  onsubmit="return email_checkform()" method="post">
                @csrf
                <tr class="tr1">
                  <th class="th1">이메일</th>
                  <td>
                    <div class="tdcell"><p class="contxt.tit">{{$seller->s_email}}<input type="button" id=modiemail value="이메일수정" name="modi" display="block" onclick="info_modification(this.value,'email' );"></p></div>
                    <div id="email" style="display:none;">
                      <input type="text" id="new_email" name="new_email"  placeholder="새 이메일">
                      <button type="submit" name="button">수정완료</button>
                    </div>
                  </td>
                </tr>
              </form>
              @if($seller->s_approval == '미승인')
                <tr class="tr1">
                  <th class="th1">사업자등록증</th>
                  @foreach ($sellerstore as $st)
                    @if(isset($st->registration_img))
                      <td>사업자등록증을 검토중입니다.</td>
                    @else
                      <td>
                        <form action="/registration" method="post"  enctype="multipart/form-data">
                          @csrf
                          <div class="tdcell">
                            <input type="file" name="registration" id="registration" class="my_img" accept="image/*" >
                            <input type="submit" onclick="check()" value="등록">
                          </div>
                        </form>
                      </td>
                    @endif
                  @endforeach
                </tr>
              @endif
            </tbody>
          @endif
        </table>
      </div>
    </div>
    {{-- @if(auth()->guard('seller')->user())
    <div class="quickbuttonwrap">
    <div class="quickgroup"><a href="/locate1">
    <div class="quickbutton">
    <img src="/imglib/orangerose.jpg" alt="" height="200px" width="300px;">
    <div class="innerbutton">
    <h1>내 주변 꽃집</h1>
  </div>
</div>
</div>
<div class="quickgroup"><a href="/sellermyorderlist">
<div class="quickbutton">
<img src="imglib/rose.jpg" alt="" height="200px" width="300px;">
<div class="innerbutton">
<h1>내 주문관리</h1>
</div>
</div>
</div>
</div>
@endif --}}
@include('lib.footer')
</body>
</html>
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function check_password(){
  var a = document.getElementById("origin_password");

  if((a.value)==""){
    $('#password_check').text("Password를 입력해주세요.");
    $('#password_check').css('color', 'red');
    $("#origin_password").focus();
    $("#new_pw").attr("disabled", "disabled")
    return false;
  }

  var origin_password = $('#origin_password').val();
  $.ajax({

    type: 'post',
    url: 'check_pw',
    dataType: 'json',
    data:{
      "input_password" : origin_password
    },

    success : function(data) {
      if(data==0){
        $('#password_check').text("Password가 일치하지 않습니다.");
        $('#password_check').css('color', 'red');
        $("#origin_password").focus();
        $("#new_pw").attr("disabled", "disabled");
      }
      else if(data==1){
        document.getElementById('password_check').style.display="none";
        $("#new_pw").removeAttr("disabled");
        $("#new_pw").focus();
        $("#origin_password").attr("disabled", "disabled");
      }
    }
    ,error : function()
    {}
  });
}


//버튼 클릭이벤트
function info_modification(s,ss){
  if(s == "연락처수정"){
    document.getElementById(ss).style.display="block"
    modinum.style.display="none";
  }
  else if(s == "이메일수정"){
    document.getElementById(ss).style.display="block"
    modiemail.style.display="none";
  }
  else if(s == "주소수정"){
    document.getElementById(ss).style.display="block"
    modiaddress.style.display="none";
  }
  else if(s == "비밀번호수정"){
    document.getElementById(ss).style.display="block"
    modiaddress.style.display="none";
  }
}

//비밀번호 정규식
function pw_checkform(){
  var regex = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;
  var password = document.getElementById("new_pw");

  if(!regex.test(password.value)){
    alert(' 문자 / 숫자를 포함한 8~16자리 이내의 비밀번호를 입력해주세요');
    return false;
  }
  else{
    alert('변경되었습니다');
    return true;
  }
}

//전화번호 정규식
function s_phonenum_checkform(){
  var special = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var middlenum = document.getElementById("delivery_tel_no2");
  var lastnum = document.getElementById("delivery_tel_no3");
  var num =  /^[0-9]{3,4}$/;
  // var regExp = /^\d{3,4}\d{3,4}\d{4}$/;
  // var phonenum = document.getElementById("new_num");
  if(!num.test(middlenum.value)){
    alert('중간 4자리의 숫자를 입력해주세요');
    return false;
  }
  if(special.test(middlenum.value)){
    alert('숫자만 입력해주세요.');
    return false;
  }
  if(!num.test(lastnum.value)){
    alert('뒤 4자리의 숫자를 입력해주세요');
    return false;
  }
  if(special.test(lastnum.value)){
    alert('숫자만 입력해주세요.');
    return false;
  }
  else {
    alert("변경되었습니다");
    return true;
  }
}

//이메일 정규식
function email_checkform(){
  var email = document.getElementById("new_email");
  var emailcheck = /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/
  if(!emailcheck.test(email.value)){
    alert("올바른 형식의 이메일을 입력해주세요");
    return false;
  }
  else{
    alert("변경되었습니다");
    return true;
  }
}
</script>
