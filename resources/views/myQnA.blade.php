<!-- 곽승지 무단 수정 금지  (페이징 박소현) -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/myqna.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>


</head>
<body>
  @include('lib.header')
  <div class="qna_total">
    <div class="mytitle">
      나의 QnA
    </div>

  <div class="frequently">
    <div class="frequently-qna">

      <table class="qna-table" id="qnas">
        <thead>
          <tr>
            <th>답변 여부</th>
            <th>문의/답변</th>
            <th>공개 범위</th>
            <th>작성자</th>
            <th>작성일</th>
          </tr>
        </thead>
        <tbody>
          @foreach($myqn as $mq)
            <tr>
              <td class="qna-condition">{{$mq->an_state}}</td>
              <td class="qna-content">{{$mq->q_title}}</td>
              <td class="qna-index">{{$mq->q_state}}</td>
              <td class="qna-writer">{{$mq->c_name}}</td>
              <td class="qna-date">{{$mq->q_date}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


  @include('lib.footer')


  <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>
  <script>
  $(document).ready(function(){
  	$("#qnas").DataTable({
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
