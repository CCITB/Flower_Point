<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/locate.css">
  <link rel="stylesheet" href="/css/shop.css">
  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

</head>

<body>
  @include('lib.header')
  <div class="menu4">
    <h3 align="center">마이페이지</h3>
    <hr align="left" class="one">
  </hr>
</div>
<div class="myinfo">
  <h4>내 정보</h4>
  <div class="privacy">
    <table border="0" table class="table1" >
      @if ($customer = auth()->guard('customer')->user())
        <div id="tablewrap">
          <table id="shopinfo">
            <tbody>
              <tr class="tr1">
                <th class="th1">
                  <div class="thcell">아이디</div>
                </th>
                <td>
                  <div class="tdcell"><p class="contxt.tit">{{$customer->c_id}}</p></div>
                </td>
              </tr>

              <form action="/c_modipw" onsubmit="return pw_checkform()" method="post">
                @csrf
                <tr class="tr1">
                  <th class="th1">
                    <div class="thcell">비밀번호</div>
                  </th>
                  <td>
                    <div class="tdcell"><p class="contxt.tit"><input type="password" id="new_pw" name="new_pw"  placeholder="새 비밀번호">
                      <button type="submit" name="button">수정완료</button></p></div>
                    </div>
                  </td>
                </tr>
              </form>


              <tr class="tr1">
                <th class="th1">
                  <div class="thcell">이름</div>
                </th>
                <td>
                  <div class="tdcell"><p class="contxt.tit">{{$customer->c_name}}</p></div>
                </td>
              </tr>
              <form action="c_information_controller" onsubmit="return phonenum_checkform()" method="post">
                @csrf
                <tr class="tr1">
                  <th class="th1">
                    <div class="thcell">연락처</div>
                  </th>
                  <td>
                    <div class="tdcell"><p class="contxt.tit">{{$customer->c_phonenum}}<input type="button" id=modinum value="연락처수정" name="modi" display="block" onclick="info_modification(this.value,'p_num' );"></button></p></div>

                    <div id="p_num" style="display:none;">
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
                      <input type="text" title="휴대폰 중간번호" name="delivery_tel_no2" id="delivery_tel_no2" class="delivery_tel" maxlength="4">
                      -
                      <input type="text" title="휴대폰 뒷자리" name="delivery_tel_no3" id="delivery_tel_no3" class="delivery_tel" maxlength="4">
                      <button type="submit" name="button">수정완료</button>
                    </div>




                    <script type="text/javascript">

                    function info_modification(s,ss){
                      if(s == "연락처수정"){
                        document.getElementById(ss).style.display="block"
                        modinum.style.display="none";
                      }
                      else if(s == "이메일수정"){
                        document.getElementById(ss).style.display="block"
                        modiemail.style.display="none";
                      }
                      else if(s == "주소수정"){
                        document.getElementById(ss).style.display="block"
                        modiaddress.style.display="none";
                      }
                      else if(s == "비밀번호수정"){
                        document.getElementById(ss).style.display="block"
                        modiaddress.style.display="none";
                      }
                    }
                    </script>

                  </td>
                </tr>
              </form>
              <form action="c_modiemail" onsubmit="return email_checkform()" method="post">
                @csrf

                <tr class="tr1">
                  <th class="th1">
                    <div class="thcell">이메일</div>
                  </th>
                  <td>
                    <div class="tdcell"><p class="contxt.tit">{{$customer->c_email}}<input type="button" id=modiemail value="이메일수정" name="modi" display="block" onclick="info_modification(this.value,'email' );"></p></div>
                    <div id="email" style="display:none;">
                      <input type="text" id="new_email" name="new_email"  placeholder="새 이메일">
                      <button type="submit" name="button">수정완료</button>
                    </div>

                  </td>
                </tr>
              </form>


              <form action="c_newaddress" method="post">
                @csrf
                @foreach ($data as $a)
                  <tr class="tr1">
                    <th class="th1">
                      <div class="thcell">주소</div>
                    </th>
                    <td>
                      <div class="tdcell"><p class="contxt.tit">({{$a->a_post}}) {{$a->a_address}}, {{$a->a_detail}}{{$a->a_extra}}<input type="button" id=modiaddress value="주소수정" name="introduce" display="block" onclick="div_show(this.value,'addresswrap' );"></p></div>
                    </td>
                  </tr>
                </div>
              @endforeach
            </form>
          </table>


          <form id=nadress action="c_newaddress" onsubmit="return checkform()" method="post">
            @csrf
            <div id="addresswrap" style="display:none;">
              <div id="addressmodi">
                <div class="delivery_wrap">
                  <strong class="info">새 주 소</strong>
                  <!-- 우편번호 -->
                  <input type="text" id="postcode" name="postcode" placeholder="우편번호" >
                  <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                </div>
                <!--주소 -->
                <div class="delivery_wrap2">
                  <input type="text"  id="address" name="address" placeholder="주소" readonly>
                  <div class="detail">
                    <input type="text" class="delivery_address_list" name="extraAddress"id="extraAddress" placeholder="참고항목" readonly>
                  </div>
                  <div class="delivery_address_detail">
                    <input type="text" class="delivery_address_list" name="detailAddress" id="detailAddress" placeholder="상세주소" >
                  </div>
                </div>
              </div>
              <button type="submit" id="complete1" name="button" >수정완료</button>
            </div>
          </form>
          <script type="text/javascript">
          function div_show(s,ss){
            if(s == "주소수정"){
              document.getElementById(ss).style.display="block";
              ad.style.display="none";
              complete1.style.display="block";
              addresswrap.style.display="block";
            }
          }
          </script>
        </tbody>

      </table>

      <div class="tablespace3">
        <h4 align="left">나의 주문 현황</h4>

        {{-- <table class="myorder" table border="0">
          <tr>
            <td>기간별조회</td>
            <td><button class="period">1주일</button></td>
            <td><button class="period">1개월</button></td>
            <td><button class="period">3개월</button></td>
            <td><input type="date"></td>
            <td><button>조회</button></td>
          </tr>
        </table> --}}
        @if(count($data2))
        <table class="order" border="1" width="100%">
          <tr>
            <th>주문번호</th>
            <th>상품명</th>
            <th>구매금액</th>
            <th>주문처리상태</th>
            <th></th>
          </tr>

          @foreach ($data2 as $data2)
            <tr>
              <td>1</td>
              <td>{{$data2->p_name}}</td>
              <td>{{$data2->pm_pay}}</td>
              <td>{{$data2->pm_status}}</td>
              <td><input type="button" value="구매후기" onclick="show_popup()"></td>
            </tr>
          @endforeach
        </table>
      @else
        <div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
          <div class="" style="top:180px; position:absolute; left:300px; ">
            주문목록이 없습니다.
          </div>
        </div>
      @endif
      </div>

      <div class="tablespace5">
        <h4 align="left">나의후기</h4>
        <style media="screen">
        table.order,table.myreview{
          width: 100%;
          border: 1px solid #444444;
          border-collapse: collapse;
        }
        </style>
        <table class="myreview" border="1" width=100%>
          <tr>
            <th>상품평</th>
            <th>후기</th>
          </tr>
          <tr>
            <th>a</th>
            <td>b</td>
          </tr>
          <tr>
            <th>c</th>
            <td>d</td>
          </tr>
          <tr>
            <th>e</th>
            <td>f</td>
          </tr>
        </table>
      </table>
    </div>
  </div>
