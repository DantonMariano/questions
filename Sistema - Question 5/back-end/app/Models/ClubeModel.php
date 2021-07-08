<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class ClubeModel extends Model
{
  protected $table = 'clubes';

  public function __construct()
  {
    parent::__construct();
  }

  public function selectAll($uid){
    $rs = DB::table($this->table)
      ->select('name','id')
      ->where('user_id', '=', $uid)
      ->orderBy('name')
      ->get();
    
    return $rs;
  }

  public function create($clube)
  {
    $rs = DB::table($this->table)
      ->insert([
        "name" => $clube['name'],
        "user_id" => $clube['user_id']
      ]);

    if ($rs) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteId($clube){
    $rs = DB::table($this->table)
      ->where('id', '=', $clube['clube_id'])
      ->where('user_id', '=', $clube['user_id'])
      ->delete();

    if ($rs) {
      return true;
    } else {
      return false;
    }
  }

  public function isUnique($clube)
  {
    $rows = DB::table($this->table)
      ->where(["name" => $clube['name']])
      ->count();

    if ($rows > 0) {
      return false;
    } else {
      return true;
    }
  }
}
