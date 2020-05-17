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
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
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

        <table id="myTable">
            <tr>
              <th class="registration-date">날짜</th>
              <th class="product-name">품목명</th>
              <th class="product-price">가격</th>
              <th class="product-amount">주문량</th>
            </tr>
          <tr>
            <td>2020.05.16</td>
            <td>asdf</td>
            <td>0원</td>
            <td></td>
          </tr>
          <tr>
            <td>2020.05.18</td>
            <td>sdf</td>
            <td>10000원</td>
            <td></td>
          </tr>
          <tr>
            <td>2020.05.14</td>
            <td>sefasd</td>
            <td>20000원</td>
            <td></td>
          </tr>
          <tr>
            <td>2022.03.25</td>
            <td>asdf</td>
            <td>30000원</td>
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
