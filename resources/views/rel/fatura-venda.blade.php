<script>
    window.print();

    setTimeout(function() {
        window.close();
        window.location.href = "{{route('painel.index', ['page' => 'painel-pdv'])}}";
    }, 3000);
</script>
@php
$meses = [
1 => 'Janeiro',
2 => 'Fevereiro',
3 => 'Março',
4 => 'Abril',
5 => 'Maio',
6 => 'Junho',
7 => 'Julho',
8 => 'Agosto',
9 => 'Setembro',
10 => 'Outubro',
11 => 'Novembro',
12 => 'Dezembro'
];

// Obter o mês atual (número de 1 a 12)
$numeroMes = date('n');

// Obter o nome do mês
$nomeMes = $meses[$numeroMes];


// Função para calcular a diferenca de dias entre duas datas
function calcularDiferencaDias($data_inicial, $data_final) {
$data1 = new DateTime($data_inicial);
$data2 = new DateTime($data_final);
$diferenca = $data1->diff($data2);
return $diferenca->days; // Retorna o número de dias
}
@endphp

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 5px;
        border: 1px solid black;
    }

    .header-table {
        margin-bottom: 10px;
    }

    .no-border {
        border: none;
    }

    .center-text {
        text-align: center;
    }

    .main-title {
        font-size: 20px;
        font-weight: bold;
    }

    .items-table td {
        height: 25px;
    }

    .footer-options {
        margin-top: 10px;
    }

    .signature-line {
        margin-top: 50px;
        text-align: right;
    }

    /* Rodapé */
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        border-top: 1px solid #ccc;
        font-size: 14px;
        color: #6c757d;
        margin-top: 12px;
        margin-bottom: 0px;
        margin: 20px 20px;
    }

    .footer p {
        margin: 4px;
    }



    .totals {
                margin-left: auto;
                width: 300px;
            }

            .total-line {
                display: flex;
                justify-content: space-between;
                padding: 5px 0;
                border-bottom: 1px solid #ccc;
            }

            .payment-method {
                margin: 20px 0;
            }

            .parcelas {
                margin: 10px 0;
            }

            .payment-method label {
                margin-right: 20px;
            }

           
            .signature p {
                margin: 10px 0;
            }

            @media print {
                body {
                    background: white;
                    padding: 0;
                }

                .invoice-container {
                    box-shadow: none;
                    padding: 20px;
                }
            }

            .dotted-line {
                border-bottom: 1px dotted #000;
                height: 1.5em;
                margin: 2px 0 2px 0;
                padding: 0px 0px;
                font-size: 15px;

            }



            .parcelas-table {
                width: 260px;
                font-size: 14px;
                border: 1px solid #ccc;
                border-collapse: collapse;
            }

          


            .termos-pagamento p {
                margin: 2px 0;
                font-size: 14px;
                color: #333;
            }

            .termos-pagamento .header-title {
                font-size: 16px;
                font-weight: bold;

            }
