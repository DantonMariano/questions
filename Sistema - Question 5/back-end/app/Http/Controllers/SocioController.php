<?php

namespace App\Http\Controllers;

use App\Models\SocioModel;
use Illuminate\Http\Request;

class SocioController extends Controller
{

  public function delete(Request $req)
  {
    $socio_id = $req->input('socio_id');

    $model = new SocioModel();

    $delete = [
      "socio_id" => $socio_id,
      "user_id"  => session('id')
    ];

    $isDeleted = $model->deleteId($delete);

    if ($isDeleted) {
      return response()->json(['success' => 'Sócio Deletado com Sucesso!'], 200);
    } else {
      return response()->json(['error' => 'Sócio não existe.'], 500);
    }
  }

  public function read()
  {
    $model = new SocioModel();

    $uid = session('id');

    $result = $model->selectAll($uid);



    $rs = json_decode($result, true);

    $socios = $rs['Socios'];
    $clubes = $rs['Clubes'];

    foreach($socios as $index => $socio){
      $socios[$index]['Associados'] = [];
    }

    foreach($socios as $sindex => $socio){
      foreach($clubes as $cindex => $clube){
        if ($socios[$sindex]['id'] == $clubes[$cindex]['socioid']){
          array_push($socios[$sindex]['Associados'], ["id"=> $clubes[$cindex]['id'],"nome"=> $clubes[$cindex]['nome']]);
        }
      }
    }

    return response()->json($socios);
  }

  public function create(Request $req)
  {

    $socio = $req->input('socio_name');

    if (empty($socio) || ctype_space($socio) || ctype_cntrl($socio)) {
      return response()->json(['error' => 'Nome do Sócio não preenchido'], 400);
    } else 
    if (ctype_digit($socio)) {
      return response()->json(['error' => 'Nome do Sócio não pode conter apenas números'], 400);
    } else 
    if (strlen($socio) < 5) {
      return response()->json(['error' => 'Nome do Sócio não podem conter menos de 5 caractéres.'], 400);
    }

    $model = new SocioModel();

    $insert = [
      "nome" => $socio,
      "user_id"   => session('id')
    ];

    if ($model->isUnique($insert)) {
      $created = $model->create($insert);
    } else {
      return response()->json(['error' => 'Sócio já cadastrado.'], 400);
    }

    if ($created) {
      return response()->json(['success' => 'Sócio Criado com Sucesso!'], 200);
    } else {
      return response()->json(['error' => 'Sócio não pode ser criado.'], 500);
    }
  }

  public function associar(Request $req)
  {
    $model = new SocioModel();

    $assoc = [
      "socio_id" => $req->input('socio_id'),
      "clube_id" => $req->input('clube_id'),
      "user_id" => session('id'),
    ];

    $isAssoc = $model->relateTo($assoc);

    if ($isAssoc) {
      return response()->json(['success' => 'Associação Criada com Sucesso!'], 200);
    } else {
      return response()->json(['error' => 'Associação não pode ser criada.'], 500);
    }
  }
}
