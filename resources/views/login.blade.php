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
      .go{
        text-align: right;
      }
      .submit{
        text-align: center;
      }
    </style>
</head>
<body>

<div id="all">
      <div class="text">
          <h1> 로그인 </h1>
          <hr class = way>
      </div>

      <div class ="login">
        <form action = 'url' method='GET or POST'>
            <p>
              <input type="text" autofocus placeholder="ID" name="id" style="width:350px; height:30px; font-size:20px;" required ><br><br>
              <input type="password" autofocus placeholder="Password" name="pw" style="width:350px; height:30px; font-size:20px;" required>
            </p>
            <div class="go">
              <a href="http://laravel.site/find_id">아이디/비밀번호 찾기</a><br><br>
            </div>
            <div class="submit">
                  <input type="submit" style="width:100px; height:30px; font-size:15px;" id="login" value="로그인">
                <p>
                  <br><br><button type="button" style="width:350px; height:30px; font-size:15px;" > <a href="http://laravel.site/user">구매자 회원가입</a> </button><br><br>
                  <button type="button" style="width:350px; height:30px; font-size:15px;" > <a href="http://laravel.site/seller">판매자 회원가입</a> </button>
                </p>
            </div>
        </form>
      </div>
</div>

@include('footer')
