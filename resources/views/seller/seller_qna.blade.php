<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="/css/orderlist.css">
</head>
<body>
  @include('lib.header')
  <div class="myoderlist-wrap">
    <div class="hr-line">
      <div id="line">
        <div class="mytitle">나의 문의관리</div>
      </div>
    </div>
    <div class="myorderlist">
      <div class="myorderlist-top">
        <div class="myorderlist-infor">
          @if(count($data))
            <div class="sellerqnalist">
              <form class="order_list" id="order_list" action="" method="post">
                @csrf

                <table id="myTable" style="border-collapse: collapse;">
                  <thead class="sel_qna">
                  <tr>
                    <th class="title">답변상태</th>
                    <th class="title">제목</th>
                    <th class="title">문의내용</th>
                    <th class="title">작성자</th>
                    <th class="title">작성일</th>
                  </tr>
                  </thead>

                  <tbody>
                  @foreach ($data as $data)
                    <tr style="height: 45px;" onclick="location.href='/product/{{$data->p_no}}#que'">
                      <td style="width:10%;">{{$data->an_state}}</td>
                      <td style="width:15%;">{{$data->q_title}}</td>
                      <td style="text-align:left;"><div class="r_con">{{$data->q_contents}}</div></td>
                      <td style="width:10%;">{{$data->c_name}}</td>
                      <td style="width:15%;">{{$data->q_date}}</td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
              </form>
              <!-- </form> -->
            </div>
          @else
            <div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
              <div class="" style="top:180px; position:absolute; left:300px; ">
                등록된 문의가 없습니다.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  @include('lib.footer')
</body>
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script>
$(document).ready(function(){
	$("#myTable").DataTable({
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
</html>
