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
        $dbdata = DB::table('customer')->get();
        $ididx = json_decode($request->input('pdidx'));
        // $request->input('getid');
        // return view('main');
        // return response()->json($getid);
        // return response()->json($request->input('getid'));
        // return $a[2];
        // return $request;
        // $data = [];
        // $data =[];
        $data1 = 0;
        $productprice = 0;
        $productdelivery = 0;
        $productsum = 0;
        // return print_r($dbdata[0]);
        // return $ididx[0];
        for($i = 0; $i<count($ididx); $i++){
        $data[] =  DB::table('basket')->where('b_no',$ididx[$i])->get();
        $productsum += $data[$i][0]->b_delivery+$data[$i][0]->b_price*$data[$i][0]->b_count;
        $productdelivery += $data[$i][0]->b_delivery;
        $productprice += $data[$i][0]->b_price*$data[$i][0]->b_count;
        // $price = $data[0]->b_price*$data[0]->b_count;
        // $data1 = $data[$i];
        }
        // return $data[0][0]->b_price*$data[0][0]->b_count;
        // return $data[0]->b_no;
        // return $productprice;
        $user = auth()->guard('customer')->user();

        return view('payment.order',compact('data','user','productprice','productdelivery','productsum'));

      }
      else
      return redirect('/');

    }
    public function paymentcomplete(){
        return view('payment.complete');
    }
}
