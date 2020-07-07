@if(! (auth()->guard('customer')->user()) || !(auth()->guard('customer')->user()))
  @foreach ($qnaq as $qna)
    <table class="qna-table">
      <tr>
        <th>번호</th>
        <th>문의/답변</th>
        <th>답변상태</th>
        <th>작성자</th>
        <th>작성일</th>
      </tr>
      @if($qna->q_state == '공개')
        <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
        @else
          <tr onclick="fake1()" class="qna_q">
          @endif
          <td class="qna-index">{{$qna->q_no}}</td>
          <td class="qna-content">{{$qna->q_title}} <span class="status">{{$qna->q_state}}</span></td>
          <td class="qna-condition">{{$qna->an_state}}</td>
          <td class="qna-writer">{{$qna->c_name}}</td>
          <td class="qna-date">{{$qna->q_date}}</td>
        </tr>
        <tr id="answer{{$qna->q_no}}" class="qna_an">
          {{-- <td class="qna-block"></td> --}}
          <td colspan="5" style="text-align:left;">
            <div style="width:70%; margin:0 auto;">{{$qna->q_contents}}</div>
            <div class=""><br>
              {{$qna->a_answer}}
            </div>
          </td>
        </tr>
      </table>
    @endforeach
  @endif

  @if(auth()->guard('customer')->user())
    @foreach ($qnaq as $qna)

      <table class="qna-table">
        <tr>
          <th>번호</th>
          <th>문의/답변</th>
          <th>답변상태</th>
          <th>작성자</th>
          <th>작성일</th>
        </tr>
        @if($cno = auth()->guard('customer')->user()->c_no)
          @if($qna->customer_no == $cno)
            <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
            @elseif($qna->q_state == '공개')
              <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
              @elseif($qna->q_state == '비공개')
                <tr onclick="fake1()" class="qna_q">
                @endif
              @endif
              <td class="qna-index">{{$qna->q_no}}</td>
              <td class="qna-content">{{$qna->q_title}} <span class="status">{{$qna->q_state}}</span></td>
              <td class="qna-condition">{{$qna->an_state}}</td>
              <td class="qna-writer">{{$qna->c_name}}</td>
              <td class="qna-date">{{$qna->q_date}}</td>
            </tr>
            <tr id="answer{{$qna->q_no}}" class="qna_an">
              {{-- <td class="qna-block"></td> --}}
              <td colspan="5" style="text-align:left;">
                <div style="width:70%; margin:0 auto;">{{$qna->q_contents}}</div>
                <div class=""><br>
                  {{$qna->a_answer}}
                </div>
              </td>
            </tr>
          </table>
        @endforeach
      @endif


      @if(auth()->guard('seller')->user())
        @foreach ($SellerAllInfor as $sel)
          <table class="qna-table">
            <tr>
              <th>번호</th>
              <th>문의/답변</th>
              <th>답변상태</th>
              <th>작성자</th>
              <th>작성일</th>
              <th>답변하기</th>
            </tr>
            @if($sel->p_no == $protb->p_no )
              <tr onclick="pd_qna({{$qna->q_no}})" class="qna_q">
              @endif
              <td class="qna-index">{{$qna->q_no}}</td>
              <td class="qna-content">{{$qna->q_title}} <span class="status">{{$qna->q_state}}</span></td>
              <td class="qna-condition">{{$qna->an_state}}</td>
              <td class="qna-writer">{{$qna->c_name}}</td>
              <td class="qna-date">{{$qna->q_date}}</td>
              @if($sel->p_no == $protb->p_no )
                @if(isset($qna->a_no))
                  <td> <a  style="font-size:10px;" onclick="qna_answer({{$qna->q_no}})">수정하기</a><a> x</a> </td>
                @else
                  <td> <a  style="font-size:10px;" onclick="openan({{$qna->q_no}})">답변하기</a> </td>
                @endif
              @endif
            </tr>
            <tr id="answer{{$qna->q_no}}" class="qna_an">
              {{-- <td class="qna-block"></td> --}}
              <td colspan="5" style="text-align:left;">
                <div style="width:70%; margin:0 auto;">{{$qna->q_contents}}</div>
                <div class=""><br>
                  {{$qna->a_answer}}
                </div>
              </td>
            </tr>
          </table>
        @endforeach
      @endif
