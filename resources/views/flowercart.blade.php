<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/flowercart.css">
  <title>장바구니</title>
</head>
<body>
  @include('lib.header')
  <div class="flowercart-wrap">
    장바구니
    <div class="flowercart-table-wrap">
      {{-- <table class="flowercart-table">
      <tr class="table-head">
      <th>상품 / 옵션정보</th>
      <th> 수량 </th>
      <th> 상품금액 </th>
      <th> 할인금액 </th>
      <th> 할인적용금액 </th>
      <th> 배송비 </th>
      <th> 주문 </th>
    </tr>
    <tr>
    <td>상품 정보 </td>
    <td> 2 </td>
    <td> 30000 원</td>
    <td> 1000 원</td>
    <td> 29000 원</td>
    <td> 3000원 </td>
    <td>
    <div class="">
    <a href="#">주문하기</a>
  </div>
  <div class="">
  <a href="#">삭제하기</a>
</div>
</td>
</tr>
<tr>
<td>상품 정보 </td>
<td> 2 </td>
<td> 30000 원</td>
<td> 1000 원</td>
<td> 29000 원</td>
<td> 3000원 </td>
<td>
<div class="">
<a href="#">주문하기</a>
</div>
<div class="">
<a href="#">삭제하기</a>
</div>
</td>
</tr>
<tr>
<td>상품 정보 </td>
<td> 2 </td>
<td> 30000 원</td>
<td> 1000 원</td>
<td> 29000 원</td>
<td> 3000원 </td>
<td>
<div class="">
<a href="#">주문하기</a>
</div>
<div class="">
<a href="#">삭제하기</a>
</div>
</td>
</tr>
<tr>
<td>상품 정보 </td>
<td> 2 </td>
<td> 30000 원</td>
<td> 1000 원</td>
<td> 29000 원</td>
<td> 3000원 </td>
<td>
<div class="">
<a href="#">주문하기</a>
</div>
<div class="">
<a href="#">삭제하기</a>
</div>
</td>
</tr>
<tr>
<td>아무것도없을때 공간</td>
</tr>
</table> --}}
<div class="flowercart-select">
  <input type="checkbox" name="checkAll" id="th_checkAll" value="">전체선택
</div>

<div class="flowercart-infor">
  <div class="flowercart-top">
    <input type="checkbox" name="checkRow" class="checkf" value="">
    <strong class="flowercart-tradename">가게명</strong>
  </div>
  <div class="flowercart-middle">
    <img class="flowercart-preview" src="/imglib/orangerose.jpg" alt="?">
    <div class="flowercart-section">
      <div class="product-name">상품 정보상품 정보상품 정보상품 정보상품 정보상품 정보상품 정보상품 정보상품 정보상품 정보상품 정보</div>
      <div class="product-price"> 가격 <a href="#" >x</a> </div>

      <div class="product-coupon">
        쿠폰
      </div>
      <div class="product-count">
        <button class="plus" type="button" name="button">
          <img src="/imglib/add.png" alt="">
        </button>
        <input class="count-plmi" type="text" name="" value="">
        <button type="button" class="minus" name="button">
          <img src="imglib/remove.png" alt="">
        </button>
      </div>
    </div>


  </div>
  <div class="flowercart-bottom">
    <div class="text-section-wrap">
      <div class="text-section">
        상품금액
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>

    <div class="imgwrap-section">
      <img src="imglib/minus.png" ondragstart="return false" class="plmieq-icon"alt="">
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
      <img src="imglib/plus.png" ondragstart="return false" class="plmieq-icon"alt="">
    </div>
    <div class="text-section-wrap">
      <div class="text-section">
        배송비
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>
    <div class="imgwrap-section">
      <img src="imglib/equal.png" ondragstart="return false" class="plmieq-icon"alt="">
    </div>
    <div class="text-section-wrap">
      <div class="text-section">
        주문금액
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>
  </div>
</div>

{{-- 2222222222 --}}

<div class="flowercart-infor">
  <div class="flowercart-top">
    <input type="checkbox" name="checkRow" class="checkf" value="">
    <strong class="flowercart-tradename">가게명</strong>
  </div>
  <div class="flowercart-middle">
    <img class="flowercart-preview" src="/imglib/orangerose.jpg" alt="?">
    <div class="flowercart-section">
      <div class="product-name"></div>
      <div class="product-count"> <button type="button" name="button">-</button> 수량<button type="button" name="button">+</button> </div>
      <div class="product-coupon">
        쿠폰
      </div>
      <div class="product-price"> 가격 <a href="#" >x</a> </div>
    </div>


  </div>
  <div class="flowercart-bottom">
    <div class="text-section-wrap">
      <div class="text-section">
        상품금액
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>

    <div class="imgwrap-section">
      <img src="imglib/minus.png" ondragstart="return false" class="plmieq-icon"alt="">
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
      <img src="imglib/plus.png" ondragstart="return false" class="plmieq-icon"alt="">
    </div>
    <div class="text-section-wrap">
      <div class="text-section">
        배송비
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>
    <div class="imgwrap-section">
      <img src="imglib/equal.png" ondragstart="return false" class="plmieq-icon"alt="">
    </div>
    <div class="text-section-wrap">
      <div class="text-section">
        주문금액
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>
  </div>
