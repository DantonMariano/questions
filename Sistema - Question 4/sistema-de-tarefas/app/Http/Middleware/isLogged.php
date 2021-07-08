<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      if (session('isLogged')){
        return redirect('/')->withErrors('Acesso Negado');
      } else {
        return $next($request);
      }
    }
}
