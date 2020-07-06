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

//이메일 인증
Route::post('/mail', 'MailController@sends');
//휴대폰 인증
Route::post('/sms', 'SMSController@SMSsend');

//************* <<< customer ID 찾기 >>> **************
Route::get('/customer_find_id', function(){
  return view('find_information_customer/find_id');
});
//email인증 id 찾기
Route::post('/customer_email_check', 'FindController@customer_email_check');
//sms인증 id 찾기
Route::post('/customer_sms_check', 'FindController@customer_sms_check');
//find_id에서 "email 값으로" id의 존재유무를 확인하는 ajax
Route::post('/customer_email_query', 'FindController@customer_email_query');
//find_id에서 "phone"값으로 id존재유무 확인
Route::post('/customer_sms_query', 'FindController@customer_sms_query');

//------customer PW 찾기------
Route::get('/customer_find_pw', function(){
  return view('find_information_customer/find_pw');
});
//find_pw_way에서 사용 0
Route::post('/customer_find_pw_controller', 'FindController@customer_find_pw');
//pw에서 id존재유무를 확인하는 jquery
Route::post('/customer_id_check', 'FindController@customer_id_check');

Route::get('/find_pw_way_customer', function(){
  return view('find_information_customer/find_pw_way');
});

//비밀번호 찾기 (find_pw_way)
Route::post('/customer_eamil_way', 'FindController@customer_eamil_way');
Route::post('/customer_sms_way', 'FindController@customer_sms_way');

Route::post('/seller_eamil_way', 'FindController@seller_eamil_way');
Route::post('/seller_sms_way', 'FindController@seller_sms_way');

Route::post('/f_reset_customer', 'FindController@customer_f_reset');


//----seller ID 찾기-----
Route::get('/seller_find_id', function(){
  return view('find_information_seller/find_id');
});

//find_id에서 id의 존재유무를 확인하는 ajax
Route::post('/seller_email_query', 'FindController@seller_email_query');
Route::post('/seller_sms_query', 'FindController@seller_sms_query');
//email인증 id 찾기
Route::post('/seller_email_check', 'FindController@seller_email_check');
//sms인증 id 찾기
Route::post('/seller_sms_check', 'FindController@seller_sms_check');

//seller PW 찾기
Route::get('/seller_find_pw', function(){
  return view('find_information_seller/find_pw');
});
Route::post('/seller_find_pw_controller', 'FindController@seller_find_pw');
//pw에서 id존재유무를 확인하는 jquery
Route::post('/seller_id_check', 'FindController@seller_id_check');

Route::get('/find_pw_way_seller', function(){
  return view('find_information_seller/find_pw_way');
});
Route::post('/f_way_seller', 'FindController@seller_f_way');

Route::post('/f_reset_seller', 'FindController@seller_f_reset');

// Route::get('/find_chk', 'FindController@find_check');

Route::post('/login_s', 'LoginController@login_s');

Route::post('/login_c', 'LoginController@login_c');

Route::get('/logout', 'LoginController@logout');

Route::post('information_controller', 'InformationController@information');

//내 주변 꽃집 찾기
Route::get('/locate1', 'LocateController@locate');

Route::post('modipw', 'InformationController@modipw');

Route::post('/c_modipw', 'InformationController@c_modipw');

Route::post('/check_login', 'LoginController@check_login');

Route::post('/check_sellerlogin', 'LoginController@check_sellerlogin');

Route::get('/faq', function () {
  return view('FAQ');
});Route::post('modiemail', 'InformationController@modifyemail');


Route::get('/customer_shop', function () {
  return view('myshop/shop_customer');
});
// Route::get('/myqna', function () {
//   return view('myQnA');
// });
Route::get('/myqna','InformationController@myqna');

// Route::get('/postlist', function () {
//   return view('post_list');
// });
Route::group(['middleware' => 'preventBackHistory'],function(){
  Route::get('/sellershoppost', 'ProductController@seller_shoppost');
});


Route::post('store_star/{id}', 'ProductController@store_star');

Route::get('/product/{id}', 'ProductController@productpage');

Route::get('/pd_qna{id}','ProductController@pd_qna');

Route::get('product/store/{id}', 'InformationController@storepage');

Route::post('/pd_modify{id}', 'InformationController@pd_modify');

Route::post('/pd_modi{id}', 'ProductController@pd_modify');

Route::post('/pd_remove{id}', 'ProductController@pd_remove');

Route::post('index', 'ProductController@seller_product_register');

Route::post('image', 'ProductController@store_img_register');

Route::get('/review', function () {
  return view('review');
});

