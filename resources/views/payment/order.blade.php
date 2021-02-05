<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>결제</title>
  <link rel="stylesheet" href="/css/payment2.css">
  <link rel="stylesheet" href="/css/header.css">
  <style media="screen">
  .layer-wrap { display: none; position: fixed; left: 0; right: 0; top: 0; bottom: 0; text-align: center; background-color: rgba(0, 0, 0, 0.5); z-index: 1;} .layer-wrap:before { content: ""; display: inline-block; height: 100%; vertical-align: middle; margin-right: -.25em; } .pop-layer { display: inline-block; vertical-align: middle; width: 900px; height: auto; background-color: #fff; border: 5px solid #3571B5; z-index: 10; } .pop-layer .pop-container { padding: 20px 25px; } .pop-layer .btn-r { width: 100%; margin: 10px 0 20px; padding-top: 10px; border-top: 1px solid #DDD; text-align: right; } a.btn-layerClose { display: inline-block; height: 25px; padding: 0 14px 0; border: 1px solid #304a8a; background-color: #3f5a9d; font-size: 13px; color: #fff; line-height: 25px; }
  </style>
  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <input type="hidden" name="c_token" value="{{$token}}">
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript">
  // 결제페이지 쿠키
  function setCookie(cookie_name, value, days) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + days);
    // 설정 일수만큼 현재시간에 만료값으로 지정
    var cookie_value = escape(value) + ((days == null) ? '' : ';    expires=' + exdate.toUTCString());
    document.cookie = cookie_name + '=' + cookie_value+';path=/';
  }
  function getCookie(cookie_name) {
    var x, y;
    var val = document.cookie.split(';');
    for (var i = 0; i < val.length; i++) {
      x = val[i].substr(0, val[i].indexOf('='));
      y = val[i].substr(val[i].indexOf('=') + 1);
      x = x.replace(/^\s+|\s+$/g, ''); // 앞과 뒤의 공백 제거하기
      if (x == cookie_name) {
        return unescape(y); // unescape로 디코딩 후 값 리턴
      }
    }
  }
  if(getCookie('paymentcookie')===$('input[name=c_token]').val()){
    // location.href='/';
    history.back();
  }
  $(document).ready(function(){
    setCookie('paymentcookie','','1');
    setCookie('paymentcookie',$('input[name=c_token]').val(),'1');
  });

  </script>
