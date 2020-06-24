<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//eojisu
Route::get('/', 'MainController@main');

Route::get('/login_customer', 'MainController@login_customer');

Route::get('/login_seller', 'MainController@login_seller');

Route::get('/register_customer','MainController@register_costomer');

Route::get('/register_seller','MainController@register_seller');

//중복 검사, 정규식 조건 ***** 어지수
Route::post('/seller_Overlap', 'RegisterController@s_overlap');

Route::post('/customer_Overlap', 'RegisterController@c_overlap');

Route::post('/register_InsertStore', 'RegisterController@store_information');

Route::get('/register', 'RegisterController@registerview');

Route::get('/terms_customers', 'MainController@register_terms_customers');

Route::get('/terms_sellers', 'MainController@register_terms_sellers');

//register_seller
Route::post('/sto_info', 'MainController@register_information');


//Database Table에 Insert ****** 어지수
Route::post('/RegisterControllerSeller', 'RegisterController@seller_store');

Route::post('/RegisterControllerCustomer', 'RegisterController@customer_store');

//MAIL_HOST ****** 어지수
//Route::get('/mailsend', 'MailController@send');
Route::get('/mailview', function(){
  return view('emails/mail');
});
Route::post('/mail', 'MailController@sends');

//seller ID 찾기
Route::get('/seller_find_id', function(){
  return view('find_information_seller/find_id');
});
//seller ID From값 전송
Route::post('/seller_find_id', 'FindController@seller_find_id');

Route::post('/check_query', 'FindController@check_query');

//seller PW 찾기
Route::get('/seller_find_pw', function(){
  return view('find_information_seller/find_pw');
});
Route::post('seller_find_pw', 'FindController@seller_find_pw');


Route::get('/find_pw_way', function(){
  return view('find_information_seller/find_pw_way');
});

Route::get('/find_pw_way/{id}', 'FindController@f_way');

Route::post('/f_way', 'FindController@f_way');

Route::get('/find_pw_reset', 'FindController@find_pw_reset');

Route::get('/find_chk', 'FindController@find_check');

Route::post('/login_s', 'LoginController@login_s');

Route::post('/login_c', 'LoginController@login_c');

Route::get('/logout', 'LoginController@logout');

Route::post('/information_controller', 'InformationController@information');

Route::get('/locate1', function () {
  return view('locate');
});


Route::get('/faq', function () {
  return view('FAQ');
});Route::post('/modiemail', 'InformationController@modifyemail');


Route::get('/locate1', function () {
  return view('locate');
});

Route::get('/customer_shop', function () {
  return view('myshop/shop_customer');
});
// Route::get('/myqna', function () {
//   return view('myQnA');
// });
Route::get('/myqna','pagination@pages');

// Route::get('/postlist', function () {
//   return view('post_list');
// });
Route::group(['middleware' => 'preventBackHistory'],function(){
  Route::get('/sellershoppost', 'ProductController@seller_shoppost');
});


Route::get('/product/{id}', 'ProductController@productpage');

Route::get('/pd_qna{id}','ProductController@pd_qna');

Route::get('product/store/{id}', 'InformationController@storepage');

Route::post('index', 'ProductController@seller_product_register');

Route::get('/review', function () {
  return view('review');
});

Route::post('rev', 'ProductController@my_review');

Route::get('/rev2', function () {
  return view('rev_image');
});
//결제
Route::get('/order', function () {
  return view('payment.order');
});
Route::get('/complete', function(){
  return view('payment.complete');
});

Route::get('/sellermyorderlist', function(){
  return view('seller.seller_myorderlist');
});
Route::get('/shopinfo','InformationController@storeinfo');

//       return view('myshop/shop_seller');

Route::get('/customer', function(){
  return view('mypage/customer');
});

Route::get('/shoppage', 'InformationController@shoppage');

Route::get('/all', 'MainController@showall');

Route::get('/newaddress', 'InformationController@newaddress');

Route::get('/detail', 'InformationController@detailaddress');

Route::get('/mypage', function(){
    if($sellerinfo = auth()->guard('seller')->user()){
      // return 0;
      $sellerprimary = $sellerinfo->s_no;
          $sellerstore = DB::table('seller')
          ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
          ->where('s_no','=', $sellerprimary )->get();

          return view('mypage/mypage', compact('sellerstore'));

          }

          else if(auth()->guard('customer')->user()){


          return view('mypage/mypage');
        }
          else{

          }
          return view('login/login_customer');

});



Route::get('/shop', function(){
  if($sellerinfo = auth()->guard('seller')->user()){
    $sellerprimary = $sellerinfo->s_no;
    // return $sellerprimary;
        $data = DB::table('seller')
        ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
        ->where('s_no','=', $sellerprimary )->get();
        $proro = DB::table('product')->select('*')->where('store_no' ,'=', $data[0]->st_no)->paginate(2);
        $introduce = DB::table('store')->select('st_introduce')->where('st_no' ,'=' , $data[0]->st_no )->get();
        $store_address = DB::table('store_address')->select('a_post','a_address','a_extra')->where('st_no' ,'=', $data[0]->st_no)->get();
        $detail_address = DB::table('store_address')->select('a_detail')->where('st_no' ,'=', $data[0]->st_no)->get();

        return view('myshop/shop_seller' , compact('data', 'proro','introduce', 'store_address', 'detail_address'));
  }
  elseif(auth()->guard('customer')->user()){

  }
  return view('myshop/shop_seller');
});

Route::get('/postlist', function(){
  if($sellerinfo = auth()->guard('seller')->user()){
    $sellerprimary = $sellerinfo->s_no;
    // return $sellerprimary;
        $data = DB::table('seller')
        ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
        ->where('s_no','=', $sellerprimary )->get();


        $proro = DB::table('product')->select('*')->where('store_no' ,'=', $data[0]->st_no)->paginate(1);
        // $st_address = '['.$st_post.']'.$st_add.','.$st_detail.$st_extra->get();

         // $data 조인을 해서 갖고온 셀러테이블과 스토어테이블이 합쳐진 데이터
        // return $proro;

        return view('post_list' , compact('data', 'proro', ));
  }
  else{

  }
  return view('login/login_seller');
});

//검색
Route::get('/search', 'SearchController@result');
Route::group(['middleware' => 'preventBackHistory'],function(){
Route::get('/flowercart', 'ProductController@basket');
});
Route::post('/delete', 'ProductController@basketdelete');

Route::post('/basketstore', 'ProductController@basketstore');

Route::post('/basketcount', 'ProductController@basketcount');

Route::post('/basketcondition', 'ProductController@basketcondition');


// });
//mail
// Route::get('/', function() {
//   $user = array(
//     'email'=>'o1032002241@gmail.net',
//     'name'=>'Kim, Se-Hee'
//   );
//
//   $data = array(
//     'detail'=>'Your awesome detail here',
//     'name' => $user['name']
//   );
//
//   Mail::send('emails.welcome', $data, function($message) use ($user)
//   {
//     $message->from('seheekim@netpas.net', 'Kim, Se-Hee');
//     $message->to($user['email'], $user['name'])->subject('Welcome!');
//   });
//   return 'Done!';
// });
