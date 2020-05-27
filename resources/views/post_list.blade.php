<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/postlist.css">
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
  </head>
  <body>
    @include('header')
    <div class="hr-line">
      <div id="line">
        <h2>물품관리</h2>
        <hr>
      </div>
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
              <th class="product-name">품목명</th>
              <th class="product-price">가격</th>
              <th class="product-amount">주문량</th>
            </tr>
          <tr>
            <td class="upload-date">2020.05.16</td>
            <td class="upload-name">asdf</td>
            <td class="upload-price">0원</td>
            <td></td>
          </tr>
          <tr>
            <td class="upload-date">2020.05.18</td>
            <td class="upload-name">sdf</td>
            <td class="upload-price">10000원</td>
            <td></td>
          </tr>
          <tr>
            <td class="upload-date">2020.05.14</td>
            <td class="upload-name">sefasd</td>
            <td class="upload-price">20000원</td>
            <td></td>
          </tr>
          <tr>
            <td class="upload-date">2022.03.25</td>
            <td class="upload-name">asdf</td>
            <td class="upload-price">30000원</td>
            <td></td>
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
    @include('footer')
  </body>
</html>
