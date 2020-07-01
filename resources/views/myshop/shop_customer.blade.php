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
    @foreach ($shop as $shop)
      <div class="wrap0">
        <h3 class="shopname">{{$shop->st_name}}</h3>

        <hr>
        <div class="wrap2">
          <div class="imgbox">
            <img class="shopimg" src="/imglib/{{$shop->st_img}}" alt="꽃집사진" >
          </div>
          <div id="tablewrap">
            <table id="shopinfo">
              <tr>
                <th>대표</th>
                <td><div class="thcell">{{$shop->s_name}}</div></td>
              </tr>

              <tr>
                <th>상호명</th>
                <td><div class="thcell">{{$shop->st_name}}</div></td>
              </tr>
            @endforeach

            @foreach ($shop_address as $shop_address)
              <tr>
                <th>주소</th>
                <td>{{$shop_address->a_address}}</td>
              </tr>
              <tr>
                <th>우편번호</th>
                <td>{{$shop_address->a_post}}</td>
              </tr>

              <tr>
                <th>참고항목</th>
                <td>{{$shop_address->a_extra}}</td>
              </tr>
              <tr>
                <th>상세주소</th>
                <td>{{$shop_address->a_detail}}</td>
              </tr>
            @endforeach
        </table>
      </div>
      <form class="shop" action="/shopinfo" method="get">
        <div class="shopintro">
          <div id="introducemodi">{{$shop->st_introduce}}</div>
        </div>
      </form>

    </div>
  <div class="wrap4">
    <form class="" action="/favorite_store/{{$shop->st_no}}" method="post">
      @csrf
    <h3 class="productname">판매물품</h3>
      <button id="favoritebtn" type="submit" onclick="alert('즐겨찾기에 추가되었습니다.')" name="button">즐겨찾기 등록</button>
          </form>
  </div>
  <div class="wrap5">
    <div class="wrap6">
      <div class="wrap6-1">
        <img src="\imglib\" alt="" width="100px" height="100px">
      </div>

      <div class="productlist">

          <div class="container-wrapping">
            @foreach ($product as $productlist)
            <div class="container-image">
              <div class="image">
                <div class="image-in" url="/product/{{$productlist->p_no}}">
                  <div class="imagewrap" >
                    <img src="\imglib\{{$productlist->p_filename}}" alt="꽃" width="100px" height="100px">
                  </div>
                  <div class="image-in-font">
                    <div class="image-in-post">
                      <!--게시글 제목-->
                      {{$productlist->p_name}}
                    </div>
                    <div class="image-in-container">
                      <div class="image-in-star">
                        <p class="star_rating">
                          <a href="#" class="on">★</a>
                          <a href="#" class="on">★</a>
                          <a href="#" class="on">★</a>
                          <a href="#" class="on">★</a>
                          <a href="#" class="on">★</a>
                        </p>
                      </div>
                      <div class="image-in-bottom">
                        <!--물품 내용-->
                      {{strip_tags($productlist->p_contents)}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

      </div>
    </div>

  </div>
</div>
  </div>
@include('lib.footer')
</body>

</html>
<script type="text/javascript">
$("div.image-in").click(
  function()
  {
    window.location = $(this).attr("url");
    return false;
  });
</script>
