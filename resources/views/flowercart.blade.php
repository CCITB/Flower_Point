<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/flowercart.css">
  <title>장바구니</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
  <body>
  @include('lib.header')
  <div class="hr-line">
    <h2>장바구니</h2>
    <hr>
  </div>
  <div class="flowercart-wrap" id="flowercart-wrap">
    @if(count($data))
      <div class="flowercart-select">
        <input type="checkbox" name="checkAll" id="th_checkAll" value=""onchange="condition()" checked="checked">전체선택 ㅣ
        <span style="cursor:pointer;" onclick="selectdel()";>선택삭제</span>
      </div>

      @foreach ($data as $list)
        <div class="flowercart-infor" id="remove{{$list->b_no}}">
          <div class="flowercart-top">
            <input type="checkbox" name="checkRow" class="checkf" id="checkf{{$list->b_no}}" onchange="selectcondition({{$list->b_no}});" value="" checked="checked">
            <strong class="flowercart-tradename">가게명</strong>
          </div>
          <div class="flowercart-middle">
            <img class="flowercart-preview" src="/imglib/{{$list->b_picture}}" alt="?">
            <div class="flowercart-section">
              <div class="product-name">{{$list->b_name}}</div>
              <div class="product-price"> {{$list->b_price}}
                {{-- <a class="btn{{$list->b_no}}" onclick="del({{$list->b_no}})" href="#" >x</a> --}}
                <button type="button" name="button" class= "btn1" onclick="del({{$list->b_no}})" value="{{$list->b_no}}">x</button>
              </div>
              {{-- <input type="text" name="" value="{{$list->b_no}}" hidden="" id="hidden1"> --}}
              <div class="product-coupon">
                쿠폰
              </div>
              <div class="product-count">
                {{-- 수량증가-------------------- --}}
                <form class="" action="" method="post" name="form">
                  <button type="button" class="plus" id="plus{{$list->b_no}}"name="button" onclick="increase({{$list->b_no}});">
                    <img src="/imglib/add.png" alt="">
                  </button>
                  <input class="count-plmi" type="text" name="amount{{$list->b_no}}" onkeydown="onKeyDown()"readonly id="count{{$list->b_no}}" value="{{$list->b_count}}">
                  <button type="button" class="minus" id="minus{{$list->b_no}}" name="button" onclick="decrease({{$list->b_no}});">
                    <img src="/imglib/remove.png" alt="">
                  </button>

                  {{-- 수량증가-------------------- --}}
                </div>
              </div>


            </div>
            <div class="flowercart-bottom">
              <div class="text-section-wrap">
                <div class="text-section">
                  상품금액
                </div>
                <div class="price-section">
                  <strong class="text-option" id="productprice{{$list->b_no}}">{{number_format($list->b_price*$list->b_count)}}</strong>원
                </div>
              </div>
            </form>
            <div class="imgwrap-section">
              <img src="/imglib/minus.png" ondragstart="return false" class="plmieq-icon" alt="">
            </div>
            <div class="text-section-wrap">
              <div class="text-section">
                할인금액
              </div>
              <div class="price-section">
                <strong class="text-option">0</strong>원
              </div>
            </div>
            <div class="imgwrap-section">
              <img src="/imglib/plus.png" ondragstart="return false" class="plmieq-icon" alt="">
            </div>
            <div class="text-section-wrap">
              <div class="text-section">
                배송비
              </div>
              <div class="price-section">
                <strong class="text-option" id="deliveryprice{{$list->b_no}}">{{number_format($list->b_delivery*$list->b_count)}}</strong>원
              </div>
            </div>
            <div class="imgwrap-section">
              <img src="/imglib/equal.png" ondragstart="return false" class="plmieq-icon" alt="">
            </div>
            <div class="text-section-wrap">
              <div class="text-section">
                주문금액
              </div>
              <div class="price-section">
                <strong class="text-option1" id="allsum{{$list->b_no}}">{{number_format(($list->b_price+$list->b_delivery)*$list->b_count)}}</strong>원
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
        <div class="" style="top:180px; position:absolute; left:260px; ">
          장바구니가 비어있습니다.
        </div>
      </div>
    @endif

    <div class="flowercart-allprice">
      <div class="flowercart-right-top">
        <strong>전체 합계</strong>
      </div>
      <div class="flowercart-right-middle">
        <div class="label-container">
          <span class="label-left">상품수</span>
          <span class="label-right"> <strong id="i_result3"></strong> 개</span>
          {{-- <span class="label-right"> <strong id="i_result3">{{number_format($count_sum1)}}</strong> 개</span> --}}
        </div>
        <div class="label-container">
          <span class="label-left">상품금액</span>
          <span class="label-right"> <strong id="i_result1"></strong> 원</span>
          {{-- <span class="label-right"> <strong id="i_result1">{{number_format($price_sum1)}}</strong> 원</span> --}}
        </div>
        <div class="label-container">
          <span class="label-left">할인금액</span>
          <span class="label-right"> <strong>0</strong> 원</span>
        </div>
        <div class="label-container">
          <span class="label-left">배송비</span>
          <span class="label-right"> <strong id="i_result2"></strong> 원</span>
          {{-- <span class="label-right"> <strong id="i_result2">{{number_format($delivery_sum1)}}</strong> 원</span> --}}
        </div>
      </div>
      <div class="flowercart-right-bottom">

        <div class="allorderprice">
          전체 주문금액

        </div>
        <div class="allorderprice-section">
          <span class="allorderprice-right"> <span id="i_result4" onchange="everysum();"></span>원 </span>
        </div>

        <div class="basketorder">
          <a href="#">주문하기</a>
        </div>
      </div>
    </div>
  </div>

  @include('lib.footer')
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
console.log("페이지 읽어올떄 불러옴");
var holy = [];
var first1 = [];
var first2 = [];
var first3 = [];
$("input:checkbox[name=checkRow]").each(function(i,elements)
{
  //해당 index(순서)값을 가져옵니다.
  index = $(elements).index("input:checkbox[name=checkRow]");
  //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
  string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
  var no=string.replace(/[^0-9]/g,'');
  holy.push(no);
  //해당 index에 해당하는 체크박스의 값을 가져옵니다.
});
for (var i = 0; i < holy.length; i++) {
  a1 = $('#productprice'+holy[i]).text();
  a2 =  $('#deliveryprice'+holy[i]).text();
  a3 =  $('#allsum'+holy[i]).text();
  // $('#productprice'+idindex[i]).text("0");
  // $('#deliveryprice'+idindex[i]).text("0");
  // $('#allsum'+idindex[i]).text("0");
  first1.push(a1);
  first2.push(a2);
  first3.push(a3);
  // productprice = $('#productprice'+idindex[i]).text().replace(/[^0-9]/g,'');
  // deliveryprice = $('#deliveryprice'+idindex[i]).text().replace(/[^0-9]/g,'');
  // allsum = $('#allsum'+idindex[i]).text().replace(/[^0-9]/g,'');
  // count = $('#count'+idindex[i]).val();
}
console.log(first1);
console.log(first2);
console.log(first3);
</script>

