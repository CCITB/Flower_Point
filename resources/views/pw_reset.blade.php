<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 재설정</title>
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
    .pw_reset{
      padding: 20px;
      text-align: center;
      border: 1px solid;
      border-radius: 25px;
      height: 300px;
    }
    .my_id{
      border: 1px solid;
    }



    </style>

</head>
<body>
 <div id="all">
   <div class="text">
      <h1> 비밀번호 재설정 </h1>
      <hr class = way>
      비밀번호를 변경해주세요.<br>
   </div>

    <div class ="pw_reset">
      <p>
        다른 아이디나 사이트에서 사용한 적 없는 안전한 비밀번호로 변경해 주세요.
      </p>

      <div class="my_id">
        꽃갈피 아이디 : <!-- 아이디 불러올 곳 -->
      </div>

        <form action = '처리할 주소' method='GET or POST'>
            <label><input type="password" autofocus placeholder="새 비밀번호" name="new_pw" size=30 required ></label><br>
            <label> <input type="password" autofocus placeholder="새 비밀번호 확인" name="pw_check" size=30 required ></label><br>
            영문, 숫자, 특수문자를 조합하여 8~16자로 만들어 주세요.
          <p>
            <button type="submit" > <a href="http://laravel.site/로그인창주소">확인</a> </button>
          </p>
        </form>
    </div>
  </div >

@include('footer')
