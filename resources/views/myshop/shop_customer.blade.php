<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/shop.css">
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
</head>
<!--정경진-->
<!-- customer에게 보이는 store화면 -->
<body>
  @include('lib.header')
  <div class="allwrap">
    @foreach ($shop as $shop)
      <div class="wrap0">
        <div class="shopname">{{$shop->st_name}}</div>
        <div class="wrap2">

          <div class="imgbox">
            <img src="/imglib/{{$shop->st_img}}" onerror="this.src='/imglib/profile.png'" class="shopimg" >
          </div>

          <div class="tablewrap">
            <table id="shopinfo">
              <tr>
                <th class="st_th">대표</th>
                <td class="st_td">{{$shop->s_name}}</td>
              </tr>

              <tr>
                <th class="st_th">상호명</th>
                <td class="st_td">{{$shop->st_name}}</td>
              </tr>
              <tr>
                <th class="st_th">연락처</th>
                <td class="st_td">{{$shop->st_tel}}</td>
              </tr>
              <tr>
                <th class="st_th">주소</th>

                <td class="st_td">({{$shop->a_post}}) {{$shop->a_address}}, {{$shop->a_detail}}{{$shop->a_extra}}</td>
              </tr>
            </table>
          </div>

          <div class="shopintro">
            <div id="introducemodi">{{$shop->st_introduce}}</div>
          </div>

        </div>
      </div>
    @endforeach

    @if(auth()->guard('customer')->user())
      <div class="wrap4">
        <form class="" action="/favorite_store/{{$shop->st_no}}" method="post">
          @csrf
          <h3 class="productname">판매물품</h3>
          <button id="favoritebtn" type="submit" onclick="alert('즐겨찾기에 추가되었습니다.')" name="button">즐겨찾기 등록</button>
        </form>
      </div>
    @elseif(auth()->guard('seller')->user())
      <div class="wrap4">
        <form class="" action="/favorite_store/{{$shop->st_no}}" method="post">
          @csrf
          <h3 class="productname">판매물품</h3>
          {{-- <button id="favoritebtn" type="submit" onclick="alert('즐겨찾기에 추가되었습니다.')" name="button">즐겨찾기 등록</button> --}}
        </form>
      </div>
    @endif
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
                      <img src="/imglib/{{$productlist->p_filename}}"  onerror="this.src='imglib/dummy.png'" width="100px" height="100px">
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
