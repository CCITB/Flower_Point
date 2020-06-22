<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/shop.css">
  <link rel="stylesheet" href="/css/postlist.css">
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <style>
  td.upload-date{
    text-align: center;
  }
  td.upload-price{
    text-align: center;
    padding-right: 10px;
    padding-left: 10px;
  }
  td.upload-name{
    text-align: center;
    padding-left: 15px;

  }
  </style>
</head>
<body>
  @include('lib.header')
  <div class="allwrap">
    <div class="wrap0">
      @if( auth()->guard('customer')->user())

          <h3 class="shopname"></h3>
          <hr>
          <div class="wrap2">
            <div class="imgbox">
              <img class="shopimg" src="/imglib/rose.jpg" alt="꽃집사진" >
            </div>
            <div id="tablewrap">
            <table class="shopinfo">
              <tr>
                <th>대표</th>
                <td><div class="thcell"></div></td>
              </tr>

              <tr>
                <th>상호명</th>
                <td><div class="thcell"></div></td>
              </tr>
              <form class="addressgroup" action="/shopinfo" method="get">

                <tr>
                  <th>주소</th>
                    <tr>
                    <th>우편번호</th>
                    <td></td>
                    </tr>
                    <tr>
                    <th>참고항목</th>
                    <td></td>
                    </tr>
                    <tr>
                    <th>상세주소</th>
                    <td></td>
                    </tr>
                  </form>
                  <form action="/newaddress" method="get">
                  <div id="addressmodi" style="display:none;">
                    <div class="delivery_wrap">
                      <strong class="info">주 소</strong>
                      <!-- 우편번호 -->
                      <input type="text" id="postcode" name="postcode" placeholder="우편번호" readonly>
                      <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                    </div>
                    <!--주소 -->
                    <div class="delivery_wrap2">
                      <input type="text"  id="address" name="address" placeholder="주소" readonly>
                        <div class="detail">
                          <input type="text" class="delivery_address_list" name="extraAddress"id="extraAddress" placeholder="참고항목" readonly>
                        </div>



                            <div class="delivery_address_detail">
                        <input type="text" class="delivery_address_list" name="detailAddress" id="detailAddress" placeholder="상세주소" readonly>
                      </div>


                    </div>
                  </div>
                  <button type="submit" id="complete1" name="button" style="display:none;">수정완료</button>
                </form>
              </div>
            </tr>
          </table>
        </div>
          <form class="shop" action="/shopinfo" method="get">
            <div class="shopintro">
              <div id="introducemodi"></div>
            </div>
          </form>
        </div>

    <div class="wrap4">
      <h3 class="productname">판매물품</h3>
    </div>
    <div class="wrap5">
        <div class="wrap6">
          <div class="wrap6-1">
            <img src="\imglib\" alt="" width="100px" height="100px">
          </div>

          <div class="productlist">
            <div class="productlist-item">


        </div>
      </div>
  </div>

</div>
</div>
@include('lib.footer')
</body>
@endif
</html>
<script type="text/javascript">
$("div.image-in").click(
  function()
  {
    window.location = $(this).attr("url");
    return false;
  });
</script>
