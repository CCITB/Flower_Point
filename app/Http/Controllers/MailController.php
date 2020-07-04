<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \App\Mail\RegisterMail;

//어지수
class MailController extends Controller
{
  public function sends(Request $request)
  {
    //이메일에 전송할 난수 4자리
    $randomNum = mt_rand(1000, 9999);

    $inputmail =  $request->input('email');
    //input대신 get도 가능

    //mailable로 입력된 email, 난수 전송
    Mail::to($inputmail)->send(new RegisterMail($randomNum));
    return response()->json($randomNum);
  }

}
