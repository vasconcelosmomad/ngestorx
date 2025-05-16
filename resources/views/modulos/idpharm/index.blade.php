<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>nGestorX - Modulo IDPharm</title>
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
    <script src="{{ url('assets/js/plugins/apexcharts.js') }}"></script>

    <!-- Axios -->
    <script src="{{ url('assets/js/plugins/axios.min.js') }}"></script>

    <!-- Fonte adicional -->
   
    <!-- CSS do Air Datepicker -->
    <link rel="stylesheet" href="{{ url('assets/css/plugins/air-datepicker.css') }}">
    <!-- JS do Air Datepicker -->
    <script src="{{ url('assets/js/plugins/air-datepicker.js') }}"></script>
    

    <!-- Adicione esta linha no <head> do seu HTML -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <style>
/* Estilo base do container */
.alertify {
    border-radius: 0.5rem !important;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
}

/* Cabeçalho do diálogo */
.alertify .ajs-header {
    border-top-left-radius: 0.5rem !important;
    border-top-right-radius: 0.5rem !important;
    background-color: #f9fafb !important;
    border-bottom: 1px solid #e5e7eb !important;
    font-weight: 600 !important;
    padding: 1rem !important;
    font-size: 1rem !important;
}

/* Corpo do diálogo */
.alertify .ajs-body {
    padding: 1rem !important;
    font-size: 0.95rem !important;
    color: #374151 !important;
}

/* Rodapé com botões */
.alertify .ajs-footer {
    border-bottom-left-radius: 0.5rem !important;
    border-bottom-right-radius: 0.5rem !important;
    background-color: #f9fafb !important;
    border-top: 1px solid #e5e7eb !important;
    padding: 0.75rem 1rem !important;
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
    flex-wrap: wrap;
}

/* Diálogo principal responsivo */
.alertify .ajs-dialog {
    width: 100% !important;
    max-width: 400px !important;
    margin: 1rem auto !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -4px rgba(0, 0, 0, 0.1) !important;
}

/* Botão OK - azul preenchido */
.alertify .ajs-ok {
    background-color: #3b82f6 !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
    font-weight: 500 !important;
    font-size: 0.875rem !important;
    transition: background-color 0.2s ease-in-out !important;
}

.alertify .ajs-ok:hover {
    background-color: #2563eb !important;
}

.alertify .ajs-ok:focus {
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.4) !important;
}

/* Botão Cancelar - contorno vermelho */
.alertify .ajs-cancel {
    background-color: transparent !important;
    color: #dc2626 !important;
    border: 2px solid #dc2626 !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
    font-weight: 500 !important;
    font-size: 0.875rem !important;
    transition: all 0.2s ease-in-out !important;
}

.alertify .ajs-cancel:hover {
    background-color: #fee2e2 !important;
}

.alertify .ajs-cancel:focus {
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.4) !important;
}

/* Notificações AlertifyJS */
.alertify-notifier .ajs-message {
    border-radius: 0.5rem !important;
    padding: 0.75rem 1rem !important;
    font-size: 0.875rem !important;
    border: 1px solid rgba(229, 231, 235, 0.5) !important;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -4px rgba(0, 0, 0, 0.1) !important;
}

/* Sucesso */
.alertify-notifier .ajs-message.ajs-success {
    background-color: #ecfdf5 !important;
    color: #065f46 !important;
    border-left: 4px solid #10b981 !important;
}

/* Erro */
.alertify-notifier .ajs-message.ajs-error {
    background-color: #fef2f2 !important;
    color: #991b1b !important;
    border-left: 4px solid #ef4444 !important;
}

/* Aviso */
.alertify-notifier .ajs-message.ajs-warning {
    background-color: #fffbeb !important;
    color: #92400e !important;
    border-left: 4px solid #f59e0b !important;
}
</style>
</head>

