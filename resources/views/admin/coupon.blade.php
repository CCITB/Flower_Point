<!DOCTYPE html>
{{-- 관리자의 상품 세부관리 페이지 -- 박소현 --}}
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
  <link rel="stylesheet" href="/css/ad_coupon.css">

</head>

<body>
  <section id="container">

    @include('admin.ad_header')

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> 쿠폰 발급 및 관리</h3>
        <div class="row mt">
          <div class="col-lg-12">


            <div class="coupon_add">

              <form action="/cop" method="post">
                @csrf
                <table class="c_table">
                  <tr class="c_add">
                    <td class="td" colspan="2"><span class="add">쿠폰 생성</span>
                      <button type="submit" name="submit" id="submit">발급</button>
                      <button type="button" name="button" id="ca">계산</button>
                      <input id="price" value="20000">
                      <input id="result" value="">
                    </td>
                  </tr>
                  <tr class="c_name">
                    <th class="th">쿠폰명</th>
                    <td class="td"><input class="c_title" name="c_title" id="c_title"></td>
                  </tr>
                  <tr class="c_mini">
                    <th class="th">사용제한 결제금액</th>
                    <td class="td"><input class="c_minimum" name="c_minimum" id="c_minimum"> 원 이상 결제 시 사용가능</td>
                  </tr>
                  <tr class="cp_flat">
                    <th class="th">최대 할인금액</th>
                    <td class="td">최대 <input class="c_flat" name="c_flat" id="c_flat"> 원 까지 할인</td>
                  </tr>
                  <tr class="c_date">
                    <th class="th">발급제한</th>
                    <td class="td"><input type="date" name="start" id="start"> ~ <input type="date" name="end" id="end"></td>
                  </tr>
                </table>
              </form>

            </div>



            <div class="">
              <table id="coupon" class="display">
                <thead>
                  <tr>
                    <th>쿠폰명</th>
                    <th>사용제한 결제금액</th>
                    <th>최대 할인금액</th>
                    <th>발급제한</th>
                    <th>발급 여부</th>
                    <th>발급</th>
                  </tr>
                </thead>
                <tbody>

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
  <script>

  $('#ca').click(function(){
    var price = $('#price').val();
    var mini = $('#c_minimum').val();
    var flat = $('#c_flat').val();

    if(price >mini){
      result = price - flat;
      $('#result').val(result);
      console.log(total);
    } else{
      alert("적용할 수 없습니다.");
    }
  });

  $(document).ready(function(){

    $("#submit").click(function(){
      if($("#c_title").val() == 0){
        alert("쿠폰명을 입력하세요.");
        $("#c_title").focus();
        return false;
      }
      if($("#c_minimum").val() == 0){
        alert("사용제한 결제금액을 입력하세요.");
        $("#c_minimum").focus();
        return false;
      }
      if($("#c_flat").val() == 0){
        alert("최대 할인금액을 입력하세요.");
        $("#c_flat").focus();
        return false;
      }
      if($("#start").val() == 0){
        alert("발급제한을 입력하세요.");
        $("#start").focus();
        return false;
      }
      if($("#end").val() == 0){
        alert("발급제한을 입력하세요.");
        $("#end").focus();
        return false;
      }else{
        alert("발급되었습니다.");
      }
    });
  });


  $(document).ready(function(){
    $("#coupon").DataTable({
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