</div>

@include('lib.footer')

<script type="text/javascript">
function pw_checkform(){
  var regex = /^[A-Za-z0-9!\@\#\$\%\^\&\*]{8,16}$/;
  // var special = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;


  // var num =  /^[0-9]{3,4}$/;
  var password = document.getElementById("new_pw");

  if(!regex.test(password.value)){
    alert(' 문자 / 숫자를 포함한 8~16자리 이내의 비밀번호를 입력해주세요');
    return false;
  }
  else{
    alert('변경되었습니다');
    return true;
  }
}

function phonenum_checkform(){
  var special = /[\{\}\[\]\/?.,;:|\)*~`!^\-+<>@\#$%&\\\=\(\'\"\s]/gi;
  var middlenum = document.getElementById("delivery_tel_no2");
  var lastnum = document.getElementById("delivery_tel_no3");
  var num =  /^[0-9]{3,4}$/;
  // var regExp = /^\d{3,4}\d{3,4}\d{4}$/;
  // var phonenum = document.getElementById("new_num");
  if(!num.test(middlenum.value)){
    alert('중간 4자리의 숫자를 입력해주세요')
    return false;
  }
  if(special.test(middlenum.value)){
    alert('숫자만 입력해주세요.')
    return false;
  }
  if(!num.test(lastnum.value)){
    alert('뒤 4자리의 숫자를 입력해주세요')
    return false;
  }
  if(special.test(lastnum.value)){
    alert('숫자만 입력해주세요.');
  }
  else {
    alert("변경되었습니다");
    return true;
  }
}

function email_checkform(){
  var email = document.getElementById("new_email");
  var emailcheck = /^[0-9a-zA-Z][0-9a-zA-Z\_\-\.\+]+[0-9a-zA-Z]@[0-9a-zA-Z][0-9a-zA-Z\_\-]*[0-9a-zA-Z](\.[a-zA-Z]{2,6}){1,2}$/
  if(!emailcheck.test(email.value)){
    alert("올바른 형식의 이메일을 입력해주세요");
    return false;
  }
  else{
    alert("변경되었습니다");
    return true;
  }
}

function show_popup() { // 리뷰 팝업창 띄우기 -- 박소현
  var rev_pop = window.open("/review", "리뷰팝업창", "width=550px, height=680px, left=570px, top=150px ");
}
</script>

@endif
</body>
</html>
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
