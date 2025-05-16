/**
 * Produtos Blade Template for IDPharm Module
 * 
 * This template handles the rendering of product-related views with specific styling
 * for table layouts and navigation elements. It includes CSS for:
 * - Fixed bottom navigation bar
 * - Parcels/installments table styling
 * - Responsive table design with alternating row colors
 * 
 * @package IDPharm
 * @subpackage Views
 * @uses session()->get('software_id') to retrieve software context
 */
@php
$software_id = session()->get('software_id');
@endphp

<style>
    .nav-bottom {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px 6px;
        background-color: #f6f6f6;
        height: auto;

    }

    .h {
        height: 45px;
    }

    /* Estilo para a tabela */
    #parcelas-container table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Arial', sans-serif;
        font-size: 16px;


    }

    #parcelas-container {
        background-color: rgba(236, 239, 241, 0.78);
    }

    /* Estilo das células da tabela */
    #parcelas-container th,
    #parcelas-container td {
        border: 1px solid #ddd;
        padding: 2px;
        text-align: center;
    }

    /* Estilo para o cabeçalho */
    #parcelas-container th {
        background-color: rgb(196, 201, 206);
        color: white;
    }

    /* Estilo para as linhas do corpo da tabela */
    #parcelas-container tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    #parcelas-container tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    /* Efeito de hover nas linhas da tabela */
    #parcelas-container tbody tr:hover {
        background-color: #e9ecef;
    }

    /* Estilo para a coluna de valor (negrito) */


    /* Responsividade para telas menores */
    @media screen and (max-width: 600px) {
        #parcelas-container table {
            font-size: 16px;
        }

        #parcelas-container th,
        #parcelas-container td {
            padding: 6px;
        }
    }

    /* Personalização para Mobile */
    @media (max-width: 600px) {
        .notyf__toast {
            width: 98% !important;
            margin-top: 10px !important;
            border-radius: 12px !important;
            margin-bottom: 10px !important;

        }

        .notyf__message {


            line-height: 1.4;
        }
    }
</style>

<div class=" mt-5 bg-white" style="height: 100vh; overflow-y: auto; overflow-x: hidden;">

    <div class="p-2">
        <!-- Nav tabs -->
        <div class="row">
            <div class="col-12 d-flex justify-content-between mt-2">
                <h5 class="fs-3 py-0">Produtos</h5>
                <div class="ms-auto">
                    <button class="btn btn-sm btn-primary py-1 px-2" id="novo-produto">
                        <span class="card-title fs-5 text-white"><i class="bi bi-plus-square-dotted"></i> Novo Produto</span>
                    </button>
                    <button class="btn btn-sm btn-primary py-1 px-2" data-bs-toggle="dropdown">
                        <span class="card-title fs-5 text-white"><i class="bi bi-download me-1 fs-4"></i> Exportar</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end rounded-3">
                        <a class="dropdown-item" href="#">
                            <span class="card-title fs-6 text-dark"><i class="fa fa-file-pdf me-2 text-danger fs-4 opacity-75"></i>Catalogo de Produtos(PDF)</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="card-title fs-6 text-dark"><i class="fa fa-file-excel me-2 text-success fs-4 opacity-75"></i>Catalogo de Produtos(Excel)</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="card-title fs-6 text-dark"><i class="fa fa-file-pdf me-2 text-danger fs-4 opacity-75"></i>Ficha de Estoque(PDF)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="custom-tab-1">
            <ul class="nav nav-tabs mt-2">
                <li class="nav-item">
                    <a class="nav-link active card-title fs-6 " data-bs-toggle="tab" href="#add_produtos"><i class="bi bi-arrow-left-right me-2"></i><span class="fs-6 text-dark">Movimentações Produtos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link card-title fs-6 " data-bs-toggle="tab" href="#itens"><i class="bi bi-box me-2"></i><span class="fs-6 text-dark">Eestoques</span></a>
                </li>


            </ul>
            <div class="tab-content p-0 bg-white rounded-3" style=" max-height: 80vh; overflow-y: auto; overflow-x: hidden;">
                <div class="tab-pane fade show active" id="add_produtos" role="tabpanel">
                    <div class="pb-2">
                        <table id="example3" class="table display fs-6  table-sm table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="w-75 card-title fs-6 text-dark">Código/Nome/(PU)...</th>
                                    <th class="w-25 card-title fs-6 text-dark">Status</th>
                                    <th class="card-title fs-6 text-dark">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="tab-pane fade" id="itens">
                    <div class="pb-2">
                        <table id="example2" class="table display fs-6  table-sm table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="w-75 card-title fs-6 text-dark">Código/Nome/(PU)...</th>
                                    <th class="w-25 card-title fs-6 text-dark">Status</th>
                                    <th class="card-title fs-6 text-dark">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

