<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/shop.css">
  </head>
  <body>
    @include('lib.header')
    <div class="allwrap">
      <div class="wrap0">
      <div class="wrap1">
      <h3 class="shopname">CCIT flower</h3>
      <button class="btn1" type="button" name="button" onclick="location.href=''">문의하기</button>
      <button class="btn1" type="button" name="button" onclick="location.href=''">물품관리</button>
    </div>
    <hr>
    <div class="wrap2">
      <div class="imgbox">
    <img class="shopimg" src="/imglib/rose.jpg" alt="꽃집사진" width="100px" height="100px">
  </div>
@if( auth()->guard('seller')->user())
  @foreach ($data as $data1)
    <table class="shopinfo">
      <tr>
        <th>대표</th>
        <td>{{$data1->s_name}}</td>
      </tr>
      <tr>
        <th>상호명</th>
        <td>{{$data1->st_name}}</td>
      </tr>
      <tr>
        <th>주소</th>
        <td>{{$data1->st_address}}</td>
      </tr>
    </table>
    <div class="shopintro">
      <span>{{$data1->st_introduce}}</span>
    </div>
@endforeach
    @endif
  </div>
  <button class="btn2" type="button" name="button" onclick="location.href=''">수정하기</button>
      <div class="wrap4">
      <h3 class="productname">판매물품</h3>
      <button class="btn1" type="button" name="button" onClick="location.href='all'">더보기</button>
    </div>
<div class="wrap5">
  @if( auth()->guard('seller')->user())
  <div class="wrap6">
    <div class="wrap6-1">
      <img src="\imglib\" alt="" width="100px" height="100px">
    </div>
    @foreach ($data as $data1)
    <div class="wrap6-2">
      <div class="wrap7-1">
        <div class="wrap8-1">
          제목
          {{-- {{$data->p_name}} --}}
        </div>
        <div class="wrap8-2">
          이름
          {{-- {{$data->p_title}} --}}
        </div>
      </div>
      <div class="wrap7-2">
        내용
        {{-- {{$data->p_contents}} --}}
      </div>
    </div>
    @endforeach
  @endif
  </div>

  </div>
</div>
  </div>
@include('lib.footer')
  </body>
</html>
