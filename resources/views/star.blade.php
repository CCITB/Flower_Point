<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/star.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>
  <!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
</head>
<!--구매자가 추가한 꽃집,상품 즐겨찾기 화면-->
<body>
  <style media="screen">
  footer{
    position:relative;
    left:0px;
    bottom:0px;
    height:60px;
    width:100%;
  }
  </style>
  @include('lib.header')
  <div class="menu4">
    <h3 align="center">즐겨찾기</h3>
    <hr align="left" class="one">
  </hr>
</div>
<div class="myinfo">
  @if(count($data))

    <table id="shopinfo">
      <thead>
        <tr><th>상품이미지</th><th>상품명</th><th>가격</th><th></th></tr>
      </thead>
      <div class="privacy">
        <tbody>

          @if($customer = auth()->guard('customer')->user())
            <div id="tablewrap">
              @foreach ($data as $data1)
                <tr class="tr1">
                  <th class="th1">
                    <div class="th1">
                      <a href="product/{{$data1->p_no}}">
                        <img src="\imglib\{{$data1->p_filename}}" onerror="this.src='imglib/profile.png'" height="100px" width="100px" >
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
                      <form action="/star2/{{$data1->p_no}}" method="post">
                        @csrf

                        <div class="tdcell2"><button type="submit">내 상품 삭제</button><p class="contxt.tit"></p></div>
                      </td>
                    </form>
                  </tr>
                @endforeach
              </div>
            @endif
          </table>
        </tbody>
      </table>

    </div>
  @else
    <div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
      <div class="" style="top:180px; position:absolute; left:300px; ">
        내상품이 비어있습니다.
      </div>
    </div>
  @endif
  <div class="menu4">
    <h3 align="center">나만의 꽃집</h3>
    <hr align="left" class="one">
  </hr>
</div>
@if(count($pro2))
  <div class="myinfo">
    <table id="shopinfo2">
      <thead>
        <tr><th>가게이미지</th><th>가게이름</th><th>가게번호</th><th></th></tr>
      </thead>
      <div class="privacy">
        <tbody>

          @if($customer = auth()->guard('customer')->user())
            <div id="tablewrap">
              @foreach ($pro2 as $data2)
                <tr class="tr1">
                  <th class="th1">
                    <div class="th1">
                      <a href="/store/{{$data2->st_name}}">
                        <img src="\imglib\{{$data2->st_img}}"  onerror="this.src='imglib/dummy.png'" width="100px" height="100px">
                      </a>
                    </div>
                  </th>
                  <td>
                    <a href="/store/{{$data2->st_name}}">
                      <div class="tdtd">{{$data2->st_name}}<p class="contxt.tit"></p>
                      </a></div>
                    </td>
                    <td>
                      <div class="tdtd">{{$data2->st_tel}}<p class="contxt.tit"></p></div>
                    </td>
                    <td>
                      <form class="" action="store_star/{{$data2->st_name}}" method="post">
                        @csrf
                        <div class="tdcell3"><p class="contxt.tit"><button type="submit">나만의 꽃집 삭제</button></p></div>
                      </td>
                    </tr>
                  </form>
                @endforeach
              </div>
            @endif
          </table>

        </tbody>
      </div>
    </div>
  @else
    <div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
      <div class="" style="top:180px; position:absolute; left:250px; ">
        나만의 꽃집이 비어있습니다.
      </div>
    </div>
  @endif
</div>
</div>
</body>
@include('lib.footer')
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script type="text/javascript">

$(document).ready(function(){
  $("#shopinfo").DataTable({
    "language": {
      "emptyTable": "데이터가 없습니다.",
      "lengthMenu": "페이지당 _MENU_ 개씩 보기",
      "info": "현재 _START_ - _END_ / _TOTAL_건",
      "infoEmpty": "데이터 없음",
      "infoFiltered": "( 전체 _MAX_건의 데이터에서 필터링됨 )",
      "search": "검색",
      "zeroRecords": "일치하는 데이터가 없습니다.",
      "loadingRecords": "로딩중...",
      "processing":     "잠시만 기다려 주세요...",
      "paginate": { "next": "다음", "previous": "이전"  }
    }
  });
});


$(document).ready(function(){
  $("#shopinfo2").DataTable({
    "language": {
      "emptyTable": "데이터가 없습니다.",
      "lengthMenu": "페이지당 _MENU_ 개씩 보기",
      "info": "현재 _START_ - _END_ / _TOTAL_건",
      "infoEmpty": "데이터 없음",
      "infoFiltered": "( 전체 _MAX_건의 데이터에서 필터링됨 )",
      "search": "검색",
      "zeroRecords": "일치하는 데이터가 없습니다.",
      "loadingRecords": "로딩중...",
      "processing":     "잠시만 기다려 주세요...",
      "paginate": { "next": "다음", "previous": "이전"  }
    }
  });
});
</script>
</html>
