<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>주문서 작성 ㅣ 꽃갈피</title>
    <style> .centered { display: table; margin-left: auto; margin-right: auto; } </style>
    <div class="centered">
    </head>
    <body>
    @include('header')
    <li><button type="submit" class="btn btn-default">배송비---------------------------------------------->0원 </button></li>
    <br>
    <li><button type="submit" class="btn btn-default">결제 금액------------------------------------------> 0원 </button> </li>
    <br>
    <li><button type="submit" class="btn btn-default">보유마일리지-------------------------------------->0원 </button> </li>
    <br>
    <li><button type="submit" class="btn btn-default">쿠폰 ㅣ 쿠폰이름 ㅣ 쿠폰 선택 </button> </li>
    <br>
    </div>
    <style> .righted { display: table; margin-left: auto; margin-right: auto; } </style>
    <div class="righted">
    <li><button type="submit" class="btn btn-default">총 상품금액 0원 </button> </li>
    <li> 배송비(+) 0원
    <li> 할인금액(-) 0원
    <li> 마일리지 사용금액(-) 0원
    <li> 쿠폰 사용금액(-) 0원
    <li> <button type="submit" class="btn btn-default">결제 ㅣ 취소 </button>
     </body>
     </div>
     @include('footer')
</html>
