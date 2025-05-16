<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DatabaseController;
use App\Models\AlertaVencimento;
use App\Models\Compras;
use App\Models\EstoqueDiario;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use App\Models\FichaEstoque;
use App\Models\Inventario;
use App\Models\ItensVenda;
use Illuminate\Support\Str;
use DateTime;

class ProdutoController extends Controller
{
    protected $databaseController;

    public function __construct(DatabaseController $databaseController)
    {
        $this->databaseController = $databaseController;
    }

    public function produtos(Request $request)
    {
        $uid_empresa = session('uid_empresa');

        if (!$uid_empresa) {
            return response()->json([
                "success" => false,
                "message" => "Usuário não está associado a uma empresa."
            ]);
        }

        $param = $request->input('param');
        $tables = [
            '890' => 'produtos',
            '888' => 'produtos',
            '889' => 'produtos',
        ];

        // Verifica se o código fornecido é válido
        if (!isset($tables[$param])) {
            return response()->json([
                "success" => false,
                "message" => "Código inválido fornecido!"
            ]);
        }

        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada']);
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        // Definir a tabela dinamicamente
        $table_Produto = $tables[$param];

        $produto = new Produto();
        $produto->setTable($table_Produto);  // Definir a tabela dinamicamente para a consulta
        // Obtém os parâmetros de DataTables
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $orderColumnIndex = $request->input('order.0.column', 0);
        $orderDir = $request->input('order.0.dir', 'asc');
        $searchValue = $request->input('search.value', '');

        $columns = ['id', 'codigo', 'nome', 'compra', 'venda', 'estoque', 'estoque_mini', 'estoque_maxi', 'status'];

        $query = $produto->select('id', 'codigo', 'nome', 'compra', 'venda', 'estoque', 'estoque_mini', 'estoque_maxi', 'status');

        // Filtro de pesquisa
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('nome', 'like', "%{$searchValue}%")
                    ->orWhere('compra', 'like', "%{$searchValue}%")
                    ->orWhere('venda', 'like', "%{$searchValue}%");
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
        $totalRecords = $produto->count();  // Usando a instância correta

        return response()->json([
            "draw" => (int) $request->input('draw'),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }
    public function produtosPdv(Request $request)
    {
        $uid_empresa = session('uid_empresa');

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');
        $param = session('software_id');
        $tables = [
            $idpharm => ['produtos', 'categorias', 'compras'],
            $restgo => ['produtos', 'categorias', 'compras'],
            $xread => ['produtos', 'categorias', 'compras'],
        ];
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        if (!isset($tables[$param])) {
            return response()->json([
                "success" => false,
                "message" => "Código inválido fornecido!"
            ]);
        }

        // Obtém os parâmetros de DataTables
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $orderColumnIndex = $request->input('order.0.column', 0);
        $orderDir = $request->input('order.0.dir', 'asc');
        $searchValue = $request->input('search.value', '');

        $tabelaCompras = $tables[$param][2];
        $tabelaProdutos = $tables[$param][0];
        $tabelaCategorias = $tables[$param][1];

        $columns = ['nome', 'lote', 'data_compra', 'estoque_disponivel', 'preco_venda'];

        $query = DB::table($tabelaProdutos . ' as p')
            ->join($tabelaCategorias . ' as c', 'p.categoria_id', '=', 'c.id')
            ->join($tabelaCompras . ' as compras', 'p.id', '=', 'compras.produto_id')
            ->select(
                'p.nome as nome',
                'p.codigo',
                'compras.id as id_compra',
                'compras.lote as lote',
                'compras.data_compra as data_compra',
                'compras.stock_disponivel as estoque_disponivel',
                'compras.preco_venda as preco_venda',
                'c.descricao as descricao',
                'c.nome as nome_categoria'
            )
            ->where('compras.stock_disponivel', '>', 0)
            ->orderBy('compras.data_compra', 'asc');

        // Filtro de pesquisa
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('p.nome', 'like', "%{$searchValue}%");
            });
        }

        // Total de registros sem filtro
        $totalRecords = DB::table($tabelaCompras)->count();

        // Total de registros filtrados
        $filteredRecords = $query->count();

