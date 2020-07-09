<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>결제</title>
  <link rel="stylesheet" href="/css/payment2.css">
  <link rel="stylesheet" href="/css/header.css">
  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" type="text/javascript">
</script>
<body>
  <!-- 정경진 -->
  <div class="wrapping">
    <div class="topheader">
      <h1 class="titles"><a id="title" href="/">꽃갈피</a></h1>
    </div>
    <div class="text">
      <span class="title">주문/결제</span>
      <div class="page-sorting">
        <span>상품선택</span>
        <span>&gt;</span>
        <span class="current-page">
          <i class="fas fa-credit-card fa-2x"></i>
          주문/결제</span>
          <span>&gt;</span>
          <i class="fas fa-gift fa-2x"></i>
          <span>주문 완료</span>
        </div>
      </div>
      <div class="groupbox">

        <!--정보기입창-->
        <div class="infobox">
          <div class="customerbox">
            <table class="customerinfo" cellpadding="5" cellspacing="5" width: 100%>
              <tr>
                <th>주문고객</th>
                <td>{{$user->c_name}}({{$user->c_phonenum}})</td>
              </tr>
            </table>
          </div>
          <div class="customerbox2">
              <!--결제 정보 창-->
              <form class="info" action="/complete" onsubmit="return checkform()" name="check" method="post">
                @csrf
                {{-- <input type="hidden" name="token_payment" value=""> --}}
                <input type="hidden" name="getarray" value="">
                <input type="hidden" name="basketarray" value="">
                <input type="hidden" name="c_token" value="{{$token}}">
                <div class="delivery_wrap">
                  <strong class="info">수령인</strong>
                  <div class=delivery_input><input id="inputtext" type="text" name="recipient"></div>
                </div>

                <div class="delivery_wrap">
                  <strong class="info">전화번호</strong>
                  <select name="phone_no1"  id="delivery_tel_no1" class="delivery_tel">
                    <option value="010">010</option>
                    <option value="011">011</option>
                    <option value="016">016</option>
                    <option value="017">017</option>
                    <option value="018">018</option>
                    <option value="019">019</option>
                    <option value="02">02</option>
                    <option value="031">031</option>
                    <option value="032">032</option>
                    <option value="033">033</option>
                    <option value="041">041</option>
                    <option value="042">042</option>
                    <option value="043">043</option>
                    <option value="044">044</option>
                    <option value="051">051</option>
                    <option value="052">052</option>
                    <option value="053">053</option>
                    <option value="054">054</option>
                    <option value="055">055</option>
                    <option value="061">061</option>
                    <option value="062">062</option>
                    <option value="063">063</option>
                    <option value="064">064</option>
                    <option value="070">070</option>
                    <option value="080">080</option>
                  </select>
                  -
                  <input type="text" title="휴대폰 중간번호" id="delivery_tel_no2"maxlength="4" class="delivery_tel" name="phone_no2">
                  -
                  <input type="text" title="휴대폰 뒷자리" id="delivery_tel_no3" maxlength="4" class="delivery_tel" name="phone_no3">
                </div>
                <div id="trade0">
                  <label><input type="radio" name="trade" id="trade1"  value="직접거래" onclick="div_show(this.value,'divshow');">직접거래</label>
                  <label><input type="radio" name="trade" id="trade2" value="무통장입금" onclick="div_show(this.value,'divshow');">무통장입금</label>
                </div>
                <div id="divshow" style="display:none;">
                  <div class="delivery_wrap">
                    <div id="trade0">
                      <label><input type="radio" name="trade" id="trade1"  value="최근배송지">최근배송지</label>
                      <label><input type="radio" name="trade" id="trade2" value="새로운배송지">새로운배송지</label>
                    </div>
                    <strong class="info">주 소</strong>
                    <!-- 우편번호 -->
                    <input type="text" id="postcode" placeholder="우편번호" name="postcode" readonly>
                    <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                  </div>
                  <!--주소 -->
                  <div class="delivery_wrap2">
                    <input type="text"  id="address" placeholder="주소" name="address" readonly>

                    <div class="delivery_address_detail">
                      <input type="text" class="delivery_address_list" id="detailAddress" placeholder="상세주소" name="detailAddress" >
                      <input type="text" class="delivery_address_list" id="extraAddress" placeholder="참고항목" name="extraAddress">
                    </div>
                  </div>
                  <div><strong class="info">요청사항</strong><input id="inputtext" type="text" name="request"></div>


                  <!--결제창-->
                  <div class="pay_data">
                    <table cellpadding="5" cellspacing="5" width="100%">
                      <label>무통장 입금</label>
                      <th><li>은행 선택</li></th>
                      <td>
                        <select id="bank" name=bank margin-left:10px;>
                          <option value="">은행을 선택해주세요</option>
                          <option value="농협">농협</option>
                          <option value="국민은행">국민은행</option>
                          <option value="우리은행">우리은행</option>
                          <option value="하나은행">하나은행</option>
                          <option value="신한은행">신한은행</option>
                          <option value="외한은행">외한은행</option>
                          <option value="씨티은행">씨티은행</option>
                          <option value="기업은행">기업은행</option>
                          <option value="우체국">우체국</option>
                          <option value="부산은행">부산은행</option>
                          <option value="SC은행">SC은행</option>
                        </select>
                      </td>
                    </table>
                  </div>
                </div>



              </div>
              <!--상품 정보창-->
              <!--곽승지-->
              @if(isset($data))
                @foreach ($data as $key => $value)
                  <div class="product_data" id="product_data{{$value[0]->p_no}}">
                    <!--product_imabe Table에서 product_no에 맞는 i_filename 가져오기-->
                    <table cellpadding="10" cellspacing="10" width="300px" class="basketno" id="basketno{{$value[0]->b_no}}">
                      <tr>
                        <td rowspan="2"><img class="product_image" src="imglib/{{$value[0]->b_picture}}" alt="Flower Image" width="100px" height="100px"></td>
                        <td>{{$value[0]->b_name}}</td>
                      </tr>
                      <tr><td>옵션선택 : {{$value[0]->b_option}}</td></tr>
                    </table>
                  </div>
                @endforeach
              @else
                <div class="product_data" id="product_data{{$prodata[0]->p_no}}">
                  <!--product_imabe Table에서 product_no에 맞는 i_filename 가져오기-->
                  <table cellpadding="10" cellspacing="10" width="300px" class="basketno" id="">
                    <tr>
                      <td rowspan="2"><img class="product_image" src="imglib/{{$prodata[0]->p_filename}}" alt="Flower Image" width="100px" height="100px"></td>
                      <td>{{$prodata[0]->p_name}}</td>
                    </tr>
                    <tr><td>옵션선택 : </td></tr>
                  </table>
                </div>
              @endif
            </div>
            <!--주문창-->
            <div class="orderbox">
              <div class="paybox">
                <div class="orderinfo">
                  주문정보
                </div>
                <hr class="line1">
                <table class="tablebox" cellpadding="10" cellspacing="10" width="100%">
                  <tr>
                    <th>주문자</th>
                    <td class="order_text">{{$user->c_name}}</td>
                  </tr>
                  <tr>
                    <th>연락처</th>
                    <td class="order_text">{{$user->c_phonenum}}</td>
                  </tr>
                </table>
                <div class="detail">
                  주문자 정보를 정확하게 입력해주세요.
                </div>
              </div>
              <div class="payresult">
                <div class="payinfo">결제정보
                </div>
                <hr class="line1">
                <div class="paymentbox">
                  <table class="tablebox" cellpadding="10" cellspacing="10" width="100%">
                    <tr>
                      <th>금액</th>
                      <td class="order_text">{{number_format($productprice)}}</td>
                    </tr>
                    <tr>
                      <th>배송비</th>
                      <td class="order_text">{{number_format($productdelivery)}}</td>
                    </tr>
                    <tr id="paypay">
                      <th>결제금액</th>
                      <td class="order_text">{{number_format($productsum)}}</td>
                    </tr>
                  </table>
                  <hr class="line2">
                  <div class="line"><label><input class="check" type="checkbox" name="ck" id="ck"> 주문내역 확인 동의(필수)</label></div>
                  <div class="line"><input class="end" type='submit' value="다음" ></div>
                </form>
              </div>
            </div><!--결제정보 -->
          </div><!--오른쪽 주문정보 박스 -->
          <!--컨테이너박스-->
        </div>
      </div>
    </div>
    @include('lib.footer')
  </body>
  {{-- <form class="" action="index.html" method="post" onsubmit="what();">
  <button type="submit" name="button"></button>
</form> --}}
<script type="text/javascript">
$(function() {

  $(document).ready(function() {

    var scrollOffset = $('.orderbox').offset();

    $(window).scroll(function() {
      if ($(document).scrollTop() > scrollOffset.top) {
        $('.orderbox').addClass('scroll-fixed');
      }
      else {
        $('.orderbox').removeClass('scroll-fixed');
      }
    });
  } );

});

