  <!-- 곽승지 무단 수정 금지 -->
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>꽃갈피</title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/QNA.css">
  <link rel="stylesheet" href="/css/FAQ.css">
    </head>
    <body>
@include('lib.header')

    <div class="hr-line">
      <div id="line">
        <h2>고객센터</h2>
        <hr>
      </div>
    </div>

  <div class="frequently">
    <div class="frequently-qna">
      <h3 style="margin-bottom: 50px;">자주 묻는 질문</h3>
    </div>
    <table class="frequently-qna">
      <tr onclick="faq_new(1)" class="faq-question">
        <td class="faq-block">Q.</td>
        <td>구매한 상품은 언제쯤 받을 수 있나요?</td>
      </tr>
      <tr id="answer1" class="faq_an">
        <td class="faq-block">A.</td>
        <td>주문한 상품이 발송되어 고객님의 자택까지 상품이 도착하기까지는 보통 2~3일이 소요됩니다.</td>
      </tr>
      <tr onclick="faq_new(2)" class="faq-question">
        <td class="faq-block">Q.</td>
        <td>제품의 재고는 어떻게 확인할 수 있나요?</td>
      </tr>
      <tr id="answer2" class="faq_an">
        <td class="faq-block">A.</td>
        <td>구매하시고 싶은 제품의 재고센터꽃갈피 웹 사이트에서 확인해보세요. 다만, 매장의 실시간 재고상황이 반영되지 않을 수 있어, 정확한 재고량은 매장에서 확인해 주시기 바랍니다.</td>
      </tr>
      <tr onclick="faq_new(3)" class="faq-question">
        <td class="faq-block">Q.</td>
        <td>구매한 제품의 배송상태가 궁금합니다.</td>
      </tr>
      <tr id="answer3" class="faq_an">
        <td class="faq-block">A.</td>
        <td>구매하시고 싶은 제품의 재고를  꽃 갈피웹사이트에서 확인해보세요. 다만, 매장의 실시간 재고상황이 반영되지 않을 수 있어, 정확한 재고량은 매장에서 확인해 주시기 바랍니다</td>
      </tr>
    </table>
    <!-- <div class="nav-page">
      <nav>
        <a href="http://laravel.site/userqna" class="active">1</a>
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
    </div> -->
  </div>
@include('lib.footer')
</body>
</html>
<script>
// FAQ List
function faq_new(num) {
	if($("#answer"+num).hasClass("faq_an_show"))
  {
		$("#answer"+num).removeClass("faq_an_show");
	}
  else
  {
		$(".faq_an").removeClass("faq_an_show");
		$("#answer"+num).addClass("faq_an_show");
	}
}
</script>
