<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <title>매장 정보 기입</title>
  <script>
  </script>
</head>
<body>
  <div id="all">
    <div class="text">
      <h1> 매장 정보 기입 </h1>
      <hr>
    </div>


    <form action = 'url' method='post'>
      <div class="paragraph">
        <div class="shop_title">
          매장 이름
        </div>
        <input class="shop_info" type="text" autofocus placeholder="Shop Name" name="Shop Name" required >
      </div>
      <div class="paragraph">
        <div class="shop_title">
          사업자 등록번호
        </div>
        <input class="shop_info" type="text" autofocus placeholder="Company Registration Number" name="Company Registration Number" required>
      </div>
      <div class="paragraph">
        <div class="shop_title">
          매장 주소
        </div>
        <input class="shop_info" type="text" autofocus placeholder="Shop Address" name="Shop Address" required>
      </div>
      <div class="paragraph">
        <div class="shop_title">
          고객센터 번호
        </div>
        <input class="shop_info" type="tell" autofocus placeholder="Service Number" name="Service Number" required>
      </div>
        <br><button class="lg_bt" type="button" id="login" value="가입하기" onclick="location.href = '/'">가입하기</button>
    </form>
  </div>

</body>
</html>
