<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/shop.css">
    <link rel="stylesheet" href="/css/postlist.css">
  </head>
  <body>
    @include('lib.header')
    <div class="allwrap">
      <div class="wrap0">
      <div class="wrap1">
      <h3 class="shopname">CCIT flower</h3>
      <button class="btn1" type="button" name="button" onclick="location.href=''">문의하기</button>
      <button class="btn1" type="button" name="button" onclick="location.href=''">물품관리</button>
    </div>
    <hr>
    <div class="wrap2">
      <div class="imgbox">
    <img class="shopimg" src="/imglib/rose.jpg" alt="꽃집사진" width="100px" height="100px">
  </div>
@if( auth()->guard('seller')->user())
  @foreach ($data as $data1)
    <table class="shopinfo">
      <tr>
        <th>대표</th>
        <td>{{$data1->s_name}}</td>
      </tr>
      <tr>
        <th>상호명</th>
        <td>{{$data1->st_name}}</td>
      </tr>
      <tr>
        <th>주소</th>
        <td>{{$data1->st_address}}</td>
      </tr>
    </table>
    <div class="shopintro">
      <span>{{$data1->st_introduce}}</span>
    </div>
@endforeach
    @endif
  </div>
  <button class="btn2" type="button" name="button" onclick="location.href=''">수정하기</button>
      <div class="wrap4">
      <h3 class="productname">판매물품</h3>
      <button class="btn1" type="button" name="button" onClick="location.href='all'">더보기</button>
    </div>
<div class="wrap5">
  @if( auth()->guard('seller')->user())
  <div class="wrap6">
    <div class="wrap6-1">
      <img src="\imglib\" alt="" width="100px" height="100px">
    </div>
    @foreach ($proro as $data3)
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
          <style>
          td.upload-date{
            text-align: center;
          }
          td.upload-price{
            text-align: right;
            padding-right: 10px;
            padding-left: 10px;
          }
          td.upload-name{
            text-align: left;
            padding-left: 15px;

          }
          </style>
          <table id="myTable">
              <tr>
                <th class="registration-date">날짜</th>
                <th class="product-name">이름</th>
                <th class="product-price">가격</th>
                <th class="product-amount">주문량</th>
              </tr>
            </tr>
            </tr>
            {{-- <tr>
              <td class="upload-date">2020.05.14</td>
              <td class="upload-name">sefasd</td>
              <td class="upload-price">20000원</td>
              <td></td>
            </tr> --}}
            <tr>
              <td class="upload-date">{{$data3->p_date}}</td>
              <td class="upload-name"{{$data3->p_name}}</td>
              <td class="upload-price">{{$data3->p_price}}</td>
            </tr>

          </table>
          <div class="nav-page">
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
          </div>
        </div>
      </div>
    @endforeach
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
</html>
