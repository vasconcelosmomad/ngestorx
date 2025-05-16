<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }

    public function listarOperadores()
    {
        // Obtendo o ID da empresa da sessão
        $uid_empresa = session('uid_empresa');
        
        // Buscar a empresa na tabela 'empresas'
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        
        // Se a empresa não for encontrada
        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }
        
        // Obtendo o parâmetro 'software_id' da sessão
        $param = session('software_id');
        
        // Carregando as variáveis de ambiente
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $flexityx = env('FLEXITYX');
        
        // Mapeando as tabelas para os diferentes parâmetros de software
        $tables = [
            $idpharm => ['funcionarios', 'usuarios'],
            $restgo => ['funcionarios', 'usuarios'],
            $gestorX => ['funcionarios', 'usuarios'],
        ];
        
        // Verificando se o parâmetro existe nas tabelas definidas
        if (!isset($tables[$param])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido!']);
        }
        
        // Configurando a conexão com o banco da empresa
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        
        // Realizando o JOIN entre as tabelas de 'funcionarios' e 'usuarios'
        $operadores = new Usuario();
        $operadores = $operadores->setTable($tables[$param][1] . ' as usuario')      
        ->join($tables[$param][0]. ' as funcionario', 'usuario.id_funcionario', '=', 'funcionario.id')
        ->where('nivel', '=', 6) 
        ->select('funcionario.*')
        ->get(); // Tabela de usuarios 
        
        
        return response()->json(['success' => true, 'operadores' => $operadores]);
    
}
    
    
}
