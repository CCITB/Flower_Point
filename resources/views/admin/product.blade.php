<!DOCTYPE html>
{{-- 관리자의 상품 세부관리 페이지 -- 박소현 --}}
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h3><i class="fa fa-angle-right"></i> 오늘 올라온 상품</h3>
        <div class="row mt">
          <div class="col-lg-12">


            <div class="se_table">
              <table id="product" class="display">
                <thead>
                  <tr>
                    <th>상품 고유번호</th>
                    <th>상품명</th>
                    <th>가격</th>
                    <th>가게 번호</th>
                    <th>가게 이름</th>
                    <th>판매자 이름</th>
                    <th>등록여부</th>
                    <th>삭제</th>
                    <th>등록</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($product as $sel)
                    <tr onclick="location.href='/product/{{$sel->p_no}}'">
                      <td>{{$sel->p_no}}</td>
                      <td>{{$sel->p_name}}</td>
                      <td>{{number_format($sel->p_price)}} 원</td>
                      <td>{{$sel->st_no}}</td>
                      <td>{{$sel->st_name}}</td>
                      <td>{{$sel->s_name}}</td>
                      <td>{{$sel->p_status}}</td>
                      <td>
                        <form name="delete" action="/ad_remove{{$sel->p_no}}" method="post">
                          @csrf
                          <input type="submit" name="remove" id="remove" value="삭제">
                          <input type="hidden" id="hidden" name="hidden" value="">
                        </form>
                      </td>
                      <td>
                        <form name="delete" action="/ad_restore{{$sel->p_no}}" method="post">
                          @csrf
                          <input type="submit" name="remove" id="remove" value="등록">
                          <input type="hidden" id="hidden" name="hidden" value="">
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>


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
$(document).ready(function(){
	$("#product").DataTable({
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