Route::post('rev', 'ReviewController@my_review');

Route::post('rev_count', 'ReviewController@rev_count');

//결제
// Route::get('/order{a}', 'PaymentController@payment');

Route::post('star2/{id}', 'ProductController@star2');

Route::get('/star', 'ProductController@star');

Route::get('/order/{name?}', 'PaymentController@payment');

Route::get('/complete', 'PaymentController@paymentcomplete')->name('complete');

Route::post('/complete', 'PaymentController@paymentprocess');

Route::get('/sellermyorderlist', 'InformationController@orderlist');

Route::get('/shopinfo','InformationController@storeinfo');

Route::post('/c_newaddress','InformationController@c_storeinfo');
//       return view('myshop/shop_seller');

Route::get('/shoppage', 'InformationController@shoppage');

Route::get('/all', 'MainController@showall');

Route::get('/newaddress', 'InformationController@newaddress');

Route::get('/detail', 'InformationController@detailaddress');

Route::post('/c_information_controller', 'InformationController@c_information');

Route::post('c_modiemail', 'InformationController@c_modifyemail');

Route::get('/favorite/{id}', 'ProductController@favorite');

Route::post('/favorite_store/{id}', 'InformationController@favorite_store');

Route::get('/mypage', function(){
    if($sellerinfo = auth()->guard('seller')->user()){
      // return 0;
      $sellerprimary = $sellerinfo->s_no;
          $sellerstore = DB::table('seller')
          ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
          ->where('s_no','=', $sellerprimary )->get();

          return view('mypage/mypage', compact('sellerstore'));

}
else{
return view('login/login_seller');
}

});

Route::get('/c_mypage', function (){
  if($customerinfo = auth()->guard('customer')->user()){
    $customerprimary = $customerinfo->c_no;
    // return $sellerprimary;
        $data = DB::table('customer_address')->select('a_post','a_address','a_extra','a_detail')
        ->where('c_no','=',$customerprimary)->get();

        return view('mypage/c_mypage',compact('data'));
}
else{
return view('login/login_customer');
}

});




Route::get('/shop', function(){
  if($sellerinfo = auth()->guard('seller')->user()){
    $sellerprimary = $sellerinfo->s_no;
    // return $sellerprimary;
        $data = DB::table('seller')
        ->join('store', 'seller.s_no', '=', 'store.seller_no')->select('*')
        ->where('s_no','=', $sellerprimary )->get();
        $proro = DB::table('product')->select('*')->where('store_no' ,'=', $data[0]->st_no)->paginate(5);
        $introduce = DB::table('store')->select('st_introduce')->where('st_no' ,'=' , $data[0]->st_no )->get();
        $store_address = DB::table('store_address')->select('*')->where('st_no' ,'=', $data[0]->st_no)->get();
        $detail_address = DB::table('store_address')->select('a_detail')->where('st_no' ,'=', $data[0]->st_no)->get();

        return view('myshop/shop_seller' , compact('data', 'proro','introduce', 'store_address', 'detail_address'));
  }
  else{
return view('login/login_seller');
  }
});

Route::post('/registration', 'InformationController@registration');

//검색
Route::get('/search', 'SearchController@result');
Route::group(['middleware' => 'preventBackHistory'],function(){
Route::get('/flowercart', 'ProductController@basket');
});
Route::post('/delete', 'ProductController@basketdelete');

Route::post('/basketstore', 'ProductController@basketstore');

Route::post('/basketcount', 'ProductController@basketcount');

Route::post('/basketcondition', 'ProductController@basketcondition');

Route::post('/questionans/{q_no}','QnAController@question_answer');

Route::get('/Sort_H', 'SortController@Sort_H');

Route::get('/Sort_L', 'SortController@Sort_L');


//footer
Route::get('/terms', function () {
  return view('lib.terms');
});

Route::get('/privacy', function () {
  return view('lib.privacy');
});

Route::get('inquiries', function () {
  return view('lib.inquiries');
});

//관리자
Route::get('/ad_admin', function () {
  return view('admin.index');
});
Route::get('/ad_customer', 'AdminController@customer');

Route::get('/ad_seller', 'AdminController@seller');

Route::post('/ad_remove{id}', 'AdminController@ad_remove');

Route::post('/ad_restore{id}', 'AdminController@ad_restore');

Route::get('/ad_product', 'AdminController@product');

Route::get('/ad_regst{id}', 'AdminController@registraion');

Route::post('/ad_confirm{id}', 'AdminController@confrim');

Route::get('/image_popup', 'InformationController@image');
