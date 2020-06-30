<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class PaymentController extends Controller
{
    //
    public function payment(Request $request){
      if(auth()->guard('customer')->user()){
        // return 0;
        $ididx = json_decode($request->input('pdidx'));
        // $request->input('getid');
        // return view('main');
        // return response()->json($getid);
        // return response()->json($request->input('getid'));
        // return $a[2];
        // return $request;
        // $data = [];
        $data =[];
        // return $data;
        for($i = 0; $i<count($ididx); $i++){
        $data[] =  DB::table('basket')->where('b_no',$ididx[$i])->get();
        // $price = $data[0]->b_price*$data[0]->b_count;
        }
        // return $data[0]->b_no;
        // return $data[0]->b_no;
        $user = auth()->guard('customer')->user();

        return view('payment.order',compact('data','user'));

      }
      else
      return redirect('/');

    }
    public function paymentcomplete($b){

        return view('payment.complete');
    }
}
