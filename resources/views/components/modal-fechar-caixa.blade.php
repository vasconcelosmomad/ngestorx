<div id="fecharCaixa"
    class="modal fixed inset-0 hidden z-50 bg-gray-500/75 flex items-center justify-center opacity-0 transition-opacity duration-300">
    <div class="relative w-full max-w-lg bg-white rounded-lg shadow-xl p-2 mx-2 sm:mx-2 my-12">
        <form id="form_fechar_caixa" action="" autocomplete="off" method="post">
            @csrf
            <div class="bg-white px-4 pt-2 pb-4 sm:p-6 sm:pb-4">

                <h3 class="text-lg font-semibold mb-4">Fechamento de caixa</h3>
                <div class="gap-2">
                    <div>
                        <label for="hora_fechamento" class="block text-md text-gray-900 ">Data e hora de fechamento</label>
                        <input type="text" id="hora_fechamento" name="hora_fechamento" value="{{ date('d-m-Y H:i:s') }}" readonly
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                    </div>
                   
                </div>
                <div class="flex gap-2 mt-2">
                    <div class="w-1/2">
                        <label for="valor_fechamento" class="block text-md text-gray-900 ">Float final</label>
                        <input type="text" id="valor_fechamento" name="valor_fechamento"
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200 ">
                    </div>
                    <div class="w-1/2">
                        <label for="caixa" class="block text-md text-gray-900 ">Caixa Nº</label>
                        <input type="text" id="numCaixa" name="caixa"
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200 bg-gray-100 text-center" readonly>
                    </div>
                </div>
                <div class="gap-2 ">
                    <label for="observacao" class="block text-md text-gray-900 ">Observação</label>
                    <textarea id="observacao" name="observacao"
                        class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200"></textarea>
                </div>

            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button"
                    class="fecharModal px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 mr-2">Cancelar</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-400 text-white rounded hover:bg-blue-400 mr-2">Confirmar</button>
            </div>
        </form>
    </div>

</div>