<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
class MailController extends Controller
{
  /** * 메일 전송 소스 입니다. 테스트 용으로 하드코딩을 했습니다. ** */
  public function send(Request $request)
  {
    $user = array( 'email' => 'ccitflowerpoint@gmail.com',
    'name' => 'yourname' );
    $data = array( 'detail'=> 'Hellow FlowerPoint',
    'name' => $user['name'] );

    Mail::send('emails.mail', $data, function($message) use ($user)
    {
      $message->from('master@betanews.net', 'Betanews Master');
      $message->to($user['email'], $user['name'])
      ->subject('Welcome!');
    });
    return 'Done!';
  }
}
