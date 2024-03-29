<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" type="text/css" href="/css/orderlist.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- <script src="https://info.sweettracker.co.kr/api/v1/companylist?t_key=2A8EDai0BMFebqhDkoYuPw" -H  "accept: application/json;charset=UTF-8"></script> -->
</head>

<!-- 어지수 -->
<body>
  @include('lib.header')
  <div class="myoderlist-wrap">
    <div class="order_line">
      <div id="line">

        <div class="mytitle">나의 주문관리</div>
        <table class="order_table">
          <tr>
            <!-- <td rowspan="3" class="orderpicture">사진</td>
            <td class="orderblink">입금대기</td>
            <td class="ordercount">0</td>
            <td class="orderspace">건</td> -->
            <td rowspan="3" class="orderpicture"><img width="100px"height="100px" src="/imglib/delivery1.png"/></td>
            <td class="order_list">배송준비</td>
            <td class="order_num"><div id="shipping_wait_cnt"><p align="right">{{$d_wait}}</p></div></td>
            <td class="order_cnt">건</td>
            <td rowspan="3" class="orderpicture"><img width="100px"height="100px" src="/imglib/delivery2.png"/></td>
            <!-- <td class="orderblink">취소요청</td> -->
            <td class="order_list">결제대기</td>
            <td class="order_num"><div id="payment_wait_cnt"><p id="rightsort" align="right">{{$pm_wait}}</p></div></td>
            <td class="order_cnt">건</td>
          </tr>
          <tr>
            <td class="order_list">배송중</td>
            <td class="order_num"><div id="delivery_cnt"><p id="rightsort" align="right">{{$d_ing}}<p></div></td>
              <td class="order_cnt">건</td>
              <td class="order_list">반품요청</td>
              <td class="order_num"><p id="rightsort" align="right">0<p></td>
                <td class="order_cnt">건</td>
              </tr>
              <tr>
                <!-- <td>오늘출발</td>
                <td>0</td>
                <td>건</td> -->
                <td class="order_list">배송완료</td>
                <td class="order_num"><div id="complete_cnt"><p id="rightsort" align="right">{{$d_complete}}</p></div></td>
                <td class="order_cnt">건</td>
                <td class="order_list">교환요청</td>
                <td class="order_num"><p id="rightsort" align="right">0</p></td>
                <td class="order_cnt">건</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="myorderlist">
          <div class="myorderlist-top">
            <div class="myorderlist-infor">

              @if(count($order))
              <div class="sellerorderlist">
                <!-- <form class="" action="index.html" method="post" name="mycheck"> -->
                <div class="orderlist-bottom">
                  <!-- <button type="submit" name="button" id="check" class="ordercheck" form="order_list">발주확인</button> -->
                  <button type="submit" name="button" id="send" class="sendmessage" form="order_list">발송처리</button>
                </div>

                <!--button에 따라 action값 변경 -->
                <!-- <form class="order_list" id="order_list" action="" method="post" onsubmit=""> -->
                @csrf

                <table id="myTable">
                  <thead>
                    <tr class="p_tr">
                      <th class="title"> <input type="checkbox" name="checkAll" id="th_checkAll"  value=""> </th>
                      <th class="title" style="width:36px;">주문번호</th>
                      <th class="title" style="width:36px;">결제번호</th>
                      <th class="title" style="width:36px;">상품번호</th>
                      <th class="title">상품명</th>
                      <th class="title" style="width:28px;">수량</th>
                      <th class="add_title" style="width:106.6px;">송장번호</th>
                      <th class="title">택배사</th>
                      <!-- <th class="title">발송일</th> -->
                      <th class="title">주문 일시</th>
                      <th class="title" style="width:41px;">고객명</th>
                      <th class="title" style="width:29px;">가격</th>
                      <th class="pm_title" style="width:45.5px;">결제 상태</th>
                      <th class="pm_title" style="width:43.8889px;">배송 상태</th>
                      <th class="title" style="width:37px;">배송 조회</th>
                      <!-- <th class="title"></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order as $order)
                    <tr id="tbody{{$order->pm_no}}">
                      <td><input type="checkbox" class="checkf" id="ordercheck{{$order->pm_no}}" name="checkRow" value=""/></td>
                      <td>{{$order->o_no}}</td>
                      <td>{{$order->pm_no}}</td>
                      <td>{{$order->p_no}}</td>
                      <td id="p_name">{{$order->p_name}}</td>
                      <td>{{$order->pm_count}}</td>

                      <!--데이터값 존재x-->
                      @if(!isset($order->pm_invoice_num))
                      <td><input type="text" class="num" id="invoice_num{{$order->pm_no}}" name="invoice_num"></td>

                      <!--데이터값 존재-->
                      @else
                      <td>
                        <div id="div_invoice{{$order->pm_no}}"><p id="re_invoice{{$order->pm_no}}">{{$order->pm_invoice_num}}</p><button class="re_invoice_btn"id="re_invoice_btn">수정</button></div>
                        <!-- <div id="editform" name="editform"> -->
                        <!-- {{$order->pm_invoice_num}} -->
                        <!-- </div>
                        <div id="editbtn" name="editbtn">
                        <button id="btn" name="btn" class="re_btn" type="button">수정</button>
                      </div> -->
                    </td>
                    @endif

                    <!--배송업체가 없을 경우 -->
                    @if(!isset($order->pm_company))
                    <td id="select">
                      <div class="selectbox" id="selectbox">
                        <select id="delivery" class="select" name=delivery margin-left:10px;>
                          <option value="">택배 선택</option>
                          <option value="우체국택배" id="kr.epost" name="우체국 택배" tel="+8215881300">우체국택배</option>
                          {{-- <option value="CJ대한통운" id="kr.cjlogistics" >CJ대한통운</option> --}}
                          <option value="로젠택배" id="kr.logen">로젠택배</option>
                          <option value="CU편의점택배" id="kr.cupost">CU편의점택배</option>
                          <option value="GSPostbox택배" id="kr.cvsnet">GSPostbox택배</option>
                          <option value="한진택배" id="kr.hanjin">한진택배</option>
                          <option value="경동택배" id="kr.kdexp">경동택배</option>
                          <option value="대신택배" id="kr.daesin">대신택배</option>
                          <option value="합동택배" id="kr.hdexp">합동택배</option>
                          <option value="천일택배" id="kr.chunilps">천일택배</option>
                        </select>
                      </div>
                    </td>

                    <!-- 배송업체가 존재할 경우 -->
                    @else
                    <td>
                      <div id="div_delivery{{$order->pm_no}}"style="display:block;">
                        <p id="re_delivery{{$order->pm_no}}">{{$order->pm_company}}</p>
                        <button class="re_delivery_btn" id="re_delivery_btn">수정</button>
                      </div>

                      <!-- display non 상태 -->
                      <div class="re_selectbox" id="re_selectbox{{$order->pm_no}}" style="display:none;">
                        <select id="re_delivery{{$order->pm_no}}" class="re_select" name=delivery margin-left:10px;>
                          <option value="">택배 선택</option>
                          <option value="우체국택배" id="kr.epost" name="우체국 택배" tel="+8215881300">우체국택배</option>
                          <option value="로젠택배" id="kr.logen">로젠택배</option>
                          <option value="CU편의점택배" id="kr.cupost">CU편의점택배</option>
                          <option value="GSPostbox택배" id="kr.cvsnet">GSPostbox택배</option>
                          <option value="한진택배" id="kr.hanjin">한진택배</option>
                          <option value="경동택배" id="kr.kdexp">경동택배</option>
                          <option value="대신택배" id="kr.daesin">대신택배</option>
                          <option value="합동택배" id="kr.hdexp">합동택배</option>
                          <option value="천일택배" id="kr.chunilps">천일택배</option>
                        </select>
                        <button class="re_select_btn" id="re_select_btn">수정하기</button>
                      </div>
                    </td>
                    @endif
                    <!-- <td>2020.04.16</td> -->
                    <td id="date">{{$order->created_at}}</td>
                    <td>{{$order->c_name}}</td>
                    <td>{{$order->pm_pay}}</td>
                    <td class="pm_status" id="pm_status">{{$order->pm_status}}</td>
                    <td id="pm_d_status" value="{{$order->pm_d_status}}">{{$order->pm_d_status}}</td>

                    @if(isset($order->pm_company))
                    <!-- <td id="delivery_search"><button id="delivery_search_btn" onclick="location.href='http://info.sweettracker.co.kr/api/v1/trackingInfo?t_key=API_KEY&t_code=04&t_invoice=380448983861'">배송조회</button></td> -->
                    <!-- <td id="delivery_search"><button id="delivery_search_btn" onclick="location.href='https://tracker.delivery/#/{{$order->delivery_code}}/{{$order->pm_invoice_num}}'">배송조회</button></td> -->
                    <td id="delivery_search"><button id="delivery_search_btn" onclick="window.open('https://tracker.delivery/#/{{$order->delivery_code}}/{{$order->pm_invoice_num}}'),'배송조회',width='300px',height='300px'">배송조회</button></td>
                    @else
                    <td id="delivery_search"></td>
                    @endif
                    <!-- <td><button type="submit" name="button">저장</button></td> -->
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- </form> -->
            </div>
            @else
            <div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
              <div class="" style="top:180px; position:absolute; left:300px; ">
                주문목록이 없습니다.
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    @include('lib.footer')
  </body>
  </html>

