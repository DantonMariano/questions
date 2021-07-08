<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isUser
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
        if (session('isLogged') && !empty(session('user_data')['id'])) {
          return $next($request);
        } else {
          return redirect('/user/login')->withErrors('Por favor, faça Login!');
        }
    }
}
