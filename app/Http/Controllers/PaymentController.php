<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function payment(Request $request,$getid){
      if(auth()->guard('customer')->user()){
        // $request->input('getid');
        return response()->json($getid);
        return response()->json($request->input('getid'));
        // return $a[2];
        // return $request;
        return view('payment.order');

      }
      else
      return $a;

    }
    public function paymentcomplete($b){

        return view('payment.complete');
    }
}