</div>

{{-- 33333333333 --}}


<div class="flowercart-infor">
  <div class="flowercart-top">
    <input type="checkbox" name="checkRow" class="checkf" value="">
    <strong class="flowercart-tradename">가게명</strong>
  </div>
  <div class="flowercart-middle">
    <img class="flowercart-preview" src="/imglib/orangerose.jpg" alt="?">
    <div class="flowercart-section">
      <div class="product-name">상품 정보</div>
      <div class="product-count"> <button type="button" name="button">-</button> 수량<button type="button" name="button">+</button> </div>
      <div class="product-coupon">
        쿠폰
      </div>
      <div class="product-price"> 가격 <a href="#" >x</a> </div>
    </div>


  </div>
  <div class="flowercart-bottom">
    <div class="text-section-wrap">
      <div class="text-section">
        상품금액
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>

    <div class="imgwrap-section">
      <img src="imglib/minus.png" ondragstart="return false" class="plmieq-icon"alt="">
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
      <img src="imglib/plus.png" ondragstart="return false" class="plmieq-icon"alt="">
    </div>
    <div class="text-section-wrap">
      <div class="text-section">
        배송비
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>
    <div class="imgwrap-section">
      <img src="imglib/equal.png" ondragstart="return false" class="plmieq-icon"alt="">
    </div>
    <div class="text-section-wrap">
      <div class="text-section">
        주문금액
      </div>
      <div class="price-section">
        <strong class="text-option">0</strong>원
      </div>
    </div>
  </div>
</div>

{{-- end --}}


<div class="flowercart-allprice">
  <div class="flowercart-right-top">
    <strong>전체 합계</strong>
  </div>
  <div class="flowercart-right-middle">
    <div class="label-container">
      <span class="label-left">상품수</span>
      <span class="label-right"> <strong>0</strong> 개</span>
    </div>
    <div class="label-container">
      <span class="label-left">상품금액</span>
      <span class="label-right"> <strong>0</strong> 원</span>
    </div>
    <div class="label-container">
      <span class="label-left">할인금액</span>
      <span class="label-right"> <strong>0</strong> 원</span>
    </div>
    <div class="label-container">
      <span class="label-left">배송비</span>
      <span class="label-right"> <strong>0</strong> 원</span>
    </div>
  </div>
  <div class="flowercart-right-bottom">

    <div class="allorderprice">
      전체 주문금액

    </div>
    <div class="allorderprice-section">
      <span class="allorderprice-right"> <span>0</span>원 </span>
    </div>

    <div class="basketorder">
      <a href="#">주문하기</a>
    </div>
  </div>
</div>
</div>
</div>
<style media="screen">
.plus img{
  height: 21px;
  width: 21px;
  bottom: 3px;
  left: 1px;
  position: absolute;
}
.minus img{
  height: 21px;
  width: 21px;
  right: 30px;
  bottom: 3px;
  position: absolute;
}
button.plus{
  cursor: pointer;
  border: none;
  height: 21px;
  width: 21px;
  padding: 0px;
  outline: 0;
  border-radius: 10px;


}
button.minus{
  cursor: pointer;
  border: none;
  height: 21px;
  width: 21px;
  padding: 0px;
  outline: 0;
  border-radius: 10px;
}
.text-option{
  font-size: 18px;
}
.text-section-wrap{
  display: inline-block;
  text-align: center;
}
.imgwrap-section{
  width: 21px;
  height: 21px;
  display: inline-block;
}
.plmieq-icon{
  width: 100%;
  height: 100%;
  -ms-user-select: none; -moz-user-select: -moz-none; -webkit-user-select: none; -khtml-user-select: none; user-select:none;

}
.text-section{
  display: inline-block;
  font-size: 12px;
  vertical-align: top;
  width: 127px;
  color: #A4A9B0;
}
.count-plmi{
  width: 20px;
  position: absolute;
  bottom: 3px;
  text-align: center;
  /* height: 10px; */
}
</style>
@include('lib.footer')
</body>
</html>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
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
