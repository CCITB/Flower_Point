<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SMStestController extends Controller
{
    //
    public function blade(){


      return view('sms');
    }
    public function jso(Request $request){
      $oCurl = curl_init();
$url =  "https://sslsms.cafe24.com/smsSenderPhone.php";
$aPostData['userId'] = "ccitsms"; // SMS 아이디
$aPostData['passwd'] = "1cc4bc9ea5d24c9811d2cf30d430276f"; // 인증키
curl_setopt($oCurl, CURLOPT_URL, $url);
curl_setopt($oCurl, CURLOPT_POST, 1);
curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aPostData);
curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, 0);
$ret = curl_exec($oCurl);
echo $ret;
curl_close($oCurl);
    }

}
