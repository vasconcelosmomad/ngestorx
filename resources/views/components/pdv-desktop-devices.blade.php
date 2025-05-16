<script src="https://unpkg.com/lucide@latest"></script>
<main class="pt-24 pb-28 px-4 sm:px-6 lg:px-8 w-full">
        <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="w-full">
            <div class="flex items-center">
                <div class="w-full">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('painel.index', ['page' => 'dashboard']) }}"
                                    class="text-gray-700 hover:text-blue-600">Home</a>
                            </li>
                            <li class="flex items-center">
                                <span class="mx-2 text-gray-400">/</span>
                                <a href="javascript: void(0)" class="text-gray-500">Faturamento (FR)</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-6">
        <!-- Card Esquerda -->
        <div class="md:col-span-8 bg-white rounded-md shadow-lg border border-gray-200">
            <!-- Nav Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 tab-buttons p-0">
                    <li class="me-2">
                        <button data-tab="tab1"
                            class="tab-link inline-block p-4 border-b-2 rounded-t-lg text-blue-600 border-blue-600">Produtos</button>
                    </li>
                    <li class="me-2">
                        <button data-tab="tab2"
                            class="tab-link inline-block p-4 border-b-2 rounded-t-lg hover:text-blue-600 hover:border-blue-600">Prescrições</button>
                    </li>
                </ul>
            </div>

            <!-- Tab Contents -->
            <div id="tab1" class="tab-content">
                <div class="overflow-x-auto bg-white p-2 rounded ">
                    <table id="get-produtos"
                        class="table-auto  min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                        <thead>
                            <tr>
                                <th class="text-left py-2">Produto</th>
                                <th class="text-left py-2">Lote</th>
                                <th class="text-left py-2">Dt.Compra</th>
                                <th class="text-left py-2">Estoque</th>
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

            <div id="tab2" class="tab-content hidden">
                <div class="overflow-x-auto bg-white p-4 rounded  ">
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


        </div>

        <!-- Card Direita -->
        <div class="md:col-span-4 bg-white rounded-md border border-gray-200 p-2 shadow-md">
            <form id="form-venda-dinheiro" action="" autocomplete="off" class="space-y-4">
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

                <ol id="itens-venda" class="list-decimal pl-2 overflow-y-auto h-[25vh] space-y-2">
                    <!-- itens da venda serão adicionados aqui -->
                </ol>

                <div class="shadow-md border-gray-300 my-2"></div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h5 class="text-xl  sm:mt-0">Total: <span id="total-venda" class="font-semibold"></span></h5>
                    <input type="hidden" id="total-venda-hidden" name="total-venda-hidden">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700  sm:mt-0 flex items-center gap-2"
                        id="btn-finalizar-venda">
                       <i data-lucide="hand-coins" class="w-5 h-5"></i> Finalizar Venda
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label for="nome-cliente" class="block text-sm font-medium text-gray-700">Nome do
                            Cliente</label>
                        <input type="text" name="nome_cliente" id="nome_cliente"
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="nuit-cliente" class="block text-sm font-medium text-gray-700">NUI</label>
                        <input type="text" name="nuit" id="nuit"
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                    </div>

                    <div class="md:col-span-2">
                        <label for="endereco-cliente" class="block text-sm font-medium text-gray-700">Endereço</label>
                        <input type="text" name="endereco" id="endereco"
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="valor_recebido" class="block text-sm font-medium text-gray-700">Valor
                            Recebido</label>
                        <input type="text" name="valor_recebido" id="valor_recebido"
                            onkeyup="calcularTroco(this, '#total-venda-hidden', '#troco')"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/,/g, '.');"
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="troco" class="block text-sm font-medium text-gray-700">Valor de Troco</label>
                        <input type="text" name="troco" id="troco" readonly placeholder="0,00"
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200 bg-gray-100 text-center">
                    </div>

                    <div>
                        <label for="metodo-pagamento" class="block text-sm font-medium text-gray-700">Método
                            Pag.<span class="text-red-500">*</span></label>
                        <select name="metodo_pagamento" id="metodo-pagamento"
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                            <option value="">Selecione </option>
                        </select>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @include('components.footer-pdv')
</main>