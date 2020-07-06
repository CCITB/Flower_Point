<!DOCTYPE html>
{{-- 관리자의 판매자관리 페이지 -- 박소현 --}}
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
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

        <div class="se_table">
          <h3><i class="fa fa-angle-right"></i> 판매자 관리</h3><br>
          <table id="seller" class="display">
            <thead>
              <tr>
                <th>판매자 고유번호</th>
                <th>아이디</th>
                <th>이름</th>
                <th>전화번호</th>
                <th>이메일</th>
                <th>성별</th>
                <th>생일</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sellerall as $sel)
                <tr>
                  <td>{{$sel->s_no}}</td>
                  <td>{{$sel->s_id}}</td>
                  <td>{{$sel->s_name}}</td>
                  <td>{{$sel->s_phonenum}}</td>
                  <td>{{$sel->s_email}}</td>
                  <td>{{$sel->s_gender}}</td>
                  <td>{{$sel->s_birth}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="se_table">
          <h3><i class="fa fa-angle-right"></i> 가게 관리</h3><br>
          <table id="store" class="display">
            <thead>
              <tr>
                <th>가게 고유번호</th>
                <th>가게 이름</th>
                <th>가게 번호</th>
                <th>사업자등록번호</th>
                <th>가게 주소</th>
                <th>상세주소</th>
                <th>판매자 고유번호</th>
                <th>승인 여부</th>
                <th>승인</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sellerall as $sel)
                <tr>
                  <td onclick="location.href='product/store/{{$sel->st_name}}'">{{$sel->st_no}}</td>
                  <td>{{$sel->st_name}}</td>
                  <td>{{$sel->st_tel}}</td>
                  <td>{{$sel->st_registeration_num}}</td>
                  <td>{{$sel->a_address}}</td>
                  <td>{{$sel->a_detail}}</td>
                  <td>{{$sel->s_no}}</td>
                  <td>{{$sel->registration_status}}</td>
                  <td>
                    <button type="button" id="bt{{$sel->st_no}}" value="{{$sel->st_no}}" onclick="openChild({{$sel->st_no}})"name="hidden" >등록증보기</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>



        <div class="se_table">
          <h3><i class="fa fa-angle-right"></i> 상품 관리</h3><br>
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
        <a href="/ad_seller#" class="go-top">
          <i class="fa fa-angle-up"></i>
        </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="lib/jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->

  <script>

  var openWin;

  function openChild(stn)
  {
      // window.name = "부모창 이름";
      window.name = "parentForm";
      // window.open("open할 window", "자식창 이름", "팝업창 옵션");
      openWin = window.open("/ad_regst"+stn,
      "childForm", "width=550px, height=680px, left=570px, top=150px ");
  }



  $(document).ready(function(){
    $("#seller").DataTable({
      "language": {
        "emptyTable": "데이터가 없습니다.",
        "lengthMenu": "페이지당 _MENU_ 개씩 보기",
        "info": "현재 _START_ - _END_ / _TOTAL_건",
        "infoEmpty": "데이터 없음",
        "infoFiltered": "( 전체 _MAX_건의 데이터에서 필터링됨 )",
        "search": "검색",
        "zeroRecords": "일치하는 데이터가 없습니다.",
        "loadingRecords": "로딩중...",
        "processing":     "잠시만 기다려 주세요...",
        "paginate": { "next": "다음", "previous": "이전"  }
      }
    });
  });
  $(document).ready(function(){
    $("#store").DataTable({
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
  $(document).ready(function(){
    $("#product").DataTable({
      "language": {
        "emptyTable": "데이터가 없습니다.",
        "lengthMenu": "페이지당 _MENU_ 개씩 보기",
        "info": "현재 _START_ - _END_ /  _TOTAL_건",
        "infoEmpty": "데이터 없음",
        "infoFiltered": "(전체 _MAX_건의 데이터에서 필터링됨 )",
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
