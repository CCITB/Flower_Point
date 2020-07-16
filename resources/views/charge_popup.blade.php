<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<link rel="stylesheet" href="/css/c_mypage.css">
<body>
  <div class="walletwrap">
    <form class="" action="/charge" method="post">
      @csrf
      <h2>금액충전</h2>
      @foreach ($data3 as $data3)
        사용자 : <strong>{{$data3->c_name}}</strong></br>
        <div class="current">현재 보유 금액 : <strong>{{$data3->c_cash}}</strong>원</div>
        <div class="money">
          충전금액
          <div id= moneycharge>
            <label><input type="radio" name="money2" id="money2" value="5,000" checked>5,000</label>
            <label><input type="radio" name="money2" id="money3" value="10,000" >10,000</label>
            <label><input type="radio" name="money2" id="money4" value="20,000" >20,000</label>
            <label><input type="radio" name="money2" id="money5" value="30,000" >30,000</label>
            <label><input type="radio" name="money2" id="money6" value="50,000" >50,000</label>
            <label><input type="radio" name="money2" id="money7" value="100,000" >100,000</label>
            <button type="submit" onclick="alert('충전되었습니다.')" class="money3">충전하기</button>
            <button type="submit" onclick="window.close()" class="money4" >창닫기</button>
          </div>
        </div>
      </div>
    @endforeach
  </form>
</div>
</body>
</html>
