<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//어지수
class SMSController extends Controller
{
  public function SMSsend(Request $request){
    //발신자 번호
    $shone1 = '010';
    $shone2 = '8897';
    $shone3 = '5637';

    $randomNum = mt_rand(1000, 9999);
    $input_phone_num =  $request->input('tel');

      /******************** 인증정보 ********************/
      $sms_url = "https://sslsms.cafe24.com/sms_sender.php"; // HTTPS 전송요청 URL
      // $sms_url = "http://sslsms.cafe24.com/sms_sender.php"; // 전송요청 URL
      $sms['user_id'] = base64_encode("ccitsms"); //SMS 아이디.
      $sms['secure'] = base64_encode("1cc4bc9ea5d24c9811d2cf30d430276f") ;//인증키
      $sms['msg'] = base64_encode(stripslashes('[꽃갈피]본인확인 인증번호 ['.$randomNum.']를 입력해주세요.')); //문자내용드갈부분

      //수신자 번호
      $sms['rphone'] = base64_encode($input_phone_num);
      //발신자 번호
      $sms['sphone1'] = base64_encode($shone1);
      $sms['sphone2'] = base64_encode($shone2);
      $sms['sphone3'] = base64_encode($shone3);

      $sms['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.

      //실험시 'Y' 입력
      //$sms['testflag'] = base64_encode('Y');

      $host_info = explode("/", $sms_url);
      $host = $host_info[2];
      $path = $host_info[3];

      srand((double)microtime()*1000000);
      $boundary = "---------------------".substr(md5(rand(0,32000)),0,10);
      //print_r($sms);

      // 헤더 생성
      $header = "POST /".$path ." HTTP/1.0\r\n";
      $header .= "Host: ".$host."\r\n";
      $header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";

      // 본문 생성
      $data = '';
      foreach($sms AS $index => $value){
        $data .="--$boundary\r\n";
        $data .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
        $data .= "\r\n".$value."\r\n";
        $data .="--$boundary\r\n";
      }
      $header .= "Content-length: " . strlen($data) . "\r\n\r\n";

      $fp = fsockopen($host, 80);

      if ($fp) {
        fputs($fp, $header.$data);
        $rsp = '';
        while(!feof($fp)) {
          $rsp .= fgets($fp,8192);
        }
        fclose($fp);
        $msg = explode("\r\n\r\n",trim($rsp));
        $rMsg = explode(",", $msg[1]);
        $Result= $rMsg[0]; //발송결과
        $Count= $rMsg[1]; //잔여건수

        //발송결과 알림
        if($Result=="success") {
          $alert = "성공";
          $alert .= " 잔여건수는 ".$Count."건 입니다.";
        }
        else if($Result=="reserved") {
          $alert = "성공적으로 예약되었습니다.";
          $alert .= " 잔여건수는 ".$Count."건 입니다.";
        }
        else if($Result=="3205") {
          $alert = "잘못된 번호형식입니다.";
        }

        else if($Result=="0044") {
          $alert = "스팸문자는발송되지 않습니다.";
        }

        else {
          $alert = "[Error]".$Result;
        }
      }
      else {
        $alert = "Connection Failed";
      }
        //난수 전달
        return response()->json($randomNum);
  }

}
