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
                        <td>asd</td>
                    </tr>
                    <tr>
                        <th>PW</th>
                        <td>******</td>
                    </tr>
                    <tr>
                        <th>이름</th>
                        <td>정경진</td>
                    </tr>
                    <tr>
                        <th>연락처</th>
                        <td>*****</td>
                    </tr>
                    <tr>
                        <th>이메일</th>
                        <td>asdsad@naver.com</td>
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td>ㅁㄴㄹㄴㅁㄹㄴㅁㄹ</td>
                    </tr>
                </table>
            </table>
            <button class="btn btn-primary">수정
            </button>
            <h3 align="center">문의관리</h3>
            <hr align="center" width="100%" >
            <table class="questiontable" border="1" cellpadding="10" width="100%";>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>등록일</th>
                <th>답변상태</th>
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
            <div class="nav-page">
              <nav>
                <a href="#" class="active">1</a>
              </nav>
              <nav>
                2
              </nav>
              <nav>
                3
              </nav>
              <nav>
                4
              </nav>
              <nav>
                5
              </nav>
            </div>
            <div class="quickbuttonwrap">
                <div class="quickgroup"><a href="/locate1">
                    <div class="quickbutton">
                        <img src="goflowershop.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>내 주변 꽃집</h1>
                        </div>
                    </div>
                </div>
                <div class="quickgroup"><a href="/mypage1">
                    <div class="quickbutton">
                        <img src="goflowershop.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>내 주문관리</h1>
                        </div>
                    </div>
                </div>
                <div class="quickgroup"><a href="#">
                    <div class="quickbutton">
                        <img src="goflowershop.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>쿠폰관리</h1>
                        </div>
                    </div>
                </div>
                <div class="quickgroup"><a href="#">
                    <div class="quickbutton">
                        <img src="goflowershop.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>물품관리</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
</body>

</html>
