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
    @include('lib.header')
    <div class="menu4">
        <h3 align="center">마이페이지</h3>
        <hr align="left" class="one">
        </hr>
    </div>
    <div class="myinfo">
        <h4>내 정보</h4>
        <div class="privacy">
          <form action="/modify">
          @if($seller = auth()->guard('seller')->user())
            <table class="table1">
                <table border="1" cellpadding="10" cellspacing="10" width="100%" border-collapse="collapse">
                    <tr>
                        <th>ID</th>
                        <td>{{$seller->s_id}}</td>
                    </tr>
                    <tr>
                        <th>PW</th>
                        <td>{{$seller->s_password}}</td>
                    </tr>
                    <tr>
                        <th>이름</th>
                        <td>{{$seller->s_name}}</td>
                    </tr>
                    <tr>
                        <th>연락처</th>
                        <td>{{$seller->s_phonenum}}</td>
                    </tr>
                    <tr>
                        <th>이메일</th>
                        <td>{{$seller->s_email}}</td>
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td>{{$seller->s_address}}</td>
                    </tr>
                </table>
            </table>

          @elseif ($customer = auth()->guard('customer')->user())
              <table class="table1">
                  <table border="1" cellpadding="10" cellspacing="10" width="100%" border-collapse="collapse">
                      <tr>
                          <th>ID</th>
                          <td >{{$customer->c_id}}</td>
                      </tr>
                      <tr>
                          <th>PW</th>
                          <td >{{$customer->c_password}}</td>
                      </tr>
                      <tr>
                          <th>이름</th>
                          <td >{{$customer->c_name}}</td>
                      </tr>
                      <tr>
                          <th>연락처</th>
                          <td >{{$customer->c_phonenum}}</td>
                      </tr>
                      <tr>
                          <th>이메일</th>
                          <td >{{$customer->c_email}}</td>
                      </tr>
                      <tr>
                          <th>주소</th>
                          <td >{{$customer->c_address}}</td>
                      </tr>
                  </table>
              </table>
          @endif
            <button class="btn btn-primary"type="submit">수정
            </button>
          </form>
            <h3 align="center">문의관리</h3>
            <hr align="center" width="100%" >
            <table class="questiontable" border="1" cellpadding="10" width="100%";>
                <th class="thinfo">번호</th>
                <th class="thinfo">제목</th>
                <th class="thinfo">작성자</th>
                <th class="thinfo">등록일</th>
                <th class="thinfo">답변상태</th>
                <tr>
                  <td>123</td>
                  <td>꽃에관한 질문입니다.</td>
                  <td>CCIT3</td>
                  <td>2020.04.15</td>
                  <td>답변완료</td>
                </tr>
                <tr>
                  <td>124</td>
                  <td>꽃에관한 질문입니다.</td>
                  <td>CCIT2</td>
                  <td>2020.04.16</td>
                  <td>답변대기</td>
                </tr>
                <tr>
                  <td>125</td>
                  <td>꽃에관한 질문입니다.</td>
                  <td>CCIT1</td>
                  <td>2020.04.16</td>
                  <td>답변대기</td>
                </tr>
                <tr>
                  <td>126</td>
                  <td>꽃에관한 질문입니다.</td>
                  <td>CCIT</td>
                  <td>2020.04.17</td>
                  <td>답변대기</td>
                </tr>
            </table>
            <div class="quickbuttonwrap">
                <div class="quickgroup"><a href="/locate1">
                    <div class="quickbutton">
                        <img src="/imglib/orangerose.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>내 주변 꽃집</h1>
                        </div>
                    </div>
                </div>
                <div class="quickgroup"><a href="/order1">
                    <div class="quickbutton">
                        <img src="imglib/rose.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>내 주문관리</h1>
                        </div>
                    </div>
                </div>
                <div class="quickgroup"><a href="#">
                    <div class="quickbutton">
                        <img src="imglib/sunflower.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>쿠폰관리</h1>
                        </div>
                    </div>
                </div>
                <div class="quickgroup"><a href="#">
                    <div class="quickbutton">
                        <img src="imglib/pink.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>물품관리</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('lib.footer')
</body>

</html>