</script>
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>

<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(document).ready(function(){

  $("#myTable").DataTable({
    "language": {
      "emptyTable": "데이터가 없습니다.",
      "lengthMenu": "페이지당 _MENU_ 개씩 보기",
      "info": "현재 _START_ - _END_ / _TOTAL_건",
      "infoEmpty": "데이터 없음",
      "infoFiltered": "( 전체 _MAX_건의 데이터에서 필터링됨 )",
      "search": "검색",
      "zeroRecords": "일치하는 데이터가 없습니다.",
      "loadingRecords": "로딩중...",
      "processing":     "잠시만 기다려 주세요...",
      "paginate": { "next": "다음", "previous": "이전"  }
    }
  });

  // $("input:checkbox[name=checkRow]").each(function(index,elements){
  //   var index_no = elements.id;
  //   var indexs = index_no.replace(/[^0-9]/g,"");
  //
  //   var dv_status_str =[];
  //   dv_status_str.push($('#'+index_no).parent().parent().children('#pm_d_status').text());
  //   // //배송 상태의 문자를 담은 배열
  //
  //   console.log($('#tbody'+indexs));
  //
  //   if(dv_status_str[index]=="배송 완료"){
  //     $('#tbody'+indexs).css('background','gray');
  //   }
  // });

  // //결제 상태의 문자를 담은 배열
  // var pm_status_str =[];
  // //배송 상태의 문자를 담은 배열
  // var dv_status_str =[];
  // //결제 대기가 몇개인지 세어주는 카운트
  // var payment_wait_cnt=0;
  // //배송 중비중이 몇개인지 세어주는 카운트
  // var shipping_wait_cnt=0;
  // //배송중 이 몇개인지 세어주는 카운트
  // var delivery_cnt=0;
  // //배송 완료가 몇개인지 세어주는 카운트
  // var complete_cnt=0;
  //
  // //전체 배송, 결제 상태의 값을 받기 위한 소스
  // $("input:checkbox[name=checkRow]").each(function(index,elements)
  // {
  //   var index_no = elements.id;
  //
  //   pm_status_str.push($('#'+index_no).parent().parent().children('#pm_status').text());
  //   dv_status_str.push($('#'+index_no).parent().parent().children('#pm_d_status').text());
  //   console.log($('#'+index_no).parent().parent().children('#pm_d_status').text());
  //
  //   pm_status_str[index];
  //   if(pm_status_str[index]=="결제 대기"){
  //     payment_wait_cnt = payment_wait_cnt+1;
  //   }
  //
  //   if(dv_status_str[index]=="배송 준비중"){
  //     shipping_wait_cnt = shipping_wait_cnt+1;
  //   }
  //
  //   if(dv_status_str[index]=="배송중"){
  //     delivery_cnt = delivery_cnt+1;
  //   }
  //
  //   if(dv_status_str[index]=="배송 완료"){
  //     complete_cnt = complete_cnt+1;
  //   }
  //
  //   console.log(complete_cnt);
  // });
  //
  // //배송준비
  // $('#shipping_wait_cnt').html(shipping_wait_cnt);
  // //결제대기
  // $('#payment_wait_cnt').html(payment_wait_cnt);
  // //배송중
  // $('#delivery_cnt').html(delivery_cnt);
  // //배송완료
  // $('#complete_cnt').html(complete_cnt);

  //상단 발주확인, 발송처리 이벤트
  $('#check').click(function () {
    // $('#order_list').attr("onsubmit", "return form_check()");
    // $('#order_list').attr("action", "/payment_status");
    form_check();
  });
  $('#send').click(function () {
    // $('#order_list').attr("onsubmit", "return form_send()");
    // $('#order_list').attr("action", "/delivery_status");
    form_send();
  });


  //택배사 수정 버튼
  $('.re_delivery_btn').click(function(){
    var check_btn_no = $(this).parent().parent().parent().children('.sorting_1').children().attr('id');
    var pm_no = check_btn_no.replace(/[^0-9]/g,"");

    if($('#div_delivery'+pm_no).css('display')=="none"){
      $('#div_delivery'+pm_no).show();
      $('#re_selectbox'+pm_no).hide();
    }
    else{
      $('#re_selectbox'+pm_no).show();
      $('#div_delivery'+pm_no).hide();
    }
  });

  //송장번호 수정버튼 클릭시 이벤트
  $('.re_invoice_btn').click(function(){
    var check_btn_no = $(this).parent().parent().parent().children('.sorting_1').children().attr('id');
    var pm_no = check_btn_no.replace(/[^0-9]/g,"");

    //원래 존재하고 있던 값을 유지한 상태로 새로운 input창과 버튼을 생성
    var text = $('#re_invoice'+pm_no).text();
    $('#div_invoice'+pm_no).html("<input type='text' class='num' id='inp_invoice' value='"+text+"'><button id='re_invoice_btn_Do' class='re_invoice_btn_Do'>수정하기</button>");
  });
});

