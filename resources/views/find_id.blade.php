<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>아이디 찾기</title>
    <script>


    </script>


    <style>

      #all{
        margin:0 auto;
        border: 1px solid;
        width : 450px;
        height: 500px;
        border-radius: 25px;
        padding: 40px;
        background-color: #FFFFFF;
        border-style: hidden;
      }
      body {
        background-color: #FFD8D8;
      }
      p{
        padding-top: 5px;
        text-align: center;
      }
      .text{
        padding-bottom:20px;
      }
      hr{
        width: 450px;
        border-bottom: 0px;
        text-align: center;
      }
      .find_id {
        padding: 20px;
        text-align: center;
        border: 1px solid;
        border-radius: 25px;
        height: 300px;
      }
    </style>
</head>
<body>

<div id="all">
      <div class="text">
          <h1> 아이디 찾기 </h1>
          <hr class = way>
          아이디  찾는 방법을 선택해 주세요.
      </div>

      <div class ="find_id">
            <p>
                회원 정보에 등록한 휴대전화로 인증
            </p>
            <p>
                회원 정보에 등록한 휴대전화 번호와 입력한 휴대전화 번호가 일치해야 인증번호를 받을 수 있습니다.

            </p>
        <form action = 'url' method='GET or POST'>
              이름 : <input type="name" autofocus placeholder="이름을 입력하세요." name="name" size=20 required ><br>
              전화번호 : <input type="tell" autofocus placeholder="전화번호를 입력하세요" name="tell" size=20 required title="000-0000-0000"><input type="submit" value="인증번호받기"><br>
              <label> <input type="name" autofocus placeholder="인증번호 입력" name="name" size=20 required ></label>
              <input type="submit" value="확인"><br>
            <p>
              <button type="button" > <a href="http://laravel.site/">홈으로</a> </button>
              <input type="submit">
              <button type="button" > <a href="http://laravel.site/find_password">비밀번호 찾기</a> </button>
            </p>
        </form>
      </div>
</div>

@include('footer')
