<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Software;    
use App\Http\Controllers\DatabaseController;

class LicencaController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }

    public function getSoftwares()
    {
     
        $software = DB::connection('central')->table('softwares')->get();
       
       return response()->json(['success' => true, 'data' => $software]);
    }

    public function getFormasPagamento()
    {
        $formasPagamento = DB::connection('central')->table('formas_pagamento')->get();
        return response()->json(['success' => true, 'data' => $formasPagamento]);
    }

    public function getPlanos()
    {
        $planos = DB::connection('central')->table('planos')->get();
        $dados = [];
        foreach ($planos as $plano) {
            $dados[] = [
                'id' => $plano->id,
                'nome' => $plano->nome,
                'descricao' => $plano->descricao,
                'valor' => $plano->valor,
                'duracao_meses' => $plano->duracao_meses,
                'tipo_plano' => $plano->tipo_plano,
                'status' => $plano->status  
            ];  
        }
        return response()->json(['success' => true, 'data' => $dados]);
    }
}