//체크박스 확인
function checkform(){

  var check1=document.check.ck.checked;
  if(!check1){
    alert('약관에 동의해 주세요');
    return false;
  }

  //입력정보 정규식
  var special = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var num =  /^[0-9]{3,4}$/;
  var receiver = document.getElementById("inputtext");
  var middlenum = document.getElementById("delivery_tel_no2");
  var lastnum = document.getElementById("delivery_tel_no3");
  var trade1 = document.getElementById("trade1")
  var trade2 = document.getElementById("trade2")
  var address = document.getElementById("address");
  var detail_address = document.getElementById("detailAddress");
  var bank = document.getElementById("bank");

  if((receiver.value)==""){
    alert('수령인을 입력해주세요');
    return false;
  }
  if(special.test(receiver.value)){
    alert("한글과 영문 대 소문자를 사용하세요.(특수기호,공백 사용불가)");
    return false;
  }
  if((middlenum.value)==""){
    alert('중간번호를 입력해주세요');
    return false;
  }
  if(!num.test(middlenum.value)){
    alert('중간 4자리의 숫자를 입력해주세요')
    return false;
  }
  if(special.test(middlenum.value)){
    alert('숫자만 입력해주세요.')
    return false;
  }
  if((lastnum.value)==""){
    alert('번호 뒷자리를 입력해주세요');
    return false;
  }
  if(!num.test(lastnum.value)){
    alert('뒤 4자리의 숫자를 입력해주세요')
    return false;
  }
  if(trade1.checked == trade2.checked){
    alert('결제방식을 선택해주세요');
    return false;
  }

  if(trade1.checked){
    return true;
  }

  if(trade2.checked){
    if((address.value)==""){
      alert('주소를 입력해주세요');
      return false;
    }
    else if((detail_address.value)==""){
      alert('상세주소를 입력해주세요');
      return false;
    }

  }

  if((bank.value)==""){
    alert('은행을 선택해주세요');
    return false;
  }
  test('Spinner.gif');
}
//라디오버튼 클릭 이벤트
function div_show(s,ss){
  if(s == "직접거래"){
    document.getElementById(ss).style.display="none";
  }else{
    document.getElementById(ss).style.display="block";
  }
}

