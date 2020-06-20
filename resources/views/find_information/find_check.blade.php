<!DOCTYPE html> <!--박소현 계속 수정중 -->
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
    @foreach ($fd_name as $myfindid)
      <div class ="my_id">
        @csrf
        <div class="intervel"></div>
        <div class="id_db"> ID :{{$myfindid->s_id}} </div>
        <div class="under_pw">
          <button class="lg_bt" type="button" onclick="location.href = '/login_customer'" >구매자 로그인</button>
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
