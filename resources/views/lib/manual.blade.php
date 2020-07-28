<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/footer.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
  <title></title>
</head>
<body>
  @include('lib.header')
  <div class="manual_total">
    <div class="detail_tabs">
      <ul class="tab_table" role="tablist">
        <li class="register_tab" role="presentation">
          <a class="register_link" role="tab" aria-selected="false" href="#register">회원가입</a>
        </li>
        <li class="invoice_tab" role="presentation">
          <a class="invoice_tab_link" role="tab" aria-selected="true" href="#invoice_num">사업자 인증</a>
        </li>
        <li class="product_tab" role="presentation">
          <a class="product_link" role="tab" aria-selected="false" href="#product">물품 등록</a>
        </li>
      </ul>
    </div>
    <div class="register_manual_h">
      <img class="register_manual" id="register" src="/imglib/register.png" >
    </div>
    <div class="invoice_manual_h">
      <img class="invoice_manual" id="invoice_num" src="/imglib/invoice_num.png" >
      <img class="invoice_manual" id="invoice_num1" src="/imglib/invoice_num1.png" >
      <img class="invoice_manual" id="invoice_num2" src="/imglib/invoice_num2.png" >
    </div>
    <div class="product_manual_h">
      <img class="product_manual" id="product" src="/imglib/product.png" >
      <img class="product_manual" id="product2" src="/imglib/product2.png" >
      <img class="product_manual" id="product3" src="/imglib/product3.png" >
      <img class="product_manual" id="product4" src="/imglib/product4.png" >
    </div>
  </div>
  @include('lib.footer')
</body>
</html>
