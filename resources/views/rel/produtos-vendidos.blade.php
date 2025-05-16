<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Produtos Vendidos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 10mm;

            @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
                font-family: Arial, sans-serif;
                font-size: 10pt;
            }
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .container {
            width: 100%;
        }

        .company-header {
            text-align: center;
            border-bottom: 1px solid #000;
            padding-bottom: 3mm;
            margin-bottom: 5mm;
        }

        .company-name {
            font-size: 12pt;
            font-weight: bold;
        }

        .company-details {
            font-size: 8pt;
        }

        h1 {
            text-align: center;
            font-size: 11pt;
            margin-bottom: 5mm;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin-bottom: 5mm;
            font-size: 10pt;
        }

        table,
        th,
        td {

            border: 0.5px solid #000;
        }

        th,
        td {
            padding: 1px;
            text-align: center;
            vertical-align: top;
        }

        th {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            width: 100%;
            border: 0.5pt solid #ddd;
            margin-bottom: 5mm;
            font-size: 8pt;
            flex-direction: row;
        }

        .summary-item {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2mm;
            border-right: 0.5pt solid #eee;
        }

        .summary-item:last-child {
            border-right: none;
        }

        .summary-item span {
            font-weight: bold;
            margin-right: 5mm;
        }

        .summary-item .value {
            border: 0.5pt solid #ddd;
            padding: 1mm;
            min-width: 30mm;
            text-align: right;
        }

        .signature-section {
            margin-top: 10mm;
            font-size: 8pt;
        }

        .signature-date {
            text-align: right;
            margin-bottom: 10mm;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 15mm;
        }

        .signature-field {
            width: 45%;
            text-align: center;
        }

        .signature-line {
            border-top: 0.5pt solid #000;
            margin-bottom: 2mm;
        }

        .value {
            border: 0.5pt solid #000;
            padding: 1mm;
            min-height: 6mm;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
            }

            /* Ensure zebra striping prints */
            tr:nth-child(even) {
                background-color: rgba(0, 0, 0, 0.05) !important;
            }

            .summary {
                display: flex !important;
                flex-direction: row !important;
                width: 100% !important;
            }

            .summary-item {
                flex: 1 !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                padding: 2mm !important;
                border-right: 0.5pt solid #eee !important;
            }

            .summary-item:last-child {
                border-right: none !important;
            }

            .summary-item span {
                font-weight: bold !important;
                margin-right: 5mm !important;
            }

            .summary-item .value {
                border: 0.5pt solid #ddd !important;
                padding: 1mm !important;
                min-width: 30mm !important;
                text-align: right !important;
            }
        }

        /* Company Header Styles */
        .company-header {
            margin-bottom: 40px;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            text-align: left;
        }

        .company-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .company-name::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .company-details::before {
            content: '•';
            color: var(--primary-color);
            font-weight: bold;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow-md);
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            background: var(--background-color);
            border-radius: 8px;
            font-weight: 500;
        }

        /* Zebra striping for rows */
        tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Specific column widths */
        th:nth-child(1),
        td:nth-child(1) {
            /* DATA */
            width: 15%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            /* DESCRIÇÃO */
            width: 45%;
        }

        th:nth-child(3),
        td:nth-child(3),
        /* ENTRADA */
        th:nth-child(4),
        td:nth-child(4) {
            /* SAÍDA */
            width: 20%;
            text-align: right;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            gap: 20px;
        }

        .summary-item span {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .value {
            min-height: 30px;
            border: 1px solid var(--border-color);
            padding: 8px;
            border-radius: 6px;
            background: white;
        }

        /* Signature Section Styles */
        .signature-date {
            margin-bottom: 30px;
            text-align: right;
            font-size: 15px;
            color: #4b5563;
        }

        .signatures {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
            gap: 40px;
        }

        .signature-field p {
            font-size: 14px;
            margin-top: 8px;
            color: #4b5563;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 10px;
            }

            .summary {
                flex-direction: column;
            }

            .signatures {
                flex-direction: column;
                align-items: center;
            }

            .signature-field {
                width: 100%;
                margin-bottom: 20px;
            }
        }

        .pagination {
            display: none;
        }

        .page-btn:hover {
            background-color: #e0e0e0;
        }

        .page-numbers {
            font-size: 14px;
            color: #666;
        }

        .invoice-container {
            border: none;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #0066cc;
            padding-bottom: 20px;
            margin-bottom: 30px;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            max-width: 90px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo p {
            font-size: 20px;
            font-weight: 700;
            color: #0066cc;
            letter-spacing: -0.5px;
        }

        .invoice-title {
            text-align: right;
            color: #333;
        }

        .invoice-title p:first-child {
            font-size: 22px;
            font-weight: 800;
            color: #0066cc;
            margin-bottom: 5px;
        }

        .invoice-title p:last-child {
            font-size: 14px;
            color: #666;
        }

        .company-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-details th,
        .invoice-details td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice-details thead {
            background-color: #f2f2f2;
        }

        .invoice-details tfoot {
            font-weight: bold;
        }

        .payment-info {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .category-summary {
            margin-top: 20px;
        }

        .category-summary table {
            width: 100%;
            border-collapse: collapse;
        }

        .category-summary th,
        .category-summary td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .category-summary thead {
            background-color: #f2f2f2;
        }

        .summary-info {
            text-align: right;
            margin-bottom: 20px;
        }

        .summary-info h3 {

            margin-bottom: 10px;
        }

        .summary-info p {
            margin: 0.5px 0;

        }

        .footer {
            margin-top: 30px;
            font-size: 0.8em;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            border-top: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            text-align: left;
        }

        .assinatura {
            margin-top: 40px;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
        }

        .assinatura p {
            margin: 10px 0;
            color: #333;
        }

        .signature-line {
            width: 300px;
            border-top: 1px solid #0066cc;
            margin: 15px auto;
        }

        .assinatura .role {
            font-size: 14px;
            color: #666;
            font-style: italic;
        }

        .assinatura .name {
            font-weight: 600;
            font-size: 16px;
            color: #0066cc;
        }

        footer.footer {
            background-color: #f4f4f4;
            border-top: 1px solid #0066cc;
            padding: 15px 20px;
            text-align: left;
            font-size: 12px;
            color: #666;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer .copyright {
            margin: 0;
            line-height: 1.5;
        }

        .footer .system-info {
            text-align: right;
            margin-right: 20px;
            font-size: 10px;
            color: #999;
            padding: 5px 15px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <header>
            <div class="logo">
                <img src="assets/icons/idpharm1.png" alt="Logo da Empresa" style="width: 45px;">
                <p style="font-size: 18px; font-weight: bold; align-items: left;">IDPharm</p>
            </div>
            <div class="invoice-title">
                <p style="font-size: 16px; font-weight: bold;">MAPA DE VENDAS POR CAIXA (TERMINAL)</p>
                <p>Período: {{$data_inicial}} a {{$data_final}}</p>
            </div>
        </header>

        <section class="company-info">
            <div class="sender-info" style="width: 50%;">
                <h3>{{$dado_empresa->nome_empresa}}</h3>
                <p>{{$dado_empresa->endereco}}</p>
                <p>{{$dado_empresa->provincia}}/{{$dado_empresa->cidade}}</p>

            </div>
            <div class="summary-info">
                <h3>Caixa (Terminal)</h3>
                @php
                // Criar uma coleção de IDs únicos de vendas
                $vendas_distintas = $dadosVendaForch->pluck('id_venda')->unique(); // pluck pega os IDs e unique remove os duplicados

                // Contar o número de vendas distintas
                $numero_vendas = $vendas_distintas->count();

                // Calcular o total do valor das vendas (soma de todas as vendas)
                $total_valor_total = 0;
                foreach ($dadosVendaForch as $item) {
                $total_valor_total += $item->valor_total;
                }
                @endphp

                <table class="invoice-details">
                    <thead>
                        <tr>
                            <th>Caixa Nº</th>
                            <th>Data Abertura</th>
                            <th>Data Fechamento</th>
                            <th>Float inicial</th>
                            <th>Total de vendas</th>
                            <th>Float final</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dadosCaixa as $item)
                        <tr>
                            <td style="width: 10px;">{{$item->caixa_id}}</td>
                            <td style="width: 10px;">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y') }}</td>
                            <td style="width: 10px;">{{ $item->data_fechamento ? \Carbon\Carbon::parse($item->data_fechamento)->format('d/m/Y H:i:s') : '-------' }}</td>
                            <td style="width: 10px;">{{number_format($item->valor_abertura, 2, ',', '.')}} MZN</td>
                            <td style="width: 10px;">{{number_format($item->total_venda, 2, ',', '.')}} MZN</td>
                            <td style="width: 10px;">{{number_format($item->valor_fechamento, 2, ',', '.')}} MZN</td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Produtos Vendidos</h3>
                <p><b>Vendas realizadas:</b> {{$numero_vendas}}</p>
                <p><b>Total de Vendas: </b>{{number_format($total_valor_total, 2, ',', '.')}} MZN</p>
            </div>

        </section>

        <table class="invoice-details">
            <thead>
                <tr>
                    <th style="width: 10px;">#</th>
                    <th>VD Nº </th>
                    <th>Produto</th>
                    <th style=" text-align: center;">Quantidade</th>
                    <th>Preço Unitário</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total_valor_total = 0;

                @endphp
                @foreach ($dadosVendaForch as $key => $item)
                <tr>
                    <td style="width: 10px;">{{$key+1}}</td>
                    <td style="width: 10px;">{{$item->id_venda}}</td>
                    <td style="width: 10px;">{{$item->produto_nome}}</td>
                    <td style="width: 10px; text-align: center;">{{$item->quantidade_total}}</td>
                    <td style="width: 10px;">{{number_format($item->pu, 2, ',', '.')}} MZN</td>
                    <td style="width: 10px; text-align: right;">{{number_format($item->valor_total, 2, ',', '.')}} MZN</td>
                </tr>
                @php
                $total_valor_total += $item->valor_total;

                @endphp
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5"><strong>Total Geral</strong></td>

                    <td style="text-align: right;"><strong>{{number_format($total_valor_total, 2, ',', '.') }} MZN</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="assinatura">
            <p>Assinatura e Carimbo</p>
            <div class="signature-line"></div>
            <p class="name">{{$dadosUsuario->nome}}</p>
            <p>Data: {{ date('d/m/Y') }} </p>
        </div>

        <footer class="footer">
            <p class="copyright">
                Documento processado por computador {{ date('d/m/Y H\h:i\m') }}<br>
                <b>nGestorX(SaaS Integrator)</b>
            </p>
            <p class="system-info">
                &copy; Softetech 2025. Todos os direitos reservados.
            </p>
        </footer>

    </div>
</body>

</html>