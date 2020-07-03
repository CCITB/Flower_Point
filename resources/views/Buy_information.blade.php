<!DOCTYPE html>  <!--박소현 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>상품</title>
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" type="text/css" href="/css/buy_information.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  @include('lib.header')

  <div id="total">
    <div class = "pd_image">
      <!--이미지 틀 -->
      @foreach ($productinfor as $protb)
        <img src="/imglib/{{$protb->p_filename}}" class="pd_image1" alt="?">
      </div>

      <!-- 상품정보와 옵션선택 -->
      <div class= "pd_option">

        @if(auth()->guard('customer')->user())
          <form class="favorite" action="/favorite/{{$protb->p_no}}" method="get">
            <div class="pd_basic">
              <div class="pd_name">{{$protb->p_name}}</div>
              <div class="star">
                <button class="convenience" onclick="alert('내 상품에 추가되었습니다!')" type="submit">내 상품</button>
              </div>
            </div>
          </form>
        @elseif(auth()->guard('seller')->user())
          <div class="pd_basic">
            <div class="pd_name">{{$protb->p_name}}</div>
          </div>
        @else
          <div class="pd_basic">
            <div class="pd_name">{{$protb->p_name}}</div>
            <div class="star">
              <button class="convenience" onclick="alert('로그인 후에 이용해주세요!')" type="submit">내 상품</button>
            </div>
          </div>
        @endif
        <hr class="option_line">

        <div class="shop_basic"> <!-- 해당 매장 테이블에서 불러와 링크걸기 -->
          @foreach ($store as $key)
            <div class="shop_name"><a href="/product/store/{{$key->st_name}}">{{$key->st_name}}</a></div>
          @endforeach
          <div class="pd_price">
            <strong><span>{{number_format($protb->p_price)}}</span>  <span>원</span> </strong>
          </div>
        </div>


        <div class="pd_deliver">
          <div class="pd_deliver1">
            <span class="del_text">배송비</span><br>
            <span>{{number_format($protb->p_title)}}</span>
            <span>원</span>
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
            <span>{{number_format($protb->p_price)}}</span>
            <span>원</span>
          </div>
          <div class="order_bt">
            <button class="order" type="button" id="btn1">담기</button>
            <button class="order" type="button" id="btn2">주문</button>
          </div>
        </div>

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
          {!!$protb->p_contents!!}
        </div>
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
            @foreach ($review as $rev)
              <li class="user_review">
                <div class="review_one">
                  <div class="review_cell">
                    <div class="user_profile">
                      <img src="https://cdn.pixabay.com/photo/2020/05/16/02/20/moon-5175691_960_720.jpg" alt="유저프로필" class="pro_image">

                    </div>
                    <div class="review_text">
                      <div class="star_small">
                        <span name="rate1" class="hi" id="st1" value="1">★</span>
                        <span name="rate2" class="hi" id="st2" value="2">★</span>
                        <span name="rate3" class="hi" id="st3" value="3">★</span>
                        <span name="rate4" class="hi" id="st4" value="4">★</span>
                        <span name="rate5" class="hi" id="st5" value="5">★</span>
                      </div>
                      <div class="status_user">
                        <span class="text_info">{{$rev->c_name}}</span>
                        <span class="text_info">{{$rev->r_date}}</span>
                        <span class ="text_info_option">{{$rev->p_name}}</span>
                      </div>
                      <div class="user_write">
                        <span class="writing">{{$rev->r_contents}}</span>
                      </div>
                      <a href="#">더보기</a>
                    </div>
                  </div>

                  <div class="review_image">
                    이미지
                  </div>
                  <div class="review_good">
                    <button type="button" name="good" id="good{{$rev->r_no}}" onclick="pd_good({{$rev->r_no}});">좋아요 <span id="count{{$rev->r_no}}">{{$rev->r_good}}</span></button>
                  </div>
                </div>
              </li>
            @endforeach
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
        <table class="qna-table">
          <tr>
            <th>번호</th>
            <th>문의/답변</th>
            <th>답변상태</th>
            <th>작성자</th>
            <th>작성일</th>
            @if(auth()->guard('seller')->user())
              <th></th>
            @endif
          </tr>
          @foreach ($qnaq as $qna)
            @if(auth()->guard('seller')->user())
              <tr class="qna_q">
              @endif

              {{-- @if($cno = auth()->guard('customer')->user()->c_no)
              @if($qna->q_state == '공개')
              <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
            @else
            <tr onclick="fake1()" class="qna_q">
          @endif
        @endif --}}

        @if(! (auth()->guard('customer')->user()))
          @if($qna->q_state == '공개')
            <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
            @else
              <tr onclick="fake1()" class="qna_q">
              @endif
            @elseif($cno = auth()->guard('customer')->user()->c_no)
              @if($qna->customer_no == $cno)
                <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
                @elseif($qna->q_state == '공개')
                  <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
                  @elseif($qna->q_state == '비공개')
                    <tr onclick="fake1()" class="qna_q">
                    @endif
                  @else
                  @endif



                  <td class="qna-index">{{$qna->q_no}}</td>
                  <td class="qna-content">{{$qna->q_title}} <span class="status">{{$qna->q_state}}</span></td>
                  <td class="qna-condition">답변완료</td>
                  <td class="qna-writer">{{$qna->c_name}}</td>
                  <td class="qna-date">{{$qna->q_date}}</td>
                  @if(auth()->guard('seller')->user())
                    @if(isset($qna->a_no))
                      <td> <a  style="font-size:10px;" onclick="qna_answer({{$qna->q_no}})">수정하기</a><a> x</a> </td>
                    @else
                      <td> <a  style="font-size:10px;" onclick="qna_answer({{$qna->q_no}})">답변하기</a> </td>
                    @endif
                  @endif
                </tr>
                <tr id="answer{{$qna->q_no}}" class="qna_an">
                  {{-- <td class="qna-block"></td> --}}
                  <td colspan="5" style="text-align:left;"><div style="width:90%; margin:0 auto;">{{$qna->q_contents}}<div></td>
                  </tr>
                  @if(isset($qna->a_answer))
                    <tr id="reply{{$qna->q_no}}" class="qna_an">
                      <td colspan="5" style="text-align:left;"><div style="width:85%; margin:0 auto;">└ RE : {{$qna->a_answer}}</div></td>
                    </tr>
                  @else
                  @endif
                @endforeach
              </table>
              {{ $qnaq ->links()}}

              <div class="qna-product-btn">
                @if(auth()->guard('customer')->user())
                  <button type="submit" name="button" class="product-question-btn" onclick="qna_new(1)">상품 문의하기</button>
                @elseif(auth()->guard('seller')->user())

                @else
                  <button type="button" class="product-question-btn" onclick="fake()">상품 문의하기</button>
                @endif
              </div>
              @if(auth()->guard('seller')->user())
                @foreach ($qnaq as $qna)
                  <div id="qna-inquiry{{$qna->q_no}}" class="faq_an">
                    답변하기
                    <form class="" action="/questionans/{{$qna->q_no}}" method='post'>
                      @csrf
                      <textarea placeholder="답변하실 내용을 입력해주세요."name="name" rows="8" cols="80" style="margin-top: 20px;"></textarea>
                      <div class="bottom-btn">
                        <button type="submit" name="button" class="qna-submit-btn">저장</button>
                        <button type="button" name="button" class="qna-submit-cancel-btn" onclick="qna_answer({{$qna->q_no}})">취소</button>
                      </div>
                    </form>
                  </div>
                @endforeach
              @else
                <div id="qna-inquiry1" class="faq_an">
                  문의하기
                  <form class="" action="/pd_qna{{$protb->p_no}}" >
                    <div class="up">
                      <input class="qna_title" name="qna_title" id="qna_title" placeholder="제목">
                      <label><input type="radio" name="state" id="open" value="공개">공개</label>
                      <label><input type="radio" name="state" id="close" value="비공개">비공개</label>
                    </div>
                    <textarea placeholder="문의하실 내용을 입력해주세요."name="name" id="content" rows="8" cols="80"></textarea>
                    <div class="bottom-btn">
                      <button type="submit" name="button" id="sub" class="qna-submit-btn">저장</button>
                      <button type="button" name="button" class="qna-submit-cancel-btn">취소</button>
                    </div>
                  </form>
                </div>
              @endif

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
        @endforeach
        <form class="" id="Pro" action="/order/" method="get" name="Pro">
          <input type="hidden" name="Pro" value="">
        </form>
        @include('lib.footer')
      </body>
      <script>
      // function alert(){
      //   alert('내 상품에 추가되었습니다.');
      // }
      // 상품문의하기 클릭시에 나타나는 input 공간
      function qna_new(num) {
        if($("#qna-inquiry"+num).hasClass("faq_an_show"))
        {

          $("#qna-inquiry"+num).removeClass("faq_an_show");
        }
        else
        {
          $(".faq_an").removeClass("faq_an_show");
          $("#qna-inquiry"+num).addClass("faq_an_show");

        }
      }

      //문의하기 클릭
      function pd_qna(num) {

        if($("#answer"+num).hasClass("qna_an_show"))
        {
          $('#reply'+num).removeClass("qna_an_show");
          $("#answer"+num).removeClass("qna_an_show");
        }
        else
        {
          $(".qna_an").removeClass("qna_an_show");
          $("#answer"+num).addClass("qna_an_show");
          $('#reply'+num).addClass("qna_an_show");
        }
      }

      function fake(){
        alert('로그인이 필요한 서비스입니다.');
      }

      function fake1(){
        alert('비공개 게시물 입니다.');
      }


      function qna_answer(num) {
        // qna_new(1);
        if($("#answer"+num).hasClass("qna_an_show"))
        {
          $('#reply'+num).removeClass("qna_an_show");
          $("#answer"+num).removeClass("qna_an_show");
          if($("#qna-inquiry"+num).hasClass("faq_an_show"))
          {
            $("#qna-inquiry"+num).removeClass("faq_an_show");
          }
          else
          {
            $(".faq_an").removeClass("faq_an_show");
            $("#qna-inquiry"+num).addClass("faq_an_show");
          }
        }
        else
        {
          $(".qna_an").removeClass("qna_an_show");
          $("#answer"+num).addClass("qna_an_show");
          $('#reply'+num).addClass("qna_an_show");
          if($("#qna-inquiry"+num).hasClass("faq_an_show"))
          {
            $("#qna-inquiry"+num).removeClass("faq_an_show");
          }
          else
          {
            $(".faq_an").removeClass("faq_an_show");
            $("#qna-inquiry"+num).addClass("faq_an_show");
          }
        }

      }

      </script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script type="text/javascript">

      function pd_good(r_no){

        var g_bt = $('#good'+r_no);
        console.log(g_bt);

        $.ajax({
          type: 'post',
          url: '/rev_count',
          dataType: 'json',
          data: { 'num' : r_no },

          success: function(data) {
            if (data == 1){
              console.log(data);
                // $('#count'+r_no).text('1');

            }

          },
          error: function(data) {
            console.log("error" +data);
            alert("잘못된 요청입니다.")
          }
        });
      }

      $(document).ready(function(){
        $("#sub").click(function(){
          if($("#qna_title").val().length==0){
            alert("제목을 입력하세요.");
            $("#qna_title").focus();
            return false;
          }
          if($("#content").val().length==0){
            alert("내용을 입력하세요.");
            $("#content").focus();
            return false;
          }
        });
      });



      $( ".up input" ).click(function() {
        var state = $('input:radio[name=state]:checked').val();
        console.log(state);
      });


      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var jjim =  {{$protb->p_no}};

      $('#btn1').click(function() {
        // var id = $("#hidden1").val();
        console.log(1);
        $.ajax({
          type: 'post',
          url: '/basketstore',
          dataType: 'json',
          data: { "id" : jjim },
          // console.log(jjim);
          success: function(data) {
            console.log(data);
            if(data==1){
              alert("판매자는 이용할 수 없습니다.");
              return false;
            }
            if(data==0){
              var logincheck= confirm("로그인이 필요한 서비스입니다. 로그인 하시겠습니까?");
              if(logincheck){
                location.href = "/login_customer"
              }
              else{
                return false;
              }
            }
            else {
              var basketalert = confirm("장바구니에 담겼습니다. 바로 장바구니로 이동할까요?")
              if (basketalert) {
                location.href = "/flowercart"
              }
              else {

              }
            }

            console.log(data);
          },
          error: function(data) {
            console.log("error" +data);
            alert("잘못된 요청입니다.")
          }
        });
      });
      $('#btn2').click(function(){
        var bb = {{$protb->p_no}};
        console.log($('input[name=Pro]').val(bb));
        // location.href = '/order/'+Pro;
        document.Pro.submit();
      });
      </script>
      </html>
