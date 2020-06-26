<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/locate.css">
  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

</head>

<body>
  @include('lib.header')
  <div class="menu4">
    <h3 align="center">마이페이지</h3>
    <hr align="left" class="one">
  </hr>
</div>
<div class="myinfo">
  <h4>내 정보</h4>
  <style media="screen">
  div.tdcell{
    padding: 10px 0 10px 30px;
    margin: 0;
    text-align: left;
  }
  div.thcell{
    padding: 30px;
    border-right: 1px solid #e5e5e5;
    background: #f9f9f9;
    text-align: left;
    letter-spacing: -1px;
  }
  div#show{
    padding-left: 32px;
  }
  </style>
  <div class="privacy">
    <table border="0" table class="table1" >

      @if($seller = auth()->guard('seller')->user())

        <tbody>
          <tr class="tr1">
            <th class="th1">
              <div class="thcell">아이디</div>
            </th>
            <td>
              <div class="tdcell"><p class="contxt.tit">{{$seller->s_id}}</p></div>
            </td>
          </tr>
          <form action="/modipw" method="post" onsubmit="return pw_checkform()">
            @csrf
            <tr class="tr1">
              <th class="th1">
                <div class="thcell">비밀번호</div>
              </th>
              <td>
                <div class="tdcell"><p class="contxt.tit"><input type="button" id=modipw value="비밀번호수정" name="modi" display="block" onclick="info_modification(this.value,'p_pw' );"></button></p></div>
                <div id="p_pw" style="display:none;">
                  <input type="password" id="new_pw" name="new_pw"  placeholder="새 비밀번호">
                  <button type="submit" name="button">수정완료</button>
                </div>
              </td>
            </tr>
          </form>

          <tr class="tr1">
            <th class="th1">
              <div class="thcell">이름</div>
            </th>
            <td>
              <div class="tdcell"><p class="contxt.tit">{{$seller->s_name}}</p></div>
            </td>
            <form action="/information_controller"  onsubmit="return phonenum_checkform()" method="post">
              @csrf
            </tr>
            <tr class="tr1">
              <th class="th1">
                <div class="thcell">연락처</div>
              </th>
              <td>
                <div class="tdcell"><p class="contxt.tit">{{$seller->s_phonenum}}<input type="button" id=modinum value="연락처수정" name="modi" display="block" onclick="info_modification(this.value,'p_num' );"></button></p></div>

                <div id="p_num" style="display:none;">
                  <input type="text" name="new_num" name="new_num" placeholder="새 연락처">
                  <button type="submit" name="button">수정완료</button>
                </div>



                <script type="text/javascript">

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
                </script>

              </td>
            </tr>
          </form>
          <form action="/modiemail"  onsubmit="return email_checkform()" method="post">
            @csrf

            <tr class="tr1">
              <th class="th1">
                <div class="thcell">이메일</div>
              </th>
              <td>
                <div class="tdcell"><p class="contxt.tit">{{$seller->s_email}}<input type="button" id=modiemail value="이메일수정" name="modi" display="block" onclick="info_modification(this.value,'email' );"></p></div>
                <div id="email" style="display:none;">
                  <input type="text" id="new_email" name="new_email"  placeholder="새 이메일">
                  <button type="submit" name="button">수정완료</button>
                </div>

              </td>
            </tr>
          </form>
        </tbody>
      </table>
    @endif
    @if(auth()->guard('seller')->user())
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
    @endif
  </div>
</div>
@include('lib.footer')
</body>





<script type="text/javascript">
var tabButtons=document.querySelectorAll(".tabContainer .buttonContainer button");
var tabPanels=document.querySelectorAll(".tabContainer  .tabPanel");

function showPanel(panelIndex,colorCode) {
  tabButtons.forEach(function(node){
    node.style.backgroundColor="";
    node.style.color="";
  });
  tabButtons[panelIndex].style.backgroundColor=colorCode;
  tabButtons[panelIndex].style.color="white";
  tabPanels.forEach(function(node){
    node.style.display="none";
  });
  tabPanels[panelIndex].style.display="block";
  tabPanels[panelIndex].style.backgroundColor=colorCode;
}
showPanel(0,'gray');

function show_popup() {
  var rev_pop = window.open("/review", "리뷰팝업창", "width=550px, height=680px, left=570px, top=150px "); }
  </script>

  </html>
  <!--POST API Link -->
  <script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
  <script type="text/javascript" src="/js/radio.js" charset="utf-8"></script>

  <script type="text/javascript">
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

  function phonenum_checkform(){
    var phonenum = document.getElementById("new_num");
    var regExp = /^\d{3,4}\d{3,4}\d{4}$/;


  if(!regExp.test(phonenum.value)){
    alert("전화번호를 정확하게 입력해주세요");
    return false;
  }
  else{
    alert("변경되었습니다");
    return true;
  }
  }

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