// 송장번호 수정하기 버튼 클릭 이벤트
$(document).on('click','.re_invoice_btn_Do',function () {
  var check_btn_no = $(this).parent().parent().parent().children('.sorting_1').children().attr('id');
  var text = $(this).parent().parent().parent().children();
  // console.log($(this).parent().parent().parent().children());

  var pm_no = check_btn_no.replace(/[^0-9]/g,"");

  //화면에 보이는 텍스트
  var text = $('#re_invoice'+pm_no).text();
  var invoice_val =$(this).parent().children('#inp_invoice').val();
  console.log($(this).parent().children('#inp_invoice').val());
  // console.log(text);
  // console.log(re_text);
  // console.log(text);

  $.ajax({
    type: 'post',
    url: '/update_invoice',
    dataType: 'json',
    data: { "pm_no" : pm_no,
    "invoice_val" : invoice_val
  },
  success: function(data) {
    console.log(data);

    if(data==0){
      refreshMemList();
    }
    // alert('수정되었습니다.');
    // document.getElementById('pm_status').innerHTML="data";
    // $('#div_invoice'+pm_no).html("<p id='re_invoice'>"+re_text+"</p><button id='re_invoice_btn'>수정</button>");
    else{
      alert('수정되었습니다');
      refreshMemList();
    }
  },
  error: function(data) {
    console.log("error");
  }
});
});