</style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td style="width: 43%;">
                <div class="center-text">
                    <div class="main-title">{{$dadosEmpresa->nome_empresa}}</div>
                    <div>{{$dadosEmpresa->endereco}}</div>
                    <div>Cell:(+258) {{$dadosEmpresa->telefone}}</div>
                    <div>{{$dadosEmpresa->email}}</div>
                    <div>{{$dadosEmpresa->provincia}}</div>
                </div>
            </td>
            <td style="width: 23%;">
                <div>Exmo(s). Sr.(s): {{$cliente->nome}} ........................................................................</div>
                <div>..............................................................................................</div>
                    <div>Morada: {{$cliente->endereco}} ....................................................................................</div>
                    <div>..............................................................................................</div>
                <div>N.U.I.T.: {{$cliente->nuit}} .....................................................</div>
            </td>
            <td style="width: 33%;">
                <div class="center-text main-title">FACTURA</div>
                <div class="center-text">
                    <p style="font-size: 18px;">Nº: {{$fatura->venda_id}}</p>
                </div>
            </td>
        </tr>
    </table>

    <table class="header-table">
        <tr>
            <td style="width: 50%;" class="center-text">{{$dadosEmpresa->provincia}}</td>
            <td style="width: 50%;" class="center-text">{{date('d')}} de {{$nomeMes}} de {{date('Y')}}</td>
        </tr>
    </table>

    <table class="items-table">
        <tr>
            <th>QTD</th>
            <th>DESCRIÇÃO</th>
            <th>PREÇO UNITÁRIO</th>
            <th>VALOR TOTAL</th>
        </tr>
        <!-- 12 linhas vazias para itens -->
        @foreach ($dadosVendaForch as $item)
        <tr>
            <td>{{$item->quantidade}}</td>
            <td>{{$item->produto_nome}}</td>
            <td>{{number_format($item->pu, 2, ',', '.')}}</td>
            <td>{{number_format($item->pu * $item->quantidade, 2, ',', '.')}}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
      
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>


        <tr>
            <td colspan="2">
                <div class="tax-info">
                    <p style="font-size: 18px;"><strong>Motivo Justificativo de não aplicação do Imposto:</strong></p>
                    <p>{{$regimeTributacao->descricao}}</p>
                    <p></p>

                </div>
            </td>
            <td colspan="2">
                <div class="totals">
                    <div class="total-line">
                        <span>SUB-TOTAL ...</span>
                        <span class="amount">{{number_format($fatura->valor_total, 2, ',', '.')}}</span>
                    </div>
                    <div class="total-line">
                        <span>IVA INCLUIDO ...</span>
                        <span class="amount">{{$iva}}</span>
                    </div>
                    <div class="total-line">
                        <span>TOTAL A PAGAR ...</span>
                        <span class="amount">{{number_format($fatura->valor_total, 2, ',', '.')}}</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer-options">
        <input
            type="checkbox"
            style="width: 20px; height: 20px; cursor: pointer; accent-color: #007BFF;">
        <span style="font-size: 16px; color: #333;">Dinheiro.............</span>
        <input
            type="checkbox"
            style="width: 20px; height: 20px; cursor: pointer; accent-color: #007BFF;">
        <span style="font-size: 16px; color: #333;">Cheque.............</span>
        <input
            type="checkbox"
            style="width: 20px; height: 20px; cursor: pointer; accent-color:rgb(242, 243, 245);">
        <span style="font-size: 16px; color: #333;">Outros</span>


        <div class="termos-pagamento">
            <p class="header-title">Termos de Pagamento</p>
            <p>Favor realizar o pagamento no prazo máximo de <strong> @php echo calcularDiferencaDias($fatura->data_emissao, $fatura->data_vencimento) @endphp dias</strong> após o recebimento desta fatura.</p>
            <p class="header-title">Modalidades de Pagamento</p>
            @foreach($modalidadePag as $item)
            <p>{{$item->nome_conta}}: {{$item->numero_conta}}, Titular: {{$item->titular_conta}} - {{$item->descricao}}</p>
            @endforeach



        </div>
        <div class="payment-method">
            <h3 class="header-title">Parcelas</h3>
            <table class="">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Valor</th>
                        <th class="center-text">Data de Vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parcelas as $parcela)
                    <tr>
                        <td class="center-text">{{$parcela->numero}}ª</td>
                        <td class="center-text">{{number_format($parcela->valor, 2, ',', '.')}}</td>
                        <td class="center-text">{{date('d/m/Y', strtotime($parcela->data_vencimento))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="signature-line  ">
            Assinatura e Carimbo
            <br>.................................................
        </div>

        <div class="footer">
            <p>Documento processado por computador</p>
            <p>Copyright &copy; <strong>nGestorX </strong> {{date('Y')}} </p>
        </div>


        