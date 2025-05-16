<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DatabaseController;
use App\Models\Cliente;

class ClienteController extends Controller
{
  protected $databaseController;

  public function __construct(DatabaseController $databaseController)
  {
    $this->databaseController = $databaseController;
  }

  public function getClientes()
  {
      $software_id = session('software_id');
      $uid_empresa = session('uid_empresa');
      //pega a empresa da central
      $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
      //configura a conexão com a empresa
      $this->databaseController->setEmpresaDatabaseConnection($empresa);
  
      $restgo = env('RESTGO');
      $gestorx = env('GESTORX');
      $idpharm = env('IDPHARM');
  
      $tables = [
          $idpharm => ['clientes_idpharm'],
          $restgo => ['clientes_restgo'],
          $gestorx => ['clientes_gestorx'],
      ];
      if (!isset($tables[$software_id])) {
        return response()->json(['success' => false, 'message' => 'Parâmetro inválido!']);
      }

      $clientes = DB::connection('empresa')->table($tables[$software_id][0])
      ->select('id', 'nome', 'nuit', 'endereco')
      ->where('status', '=', 'ativo')
      ->get();
      return response()->json(['success' => true, 'clientes' => $clientes]);
  }
  
}
