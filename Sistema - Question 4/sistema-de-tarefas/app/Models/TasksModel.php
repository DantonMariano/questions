<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TasksModel extends Model
{
  private $tabela;
  private $user_id;

  public function __construct($user_id)
  {
    parent::__construct();
    $this->tabela = 'tasks';
    $this->user_id = $user_id;
  }

  public function getTarefas()
  {
    $rs = DB::table($this->tabela)
      ->select('id', 'title', 'description', 'priority', 'status', 'user_id', 'created_at')
      ->where('user_id', '=', $this->user_id)
      ->orderByDesc('priority')
      ->get();
    return $rs;
  }

  public function createTarefas($tarefa)
  {
    $insert = DB::table($this->tabela)
      ->insert([
        'title' => $tarefa['title'],
        'description' => $tarefa['description'],
        'priority' => $tarefa['priority'],
        'status' => $tarefa['status'],
        'user_id' => $this->user_id
      ]);

    if ($insert) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteTarefa($id)
  {
    $delete = DB::table($this->tabela)
      ->where('id', '=', $id)
      ->where('user_id', '=', $this->user_id)
      ->delete();

    if ($delete) {
      return true;
    } else {
      return false;
    }
  }

  public function putTarefa($obj)
  {
    $id = $obj['id'];
    $title = $obj['title'];
    $desc = $obj['desc'];

    $update = DB::table($this->tabela)
      ->where('id', '=', $id)
      ->where('user_id', '=', $this->user_id)
      ->update(['title' => $title, 'description' => $desc]);
    if ($update) {
      return true;
    } else {
      return false;
    }
  }
  public function statusChange($status, $id)
  {
    $update = DB::table($this->tabela)
      ->where('id', '=', $id)
      ->where('user_id', '=', $this->user_id)
      ->update(['status' => $status]);
    if ($update) {
      return true;
    } else {
      return false;
    }
  }
}
