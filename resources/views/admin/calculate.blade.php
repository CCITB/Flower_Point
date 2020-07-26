<!DOCTYPE html>
{{-- 관리자의 상품 세부관리 페이지 -- 박소현 --}}
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
        <h2><i class="fa fa-angle-right"></i> 가게별 정산</h2>
        <div class="row mt">
          <div class="col-lg-12">


            <div class="se_table">
              <table id="store" class="display">
                <thead>
                  <tr>
                    <th>가게 고유번호</th>
                    <th>가게 이름</th>
                    <th>가게 번호</th>
                    <th>판매자 고유번호</th>
                    <th>정산 내역 보기</th>
                    <th>정산 내역 보기</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sellerall as $sel)
                    <tr>
                      <td>{{$sel->st_no}}</td>
                      <td>{{$sel->st_name}}</td>
                      <td>{{$sel->st_tel}} 원</td>
                      <td>{{$sel->s_no}}</td>
                      <td>
                        <button type="submit" name="show_ca" id="show_ca{{$sel->s_no}}" value="{{$sel->s_no}}" onclick="calculate({{$sel->s_no}});">정산내역 보기</button>
                      </td>
                      <td>
                          <button type="button" name="button" onclick="showcal({{$sel->s_no}});">정산하기</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>


            <div class="se_table">

              <h2><i class="fa fa-angle-right"></i>"" 정산관리</h2><br>

              <table id="calculate" class="display">
                <thead>
                  <tr>
                    <th>상품 고유번호</th>
                    <th>주문번호</th>
                    <th>결제번호</th>
                    <th>상품가격</th>
                    <th>실제 판매가</th>
                    <th>총 판매가</th>
                    <th>총 실제 판매가</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td ><span id="p_no"></span></td>
                    <td><span class="p_name" id="p_name"></span></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span id="sum_price"></span></td>
                    <td><span id="sum_o_dcnt_totalprice"></span></td>
                  </tr>
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

  var openWin;
  function showcal(sno)
  {
    // window.name = "부모창 이름";
    window.name = "parentForm";
    // window.open("open할 window", "자식창 이름", "팝업창 옵션");
    openWin = window.open("/hihi"+sno,
    "childpoint", "width=600px, height=200px, left=50px, top=50px ");
  }

  var p_no;
  var pm_no;

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  function calculate(sno) {
    var pm_pay=[];
    var o_dcnt_totalprice=[];
    var del_price=[];
    var o_no=[];
    var p_name=[];
    $.ajax({
      type: 'post',
      url: '/show_calculate',
      dataType: 'json',
      data: { 's_no' : sno },

      success: function(cal) {
        console.log(cal);

        var pricesum = 0;
        for(var i=0; i<cal.length; i++){
          pm_pay[i] = cal[i].pm_pay;
          // console.log(p_price[i]);
          pricesum += pm_pay[i]; //pm_pay 총 합
        }
        console.log("총 가격"+pricesum);
        // console.log(p_price);
        $('#sum_price').text(pricesum);

        var delsum = 0;
        for(var i=0; i<cal.length; i++){
          del_price[i] = cal[i].pm_deliverypay;
          delsum += del_price[i];
        }
        // console.log("배송비 합"+delsum);
        // var totalprice = pricesum - delsum;
        // console.log("원가격합" +totalprice);

        for (var i = 0; i < cal.length; i++) {
          p_name[i] = cal[i].p_name;
          $('.p_name').html(p_name);
        }



        // var o_dcnt_sum = 0;
        // for(var i=0; i<cal.length; i++){
        //   o_no[i] = cal[i].o_no;
        //   var hi = Array.from(new Set(o_no));
        //   console.log(hi);
        //   // console.log(o_dcnt_totalprice[i]);
        //
        //   // o_dcnt_sum= o_dcnt_sum+o_dcnt_totalprice[i]; //o_dcnt_totalprice 총 합
        // }
        // console.log("실 총 가격"+o_dcnt_sum);
        // $('#sum_o_dcnt_totalprice').text(o_dcnt_sum);
        // var realprice = o_dcnt_sum - delsum;
        // console.log(realprice);

      },
      error: function(cal) {
        console.log("error" +cal);
        alert("잘못된 요청입니다.")
      }
    });
  }














  $(document).ready(function(){
    $("#store").DataTable({
      "language": {
        "emptyTable": "가게가 없습니다.",
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
    $("#calculate").DataTable({
      "language": {
        "emptyTable": "정산내역이 없습니다.",
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
