<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/locate.css">
    <title>내 주변 꽃집</title>
</head>
<body>
    <div class="main-menu">
        <div class="menu2">
            <div class="header">
                <!--로그인,회원가입-->
                <a href="#">로그인</a>
                <a href="#">회원가입</a>
            </div>
            <div class="main">
                <!--이름, 검색창-->
                <div class="logo">
                    <!--꽃갈피 로고-->
                    <h1><a href="http://laravel.site/locate">꽃갈피</h1>
                </div>
                <form id="searchbar">
                    <!--검색창-->
                    <div class="box1">
                        <!--검색 입력-->
                        <input id="search-box" type="text" placeholder="Search...">
                        <span class="searchbar-btn"></span>
                        <!--찾기버튼-->
                        <button class="btn btn-secondary" type="button">검색</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="menu3">
            <div class="btn-group">
                <button class="dropbtn">내주변꽃집</button>
                <button class="dropbtn">전체상품보기</button>
                    <button class="dropbtn">고객센터</button>
                    <div class="dropdown-content">
                        <a href="#">자주묻는질문</a>
                        <a href="#">나의QnA</a>
                    </div>
                    <button class="dropbtn">마이페이지</button>
                    <div class="dropdown-content">
                        <a href="#">내정보</a>
                        <a href="#">마일리지</a>
                    </div>
                </div>
            </div>
        <div class="menu4"><!--탑헤더 밑-->
            <h3>내 주변 꽃집</h3>
            <hr align="left" class="one">
            </hr>
            <div class="dropdown2">
              <!-- onclick, call the Vanilla function for this one -->
              <button onclick="myFunction(this);" class="dropbtn2">시/도</button>
              <div id="myDropdown1" class="dropdown2-content">
                <a href="#home">서울시</a>
                <a href="#about">부산시</a>
                <a href="#contact">경기도</a>
              </div>
            </div>
            <!-- Added 2nd dropdown ! -->
            <div class="dropdown2">
              <!-- onclick, call the jQuery function for this one -->
              <button onclick="myJQueryFunction(this);" class="dropbtn2">군/구</button>
              <div id="myDropdown2" class="dropdown2-content">
                <a href="#home">서대문구</a>
                <a href="#about">종로구</a>
                <a href="#contact">은평구</a>
              </div>
            </div>
            <hr align="left" class="one">
            </hr>
        </div>
        <div class="menu5">
            <div class="shopname">
                <h3>ccit3</h3>
                <p>서울시 종로구 익선동</p>
                <hr align="left" class="one">
                </hr>
            </div>
            <div class="shopimg">
                <img src="img/dummy.png">
            </div>
            <div class="shopname">
                <h3>ccit2</h3>
                <p>서울시 종로구</p>
                <hr align="left" class="one">
                </hr>
            </div>
            <div class="shopname">
                <h3>ccit1</h3>
                <p>서울시 종로구~~~</p>
                <hr align="left" class="one">
                </hr>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
function myJQueryFunction(element) {
  var elements = ".dropdown2-content";
  $(elements).removeClass('show');
  $(element).next(elements).toggleClass("show");
}

/* Javascript only */
function myFunction(element) {
  var dropdowns = document.getElementsByClassName("dropdown2-content");
  var i;
  for (i = 0; i < dropdowns.length; i++) {
    dropdowns[i].classList.remove('show');
  }
  // element.nextSibling is the carriage return… need to go to the next next to point on the dropdown menu
  element.nextSibling.nextSibling.classList.toggle("show");
}

/* W3Schools function to close the dropdown when clicked outside. */
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn2')) {
    var dropdowns = document.getElementsByClassName("dropdown2-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
