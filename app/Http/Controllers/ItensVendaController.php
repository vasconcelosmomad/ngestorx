<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DatabaseController;
use App\Models\EstoqueDiario;
use App\Models\FichaEstoque;
use App\Models\ItensVenda;
use App\Models\Compras;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ItensVendaController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }

    public function getItensVenda(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        // $software_id = session('software_id');
        $usuario_id = session('id_usuario');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $bizmorph = env('BIZMORPH');

        $param = session('software_id');
        $tables = [
            $idpharm => ['itens_venda', 'produtos'],
            $restgo => ['itens_venda', 'produtos'],
            $bizmorph => ['itens_venda', 'produtos'],
        ];

        $itensVenda = DB::table($tables[$param][0] . ' as iv')
            ->join($tables[$param][1] . ' as p', 'iv.produto_id', '=', 'p.id')
            ->select(
                'iv.data',
                'iv.id',
                'iv.compra_id',
                'iv.produto_id',
                'iv.quantidade',
                'iv.pu',
                'iv.total',
                'p.nome as nome_produto'
            )
            ->where('iv.usuario_id', $usuario_id)
            ->whereNull('iv.venda_id')
            ->orderBy('iv.id', 'ASC')
            ->get();

        return response()->json(['success' => true, 'itensVenda' => $itensVenda]);
    }

    // FUNÇÃO PARA REMOVER ITEM DE VENDA
    public function removerItemVenda(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');

        // Captura os parâmetros da requisição
        $table = session('software_id');
        $id_item = $request->input('id');

        // Validação inicial
        if (!$table || !$id_item) {
            return response()->json(['success' => false, 'message' => 'Dados inválidos fornecidos!']);
        }

        // Mapeia as tabelas correspondentes
        $tables = [
            $idpharm => ['produtos', 'itens_venda', 'compras', 'ficha_estoque'],
            $restgo => ['produtos', 'itens_venda', 'compras', 'ficha_estoque'],
            $xread => ['produtos', 'itens_venda', 'compras', 'ficha_estoque']
        ];

        if (!isset($tables[$table])) {
            return response()->json(['success' => false, 'message' => 'Código inválido fornecido!']);
        }

        [$table_produto, $table_itens_venda, $table_compras, $table_ficha_estoque] = $tables[$table];

        // Obtém a empresa
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada!']);
        }

        // Configura a conexão da empresa
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        try {
            DB::beginTransaction();

            // Busca a compra associada
            $item = DB::table($table_itens_venda)
                ->where('id', $id_item)
                ->select('id', 'produto_id', 'quantidade', 'compra_id')
                ->first();

            if (!$item) {
                throw new \Exception('ID do item não encontrado!');
            }

            

            // Atualiza o estoque disponível da compra
            DB::table($table_compras)
                ->where('id', $item->compra_id)
                ->increment('stock_disponivel', $item->quantidade);

            // Busca o produto real
            $produto = DB::table($table_produto)
                ->where('id', $item->produto_id)
                ->first();

            if (!$produto) {
                throw new \Exception('Produto não encontrado!');
            }

            // Atualiza o estoque do produto
            DB::table($table_produto)
                ->where('id', $item->produto_id)
                ->increment('estoque', $item->quantidade);

          

           

            //Atualiza a ficha de estoque
            DB::table($table_ficha_estoque)
                ->updateOrInsert(
                    ['produto_id' => $item->produto_id, 'data' => date('Y-m-d')],
                    [
                        'venda' => DB::raw("venda - $item->quantidade"),
                        'stock' => $produto->estoque + $item->quantidade,
                        'usuario' => session('id_usuario'),
                        'entrada' => 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );

          // Verifica se o item de venda já existe
          DB::table($table_itens_venda)
          ->where('id', $item->id)
          ->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Removido {$item->quantidade} unidade(s) de {$produto->nome} da lista e devolvido ao estoque!",
                'produto' => $produto
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao remover o produto!',
                'error' => $e->getMessage()
            ]);
        }
    }
}
