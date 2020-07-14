<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>


  <!-- 곽승지 무단 수정 금지 -->
  <!-- 화면 상단에 들어가는 검색 및 메뉴의 구성입니다. -->
  <div id="headwrap">
    <div class="topheader">
      <div class="user-wrap">
        <div id="user">
          @if($customer = auth()->guard('customer')->user())
            <div class="login">
              <span style="cursor:default;">안녕하세요 {{$customer -> c_name}} 님</span>
              <span><a href="/logout" style="color:black;">로그아웃</a></span>
            </div>
          @elseif($seller = auth()->guard('seller')->user())
            <div class="login">
              <span style="cursor:default;">안녕하세요 {{$seller -> s_name}} 님</span>
              <span><a href="/logout" style="color:black;">로그아웃</a></span>
            </div>
          @else
            <div class="login">
              <span>로그인</span>
              <div class="login-list">
                <a href="/login_customer" class="login_left">개인</a>
                <a href="/login_seller" class="login_right">판매자</a>
              </div>
            </div>
            <div class="login">
              <span>회원가입</span>
              <div class="login-list">
                <a href="/terms_customers" class="login_left">개인</a>
                <a href="/terms_sellers" class="login_right">판매자</a>
              </div>
            </div>

          @endif
          @if(auth()->guard('customer')->user())
            <span class="login" style="float:right;"><a href="/flowercart" style="color:black;">장바구니</a></span>
            <span class="charge" style="float:right;" style="color:black;" onclick="showPopup();">충전하기</span>
          @elseif(auth()->guard('seller')->user())
          @else
            <span class="login" style="float:right;"><a href="/flowercart" style="color:black;">장바구니</a></span>
          @endif
        </div>
      </div>
<<<<<<< HEAD
      <script type="text/javascript">
      function showPopup() {
        var url="charge_popup";
        var option="width=700, height=400, top=200"
        window.open(url, "", option);
      }
      </script>

      <div id="block_container">
        <div id="header">
          <div id="block1">
            <h1><a href="/" style="color:black">꽃갈피</a></h1>
          </div>
          <div id="block2">
            <form method="get" action="/search" class="headersearch">
              @csrf
              <input name="query" type="text" id="searchbar" placeholder="Search.." maxlength="255"
              autocomplete="off" >
              <label for="headersearch">
                <button type="submit"class="search-button">검색</button>
              </label>
            </form>
          </div>
=======
    </div>
    <div id="block_container">
      <div id="header">
        <div id="block1">
          <h1><a href="/" style="color:black">꽃갈피</a></h1>
        </div>
        <div id="block2">
          <form method="get" action="/search" class="headersearch">
            @csrf
            <input name="query" type="text" id="searchbar" placeholder="Search.." maxlength="255"
            autocomplete="off" >
            <label for="headersearch">
              <button type="submit"class="search-button">검색</button>
            </label>
          </form>
>>>>>>> 4be65e86160105aef3bb63256b6d2cfa9a649825
        </div>
      </div>
    </div>
    <div class="dropdown-wrap" id=dropdown_hover>
      <div id="dropdown-menu">
        <ul class="mainmenu-wrap">
          <li class="mainmenu" onmouseover="mouseOver();" onmouseout="mouseOut();">
            <a href="/locate1">내 주변 꽃집</a>
            <ul class="submenu_list">
              <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">#</a></li>
            </ul>
            <ul class="submenu_list">
              <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">#</a></li>
            </ul>
            <ul class="submenu_list">
              <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">#</a></li>
            </ul>
          </li>
          <li class="mainmenu" onmouseover="mouseOver();" onmouseout="mouseOut();">
            <a href="/all">전체 상품 보기</a>
            <ul class="submenu_list">
              <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">#</a></li>
            </ul>
            <ul class="submenu_list">
              <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">#</a></li>
            </ul>
            <ul class="submenu_list" >
              <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">#</a></li>
            </ul>
          </li>
          <li class="mainmenu" onmouseover="mouseOver();" onmouseout="mouseOut();">
            <a href="/faq">고객센터</a>
            @if(auth()->guard('seller')->user())
              <ul class="submenu_list">
                <li class="submenu"><a href="/seller_qna">문의관리</a></li>
              </ul>
              {{-- <ul class="submenu_list">
              <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">문의관리</a></li>
            </ul>
            <ul class="submenu_list">
            <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">문의관리</a></li>
          </ul> --}}
        </li>
      @elseif(auth()->guard('customer')->user())

        <ul class="submenu_list">
          <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">문의관리</a></li>
        </ul>
        <ul class="submenu_list">
          <li class="submenu" style="height:17.6px;"><a href="#" style="display:none;">문의관리</a></li>
        </ul>
      </li>
    @endif
    @if($se=auth()->guard('seller')->user())
      <li class="mainmenu" onmouseover="mouseOver();" onmouseout="mouseOut();" style="border-right:none;">
        <a href="#">마이페이지</a>
        <ul class="submenu_list">
          <li class="submenu"><a href="/s_mypage">내 정보</a></li>
            @if($se->s_approval == '승인')
              <li class="submenu"><a href="/shop">내 꽃집 가기</a></li>
              <li class="submenu"><a href="/sellermyorderlist">나의 주문 관리</a></li>
            @else
              <li class="submenu" onclick="fake()">내 꽃집 가기</a></li>
              <li class="submenu" onclick="fake()">나의 주문 관리</a></li>
            @endif

        </ul>
      </li>
    @elseif(auth()->guard('customer')->user())
      <li class="mainmenu" onmouseover="mouseOver();" onmouseout="mouseOut();" style="border-right:none;">
        <a href="#">마이페이지</a>
        <ul class="submenu_list">
          <li class="submenu"><a href="/c_mypage">내 정보</a></li>
          <li class="submenu"><a href="/star">즐겨찾기</a></li>
          <li class="submenu"><a href="/coupon">내쿠폰</a></li>
        </ul>
      </li>
    @else
      <li class="mainmenu" onmouseover="mouseOver();" onmouseout="mouseOut();" style="border-right:none;">
        <a href="#">마이페이지</a>
      </li>
    @endif
  </ul>
