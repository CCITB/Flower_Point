<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \App\Mail\RegisterMail;

class MailController extends Controller
{
  public function sends(Request $request)
  {
    $randomNum = mt_rand(1000, 9999);

    $inputmail =  $request->input('email');
    //input대신 get도 가능
    // return response()->json($user);

    //$random =  $request->get('random');

    Mail::to($inputmail)->send(new RegisterMail($randomNum));
    return response()->json($randomNum);
  }

}
