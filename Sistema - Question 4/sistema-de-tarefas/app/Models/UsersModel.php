<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersModel extends Model
{

  private $tabela;

  public function __construct(){
    parent::__construct();
    $this->tabela = 'users';
  }

  public function register_user($object){

    $user = $object['user'];
    $pass = $object['pass'];

    $insert = DB::table($this->tabela)->insert([
      'user' => $user,
      'pass' => $pass
    ]);

    if ($insert) {
      return true;
    } else {
      return false;
    }
  }
  
  public function login_user($object){

    $user = $object['user'];
    $pass = $object['pass'];

    $rs = DB::table($this->tabela)
      ->select('user','id','pass')
      ->where('user','=', $user)
      ->first();

    $isUser = password_verify($pass, $rs->pass);

    if ($isUser){
      return [
        'name' => $rs->user,
        'id'   => $rs->id
      ];
    } else {
      return false;
    }
  }

  public function userIsUnique($username){
    $rs = DB::table($this->tabela)
      ->select('user')
      ->where('user', '=', $username)
      ->count();

    if ($rs > 0){
      return false;
    } else {
      return true;
    }
  }
}