</div>
</div>
<div class="topmenu-list">

</div>
<style>
.dropdown-wrap{
  margin-bottom: 30px;
  transition: all 0.3s ease-in-out;
}
ul.submenu_list{
  padding: 0px;
}
ul{
  list-style: none;
}
ul.mainmenu-wrap{
  padding-left: 150px;
  overflow: hidden;
  transition: all 0.3s ease-in-out;
  margin: 0;
}
li.submenu{
  /* color: #a7acbc; */
  font-size: 13px;
  padding-top: 5px;
  padding-bottom: 5px;
  text-decoration: none;
  visibility:hidden;
  opacity: 0; /*찾아라*/
  transition: all 0.3s ease-in-out;
  display: none;
}
li.submenu:hover>a{
  color: #f68500;
  text-decoration: none;
  /*찾아라*/
  transition: all 0.3s ease-in-out;
  transform: scale(1.3,1.3);
}
li.mainmenu:hover>a{
  color: #f68500;

}
li.mainmenu{
  float: left;
  display: block;
  width: 20%;
  font-size: 22px;
  transition: all 0.3s ease-in-out;
  padding-top: 16px;
  padding-bottom: 16px;
  border-right:1px solid white;
  box-sizing: border-box;
  border-collapse: collapse;

}
.dropdown-back{
  background-color: #B2D0EB;
  z-index: 10;
  transition: all 0.3s ease-in-out;
  margin-bottom: 30px;
  border-radius: 0px 0px 50px 50px;
  box-shadow: 0 1px 6px 0 rgba(32,33,36,0.28);
  position: relative;
}
.dropdown-back li.submenu{
  display: block;
  /* margin-top: 2px;
  margin-bottom: 2px; */
  transition: all 0.3s ease-in-out;
  text-decoration: none;
  opacity: 1;
  visibility:visible;
}
.dropdown-back li.mainmenu>a{
  /* margin-bottom: 15px;
  margin-top : 15px; */
  display: inline-block;
  transition: all 0.3s ease-in-out;
  text-decoration: none;
  padding-bottom: 16px;

}
.dropdown-back li.submenu:hover{
  transform: scale(1.3,1.3);
}
li.mainmenu:hover{

}

</style>
<!-- 사이드네비바 시작입니다 -->
<div class="side-nav">
  <div class="mainbtn" onclick="location.href='/'">
    <img src="/imglib/mainicon.png" alt="">
    <div class="mainover">
      메인페이지로 이동
    </div>
  </div>
  <div class="topbtn" onclick="">
    <img src="/imglib/topbtn.png" alt="">
    <div class="topover">
      위로이동
    </div>
  </div>
  <div class="bottombtn" onclick="">
    <img src="/imglib/bottombtn.png" alt="">
    <div class="bottomover">
      아래로 이동
    </div>
  </div>
</div>
</div>

<style>


/* html{
scroll-behavior: smooth;
} */
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<script type="text/javascript">
function showPopup() {
  var url="charge_popup";
  var option="width=700, height=400, top=200"
  window.open(url, "", option);
 }
 </script>
<script>

function fake(){
  alert("사업자등록증이 미승인된 꽃집입니다.");
}

$(document).ready(function(){
  $(function () {
    $('.topbtn').click(function () {
      $('body,html').animate({
        scrollTop: 0
      }, 800);
      return false;
    });
    var scrollHeight = $(document).height();
    $('.bottombtn').click(function () {
      $('body,html').animate({
        scrollTop: scrollHeight
      }, 800);
      return false;
    });
  });

});
</script>
<script>
function mouseOver(){
  document.getElementById("dropdown_hover").className = "dropdown-back";
}
function mouseOut() {
  document.getElementById("dropdown_hover").className = "dropdown-wrap";
}
function mouseOut() {
  document.getElementById("dropdown_hover").className = "dropdown-wrap";
}
</script>
<script>
// $(document).ready(function() {
//   $('.mainmenu').mouseover(function(){
//     $('.dropdown-back').animate({opacity:"1"}, 100);
//   });
//   $('.mainmenu').mouseleave(function(){
//     $('.dropdown-wrap').animate({opacity:"1"}, 100);
//   });
// })
</script>



</body>
</html>
