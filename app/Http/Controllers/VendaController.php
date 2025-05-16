<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\Cliente;
use App\Models\ItensVenda;
use App\Models\Venda;
use App\Models\ConfigEmpresa;
use App\Models\Fatura;
use App\Models\FaturaRecibo;
use App\Models\ModalidadePagFatura;
use App\Models\Parcela;
use App\Models\RegimeTributacao;
use App\Models\Usuario;
use App\Models\Funcionario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }



    public function getCategorias()
    {
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $categorias = DB::connection('empresa')->table('categorias')->get();
        return response()->json($categorias);
    }

    //Função para obter os dados do caixa       
    public function getCaixa(Request $request)
    {

        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $gestorX = env('GESTORX');


        $tables = [
            $idpharm => ['caixa'],
            $restgo => ['caixa'],
            $gestorX => ['caixa'],
        ];

        $caixa = DB::table($tables[$request->software_id][0] . ' as c')
            ->select(
                'c.caixa_id',
                'c.valor_venda'
            )
            ->where('c.status', 'aberto')
            ->orderBy('c.caixa_id', 'ASC')
            ->get();

        return response()->json(['success' => true, 'caixa' => $caixa]);
    }

    //Função para verificar se o caixa está aberto
    public function verificarStatusCaixa(Request $request)
    {

        $software_id = session('software_id');
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $flexityx = env('FLEXITYX');

        $tables = [
            $idpharm => ['caixa'],
            $restgo => ['caixa'],
            $flexityx => ['caixa'],
        ];



        try {
            $uid_empresa = session('uid_empresa');
            $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
            $this->databaseController->setEmpresaDatabaseConnection($empresa);
            $operador = session('id_usuario');
            $caixa = DB::table($tables[$software_id][0])
            ->where('status', 'aberto')
            ->where('usuario_abertura', $operador)
            ->first();
            if ($caixa) {
                return response()->json([
                    'success' => true,
                    'data' => $caixa,
                    'message' => 'O caixa foi aberto e está em uso!',
                    'redirect' => route('painel.index', ['page' => 'ponto-de-venda'])
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Caixa não está aberto!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    //Função para obter os turnos
    public function getTurnos()
    {
        $uid_empresa = session('uid_empresa');
        $software_id = session('software_id');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $tables = [
            $idpharm => ['turnos'],
            $restgo => ['turnos'],
            $trx => ['turnos'],
        ];

        $turnos = DB::table($tables[$software_id][0])->get();
        return response()->json(['success' => true, 'turnos' => $turnos]);
    }

    //Função para obter os caixas
    public function getCaixas()
    {
        $uid_empresa = session('uid_empresa');
        $software_id = session('software_id');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $tables = [
            $idpharm => ['caixas'],
            $restgo => ['caixas'],
            $trx => ['caixas'],
        ];

        $caixas = DB::table($tables[$software_id][0])->get();
        return response()->json(['success' => true, 'caixas' => $caixas]);
    }

    //Função para abrir o caixa
    public function abrirCaixa(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $software_id = session('software_id');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $tables = [
            $idpharm => ['caixa', 'funcionarios', 'caixa'],
            $restgo => ['caixa', 'funcionarios', 'caixa'],
            $trx => ['caixa', 'funcionarios', 'caixa'],
        ];




        $validated = $request->validate([
            'turno' => 'required|string',
            'caixa' => 'required|numeric',
            'valor_abertura' => 'nullable',
            'data_abertura' => 'required|date',
        ]);
        $validated['data_abertura'] = date('Y-m-d', strtotime($validated['data_abertura']));
        $validated['valor_abertura'] = str_replace(',', '.', $validated['valor_abertura']);
        if ($validated['valor_abertura'] == null) {
            $validated['valor_abertura'] = 0;
        }

        $status_caixa = DB::table($tables[$software_id][2])->where('caixa_id', $request->caixa)->where('status', 'aberto')->first();
        $operador = null;
        if ($status_caixa) {
            $operador = DB::table($tables[$software_id][1])->where('id', $status_caixa->usuario_abertura)->first();
            $operador = $operador->nome;
            return response()->json(['success' => false, 'message' => 'Caixa Nº ' . $status_caixa->caixa_id . ' já está aberto e em uso pelo operador: ' . $operador]);
        }
        try {
            DB::beginTransaction();
            $caixa = new Caixa();
            $caixa->setTable($tables[$software_id][0]);
            $caixa->caixa_id = $request->caixa;
            $caixa->usuario_abertura = $usuario_id;
            $caixa->turno = $request->turno;
            $caixa->data = $validated['data_abertura'];
            $caixa->status = 'aberto';
            $caixa->valor_abertura = $validated['valor_abertura'];
            $caixa->save();
            $caixa->refresh();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Caixa aberto com sucesso!', 'data' => $caixa, 'redirect' => route('painel.index', ['page' => 'ponto-de-venda'])]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
            DB::rollBack();
        }
    }

    public function fecharCaixa(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $software_id = session('software_id');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');

        $tables = [
            $idpharm => ['caixa', 'itens_venda'],
            $restgo => ['caixa', 'itens_venda'],
            $xread => ['caixa', 'itens_venda'],
        ];

        $validated = $request->validate([
            'caixa' => 'required|numeric',
            'valor_fechamento' => 'required|numeric',
            'observacao' => 'nullable|string',
        ]);

        // Verifica se o caixa existe
        $caixa = DB::table($tables[$software_id][0])
            ->where('caixa_id', $request->caixa)
            ->where('status', 'aberto')
            ->where('usuario_abertura', $usuario_id)
            ->first();

        if (!$caixa) {
            return response()->json(['success' => false, 'message' => 'Algo aconteceu de errado! Caixa não encontrado!'. $request->caixa."/".$usuario_id]);
        }

        try {
            DB::beginTransaction();
            $vendas = DB::table($tables[$software_id][1])
                ->where('usuario_id', $usuario_id)
                ->where('status', 'Pendente')
                ->get();

            if ($vendas->isNotEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossível fechar o caixa. Existem Itens de Venda pendentes! Por favor, verifique a lista de itens adicionados!'
                ]);
            }


            foreach ($vendas as $venda) {
                DB::table($tables[$software_id][1])
                    ->where('id', $venda->id)
                    ->update(['status' => 'Cancelado']);
            }

            // Atualiza o caixa diretamente via Query Builder
            DB::table($tables[$software_id][0])
                ->where('caixa_id', $request->caixa)
                ->where('status', 'aberto')
                ->where('usuario_abertura', $usuario_id)
                ->update([
                    'usuario_fechamento' => $usuario_id,
                    'data_fechamento' => now()->toDateTimeString(),
                    'status' => 'fechado',
                    'valor_fechamento' => $validated['valor_fechamento'],
                    'valor_quebra' => $caixa->total_venda + $caixa->valor_abertura > $validated['valor_fechamento'] ? $caixa->total_venda + $caixa->valor_abertura - $validated['valor_fechamento'] : 0,
                    'observacoes' => $request->observacao,
                ]);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Caixa fechado com sucesso!', 'redirect' => route('painel.index', ['page' => 'dashboard'])]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }



    //FUNÇÃO PARA FINALIZAR A VENDA NO DESKTOP
    public function vendaDinheiro(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');

        // Buscar a empresa
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();

        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);


        $validated = $request->validate([
            'nome_cliente' => 'nullable|string',
            'nuit' => 'nullable|string',
            'valor_recebido' => 'nullable|numeric',
            'metodo_pagamento' => 'required|numeric',
            'endereco' => 'nullable|string',
            'desconto' => 'nullable|numeric',
            'troco' => 'nullable',
            'total-venda-hidden' => 'nullable|numeric',
        ]);

        // Definir valores padrão se não informados
        if (empty($validated['valor_recebido'])) {
            $validated['valor_recebido'] = $validated['total-venda-hidden'];
        }
        $troco = 0;
        if (!empty($validated['troco'])) {
            $troco = str_replace(',', '.', $validated['troco']);
        }
        $validated['troco'] = $troco;



        $param = session('software_id');


        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $tables = [
            $idpharm => ['vendas', 'itens_venda', 'caixa', 'clientes', 'fatura_recibo'],
            $restgo => ['vendas', 'itens_venda', 'caixa', 'clientes', 'fatura_recibo'],
            $trx => ['vendas', 'itens_venda', 'caixa', 'clientes', 'fatura_recibo'],
        ];

        if (!isset($tables[$param])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido!']);
        }

        try {
            DB::beginTransaction();

            // Verificar se o caixa está aberto
            $caixa = new Caixa();
            $caixa->setTable($tables[$param][2]);
            $caixa = $caixa->select('*')
                ->where('usuario_abertura', $usuario_id)
                ->where('status', 'aberto')
                ->first();

            if (!$caixa) {
                return response()->json(['success' => false, 'message' => 'Caixa não está aberto!']);
            }


            // Verificar se há itens na venda
            $total = new ItensVenda();
            $total->setTable($tables[$param][1]);
            $total = $total->where('usuario_id', $usuario_id)
                ->whereNull('venda_id')
                ->sum('total');

            if ($total <= 0) {
                return response()->json(['success' => false, 'message' => 'Não há itens na venda!']);
            }

            // Definir valores de pagamento
            if ($validated['valor_recebido'] < $total) {
                return response()->json(['success' => false, 'message' => 'Valor recebido menor que o total da venda!']);
            }

            $valor_recebido = $validated['valor_recebido'];
            $desconto = $validated['desconto'] ?? 0;
            $troco = $validated['troco'] ?? 0;

            // Criar venda
            $venda = new Venda();
            $venda->setTable($tables[$param][0]);
            $venda->tipo = 'VD';
            $venda->total = $total;
            $venda->data_emissao = now();
            $venda->data_pagamento = now();
            $venda->usuario_id = $usuario_id;
            $venda->caixa_id = $caixa->id;
            $venda->status = 'Concluída';
            $venda->save();

            $faturaRecibo = new FaturaRecibo();
            $faturaRecibo->setTable($tables[$param][4]);
            $faturaRecibo->id_venda = $venda->id;
            $faturaRecibo->valor_recebido = $valor_recebido;
            $faturaRecibo->desconto = $desconto;
            $faturaRecibo->troco = $troco;
            $faturaRecibo->forma_pgto = $validated['metodo_pagamento'];
            $faturaRecibo->cliente = $validated['nome_cliente'];
            $faturaRecibo->nuit = $validated['nuit'];
            $faturaRecibo->endereco = $validated['endereco'];
            $faturaRecibo->save();

            // Atualizar itens da venda
            $itensVenda = new ItensVenda();
            $itensVenda->setTable($tables[$param][1]);
            $itensVenda->where('usuario_id', $usuario_id)
                ->whereNull('venda_id')
                ->update(['venda_id' => $venda->id, 'status' => 'Vendido']);

            // Atualizar caixa
            $caixa->increment('total_venda', $total);
            $caixa->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venda finalizada com sucesso!',
                'venda_id' => $venda->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao finalizar a venda!',
                'error' => $e->getMessage(),
            ]);
        }
    }






    //FUNÇÃO PARA FINALIZAR A VENDA PRAZO
    public function vendaPrazo(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');

        // Buscar a empresa
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();

        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);


        $validated = $request->validate([
            'id_cliente' => 'required|numeric',
            'nuit' => 'required|string',
            'endereco' => 'required|string',
            'total-venda-hidden' => 'required|numeric',
            'numero_parcelas' => 'nullable|numeric',
        ]);

        // Definir valores padrão se não informados
        if (empty($validated['numero_parcelas'])) {
            return response()->json(['success' => false, 'message' => 'Número de parcelas não informado!']);
        }



        $param = session('software_id');


        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $gestorX = env('GESTORX');

        $tables = [
            $idpharm => ['vendas', 'itens_venda', 'caixa', 'parcelas', 'faturas'],
            $restgo => ['vendas', 'itens_venda', 'caixa', 'parcelas', 'faturas'],
            $gestorX => ['vendas', 'itens_venda', 'caixa', 'parcelas', 'faturas'],
        ];

        if (!isset($tables[$param])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido!']);
        }

        try {
            DB::beginTransaction();

            // Verificar se o caixa está aberto
            $caixa = new Caixa();
            $caixa->setTable($tables[$param][2]);
            $caixa = $caixa->select('*')
                ->where('usuario_abertura', $usuario_id)
                ->where('status', 'aberto')
                ->first();

            if (!$caixa) {
                return response()->json(['success' => false, 'message' => 'Caixa não está aberto!']);
            }


            // Verificar se há itens na venda
            $total = new ItensVenda();
            $total->setTable($tables[$param][1]);
            $total = $total->where('usuario_id', $usuario_id)
                ->whereNull('venda_id')
                ->sum('total');

            if ($total <= 0) {
                return response()->json(['success' => false, 'message' => 'Não há itens na venda!']);
            }



            // Criar venda
            $venda = new Venda();
            $venda->setTable($tables[$param][0]);
            $venda->tipo = 'Fatura';
            $venda->total = $total;
            $venda->data_emissao = now();
            $venda->data_pagamento = now();
            $venda->usuario_id = $usuario_id;
            $venda->caixa_id = $caixa->id;
            $venda->status = 'Pendente';
            $venda->save();

            // Gerar as datas das parcelas
            $datasPagamentos = [];
            $data = new DateTime(now());

            for ($i = 0; $i < $validated['numero_parcelas']; $i++) {
                // Adiciona um mês
                $data->modify('+1 month');

                // Se cair no fim de semana, ajusta para segunda-feira
                if ($data->format('N') == 6) { // Sábado
                    $data->modify('+2 days');
                } elseif ($data->format('N') == 7) { // Domingo
                    $data->modify('+1 day');
                }

                // Salvar a data formatada no array
                $datasPagamentos[] = $data->format('Y-m-d');
            }

            // Atualizar itens da venda 

            $fatura = new Fatura(); // Criando um novo registro de conta a receber para cada parcela
            $fatura->setTable($tables[$param][4]);
            $fatura->venda_id = $venda->id;
            $fatura->cliente_id = $validated['id_cliente'];
            $fatura->valor_total = $total;
            $fatura->valor_restante = $total;
            $fatura->data_emissao = now();
            $fatura->data_vencimento = $datasPagamentos[$validated['numero_parcelas'] - 1];
            $fatura->status = 'Aberto';
            $fatura->save(); // Salva a conta no banco de dados

            for ($i = 0; $i < $validated['numero_parcelas']; $i++) {

                // Criando um novo registro de parcela para cada conta a receber
                $parcela = new Parcela();
                $parcela->setTable($tables[$param][3]);
                $parcela->fatura_id = $fatura->id;
                $parcela->numero = $i + 1; // Definindo o número da parcela corretamente
                $parcela->valor = $total / $validated['numero_parcelas']; // Divide o valor total entre as parcelas
                $parcela->data_vencimento = $datasPagamentos[$i];
                $parcela->status = 'Aberto';
                $parcela->save(); // Salva a parcela no banco de dados
            }




            // Atualizar itens da venda 
            $itensVenda = new ItensVenda();
            $itensVenda->setTable($tables[$param][1]);
            $itensVenda->where('usuario_id', $usuario_id)
                ->whereNull('venda_id')
                ->update(['venda_id' => $venda->id, 'status' => 'Vendido']);

            //Atualizar caixa
            $caixa->increment('total_venda_FT', $total);
            $caixa->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venda finalizada com sucesso!',
                'venda_id' => $venda->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao finalizar a venda!',
                'error' => $e->getMessage(),
            ]);
        }
    }



    //Função para gerar o recibo da venda
    public function printFaturaRecibo($id)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $param = session('software_id');

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');
        $tables = [
            $idpharm => ['vendas', 'itens_venda', 'produtos', 'config_empresa', 'usuarios', 'fatura_recibo', 'funcionarios'],
            $restgo => ['vendas', 'itens_venda', 'produtos', 'config_empresa', 'usuarios', 'fatura_recibo', 'funcionarios'],
            $trx => ['vendas', 'itens_venda', 'produtos', 'config_empresa', 'usuarios', 'fatura_recibo', 'funcionarios'],
        ];

        if (!isset($tables[$param])) {
            return redirect()->route('home')->with('error', 'Erro ao localizar o software.');
        }

        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();

        if (!$empresa) {
            return redirect()->route('home')->with('error', 'Empresa não encontrada.');
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        try {
            DB::beginTransaction();
            $dadosVendaForch = new Venda();
            $dadosVendaForch->setTable($tables[$param][0] . ' as vendas');
            $dadosVendaForch = $dadosVendaForch->select(
                'vendas.*',
                'iv.*',
                'fr.*',
                'p.nome as produto_nome'
            )
                ->join($tables[$param][1] . ' as iv', 'vendas.id', '=', 'iv.venda_id')
                ->join($tables[$param][2] . ' as p', 'iv.produto_id', '=', 'p.id')
                ->join($tables[$param][5] . ' as fr', 'vendas.id', '=', 'fr.id_venda')
                ->where('vendas.usuario_id', $usuario_id)
                ->where('vendas.id', $id)
                ->get();

            $dadosVenda = new Venda();
            $dadosVenda->setTable($tables[$param][0]);
            $dadosVenda = $dadosVenda->select(
                '*'
            )
                ->where('id', $id)
                ->first();
            $dadosVenda->status = $dadosVenda->status;
            $dadosVenda->date_on_update = $dadosVenda->date_on_update;
            $dadosVenda->usuario_id = $dadosVenda->usuario_id;
            $dadosVenda->total = $dadosVenda->total;

            $faturaRecibo = new FaturaRecibo();
            $faturaRecibo->setTable($tables[$param][5]);
            $faturaRecibo = $faturaRecibo->select(
                'valor_recebido',
                'desconto',
                'troco',
                'forma_pgto',
                'cliente',
                'nuit',
                'endereco'
            )
                ->where('id_venda', $id)
                ->first();
            $faturaRecibo->valor_recebido = $faturaRecibo->valor_recebido;
            $faturaRecibo->desconto = $faturaRecibo->desconto;
            $faturaRecibo->troco = $faturaRecibo->troco;
            $faturaRecibo->forma_pgto = $faturaRecibo->forma_pgto;
            $faturaRecibo->cliente = $faturaRecibo->cliente ?? 'Cliente não informado';
            $faturaRecibo->nuit = $faturaRecibo->nuit ?? 'NUIT não informada';
            $faturaRecibo->endereco = $faturaRecibo->endereco ?? 'Endereço não informado';




            //Calcular o valor do iva
            $itensVenda = new ItensVenda();
            $itensVenda->setTable($tables[$param][1]);
            $itensVenda = $itensVenda->select(
                'iva',
            )
                ->where('venda_id', $id)
                ->get();

            $iva_16 = true;
            foreach ($itensVenda as $item) {
                if ($item->iva == 1) {
                    $iva_16 = false;
                } else {
                    $iva_16 = false;
                }
            }
            $iva = $iva_16 ? '16%' : '0%';


            $dadosUsuario = new Funcionario();
            $dadosUsuario->setTable($tables[$param][6]);
            $dadosUsuario = $dadosUsuario->select(
                'nome'
            )
                ->where('id', session('id_usuario'))
                ->first();

            $dadosUsuario->nome = $dadosUsuario->nome;

            $dadosEmpresa = new ConfigEmpresa();
            $dadosEmpresa->setTable($tables[$param][3]);
            $dadosEmpresa = $dadosEmpresa->select(
                '*'
            )->first();

            $dadosEmpresa->endereco = $dadosEmpresa->endereco . ', ' . $dadosEmpresa->cidade . ' - ' . $dadosEmpresa->provincia;
            $dadosEmpresa->telefone = $dadosEmpresa->telefone_fixo . ' / ' . $dadosEmpresa->telefone_movel;
            $dadosEmpresa->email =  $dadosEmpresa->email;
            $dadosEmpresa->website =  $dadosEmpresa->website_url;
            $dadosEmpresa->nuit =  $dadosEmpresa->nuit;
            $dadosEmpresa->telefone =  $dadosEmpresa->telefone;
            $dadosEmpresa->nome_empresa =  $dadosEmpresa->nome_empresa;
            $dadosEmpresa->endereco =  $dadosEmpresa->endereco;
            $dadosEmpresa->provincia =  $dadosEmpresa->provincia;
            $dadosEmpresa->cidade =  $dadosEmpresa->cidade;
            $dadosEmpresa->email =  $dadosEmpresa->email;
            $dadosEmpresa->website =  $dadosEmpresa->website_url;
            DB::commit();
            return view('rel.vd', compact('dadosVendaForch', 'dadosVenda', 'dadosEmpresa', 'iva', 'dadosUsuario', 'faturaRecibo'));
        } catch (\Exception $e) {
            DB::rollBack();
            $error = 'Erro ao gerar o recibo da venda.' . $e->getMessage();
            return view('rel.vd', compact('error'));
        }
    }



    //Função para gerar o recibo da venda
    public function faturaVenda($id)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $param = session('software_id');

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $tables = [
            $idpharm => [
                'vendas_idpharm',
                'itens_venda',
                'produtos',
                'config_empresa',
                'usuarios',
                'regimes_tributacao',
                'faturas',
                'parcelas',
                'clientes',
                'modalidades_pag_fatura'
            ],
            $restgo => ['vendas', 'itens_venda', 'produtos', 'config_empresa', 'usuarios', 'regimes_tributacao', 'faturas', 'parcelas', 'clientes', 'modalidades_pag_fatura'],
            $trx => ['vendas', 'itens_venda', 'produtos', 'config_empresa', 'usuarios', 'regimes_tributacao', 'faturas', 'parcelas', 'clientes', 'modalidades_pag_fatura'],
        ];

        if (!isset($tables[$param])) {
            return redirect()->route('home')->with('error', 'Erro ao localizar o software.');
        }

        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();

        if (!$empresa) {
            return redirect()->route('home')->with('error', 'Empresa não encontrada.');
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        try {
            DB::beginTransaction();
            $dadosVendaForch = new Venda();
            $dadosVendaForch->setTable($tables[$param][0] . ' as vendas');
            $dadosVendaForch = $dadosVendaForch->select(
                'vendas.*',
                'iv.*',
                'p.nome as produto_nome'
            )
                ->join($tables[$param][1] . ' as iv', 'vendas.id', '=', 'iv.venda_id')
                ->join($tables[$param][2] . ' as p', 'iv.produto_id', '=', 'p.id')
                ->where('vendas.usuario_id', $usuario_id)
                ->where('vendas.id', $id)
                ->get();


            $itensVenda = new ItensVenda();
            $itensVenda->setTable($tables[$param][1]);
            $itensVenda = $itensVenda->select(
                'iva',
            )
                ->where('venda_id', $id)
                ->get();

            $iva_16 = true;
            foreach ($itensVenda as $item) {
                if ($item->iva == 1) {
                    $iva_16 = false;
                } else {
                    $iva_16 = false;
                }
            }
            $iva = $iva_16 ? '16%' : '0%';

            $fatura = new Fatura();
            $fatura->setTable($tables[$param][6]);
            $fatura = $fatura->select(
                '*'
            )
                ->where('venda_id', $id)
                ->first();
            $fatura->cliente_id = $fatura->cliente_id;
            $fatura->venda_id = $fatura->venda_id;
            $fatura->valor_total = $fatura->valor_total;
            $fatura->valor_restante = $fatura->valor_restante;
            $fatura->data_emissao = $fatura->data_emissao;
            $fatura->data_vencimento = $fatura->data_vencimento;
            $fatura->date_on_update = $fatura->date_on_update;
            $fatura->status = $fatura->status;


            $parcelas = new Parcela();
            $parcelas->setTable($tables[$param][7]);
            $parcelas = $parcelas->select(
                '*'
            )
                ->where('fatura_id', $fatura->id)
                ->get();

            $cliente = new Cliente();
            $cliente->setTable($tables[$param][8]);
            $cliente = $cliente->select(
                '*'
            )
                ->where('id', $fatura->cliente_id)
                ->first();
            $cliente->nome = $cliente->nome;
            $cliente->endereco = $cliente->endereco;
            $cliente->telefone = $cliente->telefone;
            $cliente->email = $cliente->email;
            $cliente->nuit = $cliente->nuit;

            $dadosUsuario = new Usuario();
            $dadosUsuario->setTable($tables[$param][4]);
            $dadosUsuario = $dadosUsuario->select(
                'nome',
                'id'
            )
                ->where('id', session('id_usuario'))
                ->first();
            $dadosUsuario->nome = $dadosUsuario->nome;

            $dadosEmpresa = new ConfigEmpresa();
            $dadosEmpresa->setTable($tables[$param][3]);
            $dadosEmpresa = $dadosEmpresa->select(
                '*'
            )->first();

            $regimeTributacao = new RegimeTributacao();
            $regimeTributacao->setTable($tables[$param][5]);
            $regimeTributacao = $regimeTributacao->select(
                '*'
            )->where('id', $dadosEmpresa->regime_tributacao_id)->first();

            $regimeTributacao->descricao = $regimeTributacao->nome == 'Isenção' ? 'Isenta de imposto conforme o Regime de Tributação Isenção vigente.' : ($regimeTributacao->nome == 'Simplificado' ? 'Isenta de imposto conforme o Regime de Tributação Simplificado vigente.' : '');

            $dadosEmpresa->endereco = $dadosEmpresa->endereco . ', ' . $dadosEmpresa->cidade . ' - ' . $dadosEmpresa->provincia;
            $dadosEmpresa->telefone = $dadosEmpresa->telefone_fixo . ' / ' . $dadosEmpresa->telefone_movel;
            $dadosEmpresa->email =  $dadosEmpresa->email;
            $dadosEmpresa->website =  $dadosEmpresa->website_url;
            $dadosEmpresa->nuit =  $dadosEmpresa->nuit;
            $dadosEmpresa->telefone =  $dadosEmpresa->telefone;
            $dadosEmpresa->nome_empresa =  $dadosEmpresa->nome_empresa;
            $dadosEmpresa->endereco =  $dadosEmpresa->endereco;
            $dadosEmpresa->provincia =  $dadosEmpresa->provincia;
            $dadosEmpresa->cidade =  $dadosEmpresa->cidade;
            $dadosEmpresa->email =  $dadosEmpresa->email;
            $dadosEmpresa->website =  $dadosEmpresa->website_url;

            $modalidadePag = new ModalidadePagFatura();
            $modalidadePag->setTable($tables[$param][9]);
            $modalidadePag = $modalidadePag->select(
                '*'
            )
                ->where('status', '=', 'ativo')
                ->get();




            DB::commit();
            return view('rel.fatura-venda', compact(
                'dadosVendaForch',
                'fatura',
                'cliente',
                'dadosUsuario',
                'dadosEmpresa',
                'iva',
                'parcelas',
                'regimeTributacao',
                'modalidadePag'
            ));
        } catch (\Exception $e) {
            DB::rollBack();
            $error = 'Erro ao gerar a fatura da venda.' . $e->getMessage();
            return view('rel.fatura-venda', compact('error'));
        }
    }






    public function getVendasFr(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $param = session('software_id');

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $tables = [
            $idpharm => ['vendas_idpharm'],
            $restgo => ['vendas_restgo'],
            $trx => ['vendas_trx'],
        ];

        if (!isset($tables[$param])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido!']);
        }

        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();

        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);


        $venda = new Venda();
        $venda->setTable($tables[$param][0]);  // Definir a tabela dinamicamente para a consulta
        // Obtém os parâmetros de DataTables
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $orderColumnIndex = $request->input('order.0.column', 0);
        $orderDir = $request->input('order.0.dir', 'asc');
        $searchValue = $request->input('search.value', '');

        $columns = ['id', 'data_emissao', 'total', 'status'];

        $query = $venda->select('id', 'data_emissao', 'total', 'status')
            ->where('usuario_id', $usuario_id)
            ->where('tipo', '=', 'VD');
        // Filtro de pesquisa
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('id', 'like', "%{$searchValue}%");
            });
        }

        // Total de registros filtrados
        $filteredRecords = $query->count();

        // Ordenação
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDir);
        }

        // Paginação
        $data = $query->skip($start)->take($length)->get();

        // Total de registros sem filtro
        $totalRecords = $venda->count();  // Usando a instância correta

        return response()->json([
            "draw" => (int) $request->input('draw'),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }

    public function getVendasFt(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $param = session('software_id');

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $tables = [
            $idpharm => ['vendas_idpharm'],
            $restgo => ['vendas_restgo'],
            $trx => ['vendas_trx'],
        ];

        if (!isset($tables[$param])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido!']);
        }

        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();

        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);


        $venda = new Venda();
        $venda->setTable($tables[$param][0]);  // Definir a tabela dinamicamente para a consulta
        // Obtém os parâmetros de DataTables
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $orderColumnIndex = $request->input('order.0.column', 0);
        $orderDir = $request->input('order.0.dir', 'asc');
        $searchValue = $request->input('search.value', '');

        $columns = ['id', 'data_emissao', 'total', 'status'];

        $query = $venda->select('id', 'data_emissao', 'total', 'status')
            ->where('usuario_id', $usuario_id)
            ->where('tipo', '=', 'Fatura');
        // Filtro de pesquisa
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('id', 'like', "%{$searchValue}%");
            });
        }

        // Total de registros filtrados
        $filteredRecords = $query->count();

        // Ordenação
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDir);
        }

        // Paginação
        $data = $query->skip($start)->take($length)->get();

        // Total de registros sem filtro
        $totalRecords = $venda->count();  // Usando a instância correta

        return response()->json([
            "draw" => (int) $request->input('draw'),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }





    // Cancelar Fatura Recibo
    public function cancelarFr(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $param = session('software_id');

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $gestorX = env('GESTORX');

        $tables = [
            $idpharm => ['vendas', 'itens_venda', 'produtos', 'ficha_estoque', 'caixa', 'compras'],
            $restgo => ['vendas', 'itens_venda', 'produtos', 'ficha_estoque', 'caixa', 'compras'],
            $gestorX => ['vendas', 'itens_venda', 'produtos', 'ficha_estoque', 'caixa', 'compras'],
        ];

        if (!isset($tables[$param])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido!']);
        }

        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();

        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        try {
            DB::beginTransaction();

            // Atualiza o status da venda para "Cancelado"
            $venda = DB::table($tables[$param][0])
                ->where('status', 'Concluída')
                ->where('usuario_id', $usuario_id)
                ->where('id', $request->id)
                ->first();

            if (!$venda) {
                return response()->json(['success' => false, 'message' => 'Impossível cancelar a Fatura Recibo, pois ela já foi cancelada!']);
            }

            DB::table($tables[$param][0])
                ->where('id', $venda->id)
                ->update(['status' => 'Cancelada']);

            // Busca os itens da venda
            $itensVenda = DB::table($tables[$param][1])
                ->where('venda_id', $request->id)
                ->where('usuario_id', $usuario_id)
                ->get();

            // Atualiza o status dos itens para "Cancelado"
            DB::table($tables[$param][1])
                ->where('venda_id', $request->id)
                ->update(['status' => 'Cancelado']);

            // Atualiza o caixa
            $caixa = DB::table($tables[$param][4])
                ->where('usuario_abertura', $usuario_id)
                ->where('id', $venda->caixa_id)
                ->first();

            if (!$caixa) {
                return response()->json(['success' => false, 'message' => 'Caixa não está aberto!']);
            }

            DB::table($tables[$param][4])
                ->where('id', $caixa->id)
                ->update(['total_venda' => $caixa->total_venda - $venda->total]);

            // Atualiza o estoque dos produtos
            foreach ($itensVenda as $item) {
                // Incrementa o estoque
                DB::table($tables[$param][2])
                    ->where('id', $item->produto_id)
                    ->increment('estoque', $item->quantidade);

                // Atualiza a ficha de estoque
                DB::table($tables[$param][3])
                    ->where('produto_id', $item->produto_id)
                    ->where('data', date('Y-m-d'))
                    ->update([
                        'venda' => DB::raw("venda - $item->quantidade"),
                        'stock' => DB::raw("stock + $item->quantidade")
                    ]);
                // Atualiza a compra
                DB::table($tables[$param][5])
                    ->where('id', $item->compra_id)
                    ->increment('stock_disponivel', $item->quantidade);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Fatura Recibo cancelada com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Erro ao cancelar a Fatura Recibo!', 'error' => $e->getMessage()]);
        }
    }

    //Cancelar Fatura

    public function cancelarFt(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $param = session('software_id');

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');

        $tables = [
            $idpharm => ['vendas', 'itens_venda', 'produtos', 'ficha_estoque', 'caixa', 'compras'],
            $restgo => ['vendas', 'itens_venda', 'produtos', 'ficha_estoque', 'caixa', 'compras'],
            $xread => ['vendas', 'itens_venda', 'produtos', 'ficha_estoque', 'caixa', 'compras'],
        ];

        if (!isset($tables[$param])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido!']);
        }

        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();

        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        try {
            DB::beginTransaction();

            // Atualiza o status da venda para "Cancelado"
            $venda = new Venda();
            $venda->setTable($tables[$param][0]);
            $venda = $venda->select('*')
                ->where('status', 'Pendente')
                ->where('usuario_id', $usuario_id)
                ->where('id', $request->id)
                ->first();
            if (!$venda) {
                return response()->json(['success' => false, 'message' => 'Impossível cancelar a Fatura, pois ela ja foi cancelada anteriormente!']);
            }
            $venda->update(['status' => 'Cancelada']);

            // Busca os itens da venda
            $itensVenda = DB::table($tables[$param][1])
                ->where('venda_id', $request->id)
                ->where('usuario_id', $usuario_id)
                ->get();

            // Atualiza o status dos itens para "Cancelado"
            DB::table($tables[$param][1])->where('venda_id', $request->id)->update(['status' => 'Cancelado']);

            // atualizar o caixa
            $caixa = DB::table($tables[$param][4])
                ->where('usuario_abertura', $usuario_id)
                ->where('id', $venda->caixa_id)
                ->first();
            if (!$caixa) {
                return response()->json(['success' => false, 'message' => 'Caixa não está aberto!']);
            }
            DB::table($tables[$param][4])
                ->where('id', $caixa->id)
                ->update(['total_venda_FT' => $caixa->total_venda_FT - $venda->total]);

            // Atualiza o estoque dos produtos
            foreach ($itensVenda as $item) {
                DB::table($tables[$param][2])
                    ->where('id', $item->produto_id)
                    ->increment('estoque', $item->quantidade);
                DB::table($tables[$param][3])
                    ->where('produto_id', $item->produto_id)
                    ->where('data', date('Y-m-d'))
                    ->decrement('venda', $item->quantidade);
                DB::table($tables[$param][5])
                    ->where('id', $item->compra_id)
                    ->increment('stock_disponivel', $item->quantidade);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Fatura cancelada com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Erro ao cancelar a Fatura!', 'error' => $e->getMessage()]);
        }
    }
}