<!-- Offcanvas para criar um novo produto -->
<div class="offcanvas offcanvas-bottom rounded-top " tabindex="-1" id="offcanvasNovoProduto" aria-labelledby="offcanvasNovoProdutoLabel" style=" min-height: 90vh; width: 100%;">

    <div class="offcanvas-header  ">
        <h5 class="fs-3 py-0 card-title fs-4    "><span class=" rounded border border-muted  px-2 py-2"><i class="bi bi-plus fs-2  text-primary"></i> Novo Produto</span></h5>
        <span class="text-reset close-offcanvas" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-chevron-bar-down fs-1 text-dark w-25"></i>
        </span>

    </div>


    <div class="offcanvas-body mt-0">

        <form id="form-novo-produto" method="POST" enctype="multipart/form-data" autocomplete="off">

            <div class="row">

                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="codigo" class="card-title fs-5">Código<span class="text-danger">*</span></label>
                        <input type="text" class="read-only form-control height fs-6 text-dark" id="codigo" name="codigo" readonly>
                        <span id="codigo-error" class="error-message text-danger text-small"></span>
                    </div>
                </div>
                <div class="col-md-5 mb-2">
                    <div class="form-group">
                        <label for="nome" class="card-title fs-5">Nome produto<span class="text-danger">*</span></label>
                        <input type="text" class="form-control height fs-6" id="nome" name="nome">
                        <span id="nome-error" class="nome-error error-message text-danger text-small"></span>
                    </div>

                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="select-categorias" class="card-title fs-5">Categoria<span class="text-danger">*</span></label>
                        <select id="select-categorias" class="default-select  height fs-6 form-select bg-white  " name="categoria_id" style="height: 42px; box-shadow: 0 0 0px rgba(88, 171, 219, 0.72);">
                        </select>

                        <span id="categoria-error" class="select-categorias-error error-message text-danger text-small"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="venda" class="card-title fs-5">Preço de Venda<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control height fs-6" id="venda" name="venda" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <span class="input-group-text">.00</span>
                        </div>
                        <span id="venda-error" class="venda-error error-message text-danger text-small"></span>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="estoque_mini" class="card-title fs-5">Estoque Mínimo<span class="text-danger">*</span></label>
                        <input type="text" class="form-control height fs-6" id="estoque_mini" name="estoque_mini" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <span id="estoque_mini-error" class="estoque-minimo-error error-message text-danger text-small"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="estoque_maxi" class="card-title fs-5">Estoque Máximo<span class="text-danger">*</span></label>
                        <input type="text" class="form-control height fs-6" id="estoque_maxi" name="estoque_maxi" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <span id="estoque_maxi-error" class="estoque-maximo-error error-message text-danger text-small"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2 ">

                    <label for="select-iva" class="card-title fs-5">IVA<span class="text-danger">*</span></label>
                    <select id="select-iva" class="default-select  height fs-6 form-select bg-white  " name="iva_id" style="height: 42px; box-shadow: 0 0 0px rgba(88, 171, 219, 0.72);">
                    </select>
                    <span id="iva-error" class="iva-error error-message text-danger text-small"></span>

                </div>
                <div class="col-md-6 mb-2">

                    <label for="imagem" class="card-title fs-5">Imagem</label>
                    <input type="file" class="form-control height fs-6" id="imagem" name="imagem">

                </div>

                <div class="col-md-12 mb-2">
                    <label for="descricao" class="card-title fs-5">Descrição<span class="text-danger">*</span></label>

                    <textarea rows="1" class="form-control" name="descricao" id="descricao"></textarea>
                    <!-- Imagem à direita -->
                    <span id="descricao-error" class="descricao-error error-message text-danger text-small"></span>
                </div>

            </div>
    </div>
    </form>

    <div class="offcanvas-footer p-0 mb-2 mt-2 text-center justify-content-center">

        <button type="button" class="btn  btn-primary btn-novo-produto  w-75 card-title fs-6 text-white"><i class="fa-solid fa-save"></i> Salvar dados</button>
    </div>



</div>

<!-- Offcanvas para editar um produto -->
<button class="btn btn-sm btn-primary py-1 px-2" hidden id="editar-produto" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditarProduto">
    <span class="card-title fs-5 text-white"> Editar Produto</span>
