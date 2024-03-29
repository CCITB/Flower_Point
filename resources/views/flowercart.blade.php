<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/flowercart.css">
  <title>장바구니</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
{{-- 곽승지 --}}
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
      <form class="" action="/order/" method="get" name="productpost" id="productpost">
        <input type="hidden" name="pdidx" value="">
        {{-- <input type="hidden" name="productnoidx" value=""> --}}
            </form>
        @foreach ($data as $list)
          <div class="flowercart-infor" id="remove{{$list->b_no}}">
            <div class="flowercart-top">
              <input type="checkbox" name="checkRow" class="checkf" id="checkf{{$list->b_no}}" onchange="selectcondition({{$list->b_no}},{{$list->p_no}});" value="{{$list->b_no}}" checked="checked">
              <strong class="flowercart-tradename" id="product{{$list->p_no}}">{{$list->st_name}}</strong>
            </div>
            <div class="flowercart-middle">
              <img class="flowercart-preview" src="/imglib/{{$list->b_picture}}" alt="?">
              <div class="flowercart-section">
                <div class="product-name">{{$list->b_name}}</div>
                <div class="product-price">
                  {{-- <a class="btn{{$list->b_no}}" onclick="del({{$list->b_no}})" href="#" >x</a> --}}
                  <button type="button" name="button" class= "btn1" onclick="del({{$list->b_no}},{{$list->p_no}})" value="{{$list->b_no}}">x</button>
                </div>
                {{-- <input type="text" name="" value="{{$list->b_no}}" hidden="" id="hidden1"> --}}
                {{-- <div class="product-coupon{{$list->b_no}}">
                쿠폰
              </div> --}}
              {{-- <div class="product-coupon">

              </div> --}}
              <div class="product-count">
                {{-- 수량증가-------------------- --}}
                <button type="button" class="minus" id="minus{{$list->b_no}}"name="button" onclick="decrease({{$list->b_no}});">
                  <img src="/imglib/remove.png" alt="">
                </button>
                <input class="count-plmi" type="text" name="amount{{$list->b_no}}" onkeydown="onKeyDown()"readonly id="count{{$list->b_no}}" value="{{$list->b_count}}">
                <button type="button" class="plus" id="plus{{$list->b_no}}" name="button" onclick="increase({{$list->b_no}});">
                  <img src="/imglib/add.png" alt="">
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
                <strong class="text-option" id="deliveryprice{{$list->b_no}}">{{number_format($list->b_delivery)}}</strong>원
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
                <strong class="text-option1" id="allsum{{$list->b_no}}">{{number_format($list->b_price*$list->b_count+$list->b_delivery)}}</strong>원
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
      <div class="basketorder" onclick="productcheck()">
        <a>주문하기</a>
      </div>
    </div>
  </div>
</div>

