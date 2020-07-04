<!DOCTYPE html>
{{-- 관리자 메인 dashboard -- 박소현 --}}
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>꽃갈피 관리자</title>


  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

</head>

<body>
  <section id="container">

    @include('admin.ad_header')

    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>USER VISITS</h3>
            </div>
            <div class="custom-bar-chart">
              <ul class="y-axis">
                <li><span>10.000</span></li>
                <li><span>8.000</span></li>
                <li><span>6.000</span></li>
                <li><span>4.000</span></li>
                <li><span>2.000</span></li>
                <li><span>0</span></li>
              </ul>
              <div class="bar">
                <div class="title">JAN</div>
                <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
              </div>
              <div class="bar ">
                <div class="title">FEB</div>
                <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
              </div>
              <div class="bar ">
                <div class="title">MAR</div>
                <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
              </div>
              <div class="bar ">
                <div class="title">APR</div>
                <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
              </div>
              <div class="bar">
                <div class="title">MAY</div>
                <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
              </div>
              <div class="bar ">
                <div class="title">JUN</div>
                <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
              </div>
              <div class="bar">
                <div class="title">JUL</div>
                <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
              </div>
            </div>
            <!--custom chart end-->
            <div class="row mt">
              <!-- SERVER STATUS PANELS -->
              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                    <h5>SERVER LOAD</h5>
                  </div>
                  <canvas id="serverstatus01" height="120" width="120"></canvas>
                  <script>
                  var doughnutData = [{
                    value: 70,
                    color: "#FF6B6B"
                  },
                  {
                    value: 30,
                    color: "#fdfdfd"
                  }
                ];
                var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                </script>
                <div class="row">
                  <div class="col-sm-6 col-xs-6 goleft">
                    <p>Usage<br/>Increase:</p>
                  </div>
                  <div class="col-sm-6 col-xs-6">
                    <h2>21%</h2>
                  </div>
                </div>
              </div>
              <!-- /grey-panel -->
            </div>
            <!-- /col-md-4-->
            <div class="col-md-4 col-sm-4 mb">
              <div class="darkblue-panel pn">
                <div class="darkblue-header">
                  <h5>DROPBOX STATICS</h5>
                </div>
                <canvas id="serverstatus02" height="120" width="120"></canvas>
                <script>
                var doughnutData = [{
                  value: 60,
                  color: "#1c9ca7"
                },
                {
                  value: 40,
                  color: "#f68275"
                }
              ];
              var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
              </script>
              <p>April 17, 2014</p>
              <footer>
                <div class="pull-left">
                  <h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
                </div>
                <div class="pull-right">
                  <h5>60% Used</h5>
                </div>
              </footer>
            </div>
            <!--  /darkblue panel -->
          </div>
          <!-- /col-md-4 -->
          <div class="col-md-4 col-sm-4 mb">
            <!-- REVENUE PANEL -->
            <div class="green-panel pn">
              <div class="green-header">
                <h5>REVENUE</h5>
              </div>
              <div class="chart mt">
                <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
              </div>
              <p class="mt"><b>$ 17,980</b><br/>Month Income</p>
            </div>
          </div>
          <!-- /col-md-4 -->
        </div>
        <!-- /row -->
        <div class="row">
          <!-- /col-md-4-->
          <!-- DIRECT MESSAGE PANEL -->
          <div class="col-md-8 mb">
          </div>
          <!-- /col-md-8  -->
        </div>

      </div>
      <!-- /col-lg-9 END SECTION MIDDLE -->
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->
      <div class="col-lg-3 ds">
        <!--COMPLETED ACTIONS DONUTS CHART-->
        <div class="donut-main">
          <h4>COMPLETED ACTIONS & PROGRESS</h4>
          <canvas id="newchart" height="130" width="130"></canvas>
          <script>
          var doughnutData = [{
            value: 70,
            color: "#4ECDC4"
          },
          {
            value: 30,
            color: "#fdfdfd"
          }
        ];
        var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
        </script>
      </div>
      <!--NEW EARNING STATS -->
      <div class="panel terques-chart">
        <div class="panel-body">
          <div class="chart">
            <div class="centered">
              <span>TODAY EARNINGS</span>
              <strong>$ 890,00 | 15%</strong>
            </div>
            <br>
            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
          </div>
        </div>
      </div>
      <!--new earning end-->
      <!-- CALENDAR-->
      <div id="calendar" class="mb">
        <div class="panel green-panel no-margin">
          <div class="panel-body">
            <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
              <div class="arrow"></div>
              <h3 class="popover-title" style="disadding: none;"></h3>
              <div id="date-popover-content" class="popover-content"></div>
            </div>
            <div id="my-calendar"></div>
          </div>
        </div>
      </div>
      <!-- / calendar -->
    </div>
    <!-- /col-lg-3 -->
  </div>
  <!-- /row -->
</section>
</section>
<!--main content end-->
<!--footer start-->
<footer class="site-footer">
  <div class="text-center">
    <p>
      &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
    </p>
    <div class="credits">
      <!--
      You are NOT allowed to delete the credit link to TemplateMag with free version.
      You can delete the credit link only if you bought the pro version.
      Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
      Licensing information: https://templatemag.com/license/
    -->
    Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
  </div>
  <a href="/ad_admin#" class="go-top">
    <i class="fa fa-angle-up"></i>
  </a>
</div>
</footer>
<!--footer end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="lib/jquery/jquery.min.js"></script>

<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="lib/jquery.scrollTo.min.js"></script>
<script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="lib/jquery.sparkline.js"></script>
<!--common script for all pages-->
<script src="lib/common-scripts.js"></script>
<script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="lib/gritter-conf.js"></script>
<!--script for this page-->
<script src="lib/sparkline-chart.js"></script>
<script src="lib/zabuto_calendar.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  var unique_id = $.gritter.add({
    // (string | mandatory) the heading of the notification
    title: 'Welcome to Dashio!',
    // (string | mandatory) the text inside the notification
    text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
    // (string | optional) the image to display on the left
    // image: 'img/ui-sam.jpg',
    // (bool | optional) if you want it to fade out on its own or just sit there
    sticky: false,
    // (int | optional) the time you want it to be alive for before fading out
    time: 8000,
    // (string | optional) the class name you want to apply to that specific message
    class_name: 'my-sticky-class'
  });

  return false;
});
</script>
<script type="application/javascript">
$(document).ready(function() {
  $("#date-popover").popover({
    html: true,
    trigger: "manual"
  });
  $("#date-popover").hide();
  $("#date-popover").click(function(e) {
    $(this).hide();
  });

  $("#my-calendar").zabuto_calendar({
    action: function() {
      return myDateFunction(this.id, false);
    },
    action_nav: function() {
      return myNavFunction(this.id);
    },
    ajax: {
      url: "show_data.php?action=1",
      modal: true
    },
    legend: [{
      type: "text",
      label: "Special event",
      badge: "00"
    },
    {
      type: "block",
      label: "Regular event",
    }
  ]
});
});

function myNavFunction(id) {
  $("#date-popover").hide();
  var nav = $("#" + id).data("navigation");
  var to = $("#" + id).data("to");
  console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
}
</script>
</body>

</html>