        // Ordenação
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDir);
        }

        // Paginação
        $data = $query->skip($start)->take($length)->get();

        return response()->json([
            "draw" => (int) $request->input('draw'),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }

    public function addProdutoPDV(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');
    
        // Captura os parâmetros da requisição
        $table = session('software_id');
        $id_compra = $request->input('id_compra');
        $quantidade = (int) $request->input('quantidade');
    
        // Validação inicial
        if (!$table || !$id_compra || $quantidade <= 0) {
            return response()->json(['success' => false, 'message' => 'Dados inválidos fornecidos!'.$table.'/'.$id_compra.'/'.$quantidade]);
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
            $compra = DB::table($table_compras)
                ->where('id', $id_compra)
                ->select('id', 'produto_id', 'stock_disponivel', 'preco_venda')
                ->first();
    
            if (!$compra) {
                throw new \Exception('ID do produto não encontrado!');
            }
    
            // Verifica se há estoque disponível
            if ($compra->stock_disponivel < $quantidade) {
                throw new \Exception('Estoque insuficiente! ' . $compra->stock_disponivel . ' unidades disponíveis');
            }
    
            // Atualiza o estoque disponível da compra
            DB::table($table_compras)
                ->where('id', $id_compra)
                ->decrement('stock_disponivel', $quantidade);
    
            // Busca o produto real
            $produto = DB::table($table_produto)
                ->where('id', $compra->produto_id)
                ->first();
    
            if (!$produto) {
                throw new \Exception('Produto não encontrado!');
            }
    
            // Atualiza o estoque do produto
            DB::table($table_produto)
                ->where('id', $compra->produto_id)
                ->decrement('estoque', $quantidade);
    
            // Verifica se o item de venda já existe
            $itensVenda = DB::table($table_itens_venda)
                ->where('produto_id', $compra->produto_id)
                ->where('usuario_id', session('id_usuario'))
                ->where('status', 'Pendente')
                ->first();
    
            if ($itensVenda) {
                DB::table($table_itens_venda)
                    ->where('id', $itensVenda->id)
                    ->update([
                        'quantidade' => DB::raw("quantidade + $quantidade"),
                        'total' => DB::raw("pu * (quantidade + $quantidade)")
                    ]);
            } else {
                DB::table($table_itens_venda)->insert([
                    'produto_id' => $compra->produto_id,
                    'compra_id' => $compra->id,
                    'iva' => $produto->iva_id,
                    'pu' => $compra->preco_venda,
                    'quantidade' => $quantidade,
                    'total' => $compra->preco_venda * $quantidade,
                    'usuario_id' => session('id_usuario'),
                    'data' => date('Y-m-d'),
                    'status' => 'Pendente'
                ]);
            }
    
            // Atualiza ou insere na ficha de estoque
            $ficha_estoque = DB::table($table_ficha_estoque)
                ->where('produto_id', $compra->produto_id)
                ->where('data', date('Y-m-d'))
                ->first();

            if ($ficha_estoque) {
                DB::table($table_ficha_estoque)
                    ->where('id', $ficha_estoque->id)
                    ->update([
                        'stock' => DB::raw("stock - $quantidade"),
                        'venda' => DB::raw("venda + $quantidade"),
                        'usuario' => session('id_usuario'),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
            } else {
                DB::table($table_ficha_estoque)->insert([
                    'produto_id' => $compra->produto_id,
                    'stock' => $compra->stock_disponivel,
                    'venda' => $quantidade,
                    'usuario' => session('id_usuario'),
                    'data' => date('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => "$quantidade unidade(s) de {$produto->nome} adicionada(s) a itens de venda!",
                'produto' => $produto
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao adicionar o produto!',
                'error' => $e->getMessage()
            ]);
        }
    }
    

    //Função para obter os dados das categorias
    public function getCategorias()
    {
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $categorias = DB::connection('empresa')->table('categorias')->get();
        return response()->json($categorias);
    }

    //Função para obter os alertas de vencimento
    public function alertaVencimento(Request $request)
    {
        $diasAntes = 90;
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $bizmorph = env('BIZMORPH');

        $param = $request->input('param');
        $tables = [
            $idpharm => ['alerta_vencimentos', 'produtos'],
            $restgo => ['alerta_vencimentos', 'produtos'],
            $bizmorph => ['alerta_vencimentos', 'produtos'],
        ];

        $alertas = DB::table($tables[$param][0] . ' as av')
            ->join($tables[$param][1] . ' as p', 'av.produto_id', '=', 'p.id')
            ->select(
                'av.data_vencimento',
                'av.data_alerta',
                'av.data_entrada',
                'av.lote',
                'p.nome as nome_produto'
            )
            ->where('av.data_vencimento', '<=', date('Y-m-d', strtotime('+' . $diasAntes . ' days')))
            ->orderBy('av.data_vencimento', 'ASC')
            ->get();

        return response()->json(['success' => true, 'alertas' => $alertas]);
    }

    public function fichaEstoque(Request $request)
    {
        $tables = [
            $idpharm => ['ficha_estoque', 'produtos', 'estoques_diario'],
            $restgo => ['ficha_estoque', 'produtos', 'estoques_diario'],
            $bizmorph => ['ficha_estoque', 'produtos', 'estoques_diario'],
        ];

        $param = $request->input('param');
        if (!isset($tables[$param])) {
            return response()->json(['error' => 'Parâmetro inválido'], 400);
        }

        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $orderColumnIndex = $request->input('order.0.column', 0);
        $orderDir = $request->input('order.0.dir', 'asc');
        $searchValue = $request->input('search.value', '');

        $columns = ['data', 'nome_produto', 'entrada', 'venda', 'ajusteP', 'ajusteN', 'estoque'];

        $query = DB::table($tables[$param][0] . ' as fe')
            ->join($tables[$param][1] . ' as p', 'fe.produto_id', '=', 'p.id')
            ->join($tables[$param][2] . ' as ed', function ($join) {
                $join->on('fe.produto_id', '=', 'ed.produto_id')
                    ->on('fe.data', '=', 'ed.data');
            })
            ->select(
                'fe.data as data',
                'p.nome as nome_produto',
                DB::raw('SUM(fe.entrada) as total_entrada'),
                DB::raw('SUM(fe.venda) as total_venda'),
                DB::raw('SUM(fe.ajusteP) as total_ajusteP'),
                DB::raw('SUM(fe.ajusteN) as total_ajusteN'),
                'ed.estoque as estoque_atual'
            )
            ->groupBy('fe.data', 'p.nome', 'ed.estoque');

        // Total de registros sem filtros
        $totalRecords = DB::table($tables[$param][0])->count();

        // Filtros
        // Filtros
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('p.nome', 'like', '%' . e($searchValue) . '%');

                // Verifica se a entrada do usuário pode ser interpretada como uma data
                if (strtotime($searchValue)) {
                    $query->orWhereDate('fe.data', '=', date('Y-m-d', strtotime(e($searchValue))));
                }
            });
        }



        // Total de registros filtrados
        $filteredRecords = $query->count();

        // Ordenação e Paginação
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDir);
        }
        $data = $query->skip($start)->take($length)->get();

        return response()->json([
            "success" => true,
            "draw" => (int) $request->input('draw'),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }



    //Função para obter os dados do IVA
    public function getIVA()
    {
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $iva = DB::connection('empresa')->table('iva')->get();
        return response()->json($iva);
    }
    //Função para obter os dados dos fornecedores
    public function getFornecedores()
    {
        $uid_empresa = session('uid_empresa');
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');
        $param = session('software_id');
        $tables = [
            $idpharm => 'fornecedores_idpharm',
            $restgo => 'fornecedores_restgo',
            $xread => 'fornecedores_xread',
        ];
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $fornecedores = DB::connection('empresa')->table($tables[$param])->get();
        return response()->json($fornecedores);
    }

    //Função para criar um novo produto
    public function novoProduto(Request $request)
    {
        // Pega o 'uid_empresa' da sessão

        $uid_empresa = session('uid_empresa');

        if (!$uid_empresa) {
            return response()->json([
                "success" => false,
                "message" => "Usuário não está associado a uma empresa."
            ]);
        }
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $param = session('software_id');
        $tables = [
            $idpharm => 'produtos',
            $restgo => 'produtos',
            $trx => 'produtos',
        ];

        // Obtém a empresa e conecta ao banco de dados da empresa
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada']);
        }

        $this->databaseController->setEmpresaDatabaseConnection($empresa);


        // Criação do novo produto
        $produto = new Produto();
        $produto->setTable($tables[$param]);  // Configura a tabela

        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255',
            'nome' => 'required|string|max:255',
            'venda' => 'required|numeric',
            'iva_id' => 'required|exists:iva,id',  // Certifique-se que o IVA existe no banco
            'estoque_mini' => 'required|integer',
            'estoque_maxi' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',  // Certifique-se que a categoria existe no banco
            'descricao' => 'required|string|max:500',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Verifica se o produto já existe
        $produtoExiste = $produto->where('codigo', $validatedData['codigo'])->first();
        if ($produtoExiste) {
            return response()->json(['success' => false, 'message' => 'Produto com o código ' . $validatedData['codigo'] . ' já existe']);
        }

        // Atribuição dos valores validados aos campos do produto
        $produto->codigo = $validatedData['codigo'];
        $produto->nome = $validatedData['nome'];
        $produto->venda = $validatedData['venda'];
        $produto->iva_id = $validatedData['iva_id'];
        $produto->estoque_mini = $validatedData['estoque_mini'];
        $produto->estoque_maxi = $validatedData['estoque_maxi'];
        $produto->categoria_id = $validatedData['categoria_id'];
        $produto->descricao = $validatedData['descricao'] ?? ''; // Caso o campo descricao não seja enviado

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Gera um nome único para a imagem
            $imageName = time() . '.' . $request->imagem->extension();

            // Armazena a imagem na pasta public/assets/images/products dentro do disco 'public'
            $request->imagem->storeAs('assets/images/products', $imageName, 'public');

            // Atribui o caminho relativo da imagem no banco de dados
            $produto->imagem =  $imageName;  // O caminho será 'storage/assets/images/products/{imageName}'
        }


        // Salvar o produto no banco
        DB::beginTransaction();
        try {
            $produto->save();
            DB::commit(); // Commit da transação

            return response()->json([
                'success' => true,
                'message' => 'Produto salvo com sucesso!',
                'produto' => $produto
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback em caso de erro
            return response()->json(['success' => false, 'message' => 'Erro ao salvar o produto']);
        }
    }

    //FUNÇÃO PARA OBTER OS DADOS DO PRODUTO
    public function getDadosProduto(Request $request)
    {
        //Validação dos dados recebidos
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'param' => 'required|in:890,888,889',

        ]);

        $tables = [
            '890' => 'produtos',
            '888' => 'produtos',
            '889' => 'produtos',
        ];
        $table_Produto = $tables[$validatedData['param']];
        //Obtem os dados e se conectar ao banco de dados da empresa
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);
        $produto = DB::connection('empresa')->table($table_Produto)->where('id', $validatedData['id'])->first();
        //verifica se o produto existe
        if (!$produto) {
            return response()->json(['success' => false, 'message' => 'Produto não encontrado']);
        }
        //retorna os dados do produto
        $categorias =  $this->getCategorias();
        $ivas =  $this->getIVA();
        return response()->json(['success' => true, 'produto' => $produto, 'categorias' => $categorias, 'ivas' => $ivas]);
    }


    //FUNÇÃO PARA EDITAR PRODUTO
    public function editarProduto(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'id_edicao' => 'required|integer',
            'codigo_edicao' => 'required|string|max:255',
            'nome_edicao' => 'required|string|max:255',
            'venda_edicao' => 'required|numeric',
            'iva_id_edicao' => 'required|exists:iva,id',
            'estoque_mini_edicao' => 'required|integer',
            'estoque_maxi_edicao' => 'required|integer',
            'categoria_id_edicao' => 'required|exists:categorias,id',
            'descricao_edicao' => 'required|string|max:500',
            'imagem_edicao' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $software_id = session('software_id');
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');
        $models = [
            $idpharm => 'produtos',
            $restgo => 'produtos',
            $trx => 'produtos',
        ];

        if (!isset($models[$software_id])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido.']);
        }

        $model = $models[$software_id];
        $tabela = new Produto();
        $tabela->setTable($model);

        $produto = $tabela->find($validatedData['id_edicao']);

        if (!$produto) {
            return response()->json(['success' => false, 'message' => 'Produto não encontrado']);
        }

        // Verificar se houve alteração nos dados
        $dadosAlterados = false;

        if (
            $produto->codigo != $validatedData['codigo_edicao'] ||
            $produto->nome != $validatedData['nome_edicao'] ||
            (float) $produto->venda != (float) $validatedData['venda_edicao'] || // Garante que valores numéricos sejam comparados corretamente
            (int) $produto->iva_id != (int) $validatedData['iva_id_edicao'] ||
            (int) $produto->estoque_mini != (int) $validatedData['estoque_mini_edicao'] ||
            (int) $produto->estoque_maxi != (int) $validatedData['estoque_maxi_edicao'] ||
            (int) $produto->categoria_id != (int) $validatedData['categoria_id_edicao'] ||
            trim($produto->descricao) !== trim($validatedData['descricao_edicao']) // Remove espaços extras para evitar falsos negativos
        ) {
            $dadosAlterados = true;
        }

        // Verificar alteração na imagem
        if ($request->hasFile('imagem_edicao') && $request->file('imagem_edicao')->isValid()) {
            $novaImagem = time() . '.' . $request->imagem_edicao->extension();
            $caminhoAntigo = public_path('storage/assets/images/products/' . $produto->imagem);

            if ($produto->imagem && $produto->imagem !== 'sem-img.png' && file_exists($caminhoAntigo)) {
                unlink($caminhoAntigo); // Remove a imagem antiga
            }

            $request->imagem_edicao->storeAs('assets/images/products', $novaImagem, 'public');
            $produto->imagem = $novaImagem;

            $dadosAlterados = true;
        }

        if (!$dadosAlterados) {
            return response()->json(['success' => false, 'message' => 'Nenhum dado foi modificado.']);
        }

        // Atualiza os campos do produto
        $produto->codigo = $validatedData['codigo_edicao'];
        $produto->nome = $validatedData['nome_edicao'];
        $produto->venda = $validatedData['venda_edicao'];
        $produto->iva_id = $validatedData['iva_id_edicao'];
        $produto->estoque_mini = $validatedData['estoque_mini_edicao'];
        $produto->estoque_maxi = $validatedData['estoque_maxi_edicao'];
        $produto->categoria_id = $validatedData['categoria_id_edicao'];
        $produto->descricao = $validatedData['descricao_edicao'];

        DB::beginTransaction();
        try {
            $produto->save();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Dados do produto atualizados com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Erro ao atualizar o produto', 'error' => $e->getMessage()]);
        }
    }



    public function alterarStatusProduto(Request $request)
    {
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        $validatedData = $request->validate([
            'id' => 'required|integer'
        ]);

        $software_id = session('software_id');
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');
        $models = [
            $idpharm => 'produtos',
            $restgo => 'produtos',
            $trx => 'produtos',
        ];

        $table = $models[$software_id];

        // Criar uma instância do modelo genérico e definir a tabela
        $produtoModel = new Produto();
        $produtoModel->setTable($table);

        // Buscar o produto pelo ID
        $produto = $produtoModel->find($validatedData['id']);

        if (!$produto) {
            return response()->json(['success' => false, 'message' => 'Produto não encontrado']);
        }

        // Alternar o status do produto
        $produto->status = $produto->status === 'Ativo' ? 'Inativo' : 'Ativo';

        DB::beginTransaction();
        try {
            // Salvar as alterações
            $produto->save();
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Status do produto atualizado com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Erro ao atualizar o status do produto', 'error' => $e->getMessage()]);
        }
    }




    //FUNÇÃO PARA DAR ENTRADA DE PRODUTO
    public function entradaProduto(Request $request)
    {
        $data = date('Y-m-d');
        $uid_empresa = session('uid_empresa');
        $software_id = session('software_id');

        // Recupera os dados da empresa e configura a conexão
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        // Validação dos dados recebidos
        $data_validade = date('Y-m-d', strtotime($request->input('prazo-validade')));
        $validatedData = $request->validate([
            'id_produto_entrada' => 'required|integer',
            'fornecedor' => 'required|integer|nullable',
            'prazo-validade' => 'nullable|date',
            'valorDeCompra' => 'required|numeric',
            'quantidade' => 'required|integer',
            'totalDaCompra' => 'required|numeric',
            'numeroGuia' => 'required|string',
            'lote' => 'required|string',
        ]);

        $id_pharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');
        //Mapear os parametros para as tabelas
        $tables = [
            $id_pharm => [
                'produtos',
                'compras',
                'estoques_diario',
                'ficha_estoque',
                'alerta_vencimentos',
            ],
            $restgo => [
                'produtos',
                'compras',
                'estoques_diario',
                'ficha_estoque',
                'alerta_vencimentos',
            ],
            $trx => [
                'produtos',
                'compras',
                'estoques_diario',
                'ficha_estoque',
                'alerta_vencimentos',
            ],
        ];


        if (!isset($tables[$software_id])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido']);
        }

        $tableConfig = $tables[$software_id];
        $produtoModel = new Produto();
        $produtoModel->setTable($tableConfig[0]);

        // Busca o produto pelo ID
        $produto = $produtoModel->find($validatedData['id_produto_entrada']);
        if (!$produto) {
            return response()->json(['success' => false, 'message' => 'Produto não encontrado']);
        }

        // Verifica estoque diário
        $estoqueDiarioModel = new EstoqueDiario();
        $estoqueDiarioModel->setTable($tableConfig[2]);
        $estoqueDiario = $estoqueDiarioModel
            ->where('produto_id', $produto->id)
            ->where('data', $data)
            ->first();

        DB::beginTransaction();
        try {
            // Atualiza o estoque do produto
            $produto->estoque += $validatedData['quantidade'];
            $produto->save();

            // Atualiza ou cria estoque diário
            $novo_estoque = $produto->estoque;
            if ($estoqueDiario) {

                $estoqueDiario->estoque = $novo_estoque;
                $estoqueDiario->save();
            } else {
                $estoqueDiarioModel->create([
                    'produto_id' => $produto->id,
                    'estoque' => $novo_estoque,
                    'data' => $data,
                ]);
            }

            // Insere compra
            $comprasModel = new Compras();
            $comprasModel->setTable($tableConfig[1]);
            $comprasModel->create([
                'produto_id' => $produto->id,
                'preco' => $validatedData['valorDeCompra'],
                'quantidade' => $validatedData['quantidade'],
                'total' => $validatedData['totalDaCompra'],
                'data' => $data,
                'usuario' => session('id_usuario'),
                'fornecedor' => $validatedData['fornecedor'],
            ]);

            // Insere alerta de vencimento
            $alertaVencimentoModel = new AlertaVencimento();
            $alertaVencimentoModel->setTable($tableConfig[4]);
            $alertaVencimentoModel->create([
                'produto_id' => $produto->id,
                'quantidade' => $validatedData['quantidade'],
                'lote' => $validatedData['lote'],
                'num_guia' => $validatedData['numeroGuia'],
                'data_entrada' => $data,
                'data_vencimento' => $data_validade,
                'data_alerta' => $alertaVencimentoModel->getAlertaVencimento($data_validade),
            ]);

            // Insere ficha de estoque
            $fichaEstoqueModel = new FichaEstoque();
            $fichaEstoqueModel->setTable($tableConfig[3]);
            $fichaEstoqueModel->create([
                'produto_id' => $produto->id,
                'entrada' => $validatedData['quantidade'],
                'usuario' => session('id_usuario'),
                'data' => $data,
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Dados da entrada salvo com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Erro ao realizar a entrada de produto', 'error' => $e->getMessage()]);
        }
    }


    //FUNÇÃO PARA INVENTARIO DE PRODUTO
    public function inventarioProduto(Request $request)
    {
        $data = date('Y-m-d');
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        $software_id = session('software_id');
        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $xread = env('XREAD');
        $tables = [
            $idpharm => [
                'produtos',
                'compras',
                'estoques_diario',
                'ficha_estoque',
                'inventario',
            ],
            $restgo => [
                'produtos',
                'estoques_diario',
                'ficha_estoque',
                'inventario',
            ],
            $xread => [
                'produtos',
                'estoques_diario',
                'ficha_estoque',
                'inventario',
            ],
        ];

        if (!isset($tables[$software_id])) {
            return response()->json(['success' => false, 'message' => 'Parâmetro inválido']);
        }

        $validatedData = $request->validate([
            'id_produto_inventario' => 'required|integer',
            'estoque_disponivel' => 'required|integer',
            'unidades_contadas' => 'required|integer',
            'desiqualidade' => 'nullable|integer',
            'estoque_atual' => 'nullable|integer',
            'observacao' => 'nullable|string|max:255'
        ]);

        $tableConfig = $tables[$software_id];
        $produtoModel = new Produto();
        $produtoModel->setTable($tableConfig[0]);
        $produto = $produtoModel->find($validatedData['id_produto_inventario']);
        if (!$produto) {
            return response()->json(['success' => false, 'message' => 'Produto não encontrado']);
        }

        $estoqueDiarioModel = new EstoqueDiario();
        $estoqueDiarioModel->setTable($tableConfig[2]);

        $estoqueDiario = $estoqueDiarioModel
            ->where('produto_id', $produto->id)
            ->where('data', $data)
            ->first();

        if (!$estoqueDiario) {
            $estoqueDiario = $estoqueDiarioModel->create([
                'produto_id' => $produto->id,
                'estoque' => $validatedData['estoque_disponivel'],
                'data' => $data,
            ]);
        }

        $fichaEstoqueModel = new FichaEstoque();
        $fichaEstoqueModel->setTable($tableConfig[3]);


        DB::beginTransaction();
        try {

            $inventarioModel = new Inventario();
            $inventarioModel->setTable($tableConfig[4]);
            $inventario = $inventarioModel->where('id_produto', $produto->id)->where('data', $data)->first();
            if ($inventario) {
                return response()->json(['success' => false, 'message' => 'Já foi realizado inventário para este produto e data']);
            }

            $inventarioModel->create([
                'id_produto' => $produto->id,
                'stock_disponivel' => $validatedData['estoque_disponivel'],
                'unidades_contadas' => $validatedData['unidades_contadas'],
                'diferenca' => $validatedData['desiqualidade'],
                'observacao' => $validatedData['observacao'],
                'data' => now()->toDateTimeString(),
            ]);

            $estoqueDiario->estoque = $validatedData['estoque_atual'];
            $estoqueDiario->save();

            $produto->estoque = $validatedData['estoque_atual'];
            $produto->save();

            $stockAtual = $validatedData['estoque_atual'];
            $stockAnterior = $validatedData['estoque_disponivel'];

            $fichaEstoqueModel->create([
                'produto_id' => $produto->id,
                'ajusteP' => $stockAnterior < $stockAtual ? $validatedData['desiqualidade'] : 0,
                'ajusteN' => $stockAnterior > $stockAtual ? $validatedData['desiqualidade'] : 0,
                'stock' => $stockAtual,
                'usuario' => session('id_usuario'),
                'data' => $data,
                'observacao' => 'Periodo de Inventário',

            ]);


            DB::commit();
            return response()->json(['success' => true, 'message' => 'Dados do inventário salvo com sucesso']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Erro ao salvar o inventário', 'error' => $e->getMessage()]);
        }
    }



    //FUNÇÃO PARA GERAR O CÓDIGO ÚNICO DO PRODUTO
    public function getCodigo()
    {
        $uid_empresa = session('uid_empresa');
        $empresa = DB::connection('central')->table('empresas')->where('id', $uid_empresa)->first();
        $this->databaseController->setEmpresaDatabaseConnection($empresa);

        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa não encontrada']);
        }

        $idpharm = env('IDPHARM');
        $restgo = env('RESTGO');
        $trx = env('TRX');

        $param = session('software_id');
        $tables = [
            $idpharm => 'produtos',
            $restgo => 'produtos',
            $trx => 'produtos',
        ];

        $codigo = new Produto();
        $codigo->setTable($tables[$param]);

        $codigoMax = $codigo->max('id');
        // Gerando um código único combinando o id com um valor aleatório
        $codigoUnico = 'PROD-' . str_pad($codigoMax, 6, '0', STR_PAD_LEFT);

        return response()->json(['success' => true, 'codigo' => $codigoUnico]);
    }
}
