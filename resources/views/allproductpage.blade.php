<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/allproduct.css">
  <title></title>
</head>
<style>

</style>
<body>
  @include('lib.header')
  <div class="hr-line">
    <div id="line">
      <div class="line-wrap">
        <h2 class="void-container">전체 상품 보기</h2>
        <div class="price-container">

            <span><a href="#">높은 가격순</a></span>
            <span><a href="#">낮은 가격순</a></span>


        </div>
      </div>
      <hr>
    </div>
  </div>
  <div class="container-wrap">
    <div class="container-wrapping">
      @foreach ($data as $productlist)
        <div class="container-image">
          <div class="image">
            <div class="image-in" url="/bi/{{$productlist->p_no}}">
              <div class="imagewrap" >
                <img src="\imglib\{{$productlist->p_filename}}" alt="꽃" >
              </div>

              <div class="image-in-font">
                <div class="image-in-post">
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
  @include('lib.footer')
</body>
</html>
