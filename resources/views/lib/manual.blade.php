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
      <img class="register_manual"  src="/imglib/h.PNG" width="100%" height="100%">
    </div>
    <div class="invoice_manual_h">
      <img class="invoice_manual"  src="/imglib/a.PNG" width="100%" height="100%">
      <img class="invoice_manual"  src="/imglib/b.PNG" width="100%" height="100%">
      <img class="invoice_manual"  src="/imglib/c.PNG" width="100%" height="100%">
    </div>
    <div class="product_manual_h">
      <img class="product_manual"  src="/imglib/d.PNG" width="100%" height="100%">
      <img class="product_manual" src="/imglib/e.PNG" width="100%" height="100%">
      <img class="product_manual"  src="/imglib/f.PNG" width="100%" height="100%">
      <img class="product_manual"  src="/imglib/g.PNG" width="100%" height="100%">
    </div>
  </div>
  @include('lib.footer')
</body>
</html>
