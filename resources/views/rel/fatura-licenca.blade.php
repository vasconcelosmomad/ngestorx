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
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        padding: 20px;

    }

    .invoice-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .company-info {
        margin: 0px;
        width: 280px;
    }

    .company-info h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .company-info p {
        margin: 0px 0;
        font-size: 14px;
    }

    .client-info p {
        margin: 0px 0;
        font-size: 14px;

    }

    .client-info {
        padding-left: 0px;
        width: 240px;
    }

    .invoice-number p {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
    }

    .invoice-number h2 {
        font-size: 20px;
        font-weight: bold;
        text-align: left;
        margin-top: 30px;
    }

    .invoice-number {
        padding-left: 10spx;
        width: auto;
    }

    .location-date {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
        padding: 10px 0;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    .invoice-table th {
        background-color: #f8f8f8;
    }

    .invoice-table tbody tr {
        height: 30px;
    }

    .tax-info {
        margin: 20px 0;
    }

    .tax-info p {
        margin: 5px 0;
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

    .signature {
        margin-top: 10px;
        text-align: right;
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
        margin: 20px 0px;
    }

    .footer p {
        margin: 4px;
    }

    .signature {

        margin-top: 30px;
    }



    .signature p {
        margin: 5px 0;
        font-weight: bold;
        font-size: 16px;
    }

    .signature small {
        font-size: 14px;
        color: #333;
    }

    .parcelas-table {
        width: 260px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-collapse: collapse;
    }

    .parcelas-table th,
    .parcelas-table td {
        border: 1px solid #ccc;
        padding: 5px;
        text-align: left;
    }

    .parcelas-table th {
        background-color: #f8f8f8;
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
<div class="invoice-container">
    <div class="header">
        <table style="width: 100%; border: none; table-layout: fixed;">
            <tr>
                <!-- Dados da Empresa -->
                <td style="width: 40%; vertical-align: top;" class=".company-info">
                    <h1>Softetech</h1>
                    <p>Cell: (+258) 84 123 4567</p>
                    <p>Email: empresa@email.com</p>
                    <p>N.U.I.T: 123456789</p>
                    <p>Website: www.empresa.com</p>
                </td>

                <!-- Número da Fatura -->
                <td style="width: 40%; text-align: left; vertical-align: top; margin-right: 20px;" class="invoice-client-info">
                    <p class="dotted-line"><strong>Exmo(s). Sr.(s):</strong> Nome do Cliente</p>
                    <p class="dotted-line"><strong>Morada:</strong> Endereço do Cliente</p>
                    <p class="dotted-line"><strong>N.U.I.T:</strong> 987654321</p>
                </td>
                <!-- Dados do Cliente -->
                <td style="width: 20%; text-align:right; vertical-align: top;" class="invoice-number">
                    <h2>FACTURA</h2>
                    <p>N.F: <span>000123</span></p>
                </td>
            </tr>
        </table>
    </div>


    <div class="location-date">
        <div class="location">{{$config->provincia}}</div>
        <div class="date"><?= date('d') ?> de <?= $nomeMes ?> de <?= date('Y') ?></div>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>QTD</th>
                <th>DESCRIÇÃO</th>
                <th>PREÇO UNITÁRIO</th>
                <th>VALOR TOTAL</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>1</td>
                <td>{{ $plano->descricao_completa}}</td>
                <td>{{number_format($plano->base_anual, 2, ',', '.')}}</td>
                <td>{{number_format($plano->base_mensal, 2, ',', '.')}}</td>
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>Sub-Total</strong></td>
                <td>
                    <span class="amount">{{number_format($plano->valor, 2, ',', '.')}}</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>IVA</strong></td>
                <td>0%</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>Desconto</strong></td>
                <td>

                    <span class="amount">{{$plano->desconto}}</span>

                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td><strong>Total a Pagar:</strong></td>
                <td>

                    <span class="amount">{{number_format($plano->valor, 2, ',', '.')}}</span>

                </td>
            </tr>






        </tbody>
    </table>



    
    <div class="tax-info">
        <p style="font-size: 18px;"><strong>Motivo Justificativo de não aplicação do Imposto:</strong></p>
        <p class="dotted-line">Isenta de imposto conforme o Regime de Tributação Simplificado vigente.</p>
        <p class="dotted-line"></p>

    </div>


    <div class="payment-method">
        <input
            type="checkbox"
            style="width: 20px; height: 20px; cursor: pointer; accent-color: #007BFF;">
        <span style="font-size: 16px; color: #333;">Dinheiro.............</span>
        <input
            type="checkbox"
            style="width: 20px; height: 20px; cursor: pointer; accent-color: #007BFF;" checked>
        <span style="font-size: 16px; color: #333;">M-pesa.............</span>
        <input
            type="checkbox"
            style="width: 20px; height: 20px; cursor: pointer; accent-color:rgb(242, 243, 245);">
        <span style="font-size: 16px; color: #333;">Outros</span>
    </div>






    <div class="signature" style="border-top: 1px solid #ccc; width: 300px; position: absolute; right: 20px;">

        <p style="margin-bottom: 0px; margin-top: 5px;">Assinatura e Carimbo</p>
        <small class="assinatura">{{ date('d/m/Y') . ' às ' . date('H') . 'h:' . date('i') }}</small>
    </div>
    <div class="footer">
        <p>Documento processado por computador</p>
        <p>Copyright &copy; <strong>nGestorX </strong> {{date('Y')}} </p>
    </div>
</div>