<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>상품</title>
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" type="text/css" href="/css/buy_information.css">
</head>
<body>
  @include('header')

  <div id="total">
    <div class = "pd_image"> <!--이미지 틀 -->
      이미지
    </div>

    <!-- 상품정보와 옵션선택 -->
    <div class= "pd_option">

      <form action = 'url' method='post'>

        <div class="pd_basic">
          <div class="pd_name">리시안셔스</div>
          <div class="star">
            <button class="convenience" type="button">관심매장등록</button>
            <button class="convenience" type="button" onclick="location.href = '/myqna'">문의하기</button>
          </div>
        </div>
        <hr class="option_line">

        <div class="shop_basic"> <!-- 해당 매장 테이블에서 불러와 링크걸기 -->
          <div class="shop_name"><a href="/해당매장">ccit 1</a></div>
          <div class="shop_lo">
            서울시 종로구
          </div>
          <div class="pd_price"> <!-- 상품 가격 불러오기 -->
            <strong>10,000원</strong>
          </div>
        </div>

        <div class="pd_deliver">
          <div class="pd_deliver1">
            <span class="del_text">배송비</span><br>
            2500원
          </div>
          <div class="pd_deliver2">
            <span class="del_text">배송기간</span><br>
            2일 이내
          </div>
          <div class="pd_deliver3">
            <span class="del_text">적립금</span><br>
            최대 2%
          </div>
        </div>


        <div class="options">
          <select class="select_option" name="select_option">
            <option value="option 1">옵션 없음</option>
            <option value="option 1">옵션 1</option>
            <option value="option 2">옵션 2</option>
          </select>

          <select class="select_option" name="select_pack">
            <option value="pack 1">포장 없음</option>
            <option value="pack 1">포장 1</option>
            <option value="pack 2">포장 2</option>
          </select>
        </div>


        <div class="pd_pay">
          <div class="total_price_text">
            총 금액
          </div>
          <div class="total_price">
            ~원
          </div>
          <div class="order_bt">
            <button class="order" type="button" onclick="location.href = '/결제창'">주문</button>
          </div>
        </div>

      </form>
    </div>




    <div class="detail_tabs">
      <ul class="tab_table" role="tablist">
        <li class="detail_tab" role="presentation">
          <a class="detail_tab_link" role="tab" aria-selected="false" href="#dtil">상세정보</a>
        </li>
        <li class="purchase_review_tab" role="presentation">
          <a class="purchase_review_tab_link" role="tab" aria-selected="true" href="#revw">리뷰</a>
        </li>
        <li class="qna_tab" role="presentation">
          <a class="qna_tab_link" role="tab" aria-selected="false" href="#que">문의하기</a>
        </li>
        <li class="claim_info_tab" role="presentation">
          <a class="claim_info_tab_link" role="tab" aria-selected="false" href="#clm">반품/교환정보</a>
        </li>
      </ul>
    </div>



    <div class = "pd_detail"> <!-- 상품설명 디테일 -->
      <div class="pd_detail_title">
        <h3 class="blind" id="dtil">상품리뷰</h3>
      </div>
      <pre>

        상품 본문 글 입니다.















































        쓰는 만큼 늘어납니다.
      </pre>
    </div>

    <div class="reviews">
      <div class="review_title">
        <h3 class="title_detail">
          <em class="anchor" id="revw"></em>
          상품 리뷰
        </h3>
        <p class ="revw_introduction">
          상품을 구매하신 분들이 작성한 리뷰입니다.
        </p>
      </div>
      <div class="review_list">
        <ul>
          <li class="user_review">
            <div class="review_one">
              <div class="review_cell">
                <div class="user_profile">
                  <img src="https://cdn.pixabay.com/photo/2020/05/16/02/20/moon-5175691_960_720.jpg" alt="유저프로필" class="pro_image">

                </div>
                <div class="review_text">
                  <div class="star_small">
                    <span class="stars">★★★★★</span>
                  </div>
                  <div class="status_user">
                    <span class="text_info">ID</span>
                    <span class="text_info">20.05.23</span>
                    <span class ="text_info_option">제품 : 리시안셔스   옵션 : 미니한다발</span>
                  </div>
                  <div class="user_write">
                    <span class="writing">꽃이 너무 마음에 들어요</span>
                  </div>
                  <a href="#">더보기</a>
                </div>
              </div>

              <div class="review_image">
                이미지
              </div>
              <div class="review_good">
                좋아요
              </div>
            </div>
          </li>

          <li class="user_review">
            <div class="review_one">
              <div class="review_cell">
                <div class="user_profile">
                  <img src="https://cdn.pixabay.com/photo/2020/05/16/02/20/moon-5175691_960_720.jpg" alt="유저프로필" class="pro_image">

                </div>
                <div class="review_text">
                  <div class="star_small">
                    <span class="stars">★★★★★</span>
                  </div>
                  <div class="status_user">
                    <span class="text_info">ID</span>
                    <span class="text_info">20.05.23</span>
                    <span class ="text_info_option">제품 : 리시안셔스   옵션 : 미니한다발</span>
                  </div>
                  <div class="user_write">
                    <span class="writing">꽃이 너무 마음에 들어요</span>
                  </div>
                  <a href="#">더보기</a>
                </div>
              </div>

              <div class="review_image">
                이미지
              </div>
              <div class="review_good">
                좋아요
              </div>
            </div>
          </li>

          <li class="user_review">
            <div class="review_one">
              <div class="review_cell">
                <div class="user_profile">
                  <img src="https://cdn.pixabay.com/photo/2020/05/16/02/20/moon-5175691_960_720.jpg" alt="유저프로필" class="pro_image">

                </div>
                <div class="review_text">
                  <div class="star_small">
                    <span class="stars">★★★★★</span>
                  </div>
                  <div class="status_user">
                    <span class="text_info">ID</span>
                    <span class="text_info">20.05.23</span>
                    <span class ="text_info_option">제품 : 리시안셔스   옵션 : 미니한다발</span>
                  </div>
                  <div class="user_write">
                    <span class="writing">꽃이 너무 마음에 들어요</span>
                  </div>
                  <a href="#">더보기</a>
                </div>
              </div>

              <div class="review_image">
                이미지
              </div>
              <div class="review_good">
                좋아요
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <div class="pd_qna">
      <div class="qna_title">
        <h3 class="qna_title_detail">
          <em class="anchor" id="que"></em>
          문의하기
        </h3>
      </div>
      내용
    </div>



    <div class="pd_component">
      <div class="comp_title">
        <h3 class="comp_title_detail">
          <em class="anchor" id="clm"></em>
          반품/교환정보
        </h3>
      </div>
      내용
    </div>





  </div>
  @include('footer')
</body>
</html>