//택배사 수정하기 버튼
$(document).on('click','.re_select_btn',function () {
  var check_btn_no = $(this).parent().parent().parent().children('.sorting_1').children().attr('id');
  var pm_no = check_btn_no.replace(/[^0-9]/g,"");

  if($('#re_selectbox'+pm_no).css('display')=="none"){
    $('#div_delivery'+pm_no).hide();
    $('#re_selectbox'+pm_no).show();
  }
  else{
    //선택된 option VALUE 값
    var option_val = $(this).parent().children('.re_select').children('option:selected').val();
    console.log(option_val);
    //option 값의 code
    var code_val = $(this).parent().children('.re_select').children('option:selected').attr('id');
    console.log(code_val);

    if(option_val==""){
      alert("변경할 값을 선택해주세요.");
    }

    else{
      $.ajax({
        type: 'post',
        url: '/update_delivery',
        dataType: 'json',
        data: { "pm_no" : pm_no,
        "option_val" : option_val,
        "code_val" : code_val
      },
      success: function(data) {
        console.log(data);

        if(data==0){
          refreshMemList();
        }
        // alert('수정되었습니다.');
        // document.getElementById('pm_status').innerHTML="data";
        // $('#div_invoice'+pm_no).html("<p id='re_invoice'>"+re_text+"</p><button id='re_invoice_btn'>수정</button>");
        else{
          alert('수정되었습니다');
          // refreshMemList();
        }
      },
      error: function(data) {
        console.log("error");
      }
    });
  }
}
});

