<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/locate.css">
  <link rel="stylesheet" href="/css/shop.css">
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
    padding: 32px 31px 32px;
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
      <form action="/c_information_controller" method="get">
        @csrf
        @if ($customer = auth()->guard('customer')->user())
          <div id="tablewrap">
            <table id="shopinfo">
          <tbody>
            <tr class="tr1">
              <th class="th1">
                <div class="thcell">아이디</div>
              </th>
              <td>
                <div class="tdcell"><p class="contxt.tit">{{$customer->c_id}}</p></div>
              </td>
            </tr>

            <tr class="tr1">
              <th class="th1">
                <div class="thcell">이름</div>
              </th>
              <td>
                <div class="tdcell"><p class="contxt.tit">{{$customer->c_name}}</p></div>
              </td>
            </tr>
            <tr class="tr1">
              <th class="th1">
                <div class="thcell">연락처</div>
              </th>
              <td>
                <div class="tdcell"><p class="contxt.tit">{{$customer->c_phonenum}}<input type="button" id=modinum value="연락처수정" name="modi" display="block" onclick="info_modification(this.value,'p_num' );"></button></p></div>

                <div id="p_num" style="display:none;">
                  <input type="text" id="new_num" name="c_phonenum"  placeholder="새 연락처">
                  <button type="submit" onsubmit="return checkform()" name="button">수정완료</button>
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
                }
                </script>

              </td>
            </tr>
          </form>
          <form action="/c_modiemail" method="get">
            @csrf

            <tr class="tr1">
              <th class="th1">
                <div class="thcell">이메일</div>
              </th>
              <td>
                <div class="tdcell"><p class="contxt.tit">{{$customer->c_email}}<input type="button" id=modiemail value="이메일수정" name="modi" display="block" onclick="info_modification(this.value,'email' );"></p></div>
                <div id="email" style="display:none;">
                  <input type="text" name="c_email"  placeholder="새 이메일">
                  <button type="submit" name="button">수정완료</button>
                </div>

              </td>
            </tr>
          </form>


          <form action="/c_newaddress" method="get">
            @foreach ($data as $a)
              <tr>
                <th>주소</th>
                <td>{{$a->a_address}}<input type="button" id=modiaddress value="주소수정" name="introduce" display="block" onclick="div_show(this.value,'addresswrap' );"></td>
              </tr>
              <tr>
                <th>우편번호</th>
                <td>{{$a->a_post}}</td>
              </tr>
              <tr>
                <th>참고항목</th>
                <td>{{$a->a_extra}}</td>
              </tr>
              <tr>
                <th>상세주소</th>
                <td>{{$a->a_detail}}</td>
              </tr>
              </div>
            @endforeach
          </form>
        </table>


          <form action="/c_newaddress" method="get">
            <div id="addresswrap" style="display:none;">
              <div id="addressmodi">
                <div class="delivery_wrap">
                  <strong class="info">주 소</strong>
                  <!-- 우편번호 -->
                  <input type="text" id="postcode" name="postcode" placeholder="우편번호" readonly>
                  <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                </div>
                <!--주소 -->
                <div class="delivery_wrap2">
                  <input type="text"  id="address" name="address" placeholder="주소" readonly>
                  <div class="detail">
                    <input type="text" class="delivery_address_list" name="extraAddress"id="extraAddress" placeholder="참고항목" readonly>
                  </div>
                  <div class="delivery_address_detail">
                    <input type="text" class="delivery_address_list" name="detailAddress" id="detailAddress" placeholder="상세주소" >
                  </div>
                </div>
              </div>
              <button type="submit" id="complete1" name="button" >수정완료</button>
            </div>
          </form>
          <script type="text/javascript">
          function div_show(s,ss){
            if(s == "주소수정"){
              document.getElementById(ss).style.display="block";
              ad.style.display="none";
              complete1.style.display="block";
              addresswrap.style.display="block";
            }
          }
        </script>
      </tbody>

    </table>
    <div class="tablespace2">
      <h4 align="left">즐겨찾기</h4>
      <div class="tabContainer">
        <div class="buttonContainer">
          <button onclick="showPanel(0,'gray')">꽃</button>
          <button onclick="showPanel(1,'gray')">가게</button>
        </div>
        <div class="tabPanel">
          <div class="panelbox">
            <ul class="list_item">
              <li class="list_item2">
                <a href="#">
                  <div class="imagebox">
                    <img src="dummy.jpg" alt="꽃사진" align="left">
                  </div>
                  <div class="box_information">
                    <div class="text_name">장미</div>
                    <div class="box_price">111111</div>
                  </div>
                </a>
              </li>
              <li class="list_item2">
                <a href="#">
                  <div class="imagebox">
                    <img src="dummy.jpg" alt="꽃사진" align="left">
                  </div>
                  <div class="box_information">
                    <div class="text_name">백합</div>
                    <div class="box_price">22222</div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="tabPanel">
          <div class="panelbox">
            <ul class="list_item">
              <li class="list_item2">
                <a href="#">
                  <div class="imagebox">
                    <img src="dummy.jpg" alt="가게사진" align="left">
                  </div>
                  <div class="box_information">
                    <div class="text_name">가게이름</div>
                    <div class="box_price">ㅁㄴㄻㄴㄹ</div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="tablespace3">
      <h4 align="left">나의 주문 현황</h4>

      <table class="myorder">
        <tr>
          <td>기간별조회</td>
          <td><button class="period">1주일</button></td>
          <td><button class="period">1개월</button></td>
          <td><button class="period">3개월</button></td>
          <td><input type="date"></td>
          <td><button>조회</button></td>
        </tr>
        <table border="1" width="100%">
          <tr>
            <th>주문번호</th>
            <th>상황정보</th>
            <th>구매금액</th>
            <th>주문처리상태</th>
            <th></th>
          </tr>
          <tr>
            <td>1</td>
            <td>장미특가</td>
            <td>3000원</td>
            <td>cj대한통운</td>
            <td><input type="button" value="구매후기" onclick="show_popup()"></td>
          </tr>
          <tr>
            <td>2</td>
            <td>장미</td>
            <td>4000원</td>
            <td>cj대한통운</td>
            <td></td>
          </tr>
          <tr>
            <td>1</td>
            <td>안개꽃</td>
            <td>5000원</td>
            <td>cj대한통운</td>
            <td></td>
          </tr>
        </table>
      </table>
    </div>
    <div class="tablespace4">
      <h4 align="left">마일리지</h4>
      <table class="mileage">
        <table border="1" width="100%">
          <tr>
            <th>쿠폰0장</th>
            <th>적립금0원</th>
            <th>사용내역보기</th>
          </tr>
        </table>
      </table>
    </div>
    <div class="tablespace5">
      <h4 align="left">나의후기</h4>
      <table class="myreview">
        <table border="1" width=100%>
          <tr>
            <th>상품평</th>
            <th>후기</th>
          </tr>
          <tr>
            <th>a</th>
            <td>b</td>
          </tr>
          <tr>
            <th>c</th>
            <td>d</td>
          </tr>
          <tr>
            <th>e</th>
            <td>f</td>
          </tr>
        </table>
      </table>
    </div>
  </div>

@endif
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
