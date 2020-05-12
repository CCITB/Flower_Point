<!DOCTYPE html> <!--박소현 계속 수정중 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 재설정</title>
    <!--<script>
      window.addEventListener('load', function() {
      var signup = document.querySelector('#signup');

      signup.addEventListener('click', function() {
      var new_pw = document.querySelector('#new_pw');
			var check = document.querySelector('#check');

      if (new_pw.value != check.value) {
				alert('비밀번호가 일치하지 않습니다.');
				check.focus();
      } else if (new_pw.value == ''){
        alert('비밀번호를 입력해주세요.')
        new_pw.focus();
     }
   });
});

</script>-->


    <style>
    .all{
      margin:0 auto;
      border: 1px solid;
      width : 450px;
      height: 650px;
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



    </style>

</head>
<body>
 <div class="all">
     <div class="text">
        <h1> 구매자 회원가입 </h1>
        <hr class = way>
     </div>
      <div class="signup">
        <form action = '처리할 주소' method='GET or POST'>
          <table>
            <tr>
              <td>아이디</td>
            </tr>
					  <tr>
              <td><input type="text" autofocus placeholder="ID" id="id" name="id" size=30></td>
            </tr>
            <tr>
              <td>비밀번호</td>
            </tr>
            <tr>
              <td><input type="password" autofocus placeholder="Password" id="new_pw" size=30 required ></td>
            </tr>
            <tr>
              <td>비밀번호 확인</td>
            </tr>
            <tr>
              <td><input type="password" autofocus placeholder="Password" id="check" size=30 required ></td>
            </tr>
            <tr>
              <td>이름</td>
            </tr>
            <tr>
              <td><input type="name" autofocus placeholder="Name" id="name" name="name" size=30 ></td>
            </tr>
            <tr>
              <td>연락처</td>
            </tr>
            <tr>
              <td><input type="number" autofocus placeholder="Phone Number" id="phone" name="phone" size=30>인증번호</td>
            </tr>
            <tr>
              <td>주소</td>
            </tr>
            <tr>
              <td><input type="text" autofocus placeholder="Address" id="address" name="address" size=30></td>
            </tr>
            <tr>
              <td>이메일</td>
            </tr>
            <tr>
              <td><input type="text" autofocus placeholder="email "id="email" name="email" size=30></td>
            </tr>
            <tr>
              <td><button type="button" style="border-radius:5px; font-s"/> <a href="http://laravel.site/login">돌아가기</a> </button> </td>
              <td><input type="submit" value="회원가입" style="border-radius:5px; font-s"/></td>
            </tr>
          </table>
        </form>
    </div>
  </div>

@include('footer')