</head>
<script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" type="text/javascript">
</script>
<body>
  <!-- 정경진 -->
  @include('lib.header')
  <div class="wrapping">
    {{-- <div class="topheader">
    <h1 class="titles"><a id="title" href="/">꽃갈피</a></h1>
  </div> --}}
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
              <th class="cinfo_th">주문고객</th>
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
            @if(isset($productcount))
              <input type="hidden" name="productcount" value="{{$productcount}}">
            @endif

            <div id="trade0">
              {{-- <label><input type="radio" name="trade" id="trade1"  value="직접거래" onclick="div_show(this.value,'divshow');">직접거래</label> --}}
              {{-- <label><input type="radio" name="trade" id="trade2" value="무통장입금" checked onclick="div_show(this.value,'divshow');">무통장입금</label> --}}
            </div>
            <div id="divshow" style="">
              <div class="delivery_wrap">
                <div id="trade0">
                  <label><input type="radio" name="delivery" id="trade3" onclick="delivery_show(this.value,'delivery_wrap2');" checked="checked" value="기본배송지">기본배송지</label>
                  <label><input type="radio" name="delivery" id="trade4" onclick="delivery_show(this.value,'delivery_wrap4');" value="최근배송지">최근배송지</label>
                  <label><input type="radio" name="delivery" id="trade5" onclick="delivery_show(this.value,'delivery_wrap3');" value="신규배송지">신규배송지</label>
                </div>
                <div class="delivery_wrap">
                  <strong class="info">수령인</strong>
                  <div class=delivery_input><input id="inputtext" type="text" name="recipient" value="{{$user->c_name}}"></div>
                </div>
                <div class="delivery_wrap">
                  <strong class="info">전화번호</strong>
                  <select name="phone_no1" id="delivery_tel_no1" class="delivery_tel">
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
                  <input type="text" title="휴대폰 중간번호" id="delivery_tel_no2"maxlength="4" class="delivery_tel" name="phone_no2" value="{{explode('-',$user->c_phonenum)[1]}}">
                  -
                  <input type="text" title="휴대폰 뒷자리" id="delivery_tel_no3" maxlength="4" class="delivery_tel" name="phone_no3" value="{{explode('-',$user->c_phonenum)[2]}}">
                </div>
                <strong class="info">주 소</strong>
                <!-- 우편번호 -->
              </div>
              <!--주소 -->
              <div class="delivery_wrap2" id="delivery_wrap2">
                <input type="text" class="postcode"  placeholder="우편번호"  disabled value="{{$useraddress[0]->a_post}}">
                <input type="button" class="find_post" value="우편번호"><br>
                <input type="text" class="address" placeholder="주소"  disabled value="{{$useraddress[0]->a_address}}">

                <div class="delivery_address_detail">
                  <input type="text" class="delivery_address_list"  placeholder="상세주소"  disabled value="{{$useraddress[0]->a_detail}}">
                  <input type="text" class="delivery_address_list"  placeholder="참고항목"  disabled value="{{$useraddress[0]->a_extra}}">
                </div>
              </div>
              <div class="delivery_wrap2" id="delivery_wrap3" style="display:none;">
                <input type="text" class="postcode" id="postcode" placeholder="우편번호" readonly name="postcode" value="">
                <input type="button" class="find_post" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                <input type="text" class="address" id="address" placeholder="주소" readonly name="address" value="">
                <div class="delivery_address_detail">
                  <input type="text" class="delivery_address_list" id="detailAddress" placeholder="상세주소" name="detailAddress" >
                  <input type="text" class="delivery_address_list" id="extraAddress" placeholder="참고항목" name="extraAddress">
                </div>
              </div>
              @if(isset($latestaddress))
                <div class="delivery_wrap2" id="delivery_wrap4" style="display:none;">
                  <input type="text" class="postcode"  placeholder="우편번호"  disabled value="{{$latestaddress->d_post}}">
                  <input type="button" class="find_post"  value="우편번호"><br>
                  <input type="text" class="address"  placeholder="주소"  disabled value="{{$latestaddress->d_address}}">
                  <div class="delivery_address_detail">
                    <input type="text" class="delivery_address_list"  placeholder="상세주소" disabled value="{{$latestaddress->d_detailaddress}}">
                    <input type="text" class="delivery_address_list"  placeholder="참고항목" disabled value="{{$latestaddress->d_extraaddress}}">
                  </div>
                </div>
              @else
                <div class="delivery_wrap2" id="delivery_wrap4" style="display:none;">
                  <input type="text" class="postcode"  placeholder="우편번호"  disabled value="">
                  <input type="button" class="find_post"  value="우편번호"><br>
                  <input type="text" class="address"  placeholder="주소"  disabled value="">
                  <div class="delivery_address_detail">
                    <input type="text" class="delivery_address_list"  placeholder="상세주소" disabled value="">
                    <input type="text" class="delivery_address_list"  placeholder="참고항목" disabled value="">
                  </div>
                </div>
              @endif
              <div><strong class="info">요청사항</strong><input id="inputtext1" type="text" name="request"></div>


              <!--결제창-->
              <div class="pay_data">
                <div class="pay_cash">
                  <div class="pay_cash1" style="float:left; width:67%; font-size:1.1em;">
                    cash 잔액 : <strong>{{number_format(auth()->guard('customer')->user()->c_cash)}}</strong>
                  </div>
                  <div class="pay_cash2" style="float:left; width:33%; text-align:right;">
                    <input class="bt_ch" type="button" value="충전하기" onclick="showPopup();" name="charge">
                  </div>
                </div>
                <div class="pay_point" style="font-size:1.1em;">
                  잔여포인트 : <strong>{{number_format($point)}} P</strong>
                </div>
                <div class="" style="font-size:1.1em;">
                  <input type="text" name="userpoint" id="userpoint" onkeyup="insertpoint()" value="0" style="padding:0;width: 100px; height: 20px;vertical-align:middle; text-align:right; border:none; border-bottom:1px solid #d6d6d6;" ><span style="border-bottom:solid 1px #d6d6d6;padding-bottom:1px;">원</span>
                  <input class="bt_ch" type="button" style="cursor:pointer; font-size:0.7em;" onclick="pointall()" value="전액사용">                </div>
                  <div class="">
                    <input type="button" href="#layer1" class="btn-layer" style="cursor:pointer; font-size:1em; width: 8em;" value="내 보유쿠폰 보기">                  </div>
                    <div class="send-coupon_no">
                      적용쿠폰
                      <input type="hidden" name="coupon_no" id="coupon_no" value="">
                    </div>
                    <strong class="apply-coupon">
                    </strong>
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
                      <tr><td> 가격 : {{$value[0]->b_price}}</td></tr>
                      <tr><td> 수량 : {{$value[0]->b_count}}</td></tr>
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
                    <tr><td>가격 : {{$productprice}}</td></tr>
                    <tr><td>수량 : {{$productcount}}</td></tr>
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
                <style media="screen">
                .tablebox1 tr td,th{
                  font-size: 20px;
                  padding-bottom: 10px;
                }
                </style>
                <table class="tablebox" cellpadding="10" cellspacing="10" width="100%">
                  <tr>
                    <th class="tablebox_th">주문자</th>
                    <td class="order_text">{{$user->c_name}}</td>
                  </tr>
                  <tr>
                    <th class="tablebox_th">연락처</th>
                    <td class="order_text">{{$user->c_phonenum}}</td>
                  </tr>
                </table>
                {{-- <div class="detail">
                주문자 정보를 정확하게 입력해주세요.
              </div> --}}
            </div>
            <div class="payresult">
              <div class="payinfo">결제정보
              </div>
              <hr class="line1">
              <div class="paymentbox">
                <div style="padding-left:5px; padding-right:1px">
                  <div class="hi" style="text-align:left; padding-top:5px; float:left; width:50%; font-size:25px;">
                    <strong>총 상품 가격</strong>
                  </div>
                  <div class="hi1" style="padding-bottom:15px; font-size:35px; float:left; width:50%; text-align:right;">
                    <strong id="priceall">{{number_format($productsum)}}</strong> 원
                  </div>
                </div>
                <hr style="margin-bottom:8px;">
                <table class="tablebox1" cellpadding="10" cellspacing="10" width="100%">
                  <tr>
                    <th class="ordertext">cash 잔액</th>
                    <td class="order_text">{{number_format(auth()->guard('customer')->user()->c_cash)}}원</td>
                  </tr>
                  <tr>
                    <th class="ordertext">상품 가격</th>
                    <td class="order_text" id="productpr" style="color: #4374D9;">(+) {{number_format($productprice)}}원</td>
                  </tr>
                  <tr>
                    <th class="ordertext">배송비</th>
                    <td class="order_text" style="color: #4374D9;">(+) {{number_format($productdelivery)}}원</td>
                  </tr>
                  <tr>
                    <th class="ordertext">포인트</th>
                    <td class="order_text" style="color: #F15F5F;">(-) <span id="paymentpoint">0</span>원</td>
                  </tr>
                  <tr>
                    <th class="ordertext">쿠폰</th>
                    <td class="order_text" style="color: #F15F5F;">(-)
                      <span id="paymentcoupon">0</span>원</td>
                    </tr>
                    <tr>
                      <th class="ordertext">결제 후 잔액</th>
                      @if(auth()->guard('customer')->user()->c_cash-$productsum<0)
                        <td class="order_text" id="cashcheck0" style="font-weight:bold;">잔액이 부족합니다 !</td>
                      </tr>
                    </table>
                    <hr class="line2">
                    <div class="line"><label><input class="check" type="checkbox" name="ck" id="ck"> 주문내역 확인 동의(필수)</label></div>
                    <div class="line"><input class="end" type="submit" value="다음"></div>
                  @else
                    <td class="order_text" id="cashcheck0" style="font-weight:bold;">{{number_format(auth()->guard('customer')->user()->c_cash-$productsum)}}원</td>
                  </tr>
                </table>
                <hr class="line2">
                <div class="line" style="color: #F15F5F;"><label><input class="check" type="checkbox" name="ck" id="ck"> 주문내역 확인 동의(필수)</label></div>
                <div class="line"><input class="end" type='submit' value="다 음" ></div>
              @endif

            </form>
            <form class="" action="" method="post" id="form1" name="form1">
              @csrf
              <input type="hidden" name="frm" id="frm" value="{{$productprice}}">
            </form>
          </div>
        </div><!--결제정보 -->
      </div><!--오른쪽 주문정보 박스 -->
      <!--컨테이너박스-->
    </div>
  </div>
