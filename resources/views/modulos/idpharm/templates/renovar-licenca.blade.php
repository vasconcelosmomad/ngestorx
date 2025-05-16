<div class="default-tab border-b mt-5 pt-1">
    <h3 class="card-title p-2">Renovar Licença <small class="fs-6">- Base anual: {{ number_format($plano_base, 2, ',', '.') }}</small></h3>
    <ul class="nav nav-tabs " role="tablist">
        <li class="nav-item">
            <a class="nav-link active text-dark fw-bold text-uppercase" data-bs-toggle="tab" href="#planos"><h4 class="card-title">Selecionar Plano</h4></a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark " data-bs-toggle="tab" href="#itens"><h4 class="card-title">Finalizar processo</h4></a>
        </li>

    </ul>
    <div class="tab-content p-0  rounded-3">
        <div class="tab-pane fade show active" id="planos" role="tabpanel">
            <div class="p-2">
                <div class="row">
                    <div class="col-sm-6 ">
                        <div class="card p-0">
                            <div class="card-body p-2 ">

                                <div class="accordion accordion-gradient-blue accordion-bordered opacity-75 pb-0 zindex-1000" id="accordion-seven">
                                    <div class="accordion" id="accordion-seven">

                                        <!-- Plano Mensal -->
                                        <div class="accordion-item">
                                            <div class="accordion-header rounded-lg" id="accord-7One" data-bs-toggle="collapse" data-bs-target="#collapse7One" aria-controls="collapse7One" aria-expanded="true" role="button">
                                                <span class="accordion-header-icon"></span>
                                                <span class="accordion-header-text">
                                                    <span class="fs-4" id="nomePlanoTrimestral"></span>
                                                    <span id="valorPlanoTrimestral"></span><br>
                                                    <small class="text-success" id="descricaoPlanoTrimestral"></small>
                                                </span>
                                                <span class="accordion-header-indicator"></span>
                                                <input type="hidden" id="plano-trimestral" class="plano" value="">
                                                <input type="hidden" id="valor-trimestral" class="valor" value="">
                                                <input type="hidden" id="idPlano-trimestral" class="idPlano" value="">
                                            </div>

                                            <div id="collapse7One" class="collapse accordion__body show" aria-labelledby="accord-7One" data-bs-parent="#accordion-seven">
                                                <div class="accordion-body-text">
                                                    <p><strong><i class="las la-thumbtack fs-4 text-danger"></i> Recursos Inclusos:</strong></p>
                                                    <ul>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Gestão de Vendas e Controle de Estoque</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Emissão de Vendas Diretas (VD), Recibos e Cotações</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Relatórios Detalhados de Vendas, Compras e Estoque</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Backup Manual sob Demanda</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Contas a Pagar e a Receber</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Parcelamento de Faturas</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Dashboard com Análise de Vendas, Compras e Contas</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Alertas de Contas a Receber Vencidas</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Alerta de Produtos Próximos ao Vencimento</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Exportação de Listas de Produtos em Ruptura</li>
                                                    </ul>
                                                    <p><strong><i class="las la-phone text-warning fs-3"></i> Suporte: </strong> Acesso a suporte via WhatsApp e Email (resposta em até 24h).</p>
                                                    <button class="btn btn-primary w-100 btn-sm py-2" onclick="selecionarPlano(this)"><i class="fa fa-check-circle text-success fs-4"></i> Selecionar</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Plano Semestral -->
                                        <div class="accordion-item">
                                            <div class="accordion-header collapsed rounded-lg" id="accord-7Two" data-bs-toggle="collapse" data-bs-target="#collapse7Two" aria-controls="collapse7Two" aria-expanded="false" role="button">
                                                <span class="accordion-header-icon"></span>
                                                <span class="accordion-header-text">
                                                    <span class="fs-4" id="nomePlanoSemestral"></span>
                                                    <span id="valorPlanoSemestral"></span><br>
                                                    <small class="text-success" id="descricaoPlanoSemestral"></small>
                                                </span>
                                                <span class="accordion-header-indicator"></span>
                                                <input type="hidden" id="plano-semestral" class="plano" value="">
                                                <input type="hidden" id="valor-semestral" class="valor" value="">
                                                <input type="hidden" id="idPlano-semestral" class="idPlano" value="">
                                            </div>
                                            <div id="collapse7Two" class="collapse accordion__body" aria-labelledby="accord-7Two" data-bs-parent="#accordion-seven">
                                                <div class="accordion-body-text">
                                                    <p><strong><i class="las la-thumbtack fs-4 text-danger"></i> Recursos Incluídos:</strong> Todos os recursos do Plano Mensal +</p>
                                                    <ul>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Atualizações automáticas do sistema</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Prioridade no atendimento ao suporte</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Backup Automático Mensal</li>
                                                    </ul>
                                                    <p><strong><i class="las la-phone text-warning fs-3"></i> Suporte: </strong> Acesso a suporte via WhatsApp e Email (resposta em até 12h).</p>
                                                    <button class="btn btn-primary w-100 btn-sm py-2" onclick="selecionarPlano(this)"><i class="fa fa-check-circle text-success fs-4"></i> Selecionar</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Plano Anual -->
                                        <div class="accordion-item">
                                            <div class="accordion-header collapsed rounded-lg" id="accord-7Three" data-bs-toggle="collapse" data-bs-target="#collapse7Three" aria-controls="collapse7Three" aria-expanded="false" role="button">
                                                <span class="accordion-header-icon"></span>
                                                <span class="accordion-header-text">
                                                    <span class="fs-4" id="nomePlanoAnual"></span>
                                                    <span id="valorPlanoAnual"></span><br>
                                                    <small class="text-success" id="descricaoPlanoAnual"></small>
                                                </span>
                                                <span class="accordion-header-indicator"></span>
                                                <input type="hidden" id="plano-anual" class="plano" value="">
                                                <input type="hidden" id="valor-anual" class="valor" value="">
                                                <input type="hidden" id="idPlano-anual" class="idPlano" value="">
                                            </div>
                                            <div id="collapse7Three" class="collapse accordion__body" aria-labelledby="accord-7Three" data-bs-parent="#accordion-seven">
                                                <div class="accordion-body-text">
                                                    <p><strong><i class="las la-thumbtack fs-4 text-danger"></i> Recursos Incluídos:</strong> Todos os recursos do Plano Semestral +</p>
                                                    <ul>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Implementação personalizada (ajustes para seu negócio)</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Backup Automático Diário</li>
                                                        <li><i class="fa fa-check-circle text-secondary"></i> Suporte Premium (resposta em até 6h)</li>
                                                    </ul>
                                                    <p><strong><i class="las la-phone text-warning fs-3"></i> Suporte: </strong> Suporte VIP via WhatsApp, Email e Chamadas</p>
                                                    <button class="btn btn-secondary w-100 btn-sm py-2" onclick="selecionarPlano(this)"><i class="fa fa-check-circle text-success fs-4"></i> Selecionar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade rounded" id="itens" role="tabpanel">
            <div class="p-2">
                <div class="row">
                    <div class="col-sm-6 ">
                        <div class="card" >
                            <div class="card-header d-block">
                                <p class="m-0 subtitle"><strong>NOTA:</strong> Atualização Móvel <img src="{{ asset('assets/images/mpesa.png') }}" alt="M-Pesa">(imediata) | Outras atualizações em até 24h</p>
                            </div>
                            <div class="card-body">
                                <form id="form-renovar-licenca" autocomplete="off">


                                    <div class="row">


                                        <!-- Valor a pagar -->
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Valor Total do Plano Selecionado:</label>
                                            <input type="text" class="form-control height form-control-sm fs-5" id="valorTotal" value="" placeholder="0,00 " readonly>
                                            <input type="hidden" id="idPlano" name="plano_id">
                                        </div>

                                        <!-- UID Empresa -->
                                        <div class="col-sm-3 mb-3">
                                            <label for="uid" class="form-label fw-bold">UID Empresa:<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control height form-control-sm" id="uid" value="" name="uid_empresa">
                                            <small class="error-message text-danger"></small>
                                        </div>
                                        <div class="col-sm-5 mb-3 me-0">
                                            <label for="sistema" class="form-label fw-bold">Selecione o Sistema:<span class="text-danger">*</span></label>
                                            <select class="default-select form-select height fs-6" id="sistema" name="id_sistema" required>

                                            </select>
                                            <small class="error-message text-danger"></small>
                                        </div>

                                        <!-- Método de pagamento -->
                                        <div class="col-sm-4 mb-3 ms-0">
                                            <label for="metodoPagamento" class="form-label fw-bold">Forma de Pagamento:<span class="text-danger">*</span></label>
                                            <select class="default-select form-select height fs-6" id="metodo_pagamento" name="metodo_pagamento_id" onchange="verificarPagamento()">
                                                <option value="" selected disabled>Selecione </option>

                                            </select>
                                            <small class="error-message text-danger"></small>
                                        </div>




                                        <!-- Campo de telefone -->
                                        <div id="campoTelefone" class="mb-3" style="display:none;">
                                            <label for="telefone" class="form-label fw-bold">Número de Telefone:<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control height fs-6" id="telefone" name="phone" placeholder="Ex: 84 999 999 999" maxlength="9" required>
                                            <small class="error-message text-danger" id="resultado"></small>
                                            <button type="submit" id="enviar-confirmar-pagamento" class="btn btn-primary btn-sm w-100 zindex-1000 py-2 mt-4"><i class="fa fa-check-circle text-success fs-4"></i> Confirmar Pagamento</button>
                                        </div>

                                        <!-- Campo de comprovativo -->
                                        <div id="campoComprovativo" class="mb-0" style="display:none;">
                                            <label for="comprovativo" class="form-label fw-bold">Anexar Comprovativo:</label>
                                            <input type="file" class="form-control height fs-6 mb-3" id="comprovativo" name="comprovativo">
                                            <small class="error-message text-danger" id="resultado"></small>
                                            <button type="submit" id="enviar-comprovativo" class="btn btn-primary btn-sm w-100 zindex-1000 py-2"><i class="fa fa-check-circle text-success fs-4"></i> Confirmar Pagamento</button>
                                        </div>

                                    </div>



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>















</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="{{ asset('assets/js/renovar-licenca.js') }}"></script>
<script>
    var urlPlanos = "{{ route('get.planos') }}";
    var urlSoftwares = "{{ route('get.softwares') }}";
    var urlPaymentM_Pesa = "{{ route('mpesa.send-payment') }}";
    var urlPagamentos = "{{ route('get.formas.pagamento') }}";
    var token = "{{ csrf_token() }}";
    var urlBaixarReciboPdf = "{{ route('fatura.pagamento.pdf.download', ['id' => ':id']) }}";
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>