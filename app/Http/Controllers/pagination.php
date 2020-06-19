<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class pagination extends Controller
{
  public function pages()
  {
      $myqna = DB::table('seller')->paginate(5);

      return view('myQna', ['myqn' => $myqna]);
  }


}
