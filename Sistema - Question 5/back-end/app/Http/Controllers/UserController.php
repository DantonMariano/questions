<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;


class UserController extends Controller
{
  public function login(Request $req)
  {
    $user = [
      "name" => $req->input('username'),
      "pass" => $req->input('password')
    ];
    foreach ($user as $input) {
      if (empty($input) || ctype_space($input) || ctype_cntrl($input)) {
        return response()->json(['error' => 'Formulário não preenchido'], 400);
      } else 
      if (ctype_digit($input)) {
        return response()->json(['error' => 'Formulário não pode conter apenas números'], 400);
      } else 
      if (strlen($input) < 5) {
        return response()->json(['error'=>'Usuário/Senha não podem conter menos de 5 caractéres.'], 400);
      }
    }

    $model = new UserModel();

    if (!$model->isUnique($user)){
      $logged = $model->login($user);
    } else {
      return response()->json(['error'=>'Usuário Não Existe.'], 400);
    }

    if ($logged){
      session(['id' => $logged['id']]);
      return response()->json(['success'=>'Usuário Logado com Sucesso!', "user_data" => $logged],200);
    } else {
      return response()->json(['error'=>'Senha Incorreta.'], 400);
    }
  }
  public function register(Request $req)
  {
    $user = [
      "name" => $req->input('username'),
      "pass" => $req->input('password')
    ];
    foreach ($user as $input) {
      if (empty($input) || ctype_space($input) || ctype_cntrl($input)) {
        return response()->json(['error' => 'Formulário não preenchido'], 400);
      } else 
      if (ctype_digit($input)) {
        return response()->json(['error' => 'Formulário não pode conter apenas números'], 400);
      } else 
      if (strlen($input) < 5) {
        return response()->json(['error'=>'Usuário/Senha não podem conter menos de 5 caractéres.'], 400);
      }
    }
    
    $model = new UserModel();

    if ($model->isUnique($user)){
      $registered = $model->register($user);
    } else {
      return response()->json(['error'=>'Usuário já cadastrado.'], 400);
    }

    if ($registered){
      return response()->json(['success'=>'Usuário Registrado com Sucesso!'],200);
    } else {
      return response()->json(['error'=>'Usuário não pode ser registrado.'], 500);
    }
  }
}
