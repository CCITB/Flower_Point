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
</div>
<style>

</style>
