<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>아이디 찾기</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/find.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
</head>

<body>

  <div id="all">
    <div class="text">
      <div class="id_title">Find ID</div> <hr>
      <div class="text_des">회원정보에 등록한 휴대전화로 인증</div>
    </div>

    <div class ="find_id">
      <form action = '/f_id' method='post' name="fin_id">
        @csrf
        <div class="fd_id">
          <div class="character"> </div>
          <div class="window">
            <div class="ip_name">이름</div>
            <input class="find_input" placeholder="이름을 입력하세요." name="name" id='name'><br><br>
            <div class="ip_name">전화번호</div>
            <input class="find_input" placeholder="전화번호를 입력하세요" name="tell">
            {{-- <input type="submit" value="인증"><br><br>
            <input class="find_input" placeholder="인증번호">
            <input type="submit" value="확인"><br><br> --}}
          </div>
        </div>
        <div class="under">
          <input class="lg_bt" id='id_bt' type="submit" value="찾기">
        </div>
      </form>
    </div>
    <div class="bottom">
      <a href = "/find_pw">비밀번호 찾기</a>
    </div>
    <div class="home">
      <a href = "/">홈으로</a>
    </div>
  </div>
  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
  //  $(document).ready(funtion(){
  //    $('#id_bt').click(funtion(){
  //    if($('#name').val()==''){
  //      alert('이름을 입력해주세요.');
  //      $('#name').focus();
  //      return false;
  //    }
  //  });
  // });
  </script>
</body>
</html>
