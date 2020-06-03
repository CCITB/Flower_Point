<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>꽃갈피</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/locate.css">
</head>

<body>
    @include('header')
    <div class="menu4">
        <h3 align="center">마이페이지</h3>
        <hr align="left" class="one">
        </hr>
    </div>
    <div class="myinfo">
        <h4>내 정보</h4>
        <div class="privacy">
          <table class="table1">
              <table border="0" cellpadding="10" cellspacing="10" width="100%">
                  <tr>
                      <th>ID</th>
                      <td><input type="text" placeholder="id"></td>
                  </tr>
                  <tr>
                      <th>PW</th>
                      <td><input type="password" placeholder="pw"></td>
                  </tr>
                  <tr>
                      <th>이름</th>
                      <td><input type="text" placeholder="이름"></td>
                  </tr>
                  <tr>
                      <th>연락처</th>
                      <td><input type="text" placeholder="연락처"></td>
                  </tr>
                  <tr>
                      <th>이메일</th>
                      <td><input type="email" placeholder="이메일"></td>
                  </tr>
                  <tr>
                      <th>주소</th>
                      <td><input type="text" placeholder="주소"></td>
                  </tr>
              </table>
          </table>
            <button class="btn btn-primary">수정
            </button>
    </div>
    @include('footer')
</body>

</html>