<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/locate.css">
  <link rel="stylesheet" href="/css/shop.css">
  <link rel="stylesheet" href="/css/star.css">
  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
</head>
<!--구매자가 추가한 꽃집,상품 즐겨찾기 화면-->
<body>
  @include('lib.header')
  <div class="menu4">
    <h3 align="center">즐겨찾기</h3>
    <hr align="left" class="one">
  </hr>
</div>
<div class="myinfo">
    <table border="0" table class="table1" >
  <tr class="tr1">
    <th class="th1">상품이미지</th>
  <th class="th1">상품명</th>
    <th class="th1">가격</th>
    <th></th>
  </tr>
</table>
  <div class="privacy">
    @foreach ($data as $data1)
      <table border="0" table class="table1" >
        @if($customer = auth()->guard('customer')->user())
          <div id="tablewrap">
            <form class="" action="star2/{{$data1->p_no}}" method="post">
              @csrf
              <table id="shopinfo">
                <tbody>
                  <tr class="tr1">

                    <th class="th1">
                      <div class="th1">
                        <a href="product/{{$data1->p_no}}">
                          <img src="\imglib\{{$data1->p_filename}}" onerror="this.src='imglib/image.png'" height="100px" width="100px" >
                        </a>
                      </div>
                    </th>
                    <td>
                      <a href="product/{{$data1->p_no}}">
                        <div class="tdcell">{{$data1->p_name}}<p class="contxt.tit"></p>
                        </a></div>
                      </td>
                      <td>
                        <div class="tdcell">{{$data1->p_price}}<p class="contxt.tit"></p></div>
                      </td>
                      <td>
                        <div class="tdcell"><p class="contxt.tit"><a href="{{$data1->p_no}}"></a> <button type="submit">내 상품 삭제</button></a></p></div>
                      </td>
                    @endif
                  @endforeach
                </tr>
              </div>

            </table>
          </form>
        </tbody>
      </table>

    </div>
        {{ $data->links()}}
    <div class="menu4">
      <h3 align="center">즐겨찾기 꽃집</h3>
      <hr align="left" class="one">
    </hr>
  </div>
  <div class="privacy">
    @foreach ($pro2 as $data2)
      <table border="0" table class="table1" >
        @if($customer = auth()->guard('customer')->user())
          <div id="tablewrap">
            <form class="" action="store_star/{{$data2->st_name}}" method="post">
              @csrf
              <table id="shopinfo">
                <tbody>
                  <tr class="tr1">

                    <th class="th1">
                      <div class="th1">
                        <a href="product/store/{{$data2->st_name}}">
                          <img src="\imglib\{{$data2->st_img}}" height="100px" width="100px"alt="등록된 가게이미지가 없습니다.">
                        </a>
                      </div>
                    </th>
                    <td>
                      <a href="product/store/{{$data2->st_name}}">
                        <div class="tdcell">{{$data2->st_name}}<p class="contxt.tit"></p>
                        </a></div>
                      </td>
                      <td>
                        <div class="tdcell">{{$data2->st_tel}}<p class="contxt.tit"></p></div>
                      </td>
                      <td>
                        <div class="tdcell"><p class="contxt.tit"><a href="{{$data2->st_name}}"></a> <button type="submit">즐겨찾기 꽃집 삭제</button></a></p></div>
                      </td>
                    @endif
                  @endforeach
                </tr>
              </div>
            </table>
          </form>
        </tbody>
      </table>
    </div>


  </div>
  @include('lib.footer')
</body>
</html>