</button>
<div class="offcanvas offcanvas-bottom rounded-top " tabindex="-1" id="offcanvasEditarProduto" aria-labelledby="offcanvasEditarProdutoLabel" style=" min-height: 90vh; width: 100%;">

    <div class="offcanvas-header  ">
        <h5 class="fs-3 py-0 card-title fs-4  "><span class=" rounded border border-muted  px-2 py-2"> Editar Produto</span></h5>
        <span class="text-reset close-offcanvas" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-chevron-bar-down fs-1 text-dark w-25"></i>
        </span>

    </div>


    <div class="offcanvas-body mt-0">

        <form id="form-editar-produto" method="POST" enctype="multipart/form-data" autocomplete="off">

            <div class="row">

                <div class="col-md-3 mb-2">
                    <div class="form-group">
                        <label for="codigo" class="card-title fs-5">Código<span class="text-danger">*</span></label>
                        <input type="text" class="read-only form-control height fs-6 text-dark" id="codigo_edicao" name="codigo_edicao" readonly>
                        <input type="hidden" id="id_edicao" name="id_edicao">
                        <span id="codigo-error" class="message-error text-danger text-small"></span>
                    </div>
                </div>
                <div class="col-md-5 mb-2">
                    <div class="form-group">
                        <label for="nome" class="card-title fs-5">Nome produto<span class="text-danger">*</span></label>
                        <input type="text" class="form-control height fs-6" id="nome_edicao" name="nome_edicao">
                        <span id="nome-error" class="nome-error message-error text-danger text-small"></span>
                    </div>

                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="select-categorias" class="card-title fs-5">Categoria<span class="text-danger">*</span></label>
                        <select id="select-categorias-edicao" class="default-select  height fs-6 form-select bg-white  " name="categoria_id_edicao" style="height: 42px; box-shadow: 0 0 0px rgba(88, 171, 219, 0.72);">
                        </select>

                        <span id="categoria-error" class="select-categorias-error message-error text-danger text-small"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="venda" class="card-title fs-5">Preço de Venda<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control height fs-6" id="venda_edicao" name="venda_edicao" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <span class="input-group-text">.00</span>
                        </div>
                        <span id="venda-error" class="venda-error message-error text-danger text-small"></span>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="estoque_mini" class="card-title fs-5">Estoque Mínimo<span class="text-danger">*</span></label>
                        <input type="text" class="form-control height fs-6" id="estoque_mini_edicao" name="estoque_mini_edicao" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <span id="estoque_mini-error" class="estoque-minimo-error message-error text-danger text-small"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="estoque_maxi" class="card-title fs-5">Estoque Máximo<span class="text-danger">*</span></label>
                        <input type="text" class="form-control height fs-6" id="estoque_maxi_edicao" name="estoque_maxi_edicao" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <span id="estoque_maxi-error" class="estoque-maximo-error message-error text-danger text-small"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2 ">

                    <label for="select-iva" class="card-title fs-5">IVA<span class="text-danger">*</span></label>
                    <select id="select-iva-edicao" class="default-select  height fs-6 form-select bg-white  " name="iva_id_edicao" style="height: 42px; box-shadow: 0 0 0px rgba(88, 171, 219, 0.72);">
                    </select>
                    <span id="iva-error" class="iva-error message-error text-danger text-small"></span>

                </div>
                <div class="col-md-6 mb-2">

                    <label for="imagem" class="card-title fs-5">Imagem</label>
                    <input type="file" class="form-control height fs-6" id="imagem_edicao" name="imagem_edicao">

                </div>

                <div class="col-md-12 mb-2">
                    <label for="descricao" class="card-title fs-5">Descrição<span class="text-danger">*</span></label>

                    <textarea rows="1" class="form-control" name="descricao_edicao" id="descricao_edicao"></textarea>
                    <!-- Imagem à direita -->
                    <span id="descricao-error" class="descricao-error message-error text-danger text-small"></span>
                </div>

            </div>
    </div>
    </form>

    <div class="offcanvas-footer p-0 mb-2 mt-2 text-center justify-content-center">

        <button type="button" id="btn-editar-produto" class="btn  btn-primary btn-editar-produto  w-75 card-title fs-6 text-white"><i class="fa-solid fa-save"></i> Salvar dados</button>
    </div>

</div>


<!-- Offcanvas Entradas de Produtos -->

<div class="offcanvas offcanvas-bottom rounded-top " tabindex="-1" id="offcanvasEntradasProdutos" aria-labelledby="offcanvasEntradasProdutosLabel" style=" min-height: 90vh; width: 100%;">

    <div class="offcanvas-header  ">
        <h5 class="fs-3 py-0 card-title fs-4  "><span class=" rounded border border-muted  px-2 py-2"> Entrada: <small class="text-muted" id="nome_produto_entrada"></small></span></h5>
        <span class="text-reset close-offcanvas" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-chevron-bar-down fs-1 text-dark w-25"></i>
        </span>

    </div>
    <div class="offcanvas-body mt-0">
        <form id="form-entrada-produto" method="POST" autocomplete="off">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="numeroGuia" class="card-title fs-5 ">N.º Guia<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control height fs-6" id="numeroGuia" name="numeroGuia">
                        <input type="hidden" id="id_produto_entrada" name="id_produto_entrada">

                        <span class="message-validacao   text-danger" id="numeroGuia-error"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="lote" class="card-title fs-5 ">Lote<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control height fs-6" id="lote" name="lote">
                        <span class="message-validacao   text-danger" id="lote-error"></span>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group ">
                        <label for="fornecedor" class="card-title fs-5 ">Fornecedor <span class="text-danger">*</span></label>
                        <select class=" default-select form-control height fs-6" id="fornecedor" name="fornecedor">

                        </select>
                        <span class="message-validacao   text-danger" id="fornecedor-error"></span>
                    </div>
                </div>
                <div class="col-md-6 mb-2 ">
                    <div class="form-group mb-2">
                        <label for="prazo-validade" class="card-title fs-5 ">Prazo de Validade <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <input type="text" class="form-control height fs-6 datepicker " id="prazo-validade" name="prazo-validade" placeholder="dd-mm-yyyy">
                            <span class="input-group-text"><i class=" fa-solid fa-calendar-days"></i></span>
                        </div>
                        <span class="message-validacao text-danger" id="prazo-validade-error"></span>
                    </div>
                </div>

            </div>
            <div class="row">


                <div class="col-md-6 mb-2">
                    <div class="form-group ">
                        <label for="valorDeCompra" class="card-title fs-5 ">Valor de Compra <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <input type="text" onkeyup="calcularTotal()" class="form-control height fs-6" id="valorDeCompra" name="valorDeCompra" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <span class="input-group-text">.00</span>
                        </div>
                        <span class="message-validacao   text-danger" id="valorDeCompra-error"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="quantidade" class="card-title fs-5 ">Quantidade<span class="text-danger">*</span> </label>
                        <input type="text" onkeyup="calcularTotal()" class="form-control height fs-6" id="quantidade" name="quantidade" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <span class="message-validacao   text-danger" id="quantidade-error"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="totalDaCompra" class="card-title fs-5 ">Total da compra<span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <input type="text" class="form-control height fs-6" id="totalDaCompra" name="totalDaCompra" readonly>
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                </div>

            </div>
        </form>
    </div>
    <div class="offcanvas-footer p-0 mb-2 mt-2 text-center justify-content-center">

        <button type="button" id="btn-entrada-produto" class="btn  btn-primary btn-editar-produto  w-75 card-title fs-6 text-white"><i class="fa-solid fa-save"></i> Salvar dados</button>
    </div>


