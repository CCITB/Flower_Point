<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 찾기</title>
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
    hr{
      width: 450px;
      border-bottom: 0px;
      text-align: center;
    }
    .text{
      padding-bottom:20px;
    }
    p{
      padding-top: 5px;
    }
    .find_pw_way{
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
      <h1> 비밀번호 찾기 </h1>
      <hr class = way>
      비밀번호를 찾을 방법을 선택해 주세요.
  </div>

    <div class ="find_pw_way">
      <p>
        <form action = '처리할 주소' method='GET or POST'>
            <label>이름 : <input type="name" name="name" size=20 required ></label><br>
            <label>전화번호 : <input type="tell" name="tell" size=20 required title="000-0000-0000"></label><input type="submit" value="인증번호받기"><br>
            <label> <input type="name" autofocus placeholder="인증번호 입력" name="name" size=20 required ></label>
            <input type="submit" value="확인"><br>
          <p>
            <button type="submit" > <a href="http://laravel.site/pw_reset">다음</a> </button>
          </p>
       </form>
     </p>
    </div>

</div>

</body>
</html>