@include('lib.footer')
</body>
</html>
{{-- 곽승지 --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
var productidx = $('.flowercart-tradename');
var productnoidx=[];
// console.log(productidx);
for(i=0; i<productidx.length;i++){
productnoidx.push(productidx.eq(i).attr('id').replace(/[^0-9]/g,''));
}
var holy = [];
// var holy = 장바구니에 담긴 상품의 기본키가 담겨있음
var first1 = [];
var first2 = [];
var first3 = [];
// frist1 = 상품금액 배열
// first2 = 배송비 배열
// first3 = 주문 금액 배열
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

  first1.push(a1);
  first2.push(a2);
  first3.push(a3);

}
</script>

<script type="text/javascript">
// 상품합계 ui fixed 함수
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
if(selectAll==null){

}
else{
  selectAll.addEventListener('click', function(){
    var objs = document.querySelectorAll(".checkf");
    for (var i = 0; i < objs.length; i++) {
      objs[i].checked = selectAll.checked;
      if(selectAll.checked){

      }
    };

  }, false);
}

//checkbox 기능함수
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

function increase(a) {
  var textbox = document.getElementById('count'+a);
  if(textbox.value>=999){
    alert('선택하신 상품의 주문 가능한 수량은 999개 입니다. 999개 이하로 주문해 주세요.')
    return false;
  }
  textbox.value = parseInt(textbox.value) + 1;
  n2 = textbox.value;
  $.ajax({
    type: 'post',
    url: '/basketcount',
    dataType: 'json',
    data: { "add" : n2,
    "no" : a
  },
  success: function(data) {
    // console.log(data);
    window["orderprice"+a]=AddComma(data[0]*data[1]+data[2]);
    window["productprice"+a]=AddComma(data[0]*data[1]);
    window["deliveryprice"+a]=AddComma(data[2]);
    orderprice = data[0]*(data[1]+data[2]);
    productprice = data[0]*data[1];
    deliveryprice = data[0]*data[2];
    if(!$('#checkf'+a).is(":checked")){
      return false;
    }
    else
    document.getElementById("productprice"+a).innerHTML=AddComma(window["productprice"+a]);
    document.getElementById("deliveryprice"+a).innerHTML=AddComma(window["deliveryprice"+a]);
    document.getElementById("allsum"+a).innerHTML=AddComma(window["orderprice"+a]);
    dd=1;
    autoprice(data[0],data[1],data[2],dd);
    //data[0]=수량
    //data[1]=상품가격
    //data[2]=배송비
  },
  error: function(data) {
    // console.log("error" +data);
  }
});
}
var getid=[];
$("input:checkbox[name=checkRow]:checked").each(function(i,elements){
  //해당 index(순서)값을 가져옵니다.
  index = $(elements).index("input:checkbox[name=checkRow]");
  //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
  // console.log($("input:checkbox[name=checkRow]").eq(index).attr("id"));
  string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
  var no=string.replace(/[^0-9]/g,'');
  // console.log(no);
  getid.push(no);
  //해당 index에 해당하는 체크박스의 값을 가져옵니다.
  // alert($("input:checkbox[name=checkRow]").eq(index),val());
});
//반복문을 통해 장바구니에 담긴 상품을 구별하는 동적변수를 생성합니다.
for(i=0; i<getid.length; i++){
  // console.log(getid[i]);
  window['orderprice'+getid[i]]=first3[i];
  window['productprice'+getid[i]]=first1[i];
  window['deliveryprice'+getid[i]]=first2[i];
}


var orderprice;
var productprice;
var deliveryprice;
function decrease(d) {
  var textbox = document.getElementById('count'+d);
  if(textbox.value <=1){
    alert('수량이 1보단 작을수 없습니다.');

    return false;
  }
  else textbox.value = parseInt(textbox.value) - 1;

  n2 = textbox.value;
  $.ajax({
    type: 'post',
    url: '/basketcount',
    dataType: 'json',
    data: { "remove" : n2,
    "no" : d
  },
  success: function(data) {

    window["orderprice"+d]=AddComma(data[0]*data[1]+data[2]);
    window["productprice"+d]=AddComma(data[0]*data[1]);
    window["deliveryprice"+d]=AddComma(data[2]);
    orderprice = data[0]*(data[1]+data[2]);
    productprice = data[0]*data[1];
    deliveryprice = data[0]*data[2];
    // $('.product-coupon'+d).text(window["orderprice"+d]);
    if(!$('#checkf'+d).is(":checked")){

      return false;
    }

    document.getElementById("productprice"+d).innerHTML=AddComma(window["productprice"+d]);
    document.getElementById("deliveryprice"+d).innerHTML=AddComma(window["deliveryprice"+d]);
    document.getElementById("allsum"+d).innerHTML=AddComma(window["orderprice"+d]);
    dd=-1;
    autoprice(data[0],data[1],data[2],dd);


  },
  error: function(data) {
    // console.log("error" +data);
  }
});
}


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
// 단일상품 삭제 함수
function del(e,b){
  var deleted = confirm("정말 상품을 삭제하시겠습니까?");
  if(deleted){

  }
  else{
    return false;
  }


  $.ajax({
    type: 'post',
    url: '/delete',
    dataType: 'json',
    data: { "id" : e,
  },
  // console.log(jjim);
  success: function(data) {

    if(data[0]=e){
      // autoprice();
      delcount = $('#count'+e).val();
      $("#remove"+e).remove();
      if($(".flowercart-infor").is(".flowercart-infor")){
        // ($("#div_test").hasClass("apple") === true)

        loadprice(delcount);
        proarraysequence = productnoidx.indexOf(b.toString());
        arraysequence = getid.indexOf(e.toString());
        if(arraysequence == -1){
          // alert('배열에 값이 없습니다.');
        }
        else{
          getid.splice(arraysequence,1);
        }
        if(proarraysequence == -1){
          // alert('배열에 값이 없습니다.');
        }
        else{
          productnoidx.splice(proarraysequence,1);
        }
      }
      else{

        document.getElementById("i_result4").innerHTML="0";
        document.getElementById("i_result3").innerHTML="0";
        document.getElementById("i_result1").innerHTML="0";
        document.getElementById("i_result2").innerHTML="0";
        var $div = $('<div class="flowercart-infor" id="remove" style="height:400px; position:relative;"><div class="" style="top:180px; position:absolute; left:260px; ">장바구니가 비어있습니다.</div></div>');

        $(".flowercart-select").remove();
        $(".flowercart-wrap").prepend($div);
      }
    }

  },
  error: function(data) {
    // console.log("error" +data);
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
// 선택상품 제거함수
function selectdel(){
  if(!$("input:checkbox[name='checkRow']").is(":checked")){
    alert("선택하신 상품이 없습니다. 삭제를 원하시는 상품을 선택 해 주세요.");
    return false;
  }
  var deleted = confirm("정말 상품을 삭제하시겠습니까?");
  if(deleted){
    // 여기는 체크한 상품 지우는 구간 코드
    if(selectAll.checked){

      // $('.checkf')


      var idindex = [];

      // console.log(document.querySelectorAll(".checkf").checked);
      $("input:checkbox[name=checkRow]:checked").each(function(i,elements){
        //해당 index(순서)값을 가져옵니다.
        index = $(elements).index("input:checkbox[name=checkRow]");
        //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
        string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
        var no=string.replace(/[^0-9]/g,'');

        idindex.push(no);
        //해당 index에 해당하는 체크박스의 값을 가져옵니다.
        // alert($("input:checkbox[name=checkRow]").eq(index),val());
      });

    }
    else {

      checkvalue = $('.checkf').is(":checked");

      var idindex = [];

      $("input:checkbox[name=checkRow]:checked").each(function(i,elements){
        //해당 index(순서)값을 가져옵니다.
        index = $(elements).index("input:checkbox[name=checkRow]");
        //해당 index에 해당하는 체크박스의 ID 속성을 가져옵니다.
        console.log($("input:checkbox[name=checkRow]").eq(index).attr("id"));
        string =  $("input:checkbox[name=checkRow]").eq(index).attr("id");
        var no=string.replace(/[^0-9]/g,'');

        idindex.push(no);
        //해당 index에 해당하는 체크박스의 값을 가져옵니다.
        // alert($("input:checkbox[name=checkRow]").eq(index),val());
      });

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

      var a = [];
      var countarray = 0;
      for(i=0; i<data.length;i++){
        countarray = countarray+Number($('#count'+data[i]).val());
        $("#remove"+data[i]).remove();
        //삭제후에 결제페이지에 넘기기전에 기본키가 담긴 배열을 업데이트 해줍니다.
        arraysequence = getid.indexOf(data[i].toString());
        // proarraysequence = productnoidx.indexOf(productnoidx[i].toString());
        if(arraysequence == -1){
          // alert('배열에 값이 없습니다.');
        }
        else{
          getid.splice(arraysequence,1);
        }
        if(arraysequence == -1){
          // alert('배열에 값이 없습니다.');
        }
        else{
          productnoidx.splice(arraysequence,1);
        }
        // console.log(productnoidx.indexOf(productnoidx[i].toString()));

      }

      if(data=idindex){

        if($(".flowercart-infor").is(".flowercart-infor")){
          // ($("#div_test").hasClass("apple") === true)
          loadprice(countarray);

        }
        else{
          document.getElementById("i_result4").innerHTML="0";
          document.getElementById("i_result3").innerHTML="0";
          document.getElementById("i_result1").innerHTML="0";
          document.getElementById("i_result2").innerHTML="0";
          var $div = $('<div class="flowercart-infor" id="remove" style="height:400px; position:relative;"><div class="" style="top:180px; position:absolute; left:260px; ">장바구니가 비어있습니다.</div></div>');

          $(".flowercart-select").remove();
          $(".flowercart-wrap").prepend($div);
        }

        // loadprice();
      }

    },
    error: function(data) {
      // console.log("error" +data);
    }
  });
}


</script>
<script type="text/javascript">
function condition(){
  if(selectAll.checked){
    for (var i = 0; i < holy.length; i++) {
      $('#productprice'+holy[i]).text(window["productprice"+holy[i]]);
      $('#deliveryprice'+holy[i]).text(window["deliveryprice"+holy[i]]);
      $('#allsum'+holy[i]).text(window["orderprice"+holy[i]]);
    }

    var checking = 1;

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
    getid.length=0;
    productnoidx.length=0;
    //전체선택할때마다 상품인덱스 배열을 초기화 시켜줍니다.
    for(i=0; i<idindex.length; i++){
      getid.push(idindex[i]);
      productnoidx.push(productidx.eq(i).attr('id').replace(/[^0-9]/g,''));
    }

    loadprice();
  }
  else {
    getid.length=0;
    productnoidx.length=0;
    //getid.legth
    //페이지 로드할때 getid에 장바구니 index가 담겨있고 선택해제시 초기화시켜줌
    test1.length=0;
    test2.length=0;
    test3.length=0;
    for (var i = 0; i < holy.length; i++) {
      no1 = $('#productprice'+holy[i]).text();
      no2 = $('#deliveryprice'+holy[i]).text();
      no3 = $('#allsum'+holy[i]).text();
      test1.push(no1);
      test2.push(no2);
      test3.push(no3);

      // test1.splice(0, 3,test[i]);
    }
    // delete test1[];
    // test1.splice(0, 3,test[0],test[1],test[2]);
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
    });
    // console.log(idindex);
  }
}
var test1 = [];
var test2 = [];
var test3 = [];
var now_productprice = [];
var now_deliveryprice = [];
var now_allsum = [];
// 체크박스 개별선택함수
function selectcondition(a,b){
  // var ada = $('input:checkbox[id="checkf"+'a']').is(":checked") == true;
  // console.log(ada);
  // console.log(1);
  var cc = $('#checkf'+a).is(":checked");
  //cc가 true면 하나의 상품만 선택했을경우이다.
  if(cc){
    // 개별 선택 할때마다 배열에 상품인덱스 값을 넣어줍니다.
    getid.push(a.toString());
    productnoidx.push(b.toString());


    var hide = $('#i_result3').text()+$('#count'+a).val();

    var hide1 = parseFloat($('#i_result1').text().replace(/,/gi, ""));
    var hide2 = parseFloat($('#i_result2').text().replace(/,/gi, ""));

    var hide3 = $('#i_result3').text();

    var hide4 = parseFloat($('#i_result4').text().replace(/,/gi, ""));

    var hide5 = $('#count'+a).val();

    var hide6 = parseFloat(window['productprice'+a].replace(/,/gi, ""));
    var hide7 = parseFloat(window["deliveryprice"+a].replace(/,/gi, ""));
    var hide8 = parseFloat(window["orderprice"+a].replace(/,/gi, ""));

    $('#i_result3').text(Number(hide5)+Number(hide3));

    // i_result1 i_result2 i_result4 상품 체크시마다 전체 주문합계에 반영시켜줌
    $('#i_result1').text(AddComma(hide6+hide1));
    $('#i_result2').text(AddComma(hide7+hide2));
    $('#i_result4').text(AddComma(hide8+hide4));
    // i_result1 i_result2 i_result4 상품 체크시마다 전체 주문합계에 반영시켜줌

    // 만약 input에 카운트를 실행시켯다면 전역변수에 담긴 수 들이다.
    if(!hide8==0){
      $('#productprice'+a).text(AddComma(hide6));
      $('#deliveryprice'+a).text(AddComma(hide7));
      $('#allsum'+a).text(AddComma(hide8));
    }
    else{

    }

  }

  else {
    // 체크가 안되어있으면 getid 배열에서 상품인덱스인 a를 지웁니다.
    arraysequence = getid.indexOf(a.toString());
    proarraysequence = productnoidx.indexOf(b.toString());
    if(arraysequence == -1){
      alert('배열에 값이 없습니다.');
    }
    else{
      getid.splice(arraysequence,1);
    }
    if(proarraysequence == -1){
      alert('배열에 값이 없습니다.');
    }
    else{
      productnoidx.splice(proarraysequence,1);
    }
    // 체크가 안되어있으면 getid 배열에서 상품인덱스인 a를 지웁니다.

    document.getElementById("productprice"+a).innerHTML=0;
    document.getElementById("deliveryprice"+a).innerHTML=0;
    document.getElementById("allsum"+a).innerHTML=0;
    var hide = $('#i_result3').text()-$('#count'+a).val();
    // console.log($('#i_result1').text()-window['productprice'+a]);
    abc = AddComma(parseFloat($('#i_result1').text().replace(/,/gi, ""))-parseFloat(window['productprice'+a].replace(/,/gi, "")));
    def = AddComma(parseFloat($('#i_result2').text().replace(/,/gi, ""))-parseFloat(window['deliveryprice'+a].replace(/,/gi, "")));
    ghi = AddComma(parseFloat($('#i_result4').text().replace(/,/gi, ""))-(parseFloat(window['deliveryprice'+a].replace(/,/gi, ""))+parseFloat(window['productprice'+a].replace(/,/gi, ""))));
    $('#i_result1').text(abc);
    $('#i_result2').text(def);
    $('#i_result3').text(hide);
    $('#i_result4').text(ghi);

  }
}


function autoprice(a,b,c,dd){
  if(selectAll.checked){

    loadprice();

    return false;
  }
  if(!$("input:checkbox[name='checkRow']").is(":checked")){
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
    }

    document.getElementById("i_result3").innerHTML=AddComma(0);
    document.getElementById("i_result1").innerHTML=AddComma(0);
    document.getElementById("i_result2").innerHTML=AddComma(0);
    document.getElementById("i_result4").innerHTML=AddComma(0);
  }
  if($("input:checkbox[name='checkRow']").is(":checked")){
    $('#i_result3').text();
    allpriceformat1 = parseFloat($('#i_result1').text().replace(/,/gi, ""));
    allpriceformat2 = parseFloat($('#i_result2').text().replace(/,/gi, ""));
    allpriceformat3 = parseFloat($('#i_result4').text().replace(/,/gi, ""));
    allpriceformat4 = parseFloat($('#i_result3').text().replace(/,/gi, ""));

    if(dd==1){
      $('#i_result3').text(allpriceformat4+1);
      $('#i_result1').text(AddComma(allpriceformat1+b));
      $('#i_result2').text(AddComma(allpriceformat2+c));
      $('#i_result4').text(AddComma(allpriceformat3+b+c));

    }
    if(dd==-1){
      $('#i_result3').text(allpriceformat4-1);
      $('#i_result1').text(AddComma(allpriceformat1-b));
      $('#i_result2').text(AddComma(allpriceformat2-c));
      $('#i_result4').text(AddComma(allpriceformat3-b-c));
    }
  }
}

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
    for(i=0;i<getid.length;i++){
      var asdf =+ window["productprice"+getid[i]];

    }
    $('#i_result1').text(asdf);
    $('#i_result3').text();

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
    // console.log('밑에 sum4 변수');
    // console.log(sum4);
    // console.log(Number(a));
    // console.log(Number($('#i_result3').text()-Number(a)));

    document.getElementById("i_result4").innerHTML=AddComma(sum3);

    document.getElementById("i_result1").innerHTML=AddComma(sum1);
    document.getElementById("i_result2").innerHTML=AddComma(sum2);
    if(selectAll.checked){
      document.getElementById("i_result3").innerHTML=AddComma(sum4);
    }
    else{
      $('#i_result3').text(Number($('#i_result3').text()-Number(a)));
    }

  }
  else{
    document.getElementById("i_result4").innerHTML="0";
    document.getElementById("i_result3").innerHTML="0";
    document.getElementById("i_result1").innerHTML="0";
    document.getElementById("i_result2").innerHTML="0";
  }

}
//콤마제거함수
function replaceComma(pStr) {
  var strCheck = /\,/g; pStr = pStr.replace(strCheck, '');
  return pStr;
}
// function checkindex(){
//   console.log(getid);
//   console.log(productnoidx);
// }
function productcheck(){
  var productpost = document.productpost;
  if(getid.length == 0){
    alert('최소 하나의 상품을 선택해주세요');
    return false;
  }
  else{
    var test = (JSON.stringify(getid));
    $('input[name=pdidx]').val(test);
    // $('input[name=productnoidx]').val((JSON.stringify(productnoidx)));
    // console.log(test);
    // return false;
    productpost.submit();
  }

}
if (self.name != 'reload') {
        self.name = 'reload';
        self.location.reload(true);
    }
    else self.name = '';
</script>
{{-- <button type="button" onclick="checkindex()" name="button">확인용</button> --}}
