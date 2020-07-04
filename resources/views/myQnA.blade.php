<!-- 곽승지 무단 수정 금지  (페이징 박소현) -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/myqna.css">

</head>
<body>
  @include('lib.header')
  <div class="hr-line">
    <div id="line">
      <h2>나의 QnA</h2>
      <hr>
    </div>
  </div>

  <div class="frequently">
    <div class="frequently-qna">

      <table class="qna-table" id="qnas">
        <thead>
          <tr>
            <th>공개</th>
            <th>문의/답변</th>
            <th>답변상태</th>
            <th>작성자</th>
            <th>작성일</th>
          </tr>
        </thead>
        <tbody>
          @foreach($myqn as $mq)
            <tr>
              <td class="qna-index">{{$mq->q_state}}</td>
              <td class="qna-content">{{$mq->q_title}}</td>
              <td class="qna-condition">답변 전</td>
              <td class="qna-writer">{{$mq->c_name}}</td>
              <td class="qna-date">{{$mq->q_date}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div>
        {{ $myqn->links()}}
      </div>
    </div>
  </div>


  @include('lib.footer')


  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script>
  // (function($) {
  //     $('ul.pagination li.active')
  //         .prev().addClass('show-mobile')
  //         .prev().addClass('show-mobile');
  //     $('ul.pagination li.active')
  //         .next().addClass('show-mobile')
  //         .next().addClass('show-mobile');
  //     $('ul.pagination')
  //         .find('li:first-child, li:last-child, li.active')
  //         .addClass('show-mobile');
  // });
  </script>


</body>
</html>
