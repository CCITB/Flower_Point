<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
class MailController extends Controller
{
  public function send(Request $request)
  {
    $user = 'email' => $request->'s_email';
  Mail::send('emails.mail', $data, function($message) use ($user)
    {
      $message->to($user['email'], $user['name'])
      ->subject('Welcome!');
    });
  }
}
