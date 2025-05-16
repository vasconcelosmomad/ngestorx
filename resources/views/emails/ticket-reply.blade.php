<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova Resposta em Ticket de Suporte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4a6cf7;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .message {
            background-color: white;
            padding: 15px;
            border-left: 4px solid #4a6cf7;
            margin: 15px 0;
        }
        .info {
            margin-bottom: 15px;
        }
        .info span {
            font-weight: bold;
        }
        .button {
            display: inline-block;
            background-color: #4a6cf7;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nova Resposta em Ticket de Suporte</h2>
    </div>
    
    <div class="content">
        <div class="info">
            <p><span>Ticket #:</span> {{ $data['ticket_id'] }}</p>
            <p><span>Assunto:</span> {{ $data['ticket_title'] }}</p>
            <p><span>Usuário:</span> {{ $data['user_name'] }}</p>
            <p><span>Data:</span> {{ $data['created_at'] }}</p>
        </div>
        
        <h3>Mensagem:</h3>
        <div class="message">
            {!! nl2br(e($data['message'])) !!}
        </div>
        
        @if(!empty($data['attachment']))
            <p><span>Anexo:</span> Arquivo anexado à esta mensagem</p>
        @endif
        
        <a href="{{ url('/admin/support/tickets/' . $data['ticket_id']) }}" class="button">Ver Ticket no Sistema</a>
    </div>
    
    <div class="footer">
        <p>Este é um email automático. Por favor, não responda diretamente a este email.</p>
        <p>&copy; {{ date('Y') }} nGestorX - Sistema de Gestão</p>
    </div>
</body>
</html>
