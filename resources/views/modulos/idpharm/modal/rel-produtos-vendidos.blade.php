<div
    class="modal"
    id="modal-rel-produtos-vendidos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Relatório de Produtos Vendidos</h5>
                <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
            </div>
            <form id="form_rel_produtos_vendidos" autocomplete="off" method="post" action="{{ route('relatorio.produtos.vendidos') }}">
                @csrf
                <div class="modal-body p-3 mt-2">

                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="data_inicial" class="form-label">Data Inicial<span class="text-danger">*</span></label>
                            <input type="text" class="datepicker form-control read-only" placeholder="dd/mm/yyyy" id="data_inicial" name="data_inicial" readonly required>
                            <small><span id="data_inicial-error" class="error-message text-danger text-small"></span></small>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="data_final" class="form-label">Data Final<span class="text-danger">*</span></label>
                            <input type="text" class="datepicker form-control read-only" placeholder="dd/mm/yyyy" id="data_final" name="data_final" readonly required>
                            <small><span id="data_final-error" class="error-message text-danger text-small"></span></small>
                        </div>


                    </div>
                </div>

                <div class="modal-footer border-0">
                    <span
                        type="button"
                        id="btn-cancelar"
                        class="btn btn-outline-danger py-2 btn-cancelar fs-6"
                        data-bs-dismiss="modal">
                        Cancelar/Fechar Modal
                    </span>
                    <button type="submit" class="btn btn-primary py-2 btn-fechar-caixa fs-6"><i class="fa fa-file-pdf "></i>
                        Exportar PDF
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    $('#form_rel_produtos_vendidos').on('submit', function(event) {
        event.preventDefault(); // Impede o envio imediato do formulário

        // Pega os valores dos campos
        var data_inicial = $('#data_inicial').val();
        var data_final = $('#data_final').val();
        var tipo = $('#tipo').val();

        var valido = true;
        var mensagem = '';

        // Validação do campo data inicial
        if (data_inicial.trim() === '') {
            valido = false;
            mensagem = 'Campo obrigatório.';
            $('#data_inicial-error').text(mensagem);
            return;
        } else {
            $('#data_inicial-error').text('');
        }


        // Validação do campo data final
        if (data_final.trim() === '') {
            valido = false;
            mensagem = 'O campo data final é obrigatório.';
            $('#data_final-error').text(mensagem);
            return;
        } else {
            $('#data_final-error').text('');
        }


        // Se a validação passar, envia o formulário
        this.submit(); // Submete o formulário normalmente
    });
</script>