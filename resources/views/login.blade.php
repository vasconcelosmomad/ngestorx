@php
if(isMobile()){
    $componente = 'components.login-mobile-devices';
}else{
    $componente = 'components.login-desktop-devices';
}
@endphp
<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="utf-8">
    <title>nGestorX - Solução para Gestão de Negócios</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description"
        content="nGestorX é uma solução de gestão empresarial para pequenas, médias e grandes empresas com foco em Gestao de vendas, Gestao de produtos, Gestao de equipe e Gestao financeira ">
    <meta name="keywords" content="nGestorX, gestão empresarial, farmácia, restaurante,empresarial, atendimento, insumos, equipe">
    <meta name="author" content="nGestorX">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="nGestorX">
    <meta name="theme-color" content="#fff">
    
    <!-- PWA icons para iOS -->
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/icons/72x72.png">
    <link rel="apple-touch-icon" sizes="96x96" href="/assets/icons/96x96.png">
    <link rel="apple-touch-icon" sizes="128x128" href="/assets/icons/128x128.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/icons/144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/icons/152x152.png">
    <link rel="apple-touch-icon" sizes="192x192" href="/assets/icons/192x192.png">
    <link rel="apple-touch-icon" sizes="384x384" href="/assets/icons/384x384.png">
    <link rel="apple-touch-icon" sizes="512x512" href="/assets/icons/512x512.png">
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts e Ícones -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alertify -->
    <link rel="stylesheet" href="{{ url('assets/css/alertify.min.css') }}">
    <script src="{{ url('assets/js/alertify.min.js') }}"></script>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Axios via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!-- Fonte adicional -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-white font-sans leading-normal tracking-normal">

 @include($componente)

    <script>
    lucide.createIcons();
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        axios.get("{{ route('get.modulos') }}").then(function(response) {
            console.log(response);
            const modulos = response.data;
            const select = document.querySelector('#modulo');
            modulos.forEach(function(modulo) {
                console.log(modulo);
                const option = document.createElement('option');
                option.value = modulo.id;
                option.textContent = modulo.nome;
                select.appendChild(option);
            });
        });


        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formdata = new FormData(this);
            /*   for (const [key, value] of formdata.entries()) {
        console.log(key, value);
        alert(key + ' - ' + value);
    }   
*/
            axios.post("{{ route('login') }}", formdata)
                .then(function(response) {
                    // Verifica se o status está OK (caso você queira verificar algo específico na resposta)
                    if (response.data.success) {
                        alert('Login realizado com sucesso');
                        // Redirecionamento, se necessário
                        window.location.href = response.data.redirect;
                    } else {
                        alert('Erro: ' + response.data.message);
                    }
                })
                .catch(function(error) {
                    if (error.response) {
                        console.log(error.response.data); 
                        if (error.response.data.errors) {
                            const erros = error.response.data.errors;
                            let mensagens = '';
                            for (let campo in erros) {
                                mensagens += erros[campo].join(', ') + '\n';
                            }
                            alert('Erros de validação:\n' + mensagens);
                        } else {
                            alert(error.response.data.error || 'Erro inesperado');
                        }
                    } else {
                        alert('Erro de rede ou configuração.');
                    }
                });

        });

    });
    </script>

</body>

</html>