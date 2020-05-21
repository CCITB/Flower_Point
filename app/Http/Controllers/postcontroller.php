<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class postcontroller extends Controller
{
  public function post(Request $request)
      {

          dd($request->all());  //to check all the datas dumped from the form
   //if your want to get single element,someName in this case
   $poststore = $request->poststore;
      }


}