</div>


<!-- Offcanvas Inventário de Produtos -->
<div class="offcanvas offcanvas-bottom rounded-top " tabindex="-1" id="offcanvasInventarioProdutos" aria-labelledby="offcanvasInventarioProdutosLabel" style=" min-height: 90vh; width: 100%;">

    <div class="offcanvas-header  ">
        <h5 class="fs-3 py-0 card-title fs-4  "><span class=" rounded border border-muted  px-2 py-2"> Inventário: <small class="text-muted" id="nome_produto_inventario"></small></span></h5>
        <span class="text-reset close-offcanvas" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-chevron-bar-down fs-1 text-dark w-25"></i>
        </span>

    </div>
    <div class="offcanvas-body mt-0">
        <form id="form-inventario-produto" method="POST" autocomplete="off">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="estoque-disponivel" class="card-title fs-5 ">Estoque Disponível</label>
                        <input type="hidden" id="id_produto_inventario" name="id_produto_inventario">
                        <input type="text" class=" form-control height fs-6 read-only" id="estoque-disponivel" readonly name="estoque_disponivel">
                        <span class="text-danger msg-error" id="estoque-disponivel-error"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="unidades-contadas" class="card-title fs-5 ">Unidades Contadas<span class="text-danger">*</label>
                        <input type="text" oninput="calcularDiferenca()" class="form-control height fs-6 " id="unidades-contadas" name="unidades_contadas" onkeyup="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <span class="text-danger msg-error" id="unidades-contadas-error"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="desiqualidade" class="card-title fs-5 ">Desiqualidade <small class="" id="ajustes"></small></label>
                        <input type="text " class=" form-control height fs-6 read-only" id="desiqualidade" name="desiqualidade" readonly>
                        <span class="text-danger msg-error" id="desiqualidade-error"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="estoque-atual" class="card-title fs-5 ">Estoque Atual</label>
                        <input type="text" class=" form-control height fs-6 read-only" id="estoque-atual" name="estoque_atual" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <span class="text-danger msg-error" id="estoque-atual-error"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-2">
                        <label for="observacao" class="card-title fs-5 ">Observações <small class="text-muted">(Opcional)</small></label>
                        <textarea class="form-control height fs-6" rows="1" id="observacao" name="observacao"></textarea>
                    </div>
                </div>


            </div>

    </div>

    <div class="offcanvas-footer p-0 mb-2 mt-2 text-center justify-content-center">

        <button type="button" id="btn-inventario-produto" class="btn  btn-primary btn-editar-produto  w-75 card-title fs-6 text-white"><i class="fa-solid fa-save"></i> Salvar dados</button>
    </div>
</div>


<!-- Offcanvas Status do Produto -->
<div class="offcanvas offcanvas-bottom rounded-top " tabindex="-1" id="offcanvasStatusProduto" aria-labelledby="offcanvasStatusProdutoLabel">

    <div class="offcanvas-body text-start justify-content-start pb-0 mb-0">
        <h5 class="card-title fs-4 text-dark"><strong>Atualizar Status</strong></h5>
        <input type="hidden" id="id_produto_status" name="id_produto_status">
        <p>Tem certeza que deseja alterar o status do produto <strong id="nome_produto_status"></strong> para <strong id="status_produto"></strong>?</p>

    </div>
    <div class="offcanvas-footer mb-3 pt-1 me-2 text-end justify-content-end">
        <button type="button" class="btn btn-danger  w-25 " id="btn-acao-status">Sim</button>
        <button type="button" class="btn btn-primary  w-25 " data-bs-dismiss="offcanvas" aria-label="Close" id="btn-cancelar-acao-status">Não</button>
    </div>
</div>


