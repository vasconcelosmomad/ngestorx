<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<style>
/* Reset e configurações gerais */
body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    line-height: 1.5; 
    margin: 0; 
}
@page {
    margin: 10mm 5mm 5mm 10mm; 
    size: A4; 
}
/* Cabeçalho */
.header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 0;
    border-bottom: 2px solid #eee;
    margin-bottom: 30px;
}

.header h4 {
    margin: 0;
}

.header p {
    margin: 0;
}

.left {
    text-align: left;
}

.left p {
    margin: 1px 0;
    font-size: 16px;
}

.left p:first-child {
    font-size: 18px;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 8px;
}

.right {
    text-align: right;
}

.right h4 {
    color: #2c3e50;
    font-size: 16px;
    margin: 0;
}

/* Tabela */
.table {
    width: 100%;
    margin: 20px 0;
    border: 1px solid #e0e0e0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

table thead th {
    background-color: #f8f9fa;
    color: #2c3e50;
    font-weight: bold;
    padding: 8px 10px;
    font-size: 13px;
    border: 1px solid #dee2e6;
}

table tbody td {
    padding: 5px 8px;
    font-size: 12px;
    border: 1px solid #dee2e6;
    vertical-align: middle;
}

table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

/* Status das células */
.status-aberto {
    background-color: rgba(40, 167, 69, 0.2) !important;
    color: #155724;
    font-weight: bold;
    text-align: center;
}

.status-fechado {
    background-color: rgba(220, 53, 69, 0.2) !important;
    color: #721c24;
    font-weight: bold;
    text-align: center;
}

/* Valores monetários */
.valor {
    text-align: right;
    font-family: 'Courier New', Courier, monospace;
}

/* Rodapé */
.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
    padding: 0px 20px 1px 5px;
    font-size: 11px;
    color: #6c757d;
    margin-top: 10px;
    margin-bottom: 0px;
}

.footer p {
    margin: 2px 0;
}

/* Marca d'água */
.marca {
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%) rotate(-45deg);
    opacity: 0.05;
    z-index: -1;
}

</style>

<div class="header">
  <div class="left">
    <p style=" font-weight: bold; font-size: 1.3em;">NoemBox</p>
        <p><strong>Endereço:</strong> {{$dadosEmpresa->endereco}} </p>
        <p><strong>Email: </strong> {{$dadosEmpresa->email}} </p>
    <p><strong>Contato: </strong> {{$dadosEmpresa->telefone}} </p>
  </div>
  <div class="right">
    <h4 style="margin-top: 0; margin-bottom: 2px;">Relatório: Catálogo de produtos</h4>
      <p>Data: {{date('d/m/Y')}}</p>
  </div>
</div>
<div class="container">
  <table id="example" class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Código</th>
        <th>Produto</th>
        <th>PU</th>
        <th>Estoque</th>
        <th>Observação</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($produtos  as $index => $data) 

      <tr>

        <td>{{$index + 1}}</td>
        <td>{{$data->codigo}}</td>
        <td>{{$data->nome}}</td>
        <td>{{$data->venda}}</td>
        <td>{{$data->estoque}}</td>
        <td></td>
      </tr>
      @endforeach
    </tbody>
  </table>
      <div class="footer">
   <p>Documento processado por computador</p>
   <p>Copyright &copy; <strong>n </strong>{{date('Y')}} </p>
</div>

</div>
</body>
</html>