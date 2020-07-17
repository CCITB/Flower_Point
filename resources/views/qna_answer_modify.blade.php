<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>꽃갈피</title>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/css/qnawrite.css">
</head>
<body>
  <div class="qna_all">

    <div class="top">
      <h3>답변 수정하기</h3>
    </div>
    <div class="middle">
      <div class="info1">
        상품, 배송, 취소, A/S 등의 문의를 남겨주시면 판매자가 직접 답변을 드립니다.
      </div>
      @foreach ($answer as $an)
        <form action="/an_modi{{$an->a_no}}" method="post">
          @csrf
          <table>
            <tr class="">
              <th>상품명</th>
              <td>{{$an->p_name}}</td>
            </tr>
            <tr class="">
              <th>문의내용</th>
              <td>{{$an->q_contents}}</td>
            </tr>
            <tr class="">
              <th>답변</th>
              <td><textarea class="a_text" name="an_md" id="an_md">{{$an->a_answer}}</textarea></td>
            </tr>
          @endforeach
        </table>
      </div>


      <div class="bottom1">
        <input class="q_bt" id="sub" type='submit' value="확인">
        <input class="q_bt" type="button" value="취소" onclick="self.close();" />
      </div>
    </form>
  </div>




  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script>
  $(document).ready(function(){
    $("#sub").click(function(){
      if($("#q_title").val().length==0){
        alert("제목을 입력하세요.");
        $("#q_title").focus();
        return false;
      }
      if($("#q_text").val().length==0){
        alert("내용을 입력하세요.");
        $("#q_text").focus();
        return false;
      }
    });
  });
  </script>
</body>
</html>