<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script src="{{ asset('assets/js/produtos.js') }}"></script>
<script>
    // Configuração global para eventos touch passivos
    document.addEventListener('DOMContentLoaded', function() {
        // Configuração para o iziToast
        iziToast.settings({
            timeout: 3000,
            resetOnHover: true,
            transitionIn: 'fadeInDown',
            transitionOut: 'fadeOutUp',
            position: 'topCenter',
            displayMode: 'replace',
            drag: false,
            pauseOnHover: false,
            progressBar: true,
            layout: 2,
            balloon: false,
            closeOnEscape: true,
            closeOnClick: false,
            overlay: false,
            animateInside: false,
            touchMoveCapture: {
                passive: true
            },
            touchStartCapture: {
                passive: true
            },
            touchEndCapture: {
                passive: true
            }
        });

        // Configuração global para eventos touch
        const eventListenerOptions = {
            passive: true,
            capture: false
        };

        // Aplicar configuração passiva para todos os elementos que podem ter scroll
        const scrollElements = document.querySelectorAll('.offcanvas, .modal, [data-bs-scroll="true"]');
        scrollElements.forEach(function(element) {
            element.addEventListener('touchstart', function() {}, eventListenerOptions);
            element.addEventListener('touchmove', function() {}, eventListenerOptions);
            element.addEventListener('touchend', function() {}, eventListenerOptions);
            element.addEventListener('scroll', function() {}, eventListenerOptions);
        });

        // Configuração específica para offcanvas
        const offcanvasElements = document.querySelectorAll('.offcanvas');
        offcanvasElements.forEach(function(element) {
            element.addEventListener('show.bs.offcanvas', function() {
                document.body.style.overflow = 'hidden';
            });
            element.addEventListener('hidden.bs.offcanvas', function() {
                document.body.style.overflow = '';
            });
        });
    });

    var urlIva = "{{ route('iva') }}";
    var iva_id = "{{ $produto->iva_id ?? '' }}";
    var urlCategorias = "{{ route('categorias') }}";
    var categoria_id = "{{ $produto->categoria_id ?? '' }}";
    var urlGetProdutos = "{{ route('api.produtos') }}";
    var software_id = "{{ $software_id }}";
    var urlNovoProduto = "{{ route('novo.produto') }}";
    var token = "{{ csrf_token() }}";
    var urlGetCodigo = "{{ route('get.codigo') }}";
    var urlFornecedores = "{{ route('get.fornecedores') }}";
    var urlEntradaProduto = "{{ route('entrada.produto') }}";
    var urlInventarioProduto = "{{ route('inventario.produto') }}";
    var urlAlterarStatusProduto = "{{ route('alterar.status.produto') }}";
</script>



