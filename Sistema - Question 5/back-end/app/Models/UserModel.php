<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{

  protected $table = 'users';

  public function register($user)
  {
    $rs = DB::table($this->table)
      ->insert([
        "username" => $user['name'],
        "password" => password_hash($user['pass'], PASSWORD_BCRYPT)
      ]);

    if ($rs) {
      return true;
    } else {
      return false;
    }
  }

  public function login($user)
  {
    $rs = DB::table($this->table)
      ->select('id', 'username', 'password')
      ->where("username", '=', $user['name'])
      ->first();

    $passwordIsCorrect = password_verify($user['pass'], $rs->password);

    if ($passwordIsCorrect) {
      return[
        'id' => $rs->id, 
        'username' => $rs->username
      ];
    } else {
      return false;
    }
  }

  public function isUnique($user)
  {
    $rows = DB::table($this->table)
      ->where(["username" => $user['name']])
      ->count();

    if ($rows > 0) {
      return false;
    } else {
      return true;
    }
  }
}
