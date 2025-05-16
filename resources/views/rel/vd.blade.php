<script>
    document.addEventListener("DOMContentLoaded", function() {
      /*  setTimeout(() => {
            window.print(); // Força a impressão
        }, 1000); // Aguarda um pouco para a página carregar
*/
        setTimeout(() => {
            window.close(); // Fecha a aba após um tempo
        }, 3000);
    });
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

$numeroMes = date('n');
$nomeMes = $meses[$numeroMes];

@endphp
<style>
    /* Receipt styles for 80mm thermal printer */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
        width: 80mm;
        margin: 0 auto;
        padding: 5mm;
    }

    .receipt {
        width: 100%;
    }

    .header {
        text-align: center;
        margin-bottom: 10px;
    }

    .header h1 {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .header p {
        font-size: 12px;
        line-height: 1.2;
        margin: 2px 0;
    }

    .client-info {
        margin: 10px 0;
    }

    .field {
        margin: 5px 0;
    }

    .right-header {
        text-align: right;
        font-weight: bold;
        font-size: 14px;
        margin-top: 2px;
        margin-bottom: 2px;
        padding: 3px;
        width: auto;
        margin-left: 100px;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .dotted-line {
        border-bottom: 1px dotted #000;
        height: 1.2em;
        margin: 2px 0;
        font-size: 12px;
    }

    .dotted-line-short {
        display: inline-block;
        width: 50px;
        border-bottom: 1px dotted #000;
    }

    .location-date {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;

    }

    .items {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
    }

    .items th {
        text-align: left;
        padding: 3px;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        font-size: 11px;
    }

    .items td {
        padding: 3px;
        height: 20px;
    }

    .totals {
        margin: 10px 0;
        text-align: right;
    }

    .total-line {
        display: flex;
        justify-content: space-between;
        margin: 5px 0;
    }

    .total-line .dotted-line {
        width: 120px;
    }

    .signature {
        margin-top: 20px;
        text-align: right;
    }

    .signature p {
        margin-bottom: 5px;
    }

    @media print {
        body {
            width: 80mm;
            margin: 2px;
            padding: 4px;
        }

        .receipt {
            page-break-after: always;
        }
    }

    .through {
        text-decoration: line-through;
        color: red;

    }
</style>


<div class="receipt">
    <div class="header">
        <h1>{{$dadosEmpresa->nome_empresa}}</h1>
        <p>{{$dadosEmpresa->endereco}}</p>
        <p>Telefone: {{$dadosEmpresa->telefone}}</p>
        <p>NUIT: {{$dadosEmpresa->nuit}}</p>
        <p>Email: {{$dadosEmpresa->email}}</p>
    </div>


    <div class="right-header">
        @if($faturaRecibo->status == 'Cancelada')
        <p class="through">VD: {{$dadosVenda->id}}</p>
        @else
        <p class="">VD: {{$dadosVenda->id}}</p>
        @endif
    </div>
    <div class="client-info">
        <p class="dotted-line">Exmo(s). Sr.(s): {{$faturaRecibo->cliente}}</p>
        <p class="dotted-line"></p>
        <p class="dotted-line">Morada: {{$faturaRecibo->endereco}}</p>
        <p class="dotted-line"></p>
        <p class="dotted-line">N.U.I.T: {{$faturaRecibo->nuit}}</p>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>QTD.</th>
                <th>DESIGNAÇÃO.</th>
                <th>PU</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dadosVendaForch as $item)
            <tr>
                <td class="dotted-line">{{$item->quantidade}}</td>
                <td class="dotted-line">{{$item->produto_nome}}</td>
                <td class="dotted-line">{{number_format($item->pu, 2, ',', '.')}}</td>
                <td class="dotted-line">{{number_format($item->pu * $item->quantidade, 2, ',', '.')}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>

    <div class="totals">
        <div class="total-line">
            <span>SUB-TOTAL ...</span>
            <div class="dotted-line"> <span>{{number_format($dadosVenda->total, 2, ',', '.')}}</span></div>

        </div>
        <div class="total-line">
            <span>IVA INCLUIDO ...</span>
            <div class="dotted-line"><span>{{$iva}}</span></div>

        </div>
        <div class="total-line">
            <span>DESCONTO ...</span>
            <div class="dotted-line"><span>{{number_format($faturaRecibo->desconto, 2, ',', '.')}}</span></div>
        </div>
        <div class="total-line">
            <span>VALOR RECEBIDO...</span>
            <div class="dotted-line"><span>{{number_format($faturaRecibo->valor_recebido, 2, ',', '.')}}</span></div>
        </div>
        <div class="total-line">
            <span>TROCO ...</span>
            <div class="dotted-line"><span>{{number_format($faturaRecibo->troco, 2, ',', '.')}}</span></div>
        </div>
        <div class="total-line">
            <span>TOTAL ...</span>
            <div class="dotted-line"><span>{{ number_format($dadosVenda->total, 2, ',', '.')}}</span></div>

        </div>
    </div>
    <div class="dotted-line"></div>
    <div class="location-date">
        <div class="location"><strong>{{$dadosEmpresa->provincia}}</strong></div>
        <div class="date-field">
            <div class="dotted-line-short">{{date('d')}} </div>
            <strong>de </strong>
            <div class="dotted-line-short"> {{$nomeMes}}</div>
            <strong style="margin-left: 10px;"> de </strong>
            <div class="dotted-line-short"> {{date('Y')}}</div>

        </div>
    </div>
    <div class="signature">Operador:{{$dadosUsuario->nome}}
        <p>{{date('H:i')}}H/min</p>
    </div>
    <div align="center" style="margin-top: 30px;">
        <p style="color: red; font-weight: bold; font-size: 16px;">{{$dadosVenda->status == 'Cancelada' ? 'Venda cancelada' : ''}}</p>
        <p>Documento processado por computador</p>
        <div class="dotted-line"></div>
    </div>
</div>