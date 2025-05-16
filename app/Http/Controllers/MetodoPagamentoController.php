<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoPagamento;
use Illuminate\Support\Facades\DB;


class MetodoPagamentoController extends Controller
{
    public $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }

    public function getMetodosPagamento()
    {
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada, verifique o UID e tente novamente']);
        }
       

        
        $table = 'metodos_pagamento'; 

        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $metodosPagamento = new MetodoPagamento();
        $metodosPagamento->setTable($table);
        $metodosPagamento = $metodosPagamento->get();
        return response()->json(['success' => true, 'metodosPagamento' => $metodosPagamento]);
    }

    
}