<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>아름다움을 선물하자, 꽃갈피</title>
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/header.css">
</head>
<body>
  @include('lib.header')
  <div class="hr-sect">
    검색 결과
  </div>
  <div class="container-wrap">
      @if($result_cnt<1)
     <div class="container-wrapping">
      '{{$search_query}}'에 대한 검색결과가 없습니다.
      <div>
      @elseif($search_query == false)
      <div class="container-wrapping">
        ''에 대한 검색결과가 없습니다.
      <div>
      @else
        <div class="container-wrapping">
          @foreach ($result_data as $productlist)
          <div class="container-image">
            <div class="image">
              <div class="image-in">
                <div class="imagewrap" >
                  <img src="\imglib\{{$productlist->p_filename}}" alt="꽃" >
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
  @endif
  </body>
  </html>
