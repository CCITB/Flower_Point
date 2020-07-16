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
            <div class="shop_name"><a href="/store/{{$key->st_name}}">{{$key->st_name}}</a></div>
          @endforeach
          <div class="pd_price">
            <strong><span>{{number_format($protb->p_price)}}</span>  <span>원</span> </strong>
          </div>
        </div>


        <div class="pd_deliver">
          <div class="pd_deliver1">
            <span class="del_text">배송비</span><br>
            <span>{{number_format($protb->p_delivery)}}</span>
            <span>원</span>
          </div>
          <div class="pd_deliver2">
            <span class="del_text">배송기간</span><br>
            2일 이내
          </div>
          <div class="pd_deliver3">
            <span class="del_text">적립금</span><br>
            최대 5%
          </div>
        </div>


        <div class="options">
          <div class="left">
            <div class="countinfo">수량</div>
            <div class="realcount">
              <button type="button" class="counts" id="minus" name="button1" value="-">
                <img class="countimg1" src="/imglib/remove.png" alt="">
              </button>
              <input class="count-plmi" type="text" name="amount{{$protb->p_no}}" onchange="change();" readonly id="pdcount" value="1">
              <button type="button" class="counts" id="plus" name="button2" value="+">
                <img class="countimg2" src="/imglib/add.png" alt="">
              </button>
            </div>
          </div>
          <div class="order_bt">
            <button class="order" type="button" id="btn1">담기</button>
            <button class="order" type="button" id="btn2">주문</button>
          </div>
        </div>


        <div class="pd_pay">
          <div class="total_price_text">
            총 금액
          </div>
          <div class="total_price">
            <input type="hidden" id="sums" value="{{$protb->p_price}}">
            <span id="p_show">{{number_format($protb->p_price)}}</span>
            <span>원</span>
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

          <div class="review_one">
            <table>
              @foreach ($review as $rev)
                <tr class="review_cell" onclick="pd_qna({{$rev->r_no}})">
                  <td>
                    <div class="star_small" id="star_small">
                      @if($rev->r_score == 1)
                        <span class="yel">★</span><span class="gray">★★★★</span>
                      @elseif($rev->r_score == 2)
                        <span class="yel">★★</span><span class="gray">★★★</span>
                      @elseif($rev->r_score == 3)
                        <span class="yel">★★★</span><span class="gray">★★</span>
                      @elseif($rev->r_score == 4)
                        <span class="yel">★★★★</span><span class="gray">★</span>
                      @elseif($rev->r_score == 5)
                        <span class="yel">★★★★★</span>
                      @endif
                    </div>
                  </td>
                  <td class="user_write">
                    {{$rev->r_contents}}
                  </td>
                  <td class="myname">{{$rev->c_name}}</td>
                  <td class="mydate">{{$rev->r_date}}</td>
                </tr>

                <tr class="re_detail" id="answer{{$rev->r_no}}">
                  <td colspan="4" class="re_text">
                    <div class="re_de">
                      <div class="re_con">
                        {{$rev->r_contents}}
                      </div>
                      <div class="review_image">
                        @if(isset($rev->r_image))
                          <img class="r_img" src="/imglib/{{$rev->r_image}}">
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>

              @endforeach
            </table>
          </div>

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
            <th>답변상태</th>
            <th>제목</th>
            <th>문의자</th>
            <th>작성일</th>

            @foreach ($SellerAllInfor as $qna)
              @if($sno = auth()->guard('seller')->user())
                @if($sno->s_no == $qna->s_no)
                  <th></th>
                @endif
              @endif
            @endforeach
          </tr>


          @foreach ($SellerAllInfor as $qna)
            @if($cno = auth()->guard('customer')->user())
              @if($cno->c_no == $qna->c_no)
                <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
                @else
                  @if($qna->q_state == '공개')
                    <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
                    @elseif($qna->q_state == '비공개')
                      <tr onclick="fake1()" class="qna_q">
                      @endif
                    @endif

                  @elseif($sno = auth()->guard('seller')->user())
                    @if($sno->s_no == $qna->s_no)
                      <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
                      @else
                        @if($qna->q_state == '공개')
                          <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
                          @elseif($qna->q_state == '비공개')
                            <tr onclick="fake1()" class="qna_q">
                            @endif
                          @endif

                        @else
                          @if($qna->q_state == '공개')
                            <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
                            @elseif($qna->q_state == '비공개')
                              <tr onclick="fake1()" class="qna_q">
                              @endif
                            @endif



                            <td class="qna-index">{{$qna->q_no}}</td>
                            <td class="qna-condition">{{$qna->an_state}}</td>
                            <td class="qna-content">{{$qna->q_title}} <span class="status">{{$qna->q_state}}</span></td>
                            <td class="qna-writer">{{$qna->c_name}}</td>
                            <td class="qna-date">{{$qna->q_date}}</td>
                            @if($sno = auth()->guard('seller')->user())
                              @if($sno->s_no == $qna->s_no)
                                @if(isset($qna->a_no))
                                  <td> 답변완료</td>
                                @else
                                  <td> <a  style="font-size:10px;" onclick="openan({{$qna->q_no}})">답변하기</a> </td>
                                @endif
                              @endif
                            @endif
                          </tr>
                          <tr id="answer{{$qna->q_no}}" class="qna_an">
                            <td colspan="5">
                              <div class="con">
                                <div class="qcon">Q. {{$qna->q_contents}}</div>
                                @if(isset($qna->a_no))
                                  <div class="acon"><br>
                                    A. {{$qna->a_answer}}
                                  </div>
                                @endif
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </table>

                      <div class="qna-product-btn">
                        @if(auth()->guard('customer')->user())
                          <button type="submit" name="button" class="product-question-btn" onclick="openqna({{$protb->p_no}})">상품 문의하기</button>
                        @elseif(auth()->guard('seller')->user())

                        @else
                          <button type="button" class="product-question-btn" onclick="fake()">상품 문의하기</button>
                        @endif
                      </div>
                    </div>

                    <div class="pd_component">
                      <div class="comp_title">
                        <h3 class="comp_title_detail">
                          <em class="anchor" id="clm"></em>
                          반품/교환정보
                        </h3>
                      </div>
                      <h4>교환 및 환불</h4>
                      - 생화상품의 경우 한 번 잘라지면 다시 사용할 수 없는 꽃의 특성상 제작완료시 변심으로 인한 교환 및 취소 불가
                      <br> - 상품 불량 및 파손, 오배송 등은 교환 및 반품 가능
                      <br> - 상품 출고시 취소 및 환불 불가 <br><br><br>
                    </div>
                  </div>
                @endforeach
                <form class="" id="Pro" action="/order/" method="get" name="Pro">
                  <input type="hidden" name="Pro" value="">
                  <input type="hidden" name="count" value="">
                </form>
                @include('lib.footer')
              </body>

              <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
              <script type="text/javascript">



              $(function(){
                var total = 0;
                $('#minus').click(function(e){
                  e.preventDefault();
                  var price = $('#sums').val(); //가격
                  var stat = $('#pdcount').val(); //카운트 value값
                  var num = parseInt(stat,10); // 카운트 값을 10진수 정수로 나타냄
                  num--; //하나 낮추고
                  if(num<=0){ //0보다 작으면 1
                    alert('최소 주문 수량입니다.');
                    num =1;
                  }
                  $('#pdcount').val(num);
                  total = price * num; // 최종 금액 = 원래금액 * 카운트 value값
                  com = Number(total).toLocaleString('en'); //최종금액에 영어권국가의 숫자표기방식을 따름
                  $('#p_show').text(com); // 최종 금액을 화면에 보여줌
                  console.log(total);
                });
                $('#plus').click(function(e){
                  e.preventDefault();
                  var price = $('#sums').val();
                  var stat = $('#pdcount').val();
                  var num = parseInt(stat,10);
                  num++;

                  if(num>99){
                    alert('더이상 주문할 수 없습니다.');
                    num=99;
                  }
                  $('#pdcount').val(num);
                  total = price * num;
                  com = Number(total).toLocaleString('en');
                  $('#p_show').text(com);
                  console.log(total);
                });
              });


              var openWin;
              function openqna(qno)
              {
                // window.name = "부모창 이름";
                window.name = "parentForm";
                // window.open("open할 window", "자식창 이름", "팝업창 옵션");
                openWin = window.open("/Qnawrite"+qno,
                "childqna", "width=700px, height=800px, left=50px, top=50px ");
              }
              function openan(qno)
              {
                // window.name = "부모창 이름";
                window.name = "parentForm";
                // window.open("open할 window", "자식창 이름", "팝업창 옵션");
                openWin = window.open("/Qnaanswer"+qno,
                "childqna", "width=700px, height=800px, left=50px, top=50px ");
              }

              //문의하기 클릭
              function pd_qna(num) {

                if($("#answer"+num).hasClass("re_detail_show")){
                  $("#answer"+num).removeClass("re_detail_show");
                }
                else
                {
                  $(".re_detail").removeClass("re_detail_show");
                  $("#answer"+num).addClass("re_detail_show");
                }
              }
              // 문의하기 비 로그인시
              function fake(){
                alert('로그인이 필요한 서비스입니다.');
              }

              function fake1(){
                alert('비밀글은 작성자만 조회할 수 있습니다.');
              }


              function pd_qna(num) {

                if($("#answer"+num).hasClass("qna_an_show")){
                  $("#answer"+num).removeClass("qna_an_show");
                }
                else
                {
                  $(".qna_an").removeClass("qna_an_show");
                  $("#answer"+num).addClass("qna_an_show");
                }
              }

              // 리뷰 좋아요 버튼
              // function pd_good(r_no){
              //
              //   var g_bt = $('#good'+r_no);
              //
              //   $.ajax({
              //     type: 'post',
              //     url: '/rev_count',
              //     dataType: 'json',
              //     data: { 'num' : r_no },
              //
              //     success: function(data) {
              //       if (data == 1){
              //         $('#count'+r_no).text(r_no);
              //         console.log(data);
              //         // $('#count'+r_no).text('1');
              //       }
              //
              //     },
              //     error: function(data) {
              //       console.log("error" +data);
              //       alert("잘못된 요청입니다.")
              //     }
              //   });
              // }

              $( ".up input" ).click(function() {
                var state = $('input:radio[name=state]:checked').val();
                console.log(state);
              });
              //곽승지
              //장바구니에 상품추가 함수
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
                  data: { "id" : jjim,
                  "count" : $('#pdcount').val()
                },
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
              var check = '{{auth()->guard('seller')->check()}}';
              if(1==check){
                alert('판매자는 이용할 수 없습니다.');
                return false;
              }
              var bb = {{$protb->p_no}};
              $('input[name=count]').val($('#pdcount').val());
              console.log($('input[name=Pro]').val(bb));
              // location.href = '/order/'+Pro;
              document.Pro.submit();
            });


            </script>
            </html>
