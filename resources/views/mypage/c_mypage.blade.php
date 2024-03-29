<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/c_mypage.css">
  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

</head>

<body>

  @include('lib.header')

  <div class="myinfo">
    <div class="privacy">
      <div class="mytitle">내 정보 관리</div>
      <table border="0" table class="table1" >
        @if ($customer = auth()->guard('customer')->user())
          <div id="tablewrap">
            <table  id="shopinfo">
              <tbody>
                <tr class="tr1">
                  <th class="th1">아이디</th>
                  <td><div class="tdcell"><p class="contxt.tit">{{$customer->c_id}}</p></div></td>
                </tr>
                <tr class="tr1">
                  <th class="th1">비밀번호</th>
                  <td>
                    <div class="tdcell"><p class="contxt.tit"><input class="pw" type="password" id="origin_password" name="origin_password"  placeholder="기존 비밀번호를 입력해주세요">
                      <input class="lg_bt" type="button" onclick="check_password()" value="확인"></div>
                      <div class="check_div" id="password_check" value=""></div>

                      <form action="/c_modipw" onsubmit="return pw_checkform()" method="post">
                        @csrf
                        <div class="tdcell"><p class="contxt.tit"><input class="pw" type="password" id="new_pw" name="new_pw" disabled placeholder="새 비밀번호">
                          <button type="submit" name="button">수정완료</button></p></div>
                        </div>
                      </form>
                    </td>
                  </tr>


                  <tr class="tr1">
                    <th class="th1">이름</th>
                    <td>
                      <div class="tdcell"><p class="contxt.tit">{{$customer->c_name}}</p></div>
                    </td>
                  </tr>
                  <form action="c_information_controller" onsubmit="return phonenum_checkform()" method="post">
                    @csrf
                    <tr class="tr1">
                      <th class="th1">연락처</th>
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
                      </td>
                    </tr>
                  </form>
                  <form action="c_modiemail" onsubmit="return email_checkform()" method="post">
                    @csrf
                    <tr class="tr1">
                      <th class="th1">이메일</th>
                      <td>
                        <div class="tdcell"><p class="contxt.tit">{{$customer->c_email}}<input type="button" id=modiemail value="이메일수정" name="modi" display="block" onclick="info_modification(this.value,'email' );"></p></div>
                        <div id="email" style="display:none;">
                          <input type="text" id="new_email" name="new_email"  placeholder="새 이메일">
                          <button type="submit" name="button">수정완료</button>
                        </div>
                      </td>
                    </tr>
                  </form>

                  @foreach ($data as $a)
                    <tr class="tr1">
                      <th class="th1">주소</th>
                      <td>
                        <div class="tdcell"><p class="contxt.tit">({{$a->a_post}}){{$a->a_address}}, {{$a->a_detail}}{{$a->a_extra}}<input type="button" id=modiaddress value="주소수정" name="introduce" display="block" onclick="div_show(this.value,'addresswrap' );"></p></div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div id="addresswrap" style="display:none;">
                <form id=nadress action="c_newaddress" onsubmit="return address_checkform()" method="post">
                  @csrf
                  <div class="delivery_wrap">
                    <strong class="info">새 주소</strong>
                  </div>
                  <div class="delivery_wrap2">
                    <!-- 우편번호 -->
                    <input type="text" id="postcode" name="postcode" placeholder="우편번호" >
                    <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                    <!--주소 -->
                    <input type="text"  id="address" name="address" placeholder="주소" readonly><br>
                    <input type="text" class="delivery_address_list" name="extraAddress"id="extraAddress" placeholder="참고항목" readonly><br>
                    <input type="text" class="delivery_address_list" name="detailAddress" id="detailAddress" placeholder="상세주소" >
                    <button type="submit" id="complete1"  name="button" >수정완료</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="walletwrap">
              @foreach ($data3 as $data3)
                <div class="mytitle">내 지갑 <input class="bt_ch" type="button" value="충전하기" onclick="showPopup();" name="charge"><input class="bt_ch" type="button" value="포인트 적립내역" onclick="showpoint({{$data3->c_no}});" name="mpoint"></div>

                <div class="mymoney">
                  보유 금액 : <strong>{{number_format($data3->c_cash)}}</strong>원
                </div>
                <div class="mypoint">
                  보유 포인트 : <strong>{{number_format($data3->c_point)}}</strong>원
                </div>
              @endforeach
            </div>


            {{-- <div class="myorder">
            <span class="mytitle" align="left">나의 주문 현황</span> <span>구매확정을 누르시면 구매금액의 3%가 적립됩니다.</span>
            <div class="ordertable">
            @if(count($data2))
            <table class="order" border="0" width="100%">
            <thead>
            <tr class="p_tr">
            <th>상품이미지</th>
            <th>주문날짜</th>
            <th>주문번호</th>
            <th>결제번호</th>
            <th>상품명</th>
            <th>수량</th>
            <th>구매금액</th>
            <th>주문처리상태</th>
            <th>후기 작성</th>
            <th>구매 확정</th>
            <th>배송조회</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($data2 as $data2)
        <tr>
        <td><a href="product/{{$data2->p_no}}"><img src="imglib/{{$data2->p_filename}}" width="100px" height="100px"></a></td>
        <td>{{$data2->pm_date}}</td>
        <td><a href="product/{{$data2->p_no}}">{{$data2->o_no}}</a></td>
        <td><a href="product/{{$data2->p_no}}">{{$data2->pm_no}}</a></td>
        <td><a href="product/{{$data2->p_no}}">{{$data2->p_name}}</a></td>
        <td>{{$data2->pm_count}}</td>
        <td>{{$data2->pm_pay}}</td>
        <td>{{$data2->pm_d_status}}</td>
        @if($data2->pm_status == '결제 완료'||$data2->pm_status == '구매 확정')
        @if(!isset($data2->payment_no))
        <td><input type="button" value="구매후기" onclick="show_popup({{$data2->pm_no}})"></td>
      @else
      <td>작성완료</td>
    @endif
  @else
  <td></td>
@endif
@if($data2->pm_status == '결제 대기')
<td> --}}
{{-- <form action="/pd_cancel{{$data2->pm_no}}" method="post">
@csrf --}}
{{-- <input type="submit" class="cancel" value="결제 취소"> --}}
{{-- </form> --}}
{{-- </td>

@elseif($data2->pm_d_status == '배송중')
<td>
<form action="/pd_point{{$data2->p_price}}" method="post">
<input type="hidden" name="hidden" value="{{$data2->pm_no}}">
@csrf
<input type="submit" id="confirm" value="구매확정">
</form>
</td>
@elseif($data2->pm_status == '구매 확정')
<td>구매확정 완료</td>
@elseif($data2->pm_status == '결제 취소')
<td>결제 취소</td>
@else
<td></td>
@endif
@if(isset($data2->pm_company))
<td id="delivery_search"><button id="delivery_search_btn" onclick="window.open('https://tracker.delivery/#/{{$data2->delivery_code}}/{{$data2->pm_invoice_num}}'),'배송조회',width='300px',height='300px'">배송조회</button></td>
@else
<td id="delivery_search"></td>
@endif
</tr>
@endforeach
</tbody>
</table>

@else
<div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
<div class="" style="top:180px; position:absolute; left:300px; ">
주문목록이 없습니다.
</div>
</div>
@endif
</div>
</div> --}}