<script>
    //função para fechar o offcanvas

    $('.close-offcanvas').click(function() {
        $('#form-entrada-produto')[0].reset();
        $('#form-inventario-produto')[0].reset();
    });


    $(document).ready(function() {
        //Carregar produtos
        $('#example3').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            responsive: true,
            searching: true,
            pageLength: 6,
            ajax: {
                url: urlGetProdutos,
                type: 'GET',
                data: {
                    param: software_id
                }
            },
            error: function(xhr, error, thrown) {
                console.log(xhr);
                console.log(error);
                console.log(thrown);
            },
            columns: [{
                    render: function(data, type, row) {
                        const html = `
               <div class="d-flex flex-column text-left justify-content-start  ">
                                    <h6 class="mb-0 fs-6 py-0 mb-0"  >${row.codigo}</h6>
                                    <small class="text-xs text-secondary mb-0" >       
                                        <span class="text-dark me-1">Nome:</span> ${row.nome}
                                    </small>
                                    <small class="text-xs text-secondary mb-0 " >       
                                        <span class="text-dark me-1">Compra ${row.compra} Venda: ${row.venda}</span>
                                    </small>
                                    <small class="text-xs text-secondary mb-0 " >       
                                        <span class="text-dark me-1">Estoque:</span> ${row.estoque}
                                    </small>
                </div>
               `
                        return html;
                    }
                },
                {
                    render: function(data, type, row) {

                        const html = `
               <div class="d-flex flex-column justify-content-start  ">
                                    <small class="text-xs text-secondary mb-0" >       
                                        <span class=" rounded-pill px-2 opacity-75 text-white  bg-${row.status === 'Ativo' ? 'badge badge-success rounded-pill' : row.status === 'Inativo' ? 'badge badge-danger rounded-pill' : 'badge badge-warning rounded-pill'}">${row.status}</span>
                                    </small>
                                    
               </div>
               `
                        return html;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center',
                    render: function(data, type, row) {
                        const html = `
               <div class="dropdown">
                    <a  href="javascript:;" class="btn btn-sm btn-outline-primary p-2" data-bs-toggle="dropdown" style=" cursor: pointer;"><i class="fa fa-bars fs-5 text-primary"></i></a>
                    <div class="dropdown-menu rounded-3">
                        <a class="dropdown-item fs-6" href="javascript:;" onclick="entrada( ${row.id},'${row.nome}')"><i class="bi bi-box-arrow-in-down fs-5"></i> Entradas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fs-6" href="javascript:;" onclick="inventario(${row.id},'${row.nome}',${row.estoque})"><i class="bi bi-box fs-5"></i> Inventário</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fs-6" href="javascript:;" onclick="getDadosProduto(${row.id})"><i class="bi bi-pencil-square fs-5"></i> Editar</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fs-6" href="javascript:;" onclick="status(${row.id},'${row.nome}','${row.status}')"><i class="bi bi-toggles fs-5"></i> Ativar/Inativar</a>
            
                        </div>
               </div>
               `
                        return html;
                    }
                },

            ],
            language: {
                lengthMenu: "",
                filter: "",
                search: " ",
                searchPlaceholder: "Pesquisar pelo código ou nome",
                paginate: {
                    first: "«",
                    last: "»",
                    next: "»",
                    previous: "«"
                },
                zeroRecords: "Nenhum registro encontrado",
                infoEmpty: "",
                info: "",
                infoFiltered: ""
            },
            initComplete: function() {
                var div = $('<div class="input-group mb-0 py-0   mt-0 mb-2"></div>');

                var input = $('#example3_filter input').addClass('form-control height fs-6  ');
                var span = $('<div class="input-group-text me-2"><span class="fa fa-search"></span></div>');

                div.append(input);
                div.append(span);
                $('#example3_filter').append(div);
            }
        });
    });




    function getDadosProduto(id) {
        //teste abrir o offcanvas
        $('#editar-produto').attr('data-bs-toggle', 'offcanvas');
        $('#editar-produto').attr('data-bs-target', '#offcanvasEditarProduto');
        $('#editar-produto').click();
        var table = "{{ $software_id }}";
        var url = "{{ route('get.dados.produto') }}?id=" + id + "&param=" + table;

        $.ajax({
            url: url,
            method: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                //console.log(response);

                // Verificar se o produto existe
                if (response.produto) {
                    $('#id_edicao').val(response.produto.id);
                    $('#codigo_edicao').val(response.produto.codigo);
                    $('#nome_edicao').val(response.produto.nome);
                    var venda = response.produto.venda.replace(',', '.'); // Corrige o formato decimal
                    var vendaInt = parseInt(venda)
                    $('#venda_edicao').val(vendaInt);
                    $('#estoque_mini_edicao').val(response.produto.estoque_mini);
                    $('#estoque_maxi_edicao').val(response.produto.estoque_maxi);
                    $('#descricao_edicao').val(response.produto.descricao);
                    var link = "{{ asset('storage/assets/images/products/') }}" + '/' + response.produto.imagem;
                    //console.log(link); // Verifique se o caminho está correto
                    $('#imagem_edicao').attr('src', link);
                } else {
                    //console.error('Produto não encontrado:', response.produto);
                    alertEdicao('Produto não encontrado');
                }

                // Verificar e preencher categorias (acessando a chave 'original')
                if (response.categorias && Array.isArray(response.categorias.original)) {
                    var options = '';
                    $.each(response.categorias.original, function(index, categoria) {
                        options += '<option value="' + categoria.id + '">' + categoria.nome + '</option>';
                    });
                    $('#select-categorias').html(options);
                    // Selecionar a categoria do produto
                    $('#select-categorias').val(response.produto.categoria_id).trigger('change');

                } else {
                    //console.error('Categorias não encontradas ou resposta inválida:', response.categorias);
                }

                // Verificar e preencher opções de IVA (acessando a chave 'original')
                if (response.ivas && Array.isArray(response.ivas.original)) {
                    var optionsIva = '';
                    $.each(response.ivas.original, function(index, iva) {
                        optionsIva += '<option value="' + iva.id + '">' + iva.taxa + '</option>';
                    });
                    $('#select-iva').html(optionsIva);
                    $('#select-iva').val(response.produto.iva_id).trigger('change');
                } else {
                    //console.error('Opções de IVA não encontradas ou resposta inválida:', response.ivas);
                }


            },
            error: function(xhr, status, error) {
                //console.log("Status: " + status);
                //console.log("Erro: " + error);
                alertEdicao('Ocorreu um erro inesperado. Tente novamente mais tarde');
            }
        });
    }



    $(document).ready(function() {
        $('#btn-editar-produto').click(function(e) {
            e.preventDefault();
            $('.message-error').text('');
            var form = $('#form-editar-produto')[0];
            var formData = new FormData(form);
            formData.append('_token', token);


            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }

            $.ajax({
                url: "{{ route('editar.produto') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#btn-editar-produto').prop('disabled', true);
                },
                success: function(response) {
                    $('#btn-editar-produto').prop('disabled', false);
                    //console.log(response);
                    if (response.success) {


                        iziToast.success({
                            title: 'Sucesso!',
                            titleColor: '#ffffff',
                            message: response.message,
                            position: 'topCenter',
                            timeout: 3000,
                            overlay: true,
                            displayMode: 'once',
                            messageColor: '#ffffff',
                            icon: 'fa fa-check-circle text-light',
                            backgroundColor: '#66CDAA',
                           

                        });
                        $('#form-editar-produto')[0].reset();
                        setTimeout(function() {
             
                            $('#example3').DataTable().ajax.reload(null, false);
                            $('#offcanvasEditarProduto').offcanvas('hide');
                        }, 1000);



                    } else {
                        iziToast.info({
                            title: 'Aviso!',
                            icon: 'fa fa-info-circle text-light',
                            message: response.message,
                            overlay: true,
                            displayMode: 'once',
                            backgroundColor: '#5bc0de',
                            titleColor: '#ffffff',
                            messageColor: '#ffffff',
                            position: 'topRight',
                           

                        });
                    }
                },
                error: function(xhr) {
                    $('#btn-editar-produto').prop('disabled', false);
                    $('.message-error').text('');
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        iziToast.error({
                            title: 'Erro',
                            message: 'Favor, preencha todos os campos obrigatórios!',
                            position: 'topCenter',
                            timeout: 2000,
                            overlay: true,
                            displayMode: 'once',
                            icon: 'fa fa-warning text-light',
                            backgroundColor: '#3498db',
                            titleColor: '#ffffff',
                            messageColor: '#ffffff'
                        });

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key + '-error').text(value[0]);
                            console.log(key + ': ' + value);
                        });
                    } else {
                        iziToast.error({
                            timeout: 2000,
                            title: 'Erro',
                            message: 'Erro ao processar a requisição. Tente novamente.',
                            position: 'topCenter',
                            overlay: true,
                            displayMode: 'once',
                            icon: 'fa fa-warning text-light',
                            backgroundColor: '#f0f0f0',
                            titleColor: '#ffffff',
                            messageColor: '#ffffff'
                        });
                    }
                }
            });
        });
    });





    $(document).ready(function() {
        $.ajax({
            url: urlFornecedores,
            method: 'GET',
            data: {
                param: software_id
            },
            success: function(response) {
                var options = '';
                options += '<option value="">Selecione um fornecedor</option>';
                $.each(response, function(index, fornecedor) {
                    if (fornecedor.id == response.fornecedor_id) {
                        options += '<option value="' + fornecedor.id + '" selected>' + fornecedor.nome + '</option>';
                    } else {
                        options += '<option value="' + fornecedor.id + '">' + fornecedor.nome + '</option>';
                    }
                });
                $('#fornecedor').html(options);
                $('#fornecedor-edicao').html(options);
            }
        });
    });


    function entrada(id, nome) {
        $('#offcanvasEntradasProdutos').offcanvas('show');
        $('#alert-entrada').hide();
        //Preencher o id do produto
        $('#id_produto_entrada').val(id);
        //Formatar o nome do produto
        let nomeFormatado = nome.length > 20 ? nome.substring(0, 20) + '...' : nome;
        $('#nome_produto_entrada').html(nomeFormatado)

    }

    function inventario(id, nome, estoque) {
        $('#offcanvasInventarioProdutos').offcanvas('show');
        //Preencher o id do produto
        $('#id_produto_inventario').val(id);
        //Formatar o nome do produto
        let nomeFormatado = nome.length > 20 ? nome.substring(0, 20) + '...' : nome;
        $('#nome_produto_inventario').html(nomeFormatado)
        $('#estoque-disponivel').val(estoque);
    }


    //Abrir o offcanvas para criar um novo produto
    document.addEventListener('DOMContentLoaded', function() {
        $('#novo-produto').click(function(e) {
            e.preventDefault();
            $('#form-novo-produto')[0].reset();
            $('#offcanvasNovoProduto').offcanvas('show');
            getCodigo(urlGetCodigo);
        });
    });



    //Enviar dados para o backend
    $('#btn-entrada-produto').click(function(e) {
        e.preventDefault();
        var form = $('#form-entrada-produto')[0];
        var formData = new FormData(form);
        formData.append('_token', token);

        $.ajax({
            url: urlEntradaProduto,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#btn-entrada-produto').prop('disabled', true);
            },
            success: function(response) {
                //console.log(response);
                if (response.success) {
                    $('#btn-entrada-produto').prop('disabled', false);
                    iziToast.success({
                        title: 'Sucesso!',
                        message: response.message,
                        position: 'topCenter',
                        timeout: 2000,
                        overlay: true,
                        displayMode: 'once',
                        icon: 'fa fa-check-circle text-success',
                        backgroundColor: '#f0f0f0',
                        titleColor: '#333',
                        messageColor: '#333'
                    });
                    setTimeout(function() {
                        $('#close-offcanvas').click();
                        $('#form-entrada-produto')[0].reset();
                        $('#example3').DataTable().ajax.reload(null, false);

                    }, 2000);
                } else {
                    $('#btn-entrada-produto').prop('disabled', false);
                    console.log(response);
                    iziToast.error({
                        title: 'Erro',
                        message: response.message,
                        position: 'topCenter',
                        timeout: 2000,
                        icon: 'fa fa-warning text-danger',
                        backgroundColor: '#f0f0f0',
                        titleColor: '#333',
                        messageColor: '#333'
                    });
                }
            },
            error: function(xhr) {
                $('#btn-entrada-produto').prop('disabled', false);
                $('.message-validacao').text('');
                if (xhr.status == 422) {
                    iziToast.error({
                        title: 'Erro',
                        message: 'Favor, preencha todos os campos obrigatórios!',
                        position: 'topCenter',
                        timeout: 2000,
                        icon: 'fa fa-warning text-danger',
                        backgroundColor: '#f0f0f0',
                        titleColor: '#333',
                        messageColor: '#333'
                    });

                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#' + key + '-error').text(value[0]);
                        console.log(key + ': ' + value);
                    });
                } else {
                    iziToast.error({
                        title: 'Erro',
                        message: 'Erro ao processar a requisição. Tente novamente.',
                        position: 'topCenter',
                        timeout: 2000,
                        icon: 'fa fa-warning text-danger',
                        backgroundColor: '#f0f0f0',
                        titleColor: '#333',
                        messageColor: '#333'
                    });
                }
            }
        });
    });



    //Enviar dados para o backend
    $('#btn-inventario-produto').click(function(e) {
        e.preventDefault();
        var form = $('#form-inventario-produto')[0];
        var formData = new FormData(form);
        formData.append('_token', token);

        $.ajax({
            url: urlInventarioProduto,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#btn-inventario-produto').prop('disabled', true);
            },
            success: function(response) {
                //console.log(response);
                if (response.success) {
                    $('#btn-inventario-produto').prop('disabled', false);

                    setTimeout(function() {
                        iziToast.success({
                            title: 'Sucesso!',
                            message: response.message,
                            position: 'topCenter',
                            timeout: 2000,
                            overlay: true,
                            displayMode: 'once',
                            icon: 'fa fa-check-circle text-success',
                            backgroundColor: '#f0f0f0',
                            titleColor: '#333',
                            messageColor: '#333'
                        });
                        $('.close-offcanvas').click();
                        $('#form-inventario-produto')[0].reset();
                        $('#example3').DataTable().ajax.reload(null, false);

                    }, 1000);
                } else {
                    $('#btn-inventario-produto').prop('disabled', false);
                    console.log(response);
                    iziToast.error({
                        title: 'Erro',
                        message: response.message,
                        position: 'topCenter',
                        timeout: 2000,
                        icon: 'fa fa-warning text-danger',
                        backgroundColor: '#f0f0f0',
                        titleColor: '#333',
                        messageColor: '#333'
                    });
                }
            },
            error: function(xhr) {
                $('#btn-inventario-produto').prop('disabled', false);
                $('.message-validacao').text('');
                if (xhr.status == 422) {
                    iziToast.error({
                        title: 'Erro',
                        message: 'Favor, preencha todos os campos obrigatórios!',
                        position: 'topCenter',
                        timeout: 2000,
                        icon: 'fa fa-warning text-danger',
                        backgroundColor: '#f0f0f0',
                        titleColor: '#333',
                        messageColor: '#333'
                    });

                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#' + key + '-error').text(value[0]);
                        console.log(key + ': ' + value);
                    });
                } else {
                    iziToast.error({
                        title: 'Erro',
                        message: 'Erro ao processar a requisição. Tente novamente.',
                        position: 'topCenter',
                        timeout: 2000,
                        icon: 'fa fa-warning text-danger',
                        backgroundColor: '#f0f0f0',
                        titleColor: '#333',
                        messageColor: '#333'
                    });
                }
            }
        });
    });

    //Atualizar o Status do Produto
    function status(id, nome, status) {
        var status = status == 'Ativo' ? 'Inativo' : 'Ativo';
        var statusColor = status == 'Ativo' ? 'text-success' : 'text-danger';
        iziToast.question({
            timeout: 30000,
            close: false,
            overlay: true,
            displayMode: 'once',
            titleColor: '#333',
            messageColor: '#333',
            icon: 'fa fa-question-circle text-danger fs-2',
            backgroundColor: '#f0f0f0',
            title: 'Confirmação',
            message: 'Tem certeza que deseja alterar o status do produto <b>' + nome + '</b> para <b class="' + statusColor + '">' + status + '</b> ?',
            position: 'topCenter',
            transitionIn: 'fadeIn',
            transitionOut: 'fadeOut',
            progressBar: false,
            layout: 2,
            drag: false,
            pauseOnHover: true,
            overlayClose: false,
            closeOnEscape: false,
            closeOnClick: false,
            rtl: false,
            balloon: false,
            animateInside: false,
            touchEvents: {
                touchstart: {
                    passive: true
                },
                touchmove: {
                    passive: true
                }
            },
            buttons: [
                ['<button class="btn btn-primary btn-sm fs-6 text-white bg-secondary px-4 py-2 rounded border me-2"><b>Sim</b></button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');
                    $.ajax({
                        url: urlAlterarStatusProduto,
                        type: 'POST',
                        data: {
                            id: id,
                            status: status,
                            _token: token
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                iziToast.success({
                                    title: 'Sucesso!',
                                    message: 'O Status do produto <b>' + nome + '</b> foi alterado para <b class="' + statusColor + '">' + status + '</b>!',
                                    position: 'topCenter',
                                    timeout: 3000,
                                    overlay: true,
                                    displayMode: 'once',
                                    icon: 'fa fa-check-circle text-success',
                                    backgroundColor: '#f0f0f0',
                                    titleColor: '#333',
                                    messageColor: '#333',

                                });
                                $('#example3').DataTable().ajax.reload(null, false);
                            } else {
                                iziToast.warning({
                                    title: 'Aviso!',
                                    message: response.message,
                                    overlay: true,
                                    position: 'topCenter',
                                    displayMode: 'once',
                                    timeout: 3000,
                                    icon: 'fa fa-info-circle text-warning',
                                    backgroundColor: '#f0f0f0',
                                    titleColor: '#333',
                                    messageColor: '#333',

                                });

                            }
                        },
                        error: function(xhr, error, thrown) {
                            console.error(xhr, error, thrown);
                            iziToast.error({
                                title: 'Erro',
                                message: 'Ocorreu um erro ao cancelar a Fatura.',
                                position: 'topCenter',
                                timeout: 3000,
                                icon: 'fa fa-warning text-danger',
                                backgroundColor: '#f0f0f0',
                                titleColor: '#333',
                                messageColor: '#333',

                            });
                        }
                    });
                }],
                ['<button class="btn btn-primary btn-sm fs-6 text-white bg-primary px-4 py-2 rounded border"><b>Não</b></button>', function(instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');
                }],
            ]
        });
    }
</script>