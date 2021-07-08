<?php

namespace App\Http\Controllers;

use App\Models\ClubeModel;
use Illuminate\Http\Request;

class ClubeController extends Controller
{

  public function delete(Request $req)
  {
    $clube_id = $req->input('clube_id');

    $model = new ClubeModel();

    $delete = [
      "clube_id" => $clube_id,
      "user_id"  => session('id')
    ];

    $isDeleted = $model->deleteId($delete);

    if ($isDeleted) {
      return response()->json(['success' => 'Clube Deletado com Sucesso!'], 200);
    } else {
      return response()->json(['error' => 'Clube não existe.'], 500);
    }
  }

  public function read()
  {
    $model = new ClubeModel();

    $uid = session('id');

    $clubes = $model->selectAll($uid);

    return response()->json(["clubes" => $clubes]);
  }

  public function create(Request $req)
  {

    $clube = $req->input('clube_name');

    if (empty($clube) || ctype_space($clube) || ctype_cntrl($clube)) {
      return response()->json(['error' => 'Nome do Clube não preenchido'], 400);
    } else 
    if (ctype_digit($clube)) {
      return response()->json(['error' => 'Nome do Clube não pode conter apenas números'], 400);
    } else 
    if (strlen($clube) < 5) {
      return response()->json(['error' => 'Nome do Clube não podem conter menos de 5 caractéres.'], 400);
    }

    $model = new ClubeModel();

    $insert = [
      "name" => $clube,
      "user_id"   => session('id')
    ];

    if ($model->isUnique($insert)) {
      $created = $model->create($insert);
    } else {
      return response()->json(['error' => 'Clube já cadastrado.'], 400);
    }

    if ($created) {
      return response()->json(['success' => 'Clube Criado com Sucesso!'], 200);
    } else {
      return response()->json(['error' => 'Clube não pode ser criado.'], 500);
    }
  }
}
