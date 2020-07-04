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
      <li><a class="logout" href="login.html">Logout</a></li>
    </ul>
  </div>
</header>
<!--header end-->

<!--sidebar start-->
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <h5 class="centered">Sam Soffes</h5>
      <li class="mt">
        <a class="active" href="/ad_admin">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
          </a>
      </li>
      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-book"></i>
          <span>사용자 관리</span>
          </a>
        <ul class="sub">
          <li><a href="/ad_customer">구매자 관리</a></li>
          <li><a href="/ad_seller">판매자 관리</a></li>
          <li><a href="/ad_product">상품 세부관리</a></li>
          <li><a href="faq.html">FAQ</a></li>
        </ul>
      </li>
      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-th"></i>
          <span>Data Tables</span>
          </a>
        <ul class="sub">
          <li><a href="basic_table.html">Basic Table</a></li>
          <li><a href="responsive_table.html">Responsive Table</a></li>
          <li><a href="advanced_table.html">Advanced Table</a></li>
        </ul>
      </li>
      <li class="sub-menu">
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
      </li>
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->
