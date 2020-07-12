<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/coupon.css">

<body>
  <style media="screen">
    footer{
  position:absolute;
  left:0px;
  bottom:0px;
  width:100%;
  margin-top: 50px;
    }
  </style>
  @include('lib.header')
  <div class="couponwrap">
      <h4>이달의 쿠폰</h4>
      <div class="coupon_back">
        <table class="table table-striped">
          <tr>
            <th>쿠폰명</th>
            <th>쿠폰내용</th>
            <th>유효기간</th>
            <th></th>
          </tr>
          <tr>
            <th>asd</th>
            <th>123</th>
            <th>1231</th>
            <th><button type="submit" name="button">쿠폰받기</button> </th>
          </tr>
        </table>
      </div>
    </div>
</div>
@include('lib.footer')
</body>
</html>
