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
                <table border="1" cellpadding="10" cellspacing="10" width="100%">
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
            <div class="quickbuttonwrap">
                <div class="quickgroup"><a href="http://127.0.0.1/locate1">
                    <div class="quickbutton">
                        <img src="goflowershop.jpg" alt="" height="200px" width="300px;">
                        <div class="innerbutton">
                            <h1>내 주변 꽃집</h1>
                        </div>
                    </div>
                </div>
                <div class="quickgroup"><a href="http://127.0.0.1/mypage1">
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
