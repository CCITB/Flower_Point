<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>꽃갈피</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/locate.css">
</head>

<body>
    @include('lib.header')
    <div class="menu4">
        <h3 align="center">마이페이지</h3>
        <hr align="left" class="one">
        </hr>
    </div>
    <div class="myinfo">
        <h4>내 정보</h4>
        <div class="privacy">
          <form action="{{url('/information_controller')}}" method="post">
            @csrf
            @if($seller= auth()->guard('seller')->user())
          <table class="table1">
              <table border="0" cellpadding="10" cellspacing="10" width="100%">
                  <tr>
                      <th>ID</th>
                      <td>{{$seller->s_id}}</td>
                  </tr>

                  <tr>
                      <th>이름</th>
                      <td><input type="text" name="s_name"placeholder="이름"></td>
                  </tr>
                  <tr>
                      <th>연락처</th>
                      <td><input type="text" name="s_phonenum" placeholder="연락처"></td>
                  </tr>
                  </form>
                  <form action="/modiemail" method="post">
                  <tr>
                      <th>이메일</th>
                      <td><input type="email" name="s_email" placeholder="이메일"></td>
                  </tr>
                </form>
                  <tr>
                      <th>주소</th>
                      <td><input type="text" placeholder="주소"></td>
                  </tr>
              </table>
          </table>
        @elseif($customer= auth()->guard('customer')->user())
        <table class="table1">
            <table border="0" cellpadding="10" cellspacing="10" width="100%">
                <tr>
                    <th>ID</th>
                    <td>{{$customer->c_id}}</td>
                </tr>

                <tr>
                    <th>이름</th>
                    <td><input type="text" name="s_name"placeholder="이름"></td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td><input type="text" name="s_phonenum" placeholder="연락처"></td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td><input type="email" name="s_email" placeholder="이메일"></td>
                </tr>

            </table>
        </table>
      @endif
            <button class="btn btn-primary" type="submit">수정
            </button>

    </div>
  </div>
    @include('lib.footer')
</body>

</html>
