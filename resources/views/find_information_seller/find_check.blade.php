<!DOCTYPE html> <!--찾은 아이디 나오는 페이지 html css 박소현-->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>확인</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/css/find.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">

</head>
<body>

  <div id="all">
    <div class="text">
      <div class="id_title">My Information</div> <hr>
    </div>
    @foreach ($query_result as $id)
      <div class ="my_id">
        @csrf
        <div class="intervel"></div>
        <div class="id_db"> ID : {{$id}} </div>
        <div class="under_pw">
          <button class="lg_bt" type="button" onclick="location.href = '/login_seller'">판매자 로그인</button>
        </div>
      </div>
    @endforeach
    <div class="home">
      <a href = "/">홈으로</a>
    </div>
  </div>
</body>
</html>
