<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/locate.css">
</head>

<body>
  @include('header')
  <div class="menu4">
    <h3 align="center">마이페이지</h3>
    <hr align="left" class="one">
  </hr>
</div>
<div class="myinfo">
  <h4>내 정보</h4>
  <div class="privacy">
    <div class="tablespace">
      <table class="table1">
        <table border="0" cellpadding="10" cellspacing="10" width="100%">
          <tr>
            <th>ID</th>
            <td contenteditable='true'>asd</td>
          </tr>
          <tr>
            <th>PW</th>
            <td contenteditable='true'>******</td>
          </tr>
          <tr>
            <th>이름</th>
            <td contenteditable='true'>정경진</td>
          </tr>
          <tr>
            <th>연락처</th>
            <td contenteditable='true'>*****</td>
          </tr>
          <tr>
            <th>이메일</th>
            <td contenteditable='true'>asdsad@naver.com</td>
          </tr>
          <tr>
            <th>주소</th>
            <td contenteditable='true'>ㅁㄴㄹㄴㅁㄹㄴㅁㄹ</td>
          </tr>
        </table>
      </table>
      <button class="btn btn-primary">수정</button>
    </div>
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
            <td><input type="button" value="구매후기" onclick="show_popup()">
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
      <div class="nav-page">
        <nav>
          <a href="#" class="active">1</a>
        </nav>
        <nav>
          2
        </nav>
        <nav>
          3
        </nav>
        <nav>
          4
        </nav>
        <nav>
          5
        </nav>
      </div>
    </div>
  </div>
  @include('footer')
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
  var rev_pop = window.open("/review", "리뷰팝업창", "width=550px, height=650px, left=570px, top=150px "); }
  </script>
  </html>
