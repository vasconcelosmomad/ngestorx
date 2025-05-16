<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProdutoExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\DatabaseController;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pagamento;
use App\Models\NGestorConfig;
use App\Models\Empresa;
use App\Models\Plano;
use App\Models\Software;
use App\Models\Venda;
use App\Models\ItensVenda;
use App\Models\Usuario;
use App\Models\ConfigEmpresa;
use App\Models\ModalidadePagFatura;
use App\Models\Funcionario;
use App\Models\Caixa;
class ExportController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }
    public function catalodoProdutosExcel(Request $request)
    {
        $param = $request->param;
        $uid_empresa = session('uid_empresa');
        $mpresa = DB::table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($mpresa);

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');

        $table = [
            $idpharm => 'produtos',
            $restgo => 'produtos',
            $xread => 'produtos',
        ];

        $table = $table[$param];
        $hora = date('H_i');

        return Excel::download(new ProdutoExport($table, $this->databaseController), 'catalodo_produtos-' . $hora . '.xlsx');
    }

    public function catalodoProdutosPdf(Request $request)
    {
        $param = $request->param;
        $uid_empresa = session('uid_empresa');
        $mpresa = DB::table('empresas')->where('id', $uid_empresa)->first();
        $empresa = $this->databaseController->setEmpresaDatabaseConnection($mpresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');

        $table = [
            $idpharm => ['produtos', 'config_empresa'],
            $restgo => ['produtos', 'config_empresa'],
            $xread => ['produtos', 'config_empresa'],
        ];

        $table = $table[$param];

        $produtos = DB::table($table[0])->get();
        $dadosEmpresa = DB::table($table[1])->first();

        $dadosEmpresa->endereco = $dadosEmpresa->endereco;
        $dadosEmpresa->email = $dadosEmpresa->email;
        $dadosEmpresa->telefone = $dadosEmpresa->telefone_fixo . ' - ' . $dadosEmpresa->telefone_movel;
        $dadosEmpresa->nuit = $dadosEmpresa->nuit;
        $dadosEmpresa->website_url = $dadosEmpresa->website_url;
        $contador = 0;

        $pdf = PDF::loadView('rel.catalogo-produto', compact('produtos', 'dadosEmpresa', 'contador'));
        $hora = date('H_i');
        return $pdf->download('catalodo_produtos-' . $hora . '.pdf');
    }

    public function faturaPagamentoPdfDownload(Request $request)
    {
        $id = $request->id;
        $config = NGestorConfig::first();
        $pagamento = Pagamento::select('*')->where('id', $id)->first();
        $plano = Plano::select('*')->where('id', $pagamento->plano_id)->first();
        $empresa = Empresa::select('*')->where('id', $pagamento->empresa_id)->first();
        $software = Software::select('*')->where('id', $empresa->id_software)->first();


        $pdf = PDF::loadView('rel.fatura-licenca', compact('pagamento', 'config', 'empresa', 'software', 'plano'));
        return $pdf->download('fatura_licenca_' . $pagamento->id . '.pdf');
    }



    public function mapaVendas(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $usuario_id = session('id_usuario');
        $software_id = session('software_id');

        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        $tables = [
            env('IDPHARM') => [
                'vendas',
                'itens_venda',
                'produtos',
                'config_empresa',
                'funcionarios',
                'caixa'
            ],
            env('RESTGO') => [
                'vendas',
                'itens_venda',
                'produtos',
                'config_empresa',
                'funcionarios',
                'caixa'
            ],
            env('TRX') => [
                'vendas',
                'itens_venda',
                'produtos',
                'config_empresa',
                'funcionarios',
                'caixa'
            ],
        ];
        

        $validated = $request->validate([
            'data_inicial' => 'required|date',
            'data_final' => 'required|date',
        ]);
   
        $data_inicial = date('Y-m-d', strtotime($validated['data_inicial']));
        $data_final = date('Y-m-d', strtotime($validated['data_final']));
      
        


            // Configurar conexão com o banco de dados da empresa
            $dadosVendaForch = new Venda();
            $dadosVendaForch->setTable($tables[$software_id][0] . ' as vendas');
            $dadosVendaForch = $dadosVendaForch->select(
                'p.nome as produto_nome',
                DB::raw('vendas.id as id_venda'),
                DB::raw('SUM(iv.quantidade) as quantidade_total'),
                DB::raw('SUM(iv.total) as valor_total'),
                DB::raw('AVG(iv.pu) as pu'),
                DB::raw('MIN(vendas.data_emissao) as primeira_venda'),
                DB::raw('MAX(vendas.data_emissao) as ultima_venda')
            )
                ->join($tables[$software_id][1] . ' as iv', 'vendas.id', '=', 'iv.venda_id')
                ->join($tables[$software_id][2] . ' as p', 'iv.produto_id', '=', 'p.id')
                ->where('vendas.usuario_id', $usuario_id)
                ->where('vendas.data_emissao', '>=', $data_inicial)
                ->where('vendas.data_emissao', '<=', $data_final)
                ->where('vendas.status', '!=', 'Cancelada')
                ->where('vendas.tipo', 'VD')
                ->groupBy('p.nome')
                ->groupBy('vendas.id')
                ->get();

              
                $dadosUsuario = new Funcionario();
                $dadosUsuario->setTable($tables[$software_id][4]);
                $dadosUsuario = $dadosUsuario->select(
                    'nome'
                )
                    ->where('id', session('id_usuario'))
                    ->first();
    
                $dadosUsuario->nome = $dadosUsuario->nome;

                $dadosCaixa = new Caixa();
                $dadosCaixa->setTable($tables[$software_id][5]);
                $dadosCaixa = $dadosCaixa->select('*')
                ->where('data', '>=', $data_inicial)
                ->where('data', '<=', $data_final)
                ->where('usuario_abertura', $usuario_id)
                ->get();

                $dado_empresa = new ConfigEmpresa();
                $dado_empresa->setTable($tables[$software_id][3] . ' as e');
                $dado_empresa = $dado_empresa->select('*')->first();
                $data_inicial = date('d/m/Y', strtotime($data_inicial));
                $data_final = date('d/m/Y', strtotime($data_final));


                
                    //Gerar o PDF
                    $pdf = PDF::loadView('rel.produtos-vendidos', compact('dadosVendaForch', 'data_inicial', 'data_final', 'dado_empresa', 'dadosUsuario', 'dadosCaixa'));
                    $hora = date('d-m-Y_H-i');
        
                    return $pdf->download("rel-produtos-vendidos-{$hora}.pdf");
                

            
       
    }
}
