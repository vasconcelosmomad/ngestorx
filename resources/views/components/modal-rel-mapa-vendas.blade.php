<div id="mapaVendas"
    class="modal fixed inset-0 hidden z-50 bg-gray-500/75 flex items-center justify-center opacity-0 transition-opacity duration-300">
    <div class="relative w-full max-w-lg bg-white rounded-lg shadow-xl p-2 mx-2 sm:mx-2 my-12">
        <form id="form_rel_mapa_vendas" action="{{ route('relatorio.mapa.vendas') }}" autocomplete="off" method="post">
            @csrf
            <div class="bg-white px-4 pt-2 pb-4 sm:p-6 sm:pb-4">

                <h3 class="text-lg font-semibold mb-4">Mapa de vendas</h3>
                
                <div class="flex flex-col md:flex-row gap-2 mt-2">
                    <div class="w-full">
                        <label for="data_inicial" class="block text-md text-gray-900">Data Inicial</label>
                        <div class="relative">
                            <input type="text" id="data_inicial" name="data_inicial"
                                class="datepicker mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200 pr-10"
                                value="{{ date('d-m-Y') }}" readonly>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 mt-1 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar text-gray-500">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                    <line x1="16" x2="16" y1="2" y2="6"></line>
                                    <line x1="8" x2="8" y1="2" y2="6"></line>
                                    <line x1="3" x2="21" y1="10" y2="10"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="data_final" class="block text-md text-gray-900">Data Final</label>
                        <div class="relative">
                            <input type="text" id="data_final" name="data_final" value="{{ date('d-m-Y') }}"
                                class="datepicker mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200 pr-10" readonly>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 mt-1 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar text-gray-500">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                    <line x1="16" x2="16" y1="2" y2="6"></line>
                                    <line x1="8" x2="8" y1="2" y2="6"></line>
                                    <line x1="3" x2="21" y1="10" y2="10"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button"
                    class="fecharModal px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 mr-2">Fechar</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-400 text-white rounded hover:bg-blue-400 mr-2">Gerar Mapa</button>
            </div>
        </form>
    </div>

</div>