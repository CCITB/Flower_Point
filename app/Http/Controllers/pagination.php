<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class pagination extends Controller
{
  public function pages()
  {
      $myqna = DB::table('question')->paginate(5);

      return view('myQna', ['myqn' => $myqna]);
  }

  public function pd_pages()
  {
      $product = DB::table('product')->paginate(6);

      return view('main', ['product' => $product]);
  }
}
