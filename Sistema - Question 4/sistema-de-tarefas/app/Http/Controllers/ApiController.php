<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\TasksModel;
use Illuminate\Support\Facades\Log;
use Session;

class ApiController extends Controller
{

  //
  // USUARIOS
  //

  public function userRegister(Request $request)
  {
    $UsersModel = new UsersModel();

    $username = $request->input('username');
    if ($UsersModel->userIsUnique($username)) {
      $senha = $request->input('password');

      $object = [
        'user' => $username,
        'pass' => password_hash($senha, PASSWORD_ARGON2I)
      ];

      $UsersModel->register_user($object);

      $login = [
        'user' => $username,
        'pass' => $senha
      ];

      $user = $UsersModel->login_user($login);

      session([
        'user_data' => $user,
        'isLogged'  => true
      ]);

      return redirect('/');
    } else {
      return redirect('/user/register')->withErrors('Usuário já cadastrado!');
    }
  }

  public function userLogin(Request $request)
  {
    $UsersModel = new UsersModel();

    $username = $request->input('username');
    $senha = $request->input('password');
    if (!$UsersModel->userIsUnique($username)) {

      $object = [
        'user' => $username,
        'pass' => $senha
      ];

      $user = $UsersModel->login_user($object);
      if ($user) {
        session([
          'user_data' => $user,
          'isLogged'  => true
        ]);
        return redirect('/');
      } else {
        return redirect('/user/login')->withErrors('Usuário/Senha inválida!');
      }
    } else {
      return redirect('/user/login')->withErrors('Usuário não existe!');
    }
  }

  public function userExit()
  {
    if (session('isLogged')) {
      session()->flush();
    }
    return redirect('/');
  }

  public function getTarefas()
  {
    $user_id = session('user_data')['id'];
    $isLogged = session('isLogged');
    $TasksModel = new TasksModel($user_id);

    $tarefas = $TasksModel->getTarefas();

    if ($isLogged) {
      return json_encode($tarefas);
    } else {
      return back()->withErrors('Você não está logado!');
    }
  }

  //
  // TAREFAS 
  //

  public function postTarefas(Request $request)
  {
    $status = $request->input('status');
    if (!isset($status)) {
      $status = 0;
    }

    $tarefa = [
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'priority' => $request->input('priority'),
      'status' => $status
    ];
    foreach($tarefa as $el){
      if(empty(trim($el))){
        return redirect('/tarefa/criar')->withErrors('Tarefa não pode estar vazia!');
      }
    }
    $user_id = session('user_data')['id'];
    $TasksModel = new TasksModel($user_id);
    $insert = $TasksModel->createTarefas($tarefa);

    if ($insert) {
      return redirect('/tarefa');
    } else {
      return redirect('/tarefa/criar')->withErrors('Tarefa inválida!');
    }
  }

  public function deleteTarefa($tarefa_id)
  {
    $user_id = session('user_data')['id'];
    $TasksModel = new TasksModel($user_id);
    $delete = $TasksModel->deleteTarefa($tarefa_id);

    if ($delete) {
      return response('Success', 200);
    } else {
      return response('Bad Request', 400);
    }
  }

  public function putTarefa(Request $put)
  {
    $obj = [
      'id' => $put->input('id'),
      'title' => $put->input('title'),
      'desc' => $put->input('desc')
    ];
    Log::info($obj);
    $user_id = session('user_data')['id'];
    $TasksModel = new TasksModel($user_id);
    $put = $TasksModel->putTarefa($obj);
    if ($put) {
      return response('Success', 200);
    } else {
      return response('Bad Request', 400);
    }
  }

  public function statusTarefa(Request $req)
  {
    $status = $req->input('status');
    $tarefa_id = $req->input('id');
    $user_id = session('user_data')['id'];
    $TasksModel = new TasksModel($user_id);

    $update = $TasksModel->statusChange($status, $tarefa_id);

    if ($update) {
      return response('Success', 200);
    } else {
      return response('Bad Request', 400);
    }
  }
}
