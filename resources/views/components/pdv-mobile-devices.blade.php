<main class="pt-24 pb-28 px-4 max-w-screen-xl mx-auto">

    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="w-full">
            <div class="flex items-center">
                <div class="w-full">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('painel.index', ['page' => 'dashboard-operator']) }}"
                                    class="text-gray-700 hover:text-blue-600">Home</a>
                            </li>
                            <li class="flex items-center">
                                <span class="mx-2 text-gray-400">/</span>
                                <a href="javascript: void(0)" class="text-gray-500">Ponto de venda(PDV)</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <h5 class="flex justify-between items-center px-4 py-2 bg-gray-100  rounded-t-md shadow text-sm">
        <small class=" text-gray-600 border border-blue-200 rounded px-3 py-1">
            Itens Adicionados (
            <span class="text-red-500 font-semibold" id="qtd-itens-venda">0</span>
            )
        </small>
        <span class="text-sm text-gray-700">
            <span id="numero-caixa" class="font-semibold"></span>
        </span>
    </h5>

    <ol id="itens-venda" class="list-decimal pl-2 overflow-y-auto h-[45vh] space-y-2">
        <!-- itens da venda serão adicionados aqui -->
    </ol>

  

</main>
  <!-- Conteúdo fixo acima do footer -->
  <div class="fixed bottom-16 left-0 w-full bg-white shadow z-50 px-4 py-2 rounded-t-lg">
        <div class="flex items-center justify-between gap-2">
            <h5 class="text-xl">Total: <span id="total-venda" class="font-semibold"></span></h5>

            <button type="button" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700"
                id="btnConfirmar">
                <i data-lucide="hand-coins"></i>
            </button>
        </div>
    </div>
<!-- FOOTER -->
<footer
    class="fixed bottom-0 left-0 w-full bg-white shadow-2xl flex justify-around items-center py-3 z-50 rounded-t-xl">

    <button id="btnPrescricoes" class="flex flex-col items-center text-gray-500">
        <i data-lucide="pill-bottle" class="w-5 h-5"></i>
        <span class="text-xs mt-1">Prescrições</span>

    </button>

    <button id="openSidebar" class="flex flex-col items-center text-white rounded-full bg-blue-500 p-2">
        <i data-lucide="list-tree" class="w-6 h-6 "></i>
    </button>

    <button id="btnProdutos" class="flex flex-col items-center text-gray-500">
        <i data-lucide="package-search" class="w-5 h-5"></i>
        <span class="text-xs mt-1">Produtos</span>
    </button>
</footer>
<form id="form-venda-dinheiro" action="" autocomplete="off" class="space-y-4">
    <input type="hidden" id="total-venda-hidden" name="total-venda-hidden">
    <!-- OFFCANVAS PRESCRIÇÕES -->
    <div id="offcanvasPrescricoes"
        class="fixed bottom-0 left-0 w-full bg-white shadow-xl rounded-t-2xl p-4 z-50 hidden rounded-t-2xl border-t border-gray-300">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold">Prescrições</h2>
            <button type="button" class="text-gray-500" onclick="closeAll()">
                <i data-lucide="square-x" class="w-5 h-5"></i>
            </button>
        </div>
        <div>
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md  max-w-3xl mx-auto my-4"
                role="alert">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 mt-1 flex-shrink-0 text-yellow-500" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M12 9v2m0 4h.01m-.01 0h-.01m0-4h.01m-.01 0h-.01m0-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                    </svg>
                    <div>
                        <p class="font-semibold">Em desenvolvimento</p>
                        <p class="text-sm">O recurso de integração com prescrições médicas ainda está em
                            desenvolvimento. Em breve, clínicas e hospitais poderão enviar prescrições
                            diretamente para a farmácia.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- OFFCANVAs FINALIZAR VENDA -->
    <div id="offcanvasFecharVenda"
        class="fixed bottom-0 left-0 w-full bg-white shadow-xl rounded-t-2xl p-4 z-50 hidden rounded-t-2xl border-t border-gray-300">
        <div class="flex justify-between items-center mb-2">
            <button type="submit" id="btn-finalizar-venda"
                class="text-white bg-blue-400 px-4 py-2 rounded hover:bg-blue-200 flex items-center gap-2">
                <i data-lucide="hand-coins" class="w-5 h-5"></i>
                <span>Finalizar venda</span>
            </button>

            <button type="button" class="text-gray-500" onclick="closeAll()">
                <i data-lucide="square-x" class="w-5 h-5"></i>
            </button>
        </div>
        <div>
            <!-- Grid com 2 colunas mesmo em mobile -->
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label for="nome-cliente" class="block text-sm font-medium text-gray-700">Nome do Cliente</label>
                    <input type="text" name="nome_cliente" id="nome_cliente"
                        class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                </div>

                <div>
                    <label for="nuit-cliente" class="block text-sm font-medium text-gray-700">NUIT</label>
                    <input type="text" name="nuit" id="nuit"
                        class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                </div>

                <div class="col-span-2">
                    <label for="endereco-cliente" class="block text-sm font-medium text-gray-700">Endereço</label>
                    <input type="text" name="endereco" id="endereco"
                        class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                </div>
            </div>

            <!-- Grid com 3 colunas mesmo em mobile -->
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div>
                    <label for="valor_recebido" class="block text-sm font-medium text-gray-700">Valor Receb.</label>
                    <input type="text" name="valor_recebido" id="valor_recebido"
                        onkeyup="calcularTroco(this, '#total-venda-hidden', '#troco')"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/,/g, '.');"
                        class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                </div>

                <div>
                    <label for="troco" class="block text-sm font-medium text-gray-700">Troco</label>
                    <input type="text" name="troco" id="troco" readonly
                        class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                </div>

                <div>
                    <label for="metodo-pagamento" class="block text-sm font-medium text-gray-700">Método Pag.</label>
                    <select name="metodo_pagamento" id="metodo-pagamento"
                        class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                        <option value="">Selecione </option>
                    </select>
                </div>
            </div>


        </div>
    </div>

    <!-- OFFCANVAS PRODUTOS -->
    <div id="offcanvasProdutos"
        class="fixed bottom-0 left-0 w-full bg-white shadow-xl border-t border-gray-300 rounded-t-xl p-4 z-50 hidden">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold">Produtos</h2>
            <button type="button" class="text-gray-500" onclick="closeAll()">
                <i data-lucide="square-x" class="w-5 h-5"></i>
            </button>
        </div>
        <div>
            <!-- Conteúdo manual de produtos -->
            <div class="overflow-x-auto bg-white p-2 rounded ">
                <table id="get-produtos-mobile"
                    class="table-auto  min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                    <thead>
                        <tr>
                            <th class="text-left py-2">Produto</th>
                            <th class="text-left py-2">PU</th>
                            <th class="text-left py-2">QTD</th>
                            <th class="text-left py-2">ADD</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</form>
<!-- JS -->

<script>

const offcanvasPrescricoes = document.getElementById('offcanvasPrescricoes');
const offcanvasProdutos = document.getElementById('offcanvasProdutos');
const offcanvasFecharVenda = document.getElementById('offcanvasFecharVenda');
lucide.createIcons(); // Ativa os ícones Lucide.js
</script>