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
    .find_pw{
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
        비밀번호를 찾고자 하는 아이디를 입력해 주세요.
  </div>

    <div class ="find_pw">
      <p>
        <form action = '처리할 주소' method='GET or POST'>
            <label><input type="name" autofocus placeholder="꽃갈피 아이디" name="name" size=20 required ></label><br>
          <p>
            <input type="submit">
            <button type="submit" > <a href="http://laravel.site/find_pw_way">다음</a> </button>
          </p>
        </form>
      </p>
    </div>

</div>

@include('footer')