//전체 체크박스
var selectAll = document.querySelector("#th_checkAll");

selectAll.addEventListener('click', function(){
  var objs = document.querySelectorAll(".checkf");
  for (var i = 0; i < objs.length; i++) {
    objs[i].checked = selectAll.checked;
  };
}, false);

var objs = document.querySelectorAll(".checkf");
for(var i=0; i<objs.length ; i++){
  objs[i].addEventListener('click', function(){
    var selectAll = document.querySelector("#th_checkAll");
    for (var j = 0; j < objs.length; j++) {
      if (objs[j].checked === false) {
        selectAll.checked = false;
        return;
      };
    };
    selectAll.checked = true;
  }, false);
}


//페이지 새로고침
function refreshMemList(){
  location.reload();
}

//발주확인
function form_check(){
  var invoiceJ = /^[0-9]*$/;
  //indexe 배열
  var checkbox_id = [];
  //check가 된 ordercheck를 담을 배열
  var check_on = [];
  //pm_status 의 각 상태를 넣을 배열
  var pm_status = [];
  //송장번호를 넣을 배열
  var invoice = [];
  //선택된 택배지를 넣을 배열
  var delivery = [];


  $("input:checkbox[name=checkRow]:checked").each(function(index,elements)
  {
    //checkbox 각각의 id값
    // console.log(index);
    // console.log(elements.id);

    var index_no = elements.id;
    checkbox_id.push(index_no);

    //결제 상태
    pm_status.push($('#'+index_no).parent().parent().children('#pm_status').text());

    // //송장번호 각각의 값
    // invoice.push($('#'+index_no).parent().parent().children().children('.num').val());
    //
    // //선택된 택배지를 넣을 배열
    // delivery.push($('#'+index_no).parent().parent().children().children('.select').children('option:selected').val());

    //숫자가 아닌부분 공백으로 치환 ---- payment_table no값
    var pm_no = index_no.replace(/[^0-9]/g,"");
    check_on.push(pm_no);
    console.log(pm_no);
  });


  //체크가 되어있지 않을 경우
  if($("input[name='checkRow']:checked").length<1){
    alert("상품을 선택해주세요.");
    return false;
  }

  //체크되어있을 때
  else{
    if(pm_status.indexOf("결제 완료")>=0){
      alert("이미 완료된 상품이 있습니다.");
      return false;
    }
    if(pm_status.indexOf("구매 확정")>=0){
      alert("구매가 확정 된 상품입니다.");
      return false;
    }
    if(pm_status.indexOf("결제 취소")>=0){
      alert("취소된 상품입니다.");
      return false;
    }
    else{
      //check된 box 번호를 담은 배열
      console.log(check_on);
      $.ajax({
        type: 'post',
        url: '/payment_status',
        dataType: 'json',
        data: { "check_on" : check_on },
        success: function(data) {
          console.log(data);
          alert('변경되었습니다.');
          refreshMemList();
          // document.getElementById('pm_status').innerHTML="data";
        },
        error: function(data) {
          console.log("error");
        }
      });
    }
  }
}

