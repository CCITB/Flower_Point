<!DOCTYPE html>
{{-- 관리자의 구매자 관리 페이지 -- 박소현 --}}
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Dashboard">
  <title>꽃갈피 관리자</title>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>


  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

</head>

<body>
  <section id="container">

    @include('admin.ad_header')

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h2><i class="fa fa-angle-right"></i> 구매자 관리</h2>
        <div class="row mt">
          <div class="col-lg-12">


            <table id="customer" class="display">
                <thead>
                    <tr>
                        <th>구매자 고유번호</th>
                        <th>아이디</th>
                        <th>이름</th>
                        <th>전화번호</th>
                        <th>이메일</th>
                        <th>성별</th>
                        <th>생일</th>
                        <th>포인트</th>
                        <th>포인트 지급</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($customer as $cus)
                    <tr>
                        <td style="width:10%;">{{$cus->c_no}}</td>
                        <td>{{$cus->c_id}}</td>
                        <td>{{$cus->c_name}}</td>
                        <td>{{$cus->c_phonenum}}</td>
                        <td>{{$cus->c_email}}</td>
                        <td>{{$cus->c_gender}}</td>
                        <td>{{$cus->c_birth}}</td>
                        <td>{{number_format($cus->c_point)}}P</td>
                        <td style="padding-left:20px;">
                          <button type="button" onclick="pointpop({{$cus->c_no}});">지급</button>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>

      </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">

        Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
      </div>
      <a href="/ad_customer#" class="go-top">
        <i class="fa fa-angle-up"></i>
      </a>
    </div>
  </footer>
  <!--footer end-->
</section>
<!-- js placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="lib/common-scripts.js"></script>
<script src="lib/jquery.scrollTo.min.js"></script>
<script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
<script>

var openWin;
function pointpop(cno)
{
  // window.name = "부모창 이름";
  window.name = "parentForm";
  // window.open("open할 window", "자식창 이름", "팝업창 옵션");
  openWin = window.open("/ad_point"+cno,
  "childpoint", "width=600px, height=200px, left=50px, top=50px ");
}

$(document).ready(function(){
	$("#customer").DataTable({
    "language": {
        "emptyTable": "데이터가 없습니다.",
        "lengthMenu": "페이지당 _MENU_ 개씩 보기",
        "info": "현재 _START_ - _END_ /  _TOTAL_건",
        "infoEmpty": "데이터 없음",
        "infoFiltered": "(전체  _MAX_건의 데이터에서 필터링됨 )",
        "search": "검색",
        "zeroRecords": "일치하는 데이터가 없습니다.",
        "loadingRecords": "로딩중...",
        "processing":     "잠시만 기다려 주세요...",
        "paginate": { "next": "다음", "previous": "이전"  }
      }
    });
});
</script>

</body>

</html>
