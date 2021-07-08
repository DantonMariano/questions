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
      $id = $request->input('uid');
      if (session('id') == $id && !empty($id)){
        return $next($request);
      } else {
        return response()->json(['error'=>'Usuário não está logado!'], 400);
      }
    }
}