//발송처리
function form_send(){
  var invoiceJ = /^[0-9]*$/;
  var invoiceJ = /^[0-9]*$/;
  //indexe 배열
  var checkbox_id = [];
  //check가 된 ordercheck를 담을 배열
  var check_on = [];
  //pm_d_status 의 각 상태를 넣을 배열
  var pm_d_status = [];
  //송장번호를 넣을 배열
  var invoice = [];
  //선택된 택배사를 넣을 배열
  var delivery = [];
  //선택된 택배사 코드를 넣을 배열
  var delivery_code = [];
  $("input:checkbox[name=checkRow]:checked").each(function(index,elements)
  {

    //checkbox 각각의 id값
    var index_no = elements.id;
    console.log(elements);
    checkbox_id.push(index_no);

    pm_d_status.push($('#'+index_no).parent().parent().children('#pm_d_status').text());

    //송장번호 각각의 값
    invoice.push($('#'+index_no).parent().parent().children().children('.num').val());

    //선택된 택배지를 넣을 배열
    delivery.push($('#'+index_no).parent().parent().children().children().children().children('option:selected').val());
    console.log($('#'+index_no).parent().parent().children().children().children().children('option:selected').val());
    //택배 코드
    delivery_code.push($('#'+index_no).parent().parent().children().children().children('.select').children('option:selected').attr('id'));

    //숫자가 아닌부분 공백으로 치환 ---- payment_table no값
    var pm_no = index_no.replace(/[^0-9]/g,"");
    check_on.push(pm_no);
    //console.log(pm_no);
  });
  //console.log(delivery);
  //송장번호 기입한거를 문자열로 합친것
  var invoice_num = invoice.join('');
  //console.log(invoice_num);

  if($("input[name='checkRow']:checked").length<1){
    alert("상품을 선택해주세요.");
    return false;
  }

  // 각 행의 input값 빈값 확인
  for(var i=0; i<invoice.length; i++){
    //console.log(invoice[i])
    if(invoice[i]==""){
      alert("운송장번호를 입력해주세요.")
      return false;
    }
  }

  for(var j=0; j<delivery.length; j++){
    if(delivery[j]==""){
      alert("배송 업체를 선택해주세요.")
      return false;
    }
  }

  if(!invoiceJ.test(invoice_num)){
    alert("운송장번호가 올바르지 않습니다. '-'를 제외한 숫자만 입력해주세요.")
    return false;
  }


  //예외처리 완료 후
  else{
    //배송중 상태면 업데이트 X
    if(pm_d_status.indexOf("배송중")>=0){
      alert("이미 완료된 상품이 있습니다.");
    }
    if(pm_d_status.indexOf("배송 완료")>=0){
      alert("배송이 완료된 상품입니다.");
    }
    if(pm_d_status.indexOf("결제 취소")>=0){
      alert("취소된 상품입니다.");
    }
    else{
      //check된 box 번호를 담은 배열
      console.log(check_on); //인덱스
      console.log(invoice); //운송장번호
      console.log(delivery); //택배사
      console.log(delivery_code);
      $.ajax({
        type: 'post',
        url: '/delivery_status',
        dataType: 'json',
        data: { "check_on" : check_on,
        "invoice" : invoice,
        "delivery" : delivery,
        "delivery_code" : delivery_code
      },
      success: function(data) {
        console.log(data);
        alert('변경되었습니다.');
        refreshMemList();

      },
      error: function(data) {
        console.log("error");
      }
    });
  }
}
}

</script>
