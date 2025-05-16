<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DatabaseController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardOpratorController extends Controller
{protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }


    function getVendas()
    {
        $uid_empresa = session('uid_empresa');
        $id_usuario = session('id_usuario');
        $id_software = session('software_id');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread= env('XREAD');
    
        $tables = [
            $idpharm => ['vendas'],
            $restgo => ['vendas'],
            $xread => ['vendas'],
        ];
    
        // Data atual
        $ontem = now()->subDay()->toDateString();
        $hoje = now()->toDateString();
        $inicioSemana = now()->startOfWeek()->toDateString();
        $fimSemana = now()->endOfWeek()->toDateString();
        $inicioMes = now()->startOfMonth()->toDateString();
        $fimMes = now()->endOfMonth()->toDateString();
    
        // Obter vendas diárias, semanais e mensais
    $vendasDiarias = DB::table($tables[$id_software][0] . ' as v')
    ->selectRaw('mp.nome as metodo_pagamento, SUM(v.total) as total_vendas')
    ->join('fatura_recibo as fr', 'fr.id_venda', '=', 'v.id')
    ->join('metodos_pagamento as mp', 'mp.id', '=', 'fr.forma_pgto')
    ->whereDate('v.created_at', $hoje) // Filtro de data de hoje
    ->where('v.status', 'Concluída')
    ->where('v.tipo', 'VD')
    ->where('v.usuario_id', $id_usuario)
    ->groupBy('mp.nome') // Agrupar por método de pagamento
    ->get();

    $vendasOntem = DB::table($tables[$id_software][0] . ' as v')
    ->selectRaw('mp.nome as metodo_pagamento, SUM(v.total) as total_vendas')
    ->join('fatura_recibo as fr', 'fr.id_venda', '=', 'v.id')
    ->join('metodos_pagamento as mp', 'mp.id', '=', 'fr.forma_pgto')    
    ->whereDate('v.created_at', $ontem) // Filtro de data de hoje
    ->where('v.status', 'Concluída')
    ->where('v.tipo', 'VD')
    ->where('v.usuario_id', $id_usuario)
    ->groupBy('mp.nome') // Agrupar por método de pagamento
    ->get();
    

        // Retornar as vendas de cada período em formato JSON
        return response()->json([
            'vendas_diarias' => $vendasDiarias,
            'vendas_ontem' => $vendasOntem,
        ]);
    }

    public function getVendasMensais()
    {
        $uid_empresa = session('uid_empresa');
        $id_usuario = session('id_usuario');
        $id_software = session('software_id');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');

        $tables = [
            $idpharm => ['vendas'],
            $restgo => ['vendas'],
            $xread => ['vendas'],
        ];

        // Determinar os anos
        $anoAtual = now()->year;
        $anoAnterior = $anoAtual - 1;
        
        // Arrays para armazenar os valores
        $valoresAtual = [];
        $valoresAnterior = [];
        $nomesMeses = [];
        
        // Buscar dados para cada mês dos dois anos
        for ($mes = 1; $mes <= 12; $mes++) {
            // Dados do ano atual
            $inicioMesAtual = Carbon::createFromDate($anoAtual, $mes, 1)->startOfMonth();
            $fimMesAtual = Carbon::createFromDate($anoAtual, $mes, 1)->endOfMonth();
            
            // Dados do ano anterior
            $inicioMesAnterior = Carbon::createFromDate($anoAnterior, $mes, 1)->startOfMonth();
            $fimMesAnterior = Carbon::createFromDate($anoAnterior, $mes, 1)->endOfMonth();
            
            // Buscar total de vendas para o mês atual
            $totalMesAtual = DB::table($tables[$id_software][0] . ' as v')
                ->selectRaw('SUM(v.total) as total_vendas')
                ->whereBetween('v.created_at', [
                    $inicioMesAtual->format('Y-m-d 00:00:00'),
                    $fimMesAtual->format('Y-m-d 23:59:59')
                ])
                ->where('v.status', 'Concluída')
                ->where('v.tipo', 'VD')
                ->where('v.usuario_id', $id_usuario)
                ->value('total_vendas') ?? 0;
            
            // Buscar total de vendas para o mês anterior
            $totalMesAnterior = DB::table($tables[$id_software][0] . ' as v')
                ->selectRaw('SUM(v.total) as total_vendas')
                ->whereBetween('v.created_at', [
                    $inicioMesAnterior->format('Y-m-d 00:00:00'),
                    $fimMesAnterior->format('Y-m-d 23:59:59')
                ])
                ->where('v.status', 'Concluída')
                ->where('v.tipo', 'VD')
                ->where('v.usuario_id', $id_usuario)
                ->value('total_vendas') ?? 0;
            
            // Armazenar os valores
            $valoresAtual[] = (float) $totalMesAtual;
            $valoresAnterior[] = (float) $totalMesAnterior;
            
            // Nome do mês em português
            $nomesMeses[] = ucfirst(Carbon::createFromDate($anoAtual, $mes, 1)
                ->locale('pt_PT')
                ->translatedFormat('M'));
        }
        
        // Retornar os dados em formato JSON
        return response()->json([
            'valores_atual' => $valoresAtual,
            'valores_anterior' => $valoresAnterior,
            'meses' => $nomesMeses,
            'ano_atual' => $anoAtual,
            'ano_anterior' => $anoAnterior
        ]);
    }

    public function getVendasSemanais()
    {
        $uid_empresa = session('uid_empresa');
        $id_usuario = session('id_usuario');
        $id_software = session('software_id');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');

        $tables = [
            $idpharm => ['vendas'],
            $restgo => ['vendas'],
            $xread => ['vendas'],
        ];

        // Obter a data de início da semana atual (segunda-feira)
        $inicioSemana = now()->startOfWeek();
        
        // Array para armazenar os valores diários e nomes dos dias
        $valoresDiarios = [];
        $nomesDias = [];
        
        // Buscar dados para cada dia da semana atual
        for ($dia = 0; $dia < 7; $dia++) {
            $dataAtual = $inicioSemana->copy()->addDays($dia);
            $dataFormatada = $dataAtual->toDateString();
            
            // Buscar total de vendas para o dia
            $totalDia = DB::table($tables[$id_software][0] . ' as v')
                ->selectRaw('SUM(v.total) as total_vendas')
                ->whereDate('v.created_at', $dataFormatada)
                ->where('v.status', 'Concluída')
                ->where('v.tipo', 'VD')
                ->where('v.usuario_id', $id_usuario)
                ->value('total_vendas') ?? 0;
            
            $valoresDiarios[] = (float) $totalDia;
            
            // Nome do dia em português abreviado
            $nomesDias[] = ucfirst($dataAtual->locale('pt_PT')->translatedFormat('D'));
        }
        
        // Retornar os dados em formato JSON
        return response()->json([
            'valores' => $valoresDiarios,
            'dias' => $nomesDias,
            'semana' => $inicioSemana->locale('pt_PT')->translatedFormat('d') . ' a ' . 
                       $inicioSemana->copy()->addDays(6)->locale('pt_PT')->translatedFormat('d') . '/' . ucfirst($inicioSemana->copy()->addDays(6)->locale('pt_PT')->translatedFormat('M')) . '/' . $inicioSemana->copy()->addDays(6)->locale('pt_PT')->translatedFormat('Y')
        ]);
    }

}