<body class="bg-white text-gray-700 font-sans min-h-screen">



    @php
    // Obtém o ID do software e o tipo de dispositivo da sessão
    $idSoftware = session('software_id');
    $deviceType = isMobile() ? 'modulos' : 'modulos';

    $user_level = session('nivel_acesso');

    // Define o diretório do software
    switch ($idSoftware) {
    case 888:
    $modulePath = 'ngestor';
    break;
    case 890:
    $modulePath = 'idpharm';
    break;
    case 889:
    $modulePath = 'xread';
    break;
    default:
    $modulePath = null;
    }

    // Monta o caminho completo do template
    $templatePath = $modulePath
    ? "{$deviceType}.{$modulePath}.templates.{$page}"
    : null;


    switch ($user_level) {
        case 1:
            $menuPath = 'components.menu-lateral-vendas';
            break;
        case 2:
            $menuPath = 'components.menu-lateral-gestao-produtos';
            break;
        case 3:
            $menuPath = 'components.menu-lateral-financeiro';
            break;
        default:
            $menuPath = 'redirect-login';
    }
    @endphp

    @if ($templatePath && view()->exists($templatePath))
    <!-- Navbar fixa -->
    @include('components.navbar-fixa')

    <!-- Menu lateral -->
  
    @include($templatePath)
    @else
    <p>A página solicitada não foi encontrada.</p>
    @endif



    @include($menuPath)
    @include('components.modal-abrir-caixa')
    @include('components.modal-fechar-caixa')
    @include('components.modal-rel-mapa-vendas')




    <!-- Script jQuery -->


    <!-- jQuery -->
    <script src="{{ url('assets/js/plugins/jquery-3.7.1.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ url('assets/js/plugins/dataTables.js') }}"></script>
    <script>
    lucide.createIcons();



    // Abrir qualquer modal baseado no data-modal
    $('.abrirModal').on('click', function() {
        const modalId = $(this).data('modal'); // Pega o ID do modal a ser aberto
        $('#' + modalId).removeClass('hidden opacity-0').addClass('opacity-100');
    });

    // Fechar qualquer modal
    $('.fecharModal').on('click', function() {
        const modal = $(this).closest('.modal'); // Encontra o modal mais próximo
        modal.removeClass('opacity-100').addClass('opacity-0');
        setTimeout(function() {
            modal.addClass('hidden'); // Esconde o modal após a transição
        }, 300);
    });

    // Fechar o modal ao clicar fora dele
   /* 
    $('.modal').on('click', function(e) {
        if (e.target === this) {
            $(this).find('.fecharModal').click(); // Fecha o modal se clicar fora do painel
        }
    });
   */





    // Abrir ou fechar o menu lateral ao clicar no botão
document.getElementById("openSidebar").addEventListener("click", () => {
    document.getElementById("sidebar").classList.toggle("-translate-x-full");
});

// Função para abrir ou fechar submenus
function toggleSubmenu(id) {
    document.getElementById("submenu-" + id).classList.toggle("hidden");
}

