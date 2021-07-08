<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;

use Closure;
use Illuminate\Http\Request;

class validateForm
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
    $name = $request->input('username');
    $pass = $request->input('password');
    $regex = "/[a-z]/i";
    if (empty($name) || empty($pass)) {
      return back()->withErrors('Formulário inválido!');
    } else
    if (strlen($name) < 5 || strlen($pass) < 5) {
      return back()->withErrors('Usuário/Senha tem que ter mais de 5 caracteres!');
    } else
    if (preg_match_all($regex,$name) < 5) {
      return back()->withErrors('Usuário não pode ser somente números!');
    } else {
      return $next($request);
    }
  }
}
