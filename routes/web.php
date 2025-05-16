<?php

use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ItensVendaController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MetodoPagamentoController;
use App\Http\Controllers\LicencaController;
use App\Http\Controllers\MpesaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardOpratorController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SupportTicketController;

Route::get('/manifest.json', function () {
    return response()->file(public_path('manifest.json'));
 
});
Route::get('/service-worker.js', function () {
    return response()->file(public_path('service-worker.js'));
});

Route::get('/offline', function () {
    return view('offline');
});

Route::get('/', [PainelController::class, 'ngestorx'])->name('ngestorx');
Route::get('/login', PainelController::class)->name('home');
Route::get('/cardapio', [PainelController::class, 'cardapio'])->name('cardapio');
Route::post('/login', [DatabaseController::class, 'login'])->name('login');
Route::post('/', [DatabaseController::class, 'empresaLogin'])->name('empresa.login');
Route::get('/get_modulos', [ModuloController::class, 'getModulos'])->name('get.modulos');
Route::get('/ngestorx/logout', [DatabaseController::class, 'logout'])->name('logout');
Route::get('/ngestorx/{page?}', [PainelController::class, 'painel'])->name('painel.index');
Route::get('/produtos', [ProdutoController::class, 'produtos'])->name('api.produtos');
Route::get('/categorias', [ProdutoController::class, 'getCategorias'])->name('categorias');
Route::get('/iva', [ProdutoController::class, 'getIVA'])->name('iva');
Route::post('/novo-produto', [ProdutoController::class, 'novoProduto'])->name('novo.produto');
Route::get('/get-codigo', [ProdutoController::class, 'getCodigo'])->name('get.codigo');
Route::get('/get-dados-produto', [ProdutoController::class, 'getDadosProduto'])->name('get.dados.produto');
Route::post('/editar-produto', [ProdutoController::class, 'editarProduto'])->name('editar.produto');
Route::post('/alterar-status-produto', [ProdutoController::class, 'alterarStatusProduto'])->name('alterar.status.produto');
Route::get('/get-fornecedores', [ProdutoController::class, 'getFornecedores'])->name('get.fornecedores');
Route::post('/entrada-produto', [ProdutoController::class, 'entradaProduto'])->name('entrada.produto');
Route::post('/inventario-produto', [ProdutoController::class, 'inventarioProduto'])->name('inventario.produto');
Route::get('/catalogo/produtos/excel', [ExportController::class, 'catalodoProdutosExcel'])->name('catalogo.produtos.excel');
Route::get('/catalogo/produtos/pdf', [ExportController::class, 'catalodoProdutosPdf'])->name('catalogo.produtos.pdf');
Route::get('/alertas-vencimento', [ProdutoController::class, 'alertaVencimento'])->name('alertas.vencimento');
Route::get('/ficha-estoque', [ProdutoController::class, 'fichaEstoque'])->name('api.ficha');
Route::get('/painel-pdv', [ProdutoController::class, 'produtosPDV'])->name('api.produtos.pdv');
Route::post('/add-produto-pdv', [ProdutoController::class, 'addProdutoPDV'])->name('add.produto.pdv');
Route::get('/itens-venda', [ItensVendaController::class, 'getItensVenda'])->name('itens.venda');
Route::post('/remover-item-venda', [ItensVendaController::class, 'removerItemVenda'])->name('remover.item.venda');
Route::post('/finalizar-venda', [VendaController::class, 'vendaDinheiro'])->name('finalizar.vd');
Route::get('/metodos-pagamento', [MetodoPagamentoController::class, 'getMetodosPagamento'])->name('metodos.pagamento');
Route::get('/print/fatura-recibo/{id}', [VendaController::class, 'printFaturaRecibo'])->name('print.fatura.recibo');
Route::get('/vendas-fr', [VendaController::class, 'getVendasFr'])->name('get.fr-emitidas');
Route::get('/vendas-ft', [VendaController::class, 'getVendasFt'])->name('get.ft-emitidas'); 
Route::post('/cancelar-fr/{id}', [VendaController::class, 'cancelarFr'])->name('cancelar.fr');
Route::post('/cancelar-ft/{id}', [VendaController::class, 'cancelarFt'])->name('cancelar.ft');
Route::post('/relatorio-mapa-vendas', [ExportController::class, 'mapaVendas'])->name('relatorio.mapa.vendas');
Route::get('/caixa', [VendaController::class, 'getCaixa'])->name('get.caixa');
Route::get('/clientes', [ClienteController::class, 'getClientes'])->name('get.clientes');
Route::post('/finalizar-venda-prazo-desktop', [VendaController::class, 'vendaPrazo'])->name('finalizar.venda.prazo');
Route::get('/fatura/venda/{id}', [VendaController::class, 'faturaVenda'])->name('fatura.venda');
Route::get('/renovar-licenca', [LicencaController::class, 'getSoftwares'])->name('get.softwares');
Route::get('/formas-pagamento', [LicencaController::class, 'getFormasPagamento'])->name('get.formas.pagamento');
Route::get('/planos', [LicencaController::class, 'getPlanos'])->name('get.planos');
Route::post('/api/mpesa/send-payment', [MpesaController::class, 'sendMpesaPayment'])->name('mpesa.send-payment');
Route::get('/api/check-mpesa-config', [MpesaController::class, 'checkMpesaConfig']);
Route::get('/fatura/pagamento/{id}', [ExportController::class, 'faturaPagamento'])->name('fatura.pagamento');
Route::get('/fatura/pagamento/pdf/download/{id}', [ExportController::class, 'faturaPagamentoPdfDownload'])->name('fatura.pagamento.pdf.download');
Route::get('/caixa/aberto', [VendaController::class, 'verificarStatusCaixa'])->name('caixa.aberto');
Route::post('/abrir-caixa', [VendaController::class, 'abrirCaixa'])->name('abrir.caixa');
Route::post('/fechar-caixa', [VendaController::class, 'fecharCaixa'])->name('fechar.caixa');
Route::get('/get-turnos', [VendaController::class, 'getTurnos'])->name('get.turnos');
Route::get('/get-caixas', [VendaController::class, 'getCaixas'])->name('get.caixas');
//Dashboard Operator
Route::get('/dashboard-operator/vendas', [DashboardOpratorController::class, 'getVendas'])->name('dashboard-operator.vendas');
Route::get('/dashboard-operator/vendas-mensais', [DashboardOpratorController::class, 'getVendasMensais'])->name('dashboard-operator.vendas-mensais');
Route::get('/dashboard-operator/vendas-semanais', [DashboardOpratorController::class, 'getVendasSemanais'])->name('dashboard-operator.vendas-semanais');
Route::get('/backup', [DatabaseController::class, 'backupBancoComSenha'])->name('backup');