// Fechar o menu ao clicar fora
document.addEventListener("click", (event) => {
    const sidebar = document.getElementById("sidebar");
    const openSidebarButton = document.getElementById("openSidebar");

    // Verificar se o clique foi fora do menu lateral e do botão que abre o menu
    if (!sidebar.contains(event.target) && !openSidebarButton.contains(event.target)) {
        sidebar.classList.add("-translate-x-full");  // Fecha o menu
    }
});


    const dropdownBtn = document.getElementById("userDropdownBtn");
    const dropdown = document.getElementById("userDropdown");

    dropdownBtn.addEventListener("click", () => {
        dropdown.classList.toggle("hidden");
    });

    document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target) && !dropdownBtn.contains(e.target)) {
            dropdown.classList.add("hidden");
        }
    });

    // Exemplos simples de gráficos ApexCharts
    </script>




    <script>
    //Rota para verificar se o caixa está aberto
    var urlVerificarCaixa = "{{route('caixa.aberto')}}";
    //Rota para abrir caixa
    var urlAbrirCaixa = "{{route('abrir.caixa')}}";
    //Token para o CSRF
    var token = "{{ csrf_token() }}";
    //Rota para fechar caixa
    var urlFecharCaixa = "{{ route('fechar.caixa') }}";
    //Rota para carregar turnos
    var urlTurnos = "{{ route('get.turnos') }}";
    //Rota para carregar caixas
    var urlCaixas = "{{ route('get.caixas') }}";
    //Rota para a página de produtos
    var rota = "{{ route('painel.index', ['page' => 'produtos']) }}";
    //Rota para a página de planos
    var urlPlanoDeLicenca = "{{ route('painel.index', ['page' => 'planos']) }}";
    </script>

    <script>

    //Função para abrir o Pdv
    async function pdv(event) {
       // event.preventDefault();
        try {
            const response = await axios.get(urlVerificarCaixa);

            if (response.data.success) {
                window.location.href = response.data.redirect;
            } else {
                alertify.error('Por favor abra o caixa para continuar');
            }
        } catch (error) {
            alertify.error('Erro ao processar a requisição. Tente novamente.');
            console.error(error);
        }
    }

    
    </script>


    <script>
    //Carregar turnos
    $(document).ready(function() {
        $.ajax({
            url: urlTurnos,
            type: "GET",
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.success) {
                    var options = '';
                    options += '<option value="" disabled selected>Turnos...</option>';
                    response.turnos.forEach(function(turno) {
                        options += '<option value="' + turno.id + '">' + turno.turno +
                            '</option>';
                    });
                    $('#turno').html(options);


                }
            }
        });
    });

    //Carregar caixas
    $(document).ready(function() {
        axios.get(urlCaixas)
            .then(function(response) {
                console.log(response.data);
                if (response.data.success) {
                    var options = '';
                    options += '<option value="" disabled selected>Caixas...</option>';
                    response.data.caixas.forEach(function(caixa) {
                        options += '<option value="' + caixa.id + '">' + caixa.nome +
                            '</option>';
                    });
                    $('#caixa').html(options);
                }
            })
            .catch(function(error) {
                console.error('Erro ao carregar caixas:', error);
            });
    });



    //Abrir caixa
    $(document).ready(function() {
        document.querySelector('#form_abrir_caixa').addEventListener('submit', function(e) {
            e.preventDefault();

            const formdata = new FormData(this);
            formdata.append('_token', token);
            for (const [key, value] of formdata.entries()) {
                console.log(key, value);
                //alertify.confirm(key + ' - ' + value);
            }

            axios.post(urlAbrirCaixa, formdata)
                .then(function(response) {
                    // Verifica se o status está OK (caso você queira verificar algo específico na resposta)
                    if (response.data.success) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.notify(response.data.message, 'success', 2, function() {
                            window.location.href = response.data.redirect;
                        });
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.notify(response.data.message, 'error', 2, function() {});
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
                            alertify.set('notifier', 'position', 'top-right');  
                            alertify.error('Preencha todos os campos (*) obrigatórios');
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.error(error.response.data.error || 'Erro inesperado');
                        }
                    } else {
                        alertify.error('Erro de rede ou configuração.');
                    }
                });

        });
    });



    $(document).ready(function() {
        $('#form_fechar_caixa').submit(function(e) {
            e.preventDefault();
            $('.error-message').text('');

            var formData = new FormData(this);
            formData.append('_token', token);

            $.ajax({
                url: urlFecharCaixa,
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        //console.log(response.message);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.notify(response.message, 'success', 2, function() {
                            window.location.href = response.redirect;
                        });
                    } else {
                        //console.log(response.message);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.notify(response.message, 'warning', 5, function() {});
                    }
                },
                error: function(xhr) {
                    $('.error-message').text('');
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.notify('Preencha todos os campos(* obrigatórios)', 'warning', 3,
                            function() {});

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key + '-error').text(value[0]);
                            console.log(key);
                        });
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.notify('Erro ao processar a requisição. Tente novamente.',
                            'error', 3,
                            function() {});
                    }
                }
            });
        });
    });
    </script>





    <!-- [ Air Datepicker ] start -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Função para inicializar Air Datepicker em todos os elementos .datepicker
        function initializeDatepickers(container) {
            document.querySelectorAll(".datepicker").forEach((element) => {
                new AirDatepicker(element, {
                    autoClose: true,
                    allowInput: true,
                    todayButton: true,
                    today: true,
                    buttonClass: 'btn btn-success',
                    position: 'bottom right',
                    onSelect: function(date) {
                        $(this).val(date);
                    },

                    locale: {
                        days: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
                        daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
                        daysMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
                        months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                        ],
                        monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago',
                            'Set', 'Out', 'Nov', 'Dez'
                        ],
                        today: 'Hoje',
                        clear: 'Limpar',
                        dateFormat: 'dd-MM-yyyy',
                        firstDay: 1
                    },
                    container: '#' + container,


                });
            });
        }

        // Inicializa ao carregar a página
        initializeDatepickers();

        // Inicializa quando um modal for aberto


    });
    </script>

    <script>

    $(document).ready(function() {
    verificarCaixa();
});
const saldoCaixa = $('#saldo-caixa');
const numeroCaixa = $('#numero-caixa');


function verificarCaixa() {
    axios.get(urlVerificarCaixa)
        .then(function(response) {
            if (response.data.success) {
                // Caixa está aberto
                console.log(response.data);
                const reply = response.data.data;
                console.log('usuario: ' + reply.usuario_abertura);
                saldoCaixa.text('R$ ' + reply.total_venda);
                numeroCaixa.text('Caixa N° ' + reply.caixa_id);
                $('#abertura').addClass('hidden');
                $('#fechamento').removeClass('hidden');
                $('#valor_fechamento').val(reply.total_venda);
                $('#numCaixa').val(reply.caixa_id);   
                console.log("valorFechamento: " + $('#valor_fechamento').val());
                console.log("caixa: " + $('#numCaixa').val());
                
            } else {
                // Caixa está fechado
                $('#abertura').removeClass('hidden');
                $('#fechamento').addClass('hidden');
                $('#opnModalMapaVendas').removeClass('hidden');
            }
        })
        .catch(function(error) {
            // Trate o erro se necessário
        });
}


    </script>
</body>

</html>