<script type="text/javascript">
$(function() {

  $(document).ready(function() {

    var scrollOffset = $('.flowercart-allprice').offset();

    $(window).scroll(function() {
      if ($(document).scrollTop() > scrollOffset.top) {
        $('.flowercart-allprice').addClass('scroll-fixed');
      }
      else {
        $('.flowercart-allprice').removeClass('scroll-fixed');
      }
    });
  } );

});
</script>
<script type="text/javascript">
var selectAll = document.querySelector("#th_checkAll");
selectAll.addEventListener('click', function(){
  var objs = document.querySelectorAll(".checkf");
  for (var i = 0; i < objs.length; i++) {
    objs[i].checked = selectAll.checked;
    if(selectAll.checked){

    }
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

</script>
<script type="text/javascript">
var orderprice;
var productprice;
var deliveryprice;
console.log('현재시각');
console.log(orderprice);

function increase(a) {
  var textbox = document.getElementById('count'+a);
  if(textbox.value>=999){
    alert('선택하신 상품의 주문 가능한 수량은 999개 입니다. 999개 이하로 주문해 주세요.')
    return false;
  }
  textbox.value = parseInt(textbox.value) + 1;
  console.log(textbox.value);
  n2 = textbox.value;
  $.ajax({
    type: 'post',
    url: '/basketcount',
    dataType: 'json',
    data: { "add" : n2,
    "no" : a
  },
  success: function(data) {
    console.log(data);
    orderprice = data[0]*(data[1]+data[2]);
    productprice = data[0]*data[1];
    deliveryprice = data[0]*data[2];
    console.log(orderprice);
    console.log(productprice);
    console.log(deliveryprice);
    document.getElementById("productprice"+a).innerHTML=AddComma(productprice);
    document.getElementById("deliveryprice"+a).innerHTML=AddComma(deliveryprice);
    document.getElementById("allsum"+a).innerHTML=AddComma(orderprice);
    autoprice();
  },
  error: function(data) {
    console.log("error" +data);
  }
});
}
function decrease(d) {
  var textbox = document.getElementById('count'+d);
  if(textbox.value <=1){
    alert('수량이 1보단 작을수 없습니다.');
    console.log(textbox.value);
    return false;
  }
  else textbox.value = parseInt(textbox.value) - 1;
  console.log(textbox.value);
  n2 = textbox.value;
  $.ajax({
    type: 'post',
    url: '/basketcount',
    dataType: 'json',
    data: { "remove" : n2,
    "no" : d
  },
  success: function(data) {
    console.log(data);
    orderprice = data[0]*(data[1]+data[2]);
    productprice = data[0]*data[1];
    deliveryprice = data[0]*data[2];
    console.log(orderprice);
    console.log(productprice);
    console.log(deliveryprice);
    document.getElementById("productprice"+d).innerHTML=AddComma(productprice);
    document.getElementById("deliveryprice"+d).innerHTML=AddComma(deliveryprice);
    document.getElementById("allsum"+d).innerHTML=AddComma(orderprice);
    autoprice();
    // document.getElementById("i_result4").innerHTML=AddComma(data[3]);
    // document.getElementById("i_result3").innerHTML=AddComma(data[5]);
    // document.getElementById("i_result1").innerHTML=AddComma(data[4]);
    // document.getElementById("i_result2").innerHTML=AddComma(data[6]);

  },
  error: function(data) {
    console.log("error" +data);
  }
});
}


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
function del(e){
  // var idindex;
  var deleted = confirm("정말 상품을 삭제하시겠습니까?");
  if(deleted){

  }
  else{
    return false;
  }
  console.log(e);

  $.ajax({
    type: 'post',
    url: '/delete',
    dataType: 'json',
    data: { "id" : e,
  },
  // console.log(jjim);
  success: function(data) {
    console.log(data);
    if(data[0]=e){
      // autoprice();
      $("#remove"+e).remove();
      if($(".flowercart-infor").is(".flowercart-infor")){
        // ($("#div_test").hasClass("apple") === true)
        console.log('존재');
        loadprice();
      }
      else{
        console.log('존재x');
        document.getElementById("i_result4").innerHTML="0";
        document.getElementById("i_result3").innerHTML="0";
        document.getElementById("i_result1").innerHTML="0";
        document.getElementById("i_result2").innerHTML="0";
        var $div = $('<div class="flowercart-infor" id="remove" style="height:400px; position:relative;"><div class="" style="top:180px; position:absolute; left:260px; ">장바구니가 비어있습니다.</div></div>');
        console.log($div);
        $(".flowercart-select").remove();
        $(".flowercart-wrap").prepend($div);
      }
      console.log('삭제');
    }

  },
  error: function(data) {
    console.log("error" +data);
  }
});
}
function AddComma(num)
{
  var regexp = /\B(?=(\d{3})+(?!\d))/g;
  return num.toString().replace(regexp, ',');
}
function onKeyDown()
{
  if(event.keyCode == 13)
  {
    alert('엔터키는 입력하실수 없습니다.');
    return false;
  }
}
function selectdel(){
  // var idindex;
  if(!$("input:checkbox[name='checkRow']").is(":checked")){
    alert("선택하신 상품이 없습니다. 삭제를 원하시는 상품을 선택 해 주세요.");
    return false;
  }
  var deleted = confirm("정말 상품을 삭제하시겠습니까?");
  if(deleted){
    // 여기는 체크한 상품 지우는 구간 코드
    if(selectAll.checked){
      console.log('전체선택 체크됨');
      // $('.checkf')
      console.log($('.checkf').is(":checked"));
      // console.log($('.checkf'));
      // $(".flowercart-infor").remove();
      // document.querySelectorAll(".checkf").checked;
      var idindex = [];

      // console.log(document.querySelectorAll(".checkf").checked);
      $("input:checkbox[name=checkRow]:checked").each(function(i,elements){
        //해당 index(순서)값을 가져옵니다.
        index = $(elements).index("input:checkbox[name=checkRow]");
        //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
        console.log($("input:checkbox[name=checkRow]").eq(index).attr("id"));
        string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
        var no=string.replace(/[^0-9]/g,'');
        console.log(no);
        idindex.push(no);
        //해당 index에 해당하는 체크박스의 값을 가져옵니다.
        // alert($("input:checkbox[name=checkRow]").eq(index),val());
      });
      console.log(idindex);
    }
    else {
      console.log('전체선택 되지않음');
      console.log($('.checkf').is(":checked"));
      checkvalue = $('.checkf').is(":checked");

      var idindex = [];

      $("input:checkbox[name=checkRow]:checked").each(function(i,elements){
        //해당 index(순서)값을 가져옵니다.
        index = $(elements).index("input:checkbox[name=checkRow]");
        //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
        console.log($("input:checkbox[name=checkRow]").eq(index).attr("id"));
        string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
        var no=string.replace(/[^0-9]/g,'');
        console.log(no);
        idindex.push(no);
        //해당 index에 해당하는 체크박스의 값을 가져옵니다.
        // alert($("input:checkbox[name=checkRow]").eq(index),val());
      });
      console.log(idindex);;
    }
    // 여기는 체크한 상품 지우는 구간 코드 끝나는 곳
  }
  else{
    return false;
  }
  $.ajax({
    type: 'post',
    url: '/delete',
    dataType: 'json',
    data: {
      "check" : idindex
    },
    // console.log(jjim);
    success: function(data) {
      console.log(data);
      var a = [];
      console.log(a);
      for(i=0; i<data.length;i++){
        $("#remove"+data[i]).remove();
        // loadprice();
        // console.log($("#remove"+data[i]));
        // console.log(data[9].length);
      }
      // return console.log('끝');
      if(data=idindex){

        // document.getElementById("i_result4").innerHTML=AddComma(data[5]);
        // document.getElementById("i_result3").innerHTML=AddComma(data[7]);
        // document.getElementById("i_result1").innerHTML=AddComma(data[6]);
        // document.getElementById("i_result2").innerHTML=AddComma(data[8]);
        // console.log(data[9].length);
        if($(".flowercart-infor").is(".flowercart-infor")){
          // ($("#div_test").hasClass("apple") === true)
          console.log('존재');
          loadprice();
        }
        else{
          console.log('존재x');
          document.getElementById("i_result4").innerHTML="0";
          document.getElementById("i_result3").innerHTML="0";
          document.getElementById("i_result1").innerHTML="0";
          document.getElementById("i_result2").innerHTML="0";
          var $div = $('<div class="flowercart-infor" id="remove" style="height:400px; position:relative;"><div class="" style="top:180px; position:absolute; left:260px; ">장바구니가 비어있습니다.</div></div>');
          console.log($div);
          $(".flowercart-select").remove();
          $(".flowercart-wrap").prepend($div);
        }
        console.log('삭제');
        // loadprice();
      }

    },
    error: function(data) {
      console.log("error" +data);
    }
  });
}


</script>
<script type="text/javascript">
function condition(){
  if(selectAll.checked){
    for (var i = 0; i < holy.length; i++) {
      $('#productprice'+holy[i]).text(first1[i]);
      $('#deliveryprice'+holy[i]).text(first2[i]);
      $('#allsum'+holy[i]).text(first3[i]);
      // $('#productprice'+holy[i]).text();
      // $('#deliveryprice'+holy[i]).text();
      // $('#allsum'+holy[i]).text();
    }

    var checking = 1;
    console.log('전체선택 체크됨');
    // $('.checkf')
    // console.log($('.checkf').is(":checked"));
    // console.log($('.checkf'));
    // $(".flowercart-infor").remove();
    // document.querySelectorAll(".checkf").checked;
    var idindex = [];

    // console.log(document.querySelectorAll(".checkf").checked);
    $("input:checkbox[name=checkRow]:checked").each(function(i,elements){
      //해당 index(순서)값을 가져옵니다.
      index = $(elements).index("input:checkbox[name=checkRow]");
      //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
      // console.log($("input:checkbox[name=checkRow]").eq(index).attr("id"));
      string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
      var no=string.replace(/[^0-9]/g,'');
      // console.log(no);
      idindex.push(no);
      //해당 index에 해당하는 체크박스의 값을 가져옵니다.
      // alert($("input:checkbox[name=checkRow]").eq(index),val());
    });
    console.log(idindex);
    loadprice();
  }
  else {
    var unchecked = 1;
    autoprice();
    // console.log('전체선택 되지않음');
    // console.log($('.checkf').is(":checked"));
    checkvalue = $('.checkf').is(":checked");

    var idindex = [];

    $("input:checkbox[name=checkRow]:not(:checked)").each(function(i,elements){
      //해당 index(순서)값을 가져옵니다.
      index = $(elements).index("input:checkbox[name=checkRow]");
      //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
      // console.log($("input:checkbox[name=checkRow]").eq(index).attr("id"));
      string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
      var no=string.replace(/[^0-9]/g,'');
      // console.log(no);
      idindex.push(no);
      //해당 index에 해당하는 체크박스의 값을 가져옵니다.
      // alert($("input:checkbox[name=checkRow]").eq(index),val());
    });
    // console.log(idindex);
  }

  $.ajax({
    type: 'post',
    url: '/basketcondition',
    dataType: 'json',
    data: { "check" : idindex,
    "checkcondition" : checking,
    "uncheckcondition" : unchecked,
  },
  success: function(data) {
    console.log(data);

    // document.getElementById("productprice"+a).innerHTML=AddComma(data[0]);
    // document.getElementById("deliveryprice"+a).innerHTML=AddComma(data[1]);
    // document.getElementById("allsum"+a).innerHTML=AddComma(data[2]);
    // document.getElementById("i_result4").innerHTML=AddComma(data[3]);
    // document.getElementById("i_result3").innerHTML=AddComma(data[5]);
    // document.getElementById("i_result1").innerHTML=AddComma(data[4]);
    // document.getElementById("i_result2").innerHTML=AddComma(data[6]);

  },
  error: function(data) {
    console.log("error" +data);
  }
});
}
function selectcondition(a){
  // var ada = $('input:checkbox[id="checkf"+'a']').is(":checked") == true;
  // console.log(ada);
  // console.log(1);
  var cc = $('#checkf'+a).is(":checked");
  console.log(cc);
  if(cc){
    console.log('check완료');
    loadprice(a);
  }
  else {
    console.log(' no check');
    document.getElementById("productprice"+a).innerHTML=0;
    document.getElementById("deliveryprice"+a).innerHTML=0;
    document.getElementById("allsum"+a).innerHTML=0;
  }
  $.ajax({
    type: 'post',
    url: '/basketcondition',
    dataType: 'json',
    data: { "individualcheck" : cc ,
    "no" : a,
  },
  success: function(data) {
    console.log(data);

    // document.getElementById("productprice"+a).innerHTML=AddComma(data[0]);
    // document.getElementById("deliveryprice"+a).innerHTML=AddComma(data[1]);
    // document.getElementById("allsum"+a).innerHTML=AddComma(data[2]);
    // document.getElementById("i_result4").innerHTML=AddComma(data[3]);
    // document.getElementById("i_result3").innerHTML=AddComma(data[5]);
    // document.getElementById("i_result1").innerHTML=AddComma(data[4]);
    // document.getElementById("i_result2").innerHTML=AddComma(data[6]);

  },
  error: function(data) {
    console.log("error" +data);
  }
});
}


function autoprice(){
  if(selectAll.checked){
    console.log('전체선택 체크됨');
    loadprice();
    // $("input:checkbox[name='checkRow']").is(":checked")
    // 위에는 필요한주석
  }
  if(!$("input:checkbox[name='checkRow']").is(":checked")){
    console.log('아무것도 체크되지 않음');
    console.log('계산 불가상태');
    var idindex = [];
    $("input:checkbox[name=checkRow]").each(function(i,elements)
    {
      //해당 index(순서)값을 가져옵니다.
      index = $(elements).index("input:checkbox[name=checkRow]");
      //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
      string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");

      var no=string.replace(/[^0-9]/g,'');
      idindex.push(no);
      //해당 index에 해당하는 체크박스의 값을 가져옵니다.
    });

    for (var i = 0; i < idindex.length; i++) {

      $('#productprice'+idindex[i]).text("0");
      $('#deliveryprice'+idindex[i]).text("0");
      $('#allsum'+idindex[i]).text("0");

      // productprice = $('#productprice'+idindex[i]).text().replace(/[^0-9]/g,'');
      // deliveryprice = $('#deliveryprice'+idindex[i]).text().replace(/[^0-9]/g,'');
      // allsum = $('#allsum'+idindex[i]).text().replace(/[^0-9]/g,'');
      // count = $('#count'+idindex[i]).val();
    }

    document.getElementById("i_result4").innerHTML=AddComma(0);
    document.getElementById("i_result3").innerHTML=AddComma(0);
    document.getElementById("i_result1").innerHTML=AddComma(0);
    document.getElementById("i_result2").innerHTML=AddComma(0);
  }
  if($("input:checkbox[name='checkRow']").is(":checked")){
    console.log("몇개는 선택되어있음.");
  }
}
function test(){
  console.log($('#productprice432').text());
}
// function Calculation(){
//   var idindex = [];
//   if(!$("input:checkbox[name='checkRow']").is(":checked")){
//     console.log('계산 불가상태');
//     // var idindex = [];
//
//     $("input:checkbox[name=checkRow]").each(function(i,elements)
//     {
//       //해당 index(순서)값을 가져옵니다.
//       index = $(elements).index("input:checkbox[name=checkRow]");
//       //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
//       string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
//
//       var no=string.replace(/[^0-9]/g,'');
//       idindex.push(no);
//       //해당 index에 해당하는 체크박스의 값을 가져옵니다.
//     });
//
//     for (var i = 0; i < idindex.length; i++) {
//
//       $('#productprice'+idindex[i]).text("0");
//       $('#deliveryprice'+idindex[i]).text("0");
//       $('#allsum'+idindex[i]).text("0");
//
//       // productprice = $('#productprice'+idindex[i]).text().replace(/[^0-9]/g,'');
//       // deliveryprice = $('#deliveryprice'+idindex[i]).text().replace(/[^0-9]/g,'');
//       // allsum = $('#allsum'+idindex[i]).text().replace(/[^0-9]/g,'');
//       // count = $('#count'+idindex[i]).val();
//     }
//
//     document.getElementById("i_result4").innerHTML=AddComma(0);
//     document.getElementById("i_result3").innerHTML=AddComma(0);
//     document.getElementById("i_result1").innerHTML=AddComma(0);
//     document.getElementById("i_result2").innerHTML=AddComma(0);
//   }
//   else{
//     var idindex = [];
//     // $("input:checkbox[name=checkRow]:checked").each(function(i,elements)
//     $("input:checkbox[name=checkRow]").each(function(i,elements)
//     {
//       //해당 index(순서)값을 가져옵니다.
//       index = $(elements).index("input:checkbox[name=checkRow]");
//       //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
//       string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
//       var no=string.replace(/[^0-9]/g,'');
//       idindex.push(no);
//       //해당 index에 해당하는 체크박스의 값을 가져옵니다.
//     });
//     // console.log(idindex);
//     var gettag1 = [];
//     var gettag2 = [];
//     var gettag3 = [];
//     var gettag4 = [];
//     // console.log(gettag);
//     for (var i = 0; i < idindex.length; i++) {
//       productprice = $('#productprice'+idindex[i]).text().replace(/[^0-9]/g,'');
//       deliveryprice = $('#deliveryprice'+idindex[i]).text().replace(/[^0-9]/g,'');
//       allsum = $('#allsum'+idindex[i]).text().replace(/[^0-9]/g,'');
//       count = $('#count'+idindex[i]).val();
//       // console.log(indexno);
//       gettag1.push(Number(productprice));
//       gettag2.push(Number(deliveryprice));
//       gettag3.push(Number(allsum));
//       gettag4.push(Number(count));
//     }
//
//     // var arr = [1,2,3,4,5];
//     var sum1 = gettag1.reduce((a, b) => a + b);
//     var sum2 = gettag2.reduce((a, b) => a + b);
//     var sum3 = gettag3.reduce((a, b) => a + b);
//     var sum4 = gettag4.reduce((a, b) => a + b);
//     //전체 합계
//     document.getElementById("i_result4").innerHTML=AddComma(sum3);
//     document.getElementById("i_result3").innerHTML=AddComma(sum4);
//     document.getElementById("i_result1").innerHTML=AddComma(sum1);
//     document.getElementById("i_result2").innerHTML=AddComma(sum2);
//   }
// }
$(document).ready(function (){
  if($(".flowercart-top").is(".flowercart-top")){
    var idindex = [];
    // $("input:checkbox[name=checkRow]:checked").each(function(i,elements)
    $("input:checkbox[name=checkRow]").each(function(i,elements)
    {
      //해당 index(순서)값을 가져옵니다.
      index = $(elements).index("input:checkbox[name=checkRow]");
      //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
      string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
      var no=string.replace(/[^0-9]/g,'');
      idindex.push(no);
      //해당 index에 해당하는 체크박스의 값을 가져옵니다.
    });
    // console.log(idindex);
    var gettag1 = [];
    var gettag2 = [];
    var gettag3 = [];
    var gettag4 = [];
    // console.log(gettag);
    for (var i = 0; i < idindex.length; i++) {
      productprice = $('#productprice'+idindex[i]).text().replace(/[^0-9]/g,'');
      deliveryprice = $('#deliveryprice'+idindex[i]).text().replace(/[^0-9]/g,'');
      allsum = $('#allsum'+idindex[i]).text().replace(/[^0-9]/g,'');
      count = $('#count'+idindex[i]).val();
      // console.log(indexno);
      gettag1.push(Number(productprice));
      gettag2.push(Number(deliveryprice));
      gettag3.push(Number(allsum));
      gettag4.push(Number(count));
    }

    // var arr = [1,2,3,4,5];
    var sum1 = gettag1.reduce((a, b) => a + b);
    var sum2 = gettag2.reduce((a, b) => a + b);
    var sum3 = gettag3.reduce((a, b) => a + b);
    var sum4 = gettag4.reduce((a, b) => a + b);
    //전체 합계
    document.getElementById("i_result4").innerHTML=AddComma(sum3);
    document.getElementById("i_result3").innerHTML=AddComma(sum4);
    document.getElementById("i_result1").innerHTML=AddComma(sum1);
    document.getElementById("i_result2").innerHTML=AddComma(sum2);
  }
  if(!$(".flowercart-top").is(".flowercart-top")){
    document.getElementById("i_result4").innerHTML="0";
    document.getElementById("i_result3").innerHTML="0";
    document.getElementById("i_result1").innerHTML="0";
    document.getElementById("i_result2").innerHTML="0";
  }

});
function loadprice(a){
  if(a>0)
  {
    document.getElementById("productprice"+a).innerHTML= 1;
    document.getElementById("deliveryprice"+a).innerHTML= 1;
    document.getElementById("allsum"+a).innerHTML= 1;
    console.log(a);
    console.log('찍히냐?');
    return false;
  }

  if($(".flowercart-infor").is(".flowercart-infor")){
    var idindex = [];
    // $("input:checkbox[name=checkRow]:checked").each(function(i,elements)
    $("input:checkbox[name=checkRow]").each(function(i,elements)
    {
      //해당 index(순서)값을 가져옵니다.
      index = $(elements).index("input:checkbox[name=checkRow]");
      //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
      string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
      var no=string.replace(/[^0-9]/g,'');
      idindex.push(no);
      //해당 index에 해당하는 체크박스의 값을 가져옵니다.
    });
    // console.log(idindex);
    var gettag1 = [];
    var gettag2 = [];
    var gettag3 = [];
    var gettag4 = [];
    // console.log(gettag);
    for (var i = 0; i < idindex.length; i++) {
      productprice = $('#productprice'+idindex[i]).text().replace(/[^0-9]/g,'');
      deliveryprice = $('#deliveryprice'+idindex[i]).text().replace(/[^0-9]/g,'');
      allsum = $('#allsum'+idindex[i]).text().replace(/[^0-9]/g,'');
      count = $('#count'+idindex[i]).val();
      // console.log(indexno);
      gettag1.push(Number(productprice));
      gettag2.push(Number(deliveryprice));
      gettag3.push(Number(allsum));
      gettag4.push(Number(count));
    }

    // var arr = [1,2,3,4,5];
    var sum1 = gettag1.reduce((a, b) => a + b);
    var sum2 = gettag2.reduce((a, b) => a + b);
    var sum3 = gettag3.reduce((a, b) => a + b);
    var sum4 = gettag4.reduce((a, b) => a + b);
    //전체 합계
    document.getElementById("i_result4").innerHTML=AddComma(sum3);
    document.getElementById("i_result3").innerHTML=AddComma(sum4);
    document.getElementById("i_result1").innerHTML=AddComma(sum1);
    document.getElementById("i_result2").innerHTML=AddComma(sum2);
    // for(var i = 0; i < idindex.length; i++){
    //   document.getElementById("productprice"+idindex[i]).innerHTML=AddComma(productprice);
    //   document.getElementById("deliveryprice"+idindex[i]).innerHTML=AddComma(deliveryprice);
    //   document.getElementById("allsum"+idindex[i]).innerHTML=AddComma(allsum);
    // }



  }
  else{
    document.getElementById("i_result4").innerHTML="0";
    document.getElementById("i_result3").innerHTML="0";
    document.getElementById("i_result1").innerHTML="0";
    document.getElementById("i_result2").innerHTML="0";
  }

}
</script>
<button type="button" name="button" onclick="autoprice()">확인용</button>
<button type="button" name="button" onclick="test()">확인용</button>