var getarray = [];
var basketarray = [];
for(i=0; i<$('.product_data').length; i++){
  proNum = $('.product_data').eq(i).attr('id').replace(/[^0-9]/g,'');
  basNum = $('.basketno').eq(i).attr('id').replace(/[^0-9]/g,'');
  getarray.push(proNum);
  basketarray.push(basNum);
}
console.log($('.basketno'));
console.log(basketarray);
if(basketarray==''){
  console.log('빈칸');
  var basketarray = null;
  console.log(basketarray);
}
$('input[name=getarray]').val(JSON.stringify(getarray));
$('input[name=basketarray]').val(JSON.stringify(basketarray));
// console.log(getarray);

// 결제페이지 쿠키

// function setCookie(cookie_name, value, days) {
//   var exdate = new Date();
//   exdate.setDate(exdate.getDate() + days);
//   // 설정 일수만큼 현재시간에 만료값으로 지정
//   var cookie_value = escape(value) + ((days == null) ? '' : ';    expires=' + exdate.toUTCString());
//   document.cookie = cookie_name + '=' + cookie_value+';path=/';
// }
// function getCookie(cookie_name) {
//   var x, y;
//   var val = document.cookie.split(';');
//   for (var i = 0; i < val.length; i++) {
//     x = val[i].substr(0, val[i].indexOf('='));
//     y = val[i].substr(val[i].indexOf('=') + 1);
//     x = x.replace(/^\s+|\s+$/g, ''); // 앞과 뒤의 공백 제거하기
//     if (x == cookie_name) {
//       return unescape(y); // unescape로 디코딩 후 값 리턴
//     }
//   }
// }
$(document).ready(function(){
  console.log(document.cookie);
  console.log($('input[name=c_token]').val());
  // if(getCookie('paymentcookie')===document.cookie){
  //   location.href='/';
  // }
// setCookie('paymentcookie','','1');
// setCookie('paymentcookie',document.cookie,'1');
// console.log(getCookie('paymentcookie'));
});

</script>
<script type="text/javascript">
function test(imageName) {
  LoadingWithMask('imglib/' + imageName);
  setTimeout("closeLoadingWithMask()", 3000);
}

function LoadingWithMask(gif) {
  //화면의 높이와 너비를 구합니다.
  var maskHeight = $(document).height();
  var maskWidth  = window.document.body.clientWidth;
  var popupX = (document.body.offsetWidth / 2) - (200 / 2);
  //&nbsp;만들 팝업창 좌우 크기의 1/2 만큼 보정값으로 빼주었음

  var popupY= (window.screen.height / 2) - (300 / 2);
  //&nbsp;만들 팝업창 상하 크기의 1/2 만큼 보정값으로 빼주었음
  //화면에 출력할 마스크를 설정해줍니다.
  var mask = "<div id='mask' style='position:absolute; z-index:800; background-color:#000000; display:none; left:0; top:0;'></div>";
  var loadingImg = '';

  loadingImg += " <img id= 'loadingimage' src='"+ gif + "' style='position: absolute; display: block; margin: 0px auto; z-index:999;'/>";

  //화면에 레이어 추가
  $('body')
  .append(mask)

  //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채웁니다.
  $('#mask').css({
    'width' : maskWidth,
    'height': maskHeight,
    'opacity' : '0.3'
  });

  //마스크 표시
  $('#mask').show();
  //로딩중 이미지 표시
  $('#mask').append(loadingImg);
  $('#loadingimage').css({
    'left' : popupX,
    'top' : popupY,
  });
}
function closeLoadingWithMask() {
  $('#mask').hide();
  $('#mask').empty();
}
</script>
</html>
<button type="button" onclick="test('Spinner.gif');" name="button">로딩용</button>
{{-- <button type="button" onclick="alert(getCookie('paymentcookie'))" name="button">쿠키확인용</button> --}}
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
{{-- <script type="text/javascript" src="/js/radio.js" charset="utf-8"></script> --}}
