<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
  /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
  public function handle($request, Closure $next)
  {

    if(auth()->guard('customer')->check()){
      return $next($request);

    }
    if(auth()->guard('seller')->check()){
      return view('main');
    }
    return redirect('/login_customer');
  }
}
