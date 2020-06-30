<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>
</head>
<body>

  <table id="hihi" class="display">
    <thead>
      <tr>
        <th>Column 1</th>
        <th>Column 2</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Row 1 Data 1</td>
        <td>Row 1 Data 2</td>
      </tr>
      <tr>
        <td>Row 2 Data 1</td>
        <td>Row 2 Data 2</td>
      </tr>
    </tbody>
  </table>


  <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>

  <script>
  $(document).ready(function(){
    $("#hihi").DataTable();
  });
</script>
</body>
</html>
