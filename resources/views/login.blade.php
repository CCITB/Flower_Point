<!-- [jisuEO + sohyun ] -->
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>꽃갈피 - 로그인</title>

            <!-- Fonts -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
            <!--design-->
            <link rel="stylesheet" href="/css/login.css">
        </head>
        <div id="all">
              <div class="text">
                  <h1> 로그인 </h1>
                  <hr class = way>
              </div>

              <div class ="login">
                <form action = 'url' method='post'>
                    <p>
                      <input type="text" autofocus placeholder="ID" name="id" style="width:350px; height:30px; font-size:20px;" required ><br><br>
                      <input type="password" autofocus placeholder="Password" name="pw" style="width:350px; height:30px; font-size:20px;" required>
                    </p>
                    <div class="go">
                      <a href="http://laravel.site/find_id">아이디/비밀번호 찾기</a><br><br>
                    </div>
                    <div class="submit">
                          <input type="submit" style="width:100px; height:30px; font-size:15px;" id="login" value="로그인">
                        <p>
                          <br><br><button type="button" style="width:350px; height:30px; font-size:15px;" > <a href="http://laravel.site/user">구매자 회원가입</a> </button><br><br>
                          <button type="button" style="width:350px; height:30px; font-size:15px;" > <a href="http://laravel.site/seller">판매자 회원가입</a> </button>
                        </p>
                    </div>
                </form>
              </div>
        </div>
        <!-- <body>
            <h1>로그인</h1>

            <form class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-10">
              <input type="id" class="form-control" id="inputEmail3" placeholder="ID">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-10">
              <button type="button" class="btn btn-default" onclick="location.href='http://laravel.site/register'">회원가입</button>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">로그인</button>
            </div>
          </div>
        </form> -->
        </body>
    </html>