//Teste de dispositivo
/*Route::get('/teste-dispositivo', function () {
    $resultado = [
        'isMobile' => isMobile() ? 'Sim' : 'Não',
        'isTablet' => isTablet() ? 'Sim' : 'Não',
        'userAgent' => request()->userAgent()
    ];
    return response()->json($resultado);
})->name('teste.dispositivo');*/

Route::get('/operadores', [FuncionarioController::class, 'listarOperadores'])->name('operadores');

Route::get('/graficos/exemplo', function () {
    return view('graficos.exemplo');
});

/*Rotas de chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/store', [ChatController::class, 'store'])->name('chat.store');
Route::post('/chat/mark-as-read', [ChatController::class, 'markAsRead'])->name('chat.mark-as-read');
Route::post('/chat/load-more', [ChatController::class, 'loadMore'])->name('chat.load-more');|
*/

// Rotas de suporte
Route::get('/suporte', [SupportTicketController::class, 'index'])->name('support.tickets');
Route::get('/suporte/ticket/{id}', [SupportTicketController::class, 'show'])->name('support.ticket.show');
Route::post('/suporte/ticket/store', [SupportTicketController::class, 'store'])->name('support.ticket.store');
Route::post('/suporte/ticket/reply', [SupportTicketController::class, 'replyMessage'])->name('support.ticket.reply');
Route::post('/suporte/ticket/{id}/status', [SupportTicketController::class, 'updateStatus'])->name('support.ticket.update-status');
