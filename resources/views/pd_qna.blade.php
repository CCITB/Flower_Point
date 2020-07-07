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
      <h3>판매자에게 문의하기</h3>
    </div>
    <div class="middle">
      <div class="info1">
        상품, 배송, 취소, A/S 등의 문의를 남겨주시면 판매자가 직접 답변을 드립니다.
      </div>
      @foreach ($product as $pro)
        <form action="/pd_qna{{$pro->p_no}}" method="get">
          <table>
            <tr class="pd_name">
              <th>상품명</th>
              <td>{{$pro->p_name}}</td>
            </tr>
          @endforeach
          @foreach ($cus as $cn)
            <tr class="my_name">
              <th>이름</th>
              <td>{{$cn->c_name}}</td>
            </tr>
          @endforeach
          <tr class="qna_title">
            <th>제목</th>
            <td><input class="q_title" name="q_title" id="q_title"></td>
          </tr>
          <tr class="qna_text">
            <th>내용</th>
            <td><textarea class="q_text" name="q_text" id="q_text"></textarea>
              <div class="info2">
                <span class="info_title">문의 시 유의해주세요!</span><br>
                - 회원간 직거래로 발생하는 피해에 대해 꽃갈피는 책임지지 않습니다.<br>
                - 주민등록번호, 연락처 등의 정보는 타인에게 노출될 경우 개인정보 도용의 위험이 있으니 주의해 주시기 바랍니다.<br>
                - 비방, 광고, 불건전한 내용의 글은 관리자에 의해 사전 동의 없이 삭제될 수 있습니다.<br>
              </div>
            </td>
          </tr>
        </table>

        <div class="secret">
          <label><input type="checkbox" name="state" id="close" value="비공개">비밀글로 문의하기 (판매자와 본인만 확인 가능합니다.)</label>
        </div>

      </div>


      <div class="bottom">
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
