<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>내 주문관리</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/c_mypage.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>
</head>
<body>
  @include('lib.header')
  <div class="myorder">
    <span class="mytitle" align="left">나의 주문 현황</span>
    <div class="ordertable">
      @if(count($data2))
        <table class="order" border="0" width="100%" id="myorders">
          <thead>
            <tr class="p_tr">
              <th>상품이미지</th>
              <th>주문날짜</th>
              <th>주문번호</th>
              <th>결제번호</th>
              <th>상품명</th>
              <th>수량</th>
              <th>구매금액</th>
              <th>주문처리상태</th>
              <th>후기 작성</th>
              <th>구매 확정</th>
              <th>배송조회</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data2 as $data2)
              <tr>
                <td><a href="product/{{$data2->p_no}}"><img src="imglib/{{$data2->p_filename}}" width="100px" height="100px"></a></td>
                <td>{{$data2->pm_date}}</td>
                <td><a href="product/{{$data2->p_no}}">{{$data2->o_no}}</a></td>
                <td><a href="product/{{$data2->p_no}}">{{$data2->pm_no}}</a></td>
                <td><a href="product/{{$data2->p_no}}">{{$data2->p_name}}</a></td>
                <td>{{$data2->pm_count}}</td>
                <td>{{$data2->pm_pay}}</td>
                <td>{{$data2->pm_d_status}}</td>
                @if($data2->pm_status == '결제 완료'||$data2->pm_status == '구매 확정')
                  @if(!isset($data2->payment_no))
                    <td><input type="button" value="구매후기" onclick="show_popup({{$data2->pm_no}})"></td>
                  @else
                    <td>작성완료</td>
                  @endif
                @else
                  <td></td>
                @endif
                @if($data2->pm_status == '결제 대기')
                  <td>
                    {{-- <form action="/pd_cancel{{$data2->pm_no}}" method="post">
                    @csrf --}}
                    <input type="submit" class="cancel" value="결제 취소">
                    {{-- </form> --}}
                  </td>

                @elseif($data2->pm_d_status == '배송중')
                  <td>
                    <form action="/pd_point{{$data2->p_price}}" method="post">
                      <input type="hidden" name="hidden" value="{{$data2->pm_no}}">
                      @csrf
                      <input type="submit" id="confirm" value="구매확정">
                    </form>
                  </td>
                @elseif($data2->pm_status == '구매 확정')
                  <td>구매확정 완료</td>
                @elseif($data2->pm_status == '결제 취소')
                  <td>결제 취소</td>
                @else
                  <td></td>
                @endif
                @if(isset($data2->pm_company))
                  <td id="delivery_search"><button id="delivery_search_btn" onclick="window.open('https://tracker.delivery/#/{{$data2->delivery_code}}/{{$data2->pm_invoice_num}}'),'배송조회',width='300px',height='300px'">배송조회</button></td>
                @else
                  <td id="delivery_search"></td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>

      @else
        <div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
          <div class="" style="top:180px; position:absolute; left:300px; ">
            주문목록이 없습니다.
          </div>
        </div>
      @endif
    </div>
  </div>
  @include('lib.footer')

  <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>

  <script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.cancel').click(function(){
    var tdArr = new Array();    // 배열 선언
    var checkBtn = $(this);
    var tr = checkBtn.parent().parent();
    var td = tr.children();
    var number = td.eq(3).text();

    $.ajax({
      type: 'post',
      url: '/refund',
      dataType: 'json',
      data: { "number" : number,
    },
    success: function(data) {
      // console.log(data);
      // return false;
      if(data==1){
        alert('취소되었습니다.');
        location.reload();
      }
    },
    error: function() {
      console.log();
    }
  });
  });


  $('#confirm').click(function(){
    var test = confirm("구매를 확정하시겠습니까?");
    if(test == true){
      alert("구매가 확정되었습니다.");
    }else{
      return false;
    }
  });


  function show_popup(n) { // 리뷰 팝업창 띄우기 -- 박소현
    var rev_pop = window.open("/review"+n, "리뷰팝업창", "width=580px, height=750px, left=500px, top=100px ");
  }

  $(document).ready(function(){
    $("#myorders").DataTable({
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
