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

</head>
<script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" type="text/javascript">
</script>
<body>
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
                <td>c_name(c_phonenum)</td>
              </tr>
            </table>
          </div>
          <div class="customerbox2">
            <!--결제 정보 창-->
            <form class="info" action="#" method="post">
              @csrf
              <div class="delivery_wrap">
                <strong class="info">수령인</strong>
                <div class=delivery_input><input id="inputtext" type="text" name="recipient"></div>
              </div>

              <div class="delivery_wrap">
                <strong class="info">전화번호</strong>
                <!-- <div class=delivery_input><input id="inputtext" type="text" name="order_tel"></div> -->
                <!-- <input type="text" title="휴대폰 앞자리" id="delivery_tel_no1" class="delivery_tel"> -->
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
                <input type="text" title="휴대폰 중간번호" id="delivery_tel_no2" class="delivery_tel">
                -
                <input type="text" title="휴대폰 뒷자리" id="delivery_tel_no3" class="delivery_tel">
              </div>
              <div id="trade0">
              <input type="radio" name="trade" id="trade1"  value="직접거래" onclick="div_show(this.value,'divshow');">직접거래
              <input type="radio" name="trade" id="trade2" value="무통장입금" onclick="div_show(this.value,'divshow');">무통장입금
            </div>
              <div id="divshow" style="display:none;">
                <div class="delivery_wrap">
                  <strong class="info">주 소</strong>
                  <!-- 우편번호 -->
                  <input type="text" id="postcode" placeholder="우편번호">
                  <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                </div>
                <!--주소 -->
                <div class="delivery_wrap2">
                  <input type="text"  id="address" placeholder="주소">

                  <div class="delivery_address_detail">
                    <input type="text" class="delivery_address_list" id="detailAddress" placeholder="상세주소">
                    <input type="text" class="delivery_address_list" id="extraAddress" placeholder="참고항목">
                  </div>
                </div>
                <div><strong class="info">요청사항</strong><input id="inputtext" type="text" name="request"></div>
              </table>

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
          <div class="product_data">
            <!--product_imabe Table에서 product_no에 맞는 i_filename 가져오기-->
            <table cellpadding="10" cellspacing="10" width="300px">
              <tr>
                <td rowspan="2"><img class="product_image" src="dummy.jpg" alt="Flower Image" width="100px" height="100px"></td>
                <td>상품명 : p_name</td>
              </tr>
              <tr><td>리시안셔스/옵션선택 : 안함</td></tr>
            </table>
          </div>
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
                <td class="order_text">c_name</td>
              </tr>
              <tr>
                <th>연락처</th>
                <td class="order_text">c_phonenum</td>
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
                  <td class="order_text">p_price</td>
                </tr>
                <tr>
                  <th>배송비</th>
                  <td class="order_text">p_delivery</td>
                </tr>
                <tr id="paypay">
                  <th>결제금액</th>
                  <td class="order_text">p_price + p_delivery</td>
                </tr>
              </table>
              <hr class="line2">
            </form>
            <form class="check" action="/complete" onsubmit="return checkform()" name="check">
              <div class="line"><label><input class="check" type="checkbox" name="ck" id="ck"> 주문내역 확인 동의(필수)</label></div>
              <div class="line"><input class="end" type='submit' value="다음" ></div></form>
            </div>
          </div><!--결제정보 -->
        </div><!--오른쪽 주문정보 박스 -->
        <!--컨테이너박스-->
      </div>
    </div>
  </div>
  @include('lib.footer')
</body>
<script type="text/javascript">


function checkform(){

  var check1=document.check.ck.checked;
  if(!check1){
    alert('약관에 동의해 주세요');
    return false;
  }


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

  if((middlenum.value)==""){
    alert('중간번호를 입력해주세요');
    return false;
  }

  if((lastnum.value)==""){
    alert('번호 뒷자리를 입력해주세요');
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
}

function div_show(s,ss){
  if(s == "직접거래"){
    document.getElementById(ss).style.display="none";
  }else{
    document.getElementById(ss).style.display="";


  }
}
</script>
</html>

<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/radio.js" charset="utf-8"></script>
