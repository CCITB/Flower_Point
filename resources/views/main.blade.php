
<!-- 곽승지 무단 수정 금지 -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
</head>
<body>
  @include('lib.header')
  @include('advertising')

  <div class="hr-sect">최신상품 <img id="new_icon" src="/imglib/newicon.png"></div>
  <!-- 상품진열 테이블입니다. -->
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">

        <div class="container-wrap">
          <div class="container-wrapping">
            @foreach ($product as $productlist)
              <div class="container-image">
                <div class="image">
                  <div class="image-in" url="/product/{{$productlist->p_no}}">
                    <div class="imagewrap" >
                      <img src="\imglib\{{$productlist->p_filename}}" onerror="this.src='imglib/dummy.png'" >
                    </div>

                    <div class="image-in-font">
                      <div class="image-in-post">
                        {{-- {{$productlist->p_name}} --}}
                        {{$productlist->st_name}}
                      </div>
                      <div class="image-in-container">
                        {{-- <div class="image-in-star">
                        </div> --}}
                        <div class="image-in-bottom">
                          {{$productlist->p_name}}
                          {{-- {{str_replace("&nbsp;"," ",strip_tags($productlist->p_contents))}} --}}
                        </div>
                      </div>
                      <div class="image-in-price">
                        <strong>{{number_format($productlist->p_price)}}원</strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div> {{-- swiper-slide --}}

      <div class="swiper-slide">

        <div class="container-wrap">
          <div class="container-wrapping">
            @foreach ($prod as $productlist)
              <div class="container-image">
                <div class="image">
                  <div class="image-in" url="/product/{{$productlist->p_no}}">
                    <div class="imagewrap" >
                      <img src="\imglib\{{$productlist->p_filename}}" alt="꽃" >
                    </div>

                    <div class="image-in-font">
                      <div class="image-in-post">
                        {{$productlist->st_name}}
                      </div>
                      <div class="image-in-container">

                        <div class="image-in-bottom">
                            {{$productlist->p_name}}
                        </div>
                      </div>
                      <div class="image-in-price">
                        <strong>{{number_format($productlist->p_price)}}원</strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>

      {{-- <div class="swiper-slide">

        <div class="container-wrap">
          <div class="container-wrapping">
            @foreach ($pro as $productlist)
              <div class="container-image">
                <div class="image">
                  <div class="image-in" url="/product/{{$productlist->p_no}}">
                    <div class="imagewrap" >
                      <img src="\imglib\{{$productlist->p_filename}}" alt="꽃" >
                    </div>

                    <div class="image-in-font">
                      <div class="image-in-post">
                        {{$productlist->st_name}}
                      </div>
                      <div class="image-in-container">
                        <div class="image-in-star">
                        </div>
                        <div class="image-in-bottom">
                          {{$productlist->p_name}}
                        </div>
                      </div>
                      <div class="image-in-price">
                        <strong>{{number_format($productlist->p_price)}}원</strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div> --}}

    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>

<!-- 인기 상품-->
<div class="hot_div">
<div class="hr-sect">인기상품 <img id="star_icon" src="/imglib/staricon.png"></div>

<div class="container-wrap">
  <div class="container-wrapping">
    @foreach ($product as $productlist)
      <div class="hot-container-image">
        <div class="hot-image">
          <div class="hot-image-in" url="/product/{{$productlist->p_no}}">
            <div class="hot-imagewrap" >
              <img class="hot-imagewrap" src="\imglib\{{$productlist->p_filename}}" alt="꽃" >
            </div>

            <div class="hot-image-in-font">
              <div class="hot-image-in-container">
                <div class="hot-image-in-bottom">
                  {{$productlist->p_name}}
                </div>
              </div>
              <div class="hot-image-in-price">
                <strong>{{number_format($productlist->p_price)}}원</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
</div>


@include('lib.footer')




<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
<script>

// 메인 슬라이드
var mySwiper = new Swiper('.swiper-container', {

  slidesPerView: 1, // 보여지는 슬라이드 수
  slidesPerGroup: 1, // 넘어가는 한 그룹 당 슬라이드 수
  spaceBetween: 20, // 슬라이드 간의 거리(px 단위)
  // loop: true, // 슬라이드 무한 반복
  // centeredSlides: true, // 다음 슬라이드의 모습이 50%만 보입니다.(중앙)
  navigation: {
    prevEl: '.swiper-button-prev',
    nextEl: '.swiper-button-next',
  },
});

 // 평점
$( ".star_rating a" ).click(function() {
  $(this).parent().children("a").removeClass("on");
  $(this).addClass("on").prevAll("a").addClass("on");
  return false;
});
</script>

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
