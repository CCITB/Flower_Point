<!--어지수-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <title>매장 정보 기입</title>
</head>

<body>
  <div id="all">
    <div class="text">
      <h1>꽃갈피 - 매장 정보 기입 </h1>
      <hr>
    </div>
    <form action = 'register_InsertStore' method='post' name="insertstore" onsubmit='return validatate();' >
      @csrf
      <div class="paragraph">
        <div class="shop_title">
          <label>매장 이름</label>
        </div>
        <input class="shop_info" type="text" placeholder="store name" id="st_name" name="st_name" >
        <div class="check_div" style="height:45px;"id="stname_check" value=""></div>
      </div>
      <div class="paragraph">
        <div class="shop_title">
          사업자 등록번호
        </div>
        <input class="shop_info" type="text" placeholder="Company Registration Number" id="registeration_num" name="registeration_num">
        <div class="check_div" style="height:45px;"id="stnum_check" value=""></div>
      </div>
      <div class="paragraph">
        <div class="shop_title">
          매장 주소
        </div>
        <input class="shop_info" type="text" placeholder="Shop Address" id="st_address" name="st_address">
        <div class="check_div" style="height:45px;"id="staddress_check" value=""></div>
      </div>

      <div class="paragraph">
        <div class="shop_title">
          고객센터 번호
        </div>
        <input class="shop_info" type="text" placeholder="Service Number" id="st_tel" name="st_tel">
      </div>
      <div class="paragraph">
        <div class="shop_title">
          <label>매장 소개</label>
        </div>
        <textarea cols="50" rows="10" style=resize:none; placeholder="introduce" id="st_introduce" name="st_introduce" ></textarea>
      </div>
        <br><input class="end" type='submit' id="login" value="가입하기">
    </form>
  </div>
</body>
</html>

<script type="text/javascript">
  //onsubmit -- 어지수
  function validatate(){
    var st_name = document.getElementById("st_name");
    var registeration_num = document.getElementById("registeration_num");
    var st_address = document.getElementById("st_address");
    var st_tel = document.getElementById("st_tel");
    var st_introduce = document.getElementById("st_introduce");

    if(st_name.value()==""){
      alert('매장명을 입력해주세요.');
      return false;
    }
    if(registeration_num.value()==""){
      alert('사업자등록번호를 입력해주세요.');
      return false;
    }
    if(st_address.value()==""){
      alert('매장주소를 입력해주세요.');
      return false;
    }
    if(st_tel.value()==""){
      alert('고객센터 번호를 입력해주세요.');
      return false;
    }
    if(st_introduce.value()==""){
      alert('고객센터 번호를 입력해주세요.');
      return false;
    }
    else {
      return true;
    }
  }
</script>