<div class="myreview">
  <div class="mytitle" align="left">내 후기</div>
  <table class="table_review" id="reviews">
    <thead>
      <tr class="r_tr">
        <th class="r_pname">상품명</th>
        <th class="r_con">후기</th>
        <th class="r_date">작성일</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($my as $re)
        <tr class="r_tr" onclick="location.href='/product/{{$re->p_no}}#revw'" style="cursor: pointer;">
          <td class="r_td">{{$re->p_name}}</td>
          <td class="r_td">{{$re->r_contents}}</td>
          <td class="r_td" style="text-align:center;">{{$re->r_date}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

@include('lib.footer')
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>
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

function showPopup() {
  var url="charge_popup";
  var option="width=700, height=400, top=100, left=50px"
  window.open(url, "", option);
}


function div_show(s,ss){
  if(s == "주소수정"){
    document.getElementById(ss).style.display="block";
    ad.style.display="none";
    complete1.style.display="block";
    addresswrap.style.display="block";
  }
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function check_password(){
  var a = document.getElementById("origin_password");

  if((a.value)==""){
    $('#password_check').text("Password를 입력해주세요.");
    $('#password_check').css('color', 'red');
    $("#origin_password").focus();
    $("#new_pw").attr("disabled", "disabled")
    return false;
  }

  var origin_password = $('#origin_password').val();
  $.ajax({

    type: 'post',
    url: 'check_pw',
    dataType: 'json',
    data:{
      "input_password" : origin_password
    },

    success : function(data) {
      if(data==0){
        $('#password_check').text("Password가 일치하지 않습니다.");
        $('#password_check').css('color', 'red');
        $("#origin_password").focus();
        $("#new_pw").attr("disabled", "disabled");
      }
      else if(data==1){
        document.getElementById('password_check').style.display="none";
        $("#new_pw").removeAttr("disabled");
        $("#new_pw").focus();
        $("#origin_password").attr("disabled", "disabled");
      }
    }
    ,error : function()
    {}
  });
}





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

function address_checkform(){
  var address = document.getElementById("postcode");
  if((address.value)==""){
    alert("새 주소를 입력해주세요");
    return false;
  }
}


var openWin;
function showpoint(cno)
{
  // window.name = "부모창 이름";
  window.name = "parentForm";
  // window.open("open할 window", "자식창 이름", "팝업창 옵션");
  openWin = window.open("/mypoint"+cno,
  "childqna", "width=550px, height=700px, left=600px, top=100px ");
}

$(document).ready(function(){
  $("#reviews").DataTable({
    "language": {
      "emptyTable": "작성한 후기가 없습니다.",
      "lengthMenu": "페이지당 _MENU_ 개씩 보기",
      "info": "현재 _START_ - _END_ /  _TOTAL_건",
      "infoEmpty": "데이터 없음",
      "infoFiltered": "(전체  _MAX_건의 데이터에서 필터링됨 )",
      "search": "검색",
      "zeroRecords": "일치하는 데이터가 없습니다.",
      "loadingRecords": "로딩중...",
      "processing":     "잠시만 기다려 주세요...",
      "paginate": { "next": "다음", "previous": "이전"  }
    }
  });
});
</script>

@endif
</body>
</html>

<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.cancel').click(function(){
  var tdArr = new Array();    // 배열 선언
  var checkBtn = $(this);
  var tr = checkBtn.parent().parent();
  var td = tr.children();
  var number = td.eq(3).text();

  $.ajax({
    type: 'post',
    url: '/refund',
    dataType: 'json',
    data: { "number" : number,
  },
  success: function(data) {
    console.log(data);
    // return false;
    if(data==1){
      alert('취소되었습니다.');
      location.reload();
    }
  },
  error: function() {
    console.log('실패');
  }
});
});




</script>
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
