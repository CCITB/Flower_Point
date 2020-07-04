<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/postlist.css">
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
</head>
<body>
  @include('lib.header')
  @if( auth()->guard('seller')->user())
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
          <thead>
            <tr>
              <th class="registration-date">상품번호</th>
              <th class="product-name">상품명</th>
              <th class="product-price">가격</th>
              <th class="product-amount">주문량</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($proro as $data)
              <tr>
                <td class="upload-date">{{$data->p_no}}</td>
                <td class="upload-name">{{$data->p_name}}</td>
                <td class="upload-price">{{$data->p_price}}</td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div>
          {{ $proro->links()}}
        </div>

      </div>
    </div>
  @endif

  @include('lib.footer')



  <script>
  // 곽승지 오름차순 내림차순 함수
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

</body>
</html>
