<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class SocioModel extends Model
{
  protected $table = 'socios';

  public function __construct()
  {
    parent::__construct();
  }

  public function selectAll($uid)
  {
    $rs = DB::table($this->table)
      ->select('nome', 'id')
      ->where('user_id', '=', $uid)
      ->orderBy('nome')
      ->get();


    $query = "
    SELECT c.id as id,
          cs.socio_id as socioid,
          c.name as nome
    FROM socios s
    JOIN clube_socio cs on s.id = cs.socio_id
    and s.user_id = cs.user_id
    JOIN clubes c on c.id = cs.clube_id
    and c.user_id = s.user_id
    WHERE c.user_id = " . $uid . "
    ORDER BY c.name ASC
    ";

    $clubes = DB::select($query);

    return json_encode(["Socios" => $rs, "Clubes" => $clubes]);
  }

  public function create($socio)
  {
    $rs = DB::table($this->table)
      ->insert([
        "nome" => $socio['nome'],
        "user_id" => $socio['user_id']
      ]);

    if ($rs) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteId($socio)
  {
    $rs = DB::table($this->table)
      ->where('id', '=', $socio['socio_id'])
      ->where('user_id', '=', $socio['user_id'])
      ->delete();

    if ($rs) {
      return true;
    } else {
      return false;
    }
  }

  public function relateTo($assoc)
  {
    $socio_id = $assoc['socio_id'];
    $clube_id = $assoc['clube_id'];
    $user_id = $assoc['user_id'];

    $userExists = DB::table('socios')
      ->where('id', '=', $socio_id)
      ->where('user_id', '=', $user_id)
      ->count();

    if ($userExists == 0) {
      return false;
    }

    $clubeExists = DB::table('clubes')
      ->where('id', '=', $clube_id)
      ->where('user_id', '=', $user_id)
      ->count();

    if ($clubeExists == 0) {
      return false;
    }

    $isUnique = DB::table('clube_socio')
      ->where('clube_id', '=', $clube_id)
      ->where('socio_id', '=', $socio_id)
      ->where('user_id', '=', $user_id)
      ->count();

    if ($isUnique > 0) {
      return false;
    }

    $rs = DB::table('clube_socio')
      ->insert([
        'user_id' => $user_id,
        'socio_id' => $socio_id,
        'clube_id' => $clube_id
      ]);

    if ($rs) {
      return true;
    } else {
      return false;
    }
  }

  public function isUnique($socio)
  {
    $rows = DB::table($this->table)
      ->where(["nome" => $socio['nome']])
      ->count();

    if ($rows > 0) {
      return false;
    } else {
      return true;
    }
  }
}
