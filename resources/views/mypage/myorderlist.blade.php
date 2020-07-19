<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>내 주문관리</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/c_mypage.css">
  </head>
  <body>
    @include('lib.header')
    <div class="myorder">
      <span class="mytitle" align="left">나의 주문 현황</span> <span>구매확정을 누르시면 구매금액의 3%가 적립됩니다.</span>
      <div class="ordertable">
        @if(count($data2))
          <table class="order" border="0" width="100%">
            <thead>
              <tr class="p_tr">
                <th>상품이미지</th>
                <th>주문날짜</th>
                <th>주문번호</th>
                <th>결제번호</th>
                <th>상품명</th>
                <th>수량</th>
                <th>구매금액</th>
                <th>주문처리상태</th>
                <th>후기 작성</th>
                <th>구매 확정</th>
                <th>배송조회</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data2 as $data2)
                <tr>
                  <td><a href="product/{{$data2->p_no}}"><img src="imglib/{{$data2->p_filename}}" width="100px" height="100px"></a></td>
                  <td>{{$data2->pm_date}}</td>
                  <td><a href="product/{{$data2->p_no}}">{{$data2->o_no}}</a></td>
                  <td><a href="product/{{$data2->p_no}}">{{$data2->pm_no}}</a></td>
                  <td><a href="product/{{$data2->p_no}}">{{$data2->p_name}}</a></td>
                  <td>{{$data2->pm_count}}</td>
                  <td>{{$data2->pm_pay}}</td>
                  <td>{{$data2->pm_d_status}}</td>
                  @if($data2->pm_status == '결제 완료'||$data2->pm_status == '구매 확정')
                    @if(!isset($data2->payment_no))
                      <td><input type="button" value="구매후기" onclick="show_popup({{$data2->pm_no}})"></td>
                    @else
                      <td>작성완료</td>
                    @endif
                  @else
                    <td></td>
                  @endif
                  @if($data2->pm_status == '결제 대기')
                    <td>
                      {{-- <form action="/pd_cancel{{$data2->pm_no}}" method="post">
                        @csrf --}}
                        <input type="submit" class="cancel" value="결제 취소">
                      {{-- </form> --}}
                    </td>

                  @elseif($data2->pm_d_status == '배송중')
                    <td>
                      <form action="/pd_point{{$data2->p_price}}" method="post">
                        <input type="hidden" name="hidden" value="{{$data2->pm_no}}">
                        @csrf
                        <input type="submit" id="confirm" value="구매확정">
                      </form>
                    </td>
                  @elseif($data2->pm_status == '구매 확정')
                    <td>구매확정 완료</td>
                  @elseif($data2->pm_status == '결제 취소')
                    <td>결제 취소</td>
                  @else
                    <td></td>
                  @endif
                  @if(isset($data2->pm_company))
                  <td id="delivery_search"><button id="delivery_search_btn" onclick="window.open('https://tracker.delivery/#/{{$data2->delivery_code}}/{{$data2->pm_invoice_num}}'),'배송조회',width='300px',height='300px'">배송조회</button></td>
                  @else
                  <td id="delivery_search"></td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>

        @else
          <div class="flowercart-infor" id="remove" style="height:400px; position:relative;">
            <div class="" style="top:180px; position:absolute; left:300px; ">
              주문목록이 없습니다.
            </div>
          </div>
        @endif
      </div>
    </div>
  @include('lib.footer')
  </body>
</html>