<!-- 곽승지 무단 수정 금지 -->
<!-- 화면 상단에 들어가는 검색 및 메뉴의 구성입니다. -->
<div id="headwrap">
  <div class="topheader">
    <div class="user-wrap">

      <div id="user">
        @if(session('iding')==false)
        <div class="login">
          <span>로그인</span>
          <div class="login-list">
            <a href="/login_customer">개인</a>
            <a href="/login_seller">판매자</a>
          </div>
        </div>
        <div class="login">
          <span>회원가입</span>
          <div class="login-list">
            <a href="/terms_customers">개인</a>
            <a href="/terms_sellers">판매자</a>
          </div>
        </div>
        @else
        <div class="login">
          <span><a href="/logout">로그아웃</a></span>
        </div>
        @endif
      </div>
    </div>

    <div id="block_container">
      <div id="header">
        <div id="block1">
          <h1><a href="/">꽃갈피</a></h1>
        </div>
        <div id="block2">
          <form class="headersearch">
            <input type="text" id="searchbar" placeholder="Search.." name="search">
            <label for="headersearch">
              <button type="submit"class="search-button">검색</button>
            </label>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="dropdown-wrap">
    <div id="dropdown-menu">
      <div class="dropdown">
        <button class="dropbtn" onclick="location.href = '/locate1'">내 주변 꽃집</button>
        <div class="dropdown-content">

        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn">전체 상품 보기</button>
        <div class="dropdown-content">

        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn"onclick="location.href = '/faq'">고객센터</button>
        <div class="dropdown-content">
          <a href="/myqna">문의관리</a>

        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn">마이페이지</button>
        <div class="dropdown-content">
          <a href="#">내 정보</a>
          <a href="#">내 꽃집 가기</a>
          <a href="#">나의 주문 관리</a>
        </div>
      </div>
    </div>
  </div>

  <!-- 사이드네비바 시작입니다 -->
  <div class="side-nav">
    <div class="topbtn" onclick="">
      <div class="topover">
        위로이동
      </div>

    </div>
    <div class="bottombtn" onclick="">
      <div class="bottomover">
        아래로 이동
      </div>
    </div>
    <div class="mainbtn" onclick="location.href='/'">
      <div class="mainover">
        메인페이지로 이동
      </div>
    </div>
  </div>
</div>

<style>
.topbtn{
  width: 30px;
  height: 30px;
  border: 1px solid black;
  margin-bottom: 5px;
  cursor: pointer;
  display: inline-block;
  position: relative;

}
.topbtn:hover .topover{
  display: block;
}
.topover{
  display: none;
  padding: 0 5px;
  height: 18px;
  position: absolute;
  right: 40px;
  border: 1px solid gray;
  top: 10px;
  text-align: center;
  white-space: nowrap;
}
.topbtn:hover{


}
.bottombtn{
  width: 30px;
  height: 30px;
  border: 1px solid black;
  margin-bottom: 5px;
  cursor: pointer;
  position: relative;

}
.bottombtn:hover .bottomover{
  display: block;
}
.bottombtn:hover{

}
.bottomover{
  display: none;
  padding: 0 5px;
  height: 18px;
  position: absolute;
  right: 40px;
  border: 1px solid gray;
  top: 10px;
  text-align: center;
  white-space: nowrap;
}
.mainbtn{
  width: 30px;
  height: 30px;
  border: 1px solid black;
  margin-bottom: 5px;
  cursor: pointer;
  position: relative;
}
.mainbtn:hover{

}
.mainbtn:hover .mainover{
  display: block;
}
.mainover{
  display: none;
  padding: 0 5px;
  height: 18px;
  position: absolute;
  right: 40px;
  border: 1px solid gray;
  top: 10px;
  text-align: center;
  white-space: nowrap;
}
.side-nav{
  position: fixed;
  right: 15px;
  font-size: 12px;
  z-index: 3;
}
/* html{
  scroll-behavior: smooth;
} */
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<script>
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