</div>
{{-- <a href="#layer1" class="btn-layer">레이어 팝업보기</a> --}}
<!-- Start : layer-popup content -->
<div id="layer1" class="layer-wrap">
  <div class="pop-layer">
    <div class="pop-container">
      <div class="pop-conts">
        <!--content //-->
        <div class="btn-r">
          <a class="btn-layerClose">Close</a>
        </div>
        <!--// content-->
      </div>
    </div>
  </div>
</div>
<!-- End : layer-popup content -->
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
  var trade1 = document.getElementById("trade1");
  var trade2 = document.getElementById("trade2");
  var trade3 = document.getElementById("trade3");
  var trade4 = document.getElementById("trade4");
  var trade5 = document.getElementById("trade5");
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

  // if(trade1.checked == trade2.checked){
  //   alert('결제방식을 선택해주세요');
  //   return false;
  // }

  // if(trade1.checked){
  //   return true;
  // }

  // if(trade2.checked){
  if(trade3.checked){
    // 기본배송지
  }
  if(trade4.checked){
    // 최근배송지
  }
  if(trade5.checked){
    if((address.value)==""){
      alert('주소를 입력해주세요');
      return false;
    }
    else if((detail_address.value)==""){
      alert('상세주소를 입력해주세요');
      return false;
    }
  }
  // }

  // if((bank.value)==""){
  //   alert('은행을 선택해주세요');
  //   return false;
  // }
  if($('#cashcheck0').text()=="잔액이 부족합니다 !"){
    alert('잔액이 부족합니다 ! 충전 후 이용하여 주시기 바랍니다.');
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
function delivery_show(s,ss){
  if(s == "신규배송지"){
    if(document.getElementById(ss).style.display=="none"){
      document.getElementById(ss).style.display="block";
      document.getElementById('delivery_wrap2').style.display="none";
      document.getElementById('delivery_wrap4').style.display="none";
    }
  }
  else if(s=="기본배송지"){
    if(document.getElementById(ss).style.display=="none")
    document.getElementById(ss).style.display="block"
    document.getElementById('delivery_wrap3').style.display="none";
    document.getElementById('delivery_wrap4').style.display="none";
  }
  else if(s=="최근배송지"){
    if(document.getElementById(ss).style.display=="none")
    document.getElementById(ss).style.display="block"
    document.getElementById('delivery_wrap2').style.display="none";
    document.getElementById('delivery_wrap3').style.display="none";
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

if(basketarray==''){

  var basketarray = null;

}
$('input[name=getarray]').val(JSON.stringify(getarray));
$('input[name=basketarray]').val(JSON.stringify(basketarray));
// console.log(getarray);


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
<script type="text/javascript">
// function showPopup() {
//   var url="charge_popup";
//   var option="width=700, height=400, top=200"
//   window.open(url, "", option);
// }


var g_oWindow = null;
var g_oInterval = null;
var url="charge_popup";
var option="width=700, height=400, top=200"
var showPopup = function() {
  g_oWindow = window.open(url,"",option);
  // 0.5초 마다 감지
  g_oInterval = window.setInterval(function() {
    try {
      // 창이 꺼졌는지 판단
      if( g_oWindow == null || g_oWindow.closed ) {
        window.clearInterval(g_oInterval);
        g_oWindow = null;
        // Todo....
        //.....
        location.reload();
      }
    } catch (e) { }
  }, 500);
};
function onlyNumber(){
  if((event.keyCode<48)||(event.keyCode>57))
  event.returnValue=false;
  // console.log(1);
}
var cash = {{auth()->guard('customer')->user()->c_cash}};
var point = 0;
var coupon = 0;
var price = Number($('#priceall').text().replace(/[^0-9]/g,''));
var productpr = Number($('#productpr').text().replace(/[^0-9]/g,''));
function insertpoint(){
  var nowprice = $('#userpoint').val($('#userpoint').val().replace(/[^0-9]/g,''));
  point = Number($('#userpoint').val().replace(/[^0-9]/g,''));
  // console.log(point);
  if({{number_format($point)}}<point){
    alert('사용하실 수 있는 포인트보다 많이 입력하셧습니다.');
    point = {{number_format($point)}};
    $('#userpoint').val(AddComma(point));
    $('#priceall').text(AddComma(price - point - coupon));
    $('#paymentpoint').text(AddComma(point));
    replaceprice(cash,point);
  }
  else{
    // var cal = price - point;

    $('#priceall').text(AddComma(price - point - coupon));
    $('#paymentpoint').text(AddComma(point));
    replaceprice(cash,point);

    // console.log(point);
    // console.log();
    // console.log(price- point);
  }
}
function pointall(){
  $('#userpoint').val({{number_format($point)}});
  $('#priceall').text(AddComma(price - {{number_format($point)}} - coupon));
  $('#paymentpoint').text(AddComma({{number_format($point)}}));
  point = Number($('#userpoint').val().replace(/[^0-9]/g,''));
  replaceprice(cash,point);
}
function AddComma(num)
{
  var regexp = /\B(?=(\d{3})+(?!\d))/g;
  return num.toString().replace(regexp, ',');
}
$('#userpoint').blur(function(){
  if($('#userpoint').val()==''){
    $('#userpoint').val('0');
  }
  $('#userpoint').val($('#userpoint').val().replace(/[^0-9]/g,''));
  if($('#userpoint').val()>{{number_format($point)}}){
    $('#userpoint').val({{number_format($point)}});
  }
  // if($('#userpoint').val()<1000){
  //   alert('포인트 최소 사용량은 1,000원 입니다.');
  // }
});
function replaceprice(cash,point){
  if(cash>=Number($('#priceall').text().replace(/[^0-9]/g,''))){
    $('#cashcheck0').text(AddComma(cash+point+coupon-price)+'원');
  }
  else{
    $('#cashcheck0').text('잔액이 부족합니다 !');
  }
}

function couponapply(mypage, myname, w, h, scroll) {
  var winl = (screen.width - w) / 2;
  var wint = (screen.height - h) / 2;
  var frmData = document.forms[1];
  winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable';
  g_oWindow = window.open('', myname, winprops);
  frmData.target = myname;
  frmData.action = mypage;
  frmData.method = "post";
  frmData.submit();
  if (parseInt(navigator.appVersion) >= 4) {
    g_oWindow.window.focus();
  }
  g_oInterval = window.setInterval(function() {
    try {
      // 창이 꺼졌는지 판단
      if( g_oWindow == null || g_oWindow.closed ) {
        window.clearInterval(g_oInterval);
        g_oWindow = null;
        // Todo....
        //.....
        location.reload();
      }
    } catch (e) { }
  }, 500);
}
$('#userpoint').click(function(){
  if($('#userpoint').val()==0){
    $('#userpoint').val('');
  }
});
// var couponapply = function() {
//   g_oWindow = window.open(url,"",option);
//   // 0.5초 마다 감지
//
// };
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
var html = 0;
function layerpopup(){
  // console.log();
  // return false;
  var frmData = $('#frm').val();
  // var frmData = document.forms[1];
  $.ajax({
    url:'/layerpopup', //request 보낼 서버의 경로
    type:'post', // 메소드(get, post, put 등)
    data:{'price':frmData}, //보낼 데이터
    success: function(data) {
      // console.log(data);
      html = data;
      $('.pop-conts').html(html);
      // var list = document.querySelector('.pop-conts');
      // list.innerHTML = html;
      var target = $('.btn-layer').attr('href');
      $(target).fadeIn();
      return false;
      if(data==1){
        alert('적용되었습니다!');
      }
      else if(data==0){
        alert('쿠폰사용 조건의 최소금액을 만족하지 않습니다!');
      }

      //서버로부터 정상적으로 응답이 왔을 때 실행
    },
    error: function(data) {
      // console.log(data);

      //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
    }
  });
  // return false;

}
$('.btn-layer').on('click', function() {
  layerpopup();
});
$(document).on('click','.btn-layerClose', function() {
  $('.layer-wrap').fadeOut();
});
function apply(e){
  // return false;
  $.ajax({
    url:'/couponapply', //request 보낼 서버의 경로
    type:'post', // 메소드(get, post, put 등)
    data:{'id':e}, //보낼 데이터
    success: function(data) {
      // console.log(data);
      // return false;
      if(data==0){
        alert('쿠폰사용 조건의 최소금액을 만족하지 않습니다!');
        return false;
      }
      $('#coupon_no').val(e);
      coupon = data[0].cp_flatrate;
      $('#paymentcoupon').text(AddComma(coupon));
      $('#priceall').text(AddComma(price - point - coupon));
      $('.apply-coupon').text(data[0].cp_title+' '+AddComma(coupon)+'원');
      $('.apply-coupon').append($('<img class="coupon_cancel" src="/imglib/delete.png" style="cursor:pointer; vertical-align:middle;padding-left:4px;margin-bottom:4px;">'));
      replaceprice(cash,point);
      alert('적용되었습니다!');
      $('.layer-wrap').fadeOut();
      return false;
      //서버로부터 정상적으로 응답이 왔을 때 실행
    },
    error: function(data) {
      // console.log(data);
      alert('요청에 실패하였습니다.');
      //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
    }
  });
  // return false;
}
$(document).on('click','.coupon_cancel', function() {
  alert('사용이 취소되었습니다.');
  coupon=0;
  $('.apply-coupon').text('');
  $('#priceall').text(AddComma(price - point - coupon));
  $('#paymentcoupon').text(AddComma(coupon));
  $('#coupon_no').val('');
  replaceprice(cash,point);
  $('.layer-wrap').fadeOut();
});
</script>
{{-- <button type="button" onclick="test('Spinner.gif');" name="button">로딩용</button> --}}
{{-- <button type="button" onclick="alert(getCookie('paymentcookie'))" name="button">쿠키확인용</button> --}}
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
{{-- <script type="text/javascript" src="/js/radio.js" charset="utf-8"></script> --}}
