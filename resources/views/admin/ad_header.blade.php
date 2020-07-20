{{-- 관리자페이지 헤더 -- 박소현 --}}
<!--header start-->
<header class="header black-bg">
  <div class="sidebar-toggle-box">
    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
  </div>
  <!--logo start-->
  <a href="/ad_admin" class="logo"><b>꽃갈피<span> 관리페이지</span></b></a>
  <!--logo end-->

  <div class="top-menu">
    <ul class="nav pull-right top-menu">
      <li style="float:left;"><a class="logout" href="/">꽃갈피 메인가기</a></li>
      <li style="float:left;"><button class="logout" style="outline:0;">LogOut</button></li>
    </ul>
  </div>
</header>
<!--header end-->

<!--sidebar start-->
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <h5 class="centered">관리자 페이지</h5>
      {{-- <li class="mt">
        <a class="active" href="/ad_admin">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
          </a>
      </li> --}}
      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-book"></i>
          <span class="head_title"><strong>사용자 관리</strong></span>
          </a>
        <ul class="sub">
          <li class="head_sub_title"><a href="/ad_customer">구매자 관리</a></li>
          <li class="head_sub_title"><a href="/ad_seller">판매자 관리</a></li>
          <li class="head_sub_title"><a href="/ad_product">상품 세부관리</a></li>
          {{-- <li><a href="faq.html">FAQ</a></li> --}}
        </ul>
      </li>
      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-th"></i>
          <span class="head_title"><strong>Coupon</strong></span>
          </a>
        <ul class="sub">
          <li class="head_sub_title"><a href="/ad_coupon">쿠폰 발급</a></li>
        </ul>
      </li>
      {{-- <li class="sub-menu">
        <a href="javascript:;">
          <i class=" fa fa-bar-chart-o"></i>
          <span>Charts</span>
          </a>
        <ul class="sub">
          <li><a href="morris.html">Morris</a></li>
          <li><a href="chartjs.html">Chartjs</a></li>
          <li><a href="flot_chart.html">Flot Charts</a></li>
          <li><a href="xchart.html">xChart</a></li>
        </ul>
      </li> --}}
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->
