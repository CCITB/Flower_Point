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
      @if( auth()->guard('seller')->user())
        @foreach ($data as $data1)
          <h3 class="shopname">{{$data1->st_name}}</h3>
          <hr>
          <div class="wrap2">
            <div class="imgbox">
              <img class="shopimg" src="/imglib/rose.jpg" alt="꽃집사진" >
            </div>
            <table class="shopinfo">
              <tr>
                <th>대표</th>
                <td><div class="thcell">{{$data1->s_name}}</div></td>
              </tr>

              <tr>
                <th>상호명</th>
                <td><div class="thcell">{{$data1->st_name}}</div></td>
              </tr>
              <form class="addressgroup" action="/shopinfo" method="get">

                <tr>
                  <th>주소</th>
                  <td><div id="ad">{{$data1->st_address}}<input type="button" id=modiaddress value="주소수정" name="introduce" display="block" onclick="div_show(this.value,'addressmodi' );"></div>

                    <div id="addressmodi" style="display:none;">
                      <div class="delivery_wrap">
                        <strong class="info">주 소</strong>
                        <!-- 우편번호 -->
                        <input type="text" id="postcode" placeholder="우편번호">
                        <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                      </div>
                      <!--주소 -->
                      <div class="delivery_wrap2">
                        <input type="text"  id="address" placeholder="주소">
                        <div class="delivery_address_detail">
                          <input type="text" class="delivery_address_list" id="detailAddress" placeholder="상세주소">
                          <div class="detail">
                            <input type="text" class="delivery_address_list" id="extraAddress" placeholder="참고항목">
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" id="complete1" name="button" style="display:none;">수정완료</button>
                  </td>
                </form>
              </div>

            </tr>
          </table>
          <form class="shop" action="/shopinfo" method="get">
            <div class="shopintro">
              <div id="introducemodi">{{$data1->st_introduce}}</div>
              <input type="button" id="modiinfo" value="소개수정" name="introduce" display="block" onclick="div_show(this.value,'addressapi' );">
              <div id="addressapi" style="display:none;">
                <input type="text" id="content" name="newintroduce" placeholder="가게소개를 적으세요.">
                <button type="submit" id="complete2" name="button">수정완료</button>
              </div>
            </div>
          </form>
        @endforeach
      @endif
      <script type="text/javascript">
      function div_show(s,ss){
        if(s == "주소수정"){
          document.getElementById(ss).style.display="block";
          ad.style.display="none";
          complete1.style.display="block";
        }
        else if(s== "소개수정"){
          document.getElementById(ss).style.display="block";
          modiinfo.style.display="none";
          introducemodi.style.display="none";
        }
      }
      </script>
    </div>

    <div class="wrap4">
      <h3 class="productname">판매물품</h3>
    </div>
    <div class="wrap5">
      @if( auth()->guard('seller')->user())
        <div class="wrap6">
          <div class="wrap6-1">
            <img src="\imglib\" alt="" width="100px" height="100px">
          </div>

          <div class="productlist">
            <div class="productlist-item">
              <div class="">
                <form class="date-sort">
                  <select id="id-sort"name="language" onchange="sortTable(value)">
                    <option value="0" selected>내림차순</option>
                    <option value="0">오름차순</option>
                  </select>
                </form>
                <div class="write-post">
                  <a href="/sellershoppost">물품등록</a>
                </div>

                <input type="text" name="" value="">
                <button type="submit" name="button" >검색</button>
              </div>
              <table id="myTable">
                <thead>
                  <tr>
                    <th class="registration-date">날짜</th>
                    <th class="product-name">이름</th>
                    <th class="product-price">가격</th>
                    <th class="product-amount">주문량</th>
                  </tr>
                </thead>
                <tbody>

                  {{-- <tr>
                  <td class="upload-date">2020.05.14</td>
                  <td class="upload-name">sefasd</td>
                  <td class="upload-price">20000원</td>
                  <td></td>
                </tr> --}}
                @foreach ($proro as $data3)
                  <tr>
                    <td class="upload-date">{{$data3->p_date}}</td>
                    <td class="upload-name">{{$data3->p_name}}</td>
                    <td class="upload-price">{{$data3->p_price}}</td>
                    <td></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div>
              {{ $proro->links()}}
            </div>

          {{-- <div class="nav-page">
            <nav>
              <a href="#" class="active">1</a>
            </nav>
            <nav>
              2
            </nav>
            <nav>
              3
            </nav>
            <nav>
              4
            </nav>
            <nav>
              5
            </nav>
          </div> --}}
        </div>
      </div>

    @endif
  </div>

</div>
</div>
</div>
@include('lib.footer')
</body>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }

}
</script>
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/radio.js" charset="utf-8"></script>

</html>
