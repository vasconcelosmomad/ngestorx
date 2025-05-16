<div
    class="modal"
    id="modal-rel-mapa-vendas"
  >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mapa de Vendas</h5>
                <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
            </div>
            <form id="form_rel_mapa_vendas" action="{{ route('relatorio.mapa.vendas') }}" autocomplete="off" method="post">
                @csrf
        
                <div class="modal-body p-3 mt-2">

                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="data_inicial_mapa" class="form-label">Data Inicial</label>
                            <input type="text" class="datepicker form-control read-only" id="data_inicial_mapa" name="data_inicial_mapa" readonly>
                            <small><span id="data_inicial_mapa-error" class="error-message text-danger text-small"></span></small>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="data_final_mapa" class="form-label">Data Final</label>
                                <input type="text" class="datepicker form-control read-only" id="data_final_mapa" name="data_final_mapa" readonly>
                            <small><span id="data_final_mapa-error" class="error-message text-danger text-small"></span></small>
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-0">
                    <span
                        type="button"
                        id="btn-cancelar"
                        class="btn btn-outline-danger py-2 btn-cancelar fs-6"
                        data-bs-dismiss="modal">
                        Cancelar
                    </span>
                    <button type="submit" class="btn btn-primary py-2 btn-fechar-caixa fs-6">
                        Gerar Mapa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>l