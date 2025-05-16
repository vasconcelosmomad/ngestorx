@php
$user = session()->get('nivel_acesso');
$data_hora_fechamento = date('d-m-Y H\h:i\m');
@endphp
<!doctype html>
<html lang="en">
<!-- [Head] start -->
<!-- Mirrored from mantisdashboard.io/bootstrap/default/dashboard/analytics.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Mar 2025 18:35:14 GMT -->

<head>
    <title>IDPharm</title><!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="idpharm">
    <meta name="keywords" content="idpharm">
    <meta name="author" content="Softetech"><!-- [Favicon] icon -->

    <link rel="icon" href="{{ asset('assets/icons/idpharm.png') }}" type="image/x-icon"><!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap"
        id="main-font-link"><!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('assets/css/alertify.min.css') }}">
    <!-- CSS do Air Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.css">
    <link
        rel="stylesheet"
        href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}" />

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/plugins/select.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />

    <!-- JS do Air Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/fonts/phosphor/duotone/style.css') }}">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}    ">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}"><!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#4285f4">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="IDPHARM">
    <link rel="apple-touch-icon" href="/assets/images/idpharm-desk1.png">

    <style>
        /* Efeito hover */
        .hover-effect {

            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        .hover-effect:hover {
            transform: scale(1.1);
            color: #fff;
        }


        /* Botão "Confirmar" */
        .ajs-dialog .ajs-footer .ajs-ok {
            background-color: rgb(40, 139, 231) !important;
            color: white !important;
            border-radius: 5px !important;
            border: 1px solid rgb(40, 139, 231) !important;
            padding: 10px 10px !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
        }

        /* Botão "Cancelar" */
        .ajs-dialog .ajs-footer .ajs-cancel {
            background-color: rgb(255, 255, 255) !important;
            color: rgb(248, 20, 20) !important;
            border-radius: 5px !important;
            border: 1px solid rgb(248, 20, 20) !important;
            padding: 10px 20px !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
        }

        /* Efeito hover */
        .ajs-dialog .ajs-footer .ajs-ok:hover {
            background-color: rgb(30, 110, 200) !important;
        }

        /* Efeito hover */
        .ajs-dialog .ajs-footer .ajs-cancel:hover {
            background-color: rgb(245, 245, 245) !important;
        }

        .ajs-notifier {
            font-size: 14px !important;
            font-weight: 600 !important;
            color: white !important;
        }

        .ajs-notifier .ajs-message {
            color: white !important;
        }

        /* Garantir que o Air Datepicker tenha o maior z-index possível */
        .air-datepicker {
            z-index: 9999 !important;
        }

        /* Customização para o AlertifyJS */
        .alertify .ajs-dialog {
            border-radius: 5px;
            /* Ajuste o valor conforme necessário */
        }

        .alertify .ajs-header,
        .alertify .ajs-header {
            border-radius: 5px 5px 0 0;
            /* Ajuste os cantos superior */
        }

        .alertify .ajs-footer {
            border-radius: 0 0 5px 5px;
            /* Ajuste os cantos inferior */
        }

        .alertify .ajs-body {
            border-radius: 0 0 5px 5px;
            /* Ajuste os cantos inferiores */
        }

        /* Estilo do input e configuração da largura */
        .datepicker {
            width: 100%;
            max-width: 500px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Oculta a barra de rolagem inicialmente */
            scrollbar-width: thin;
            /* Para Firefox */
        }

        /* Aplica o scroll quando o mouse passar sobre o body */
        body:hover {
            overflow-y: auto;
            /* Torna o scroll visível quando o mouse passar sobre a página */
        }

        /* Personalização para navegadores WebKit (Chrome, Safari, Edge) */
        body::-webkit-scrollbar {
            width: 1px;
            /* Largura da barra de rolagem */
        }

        body::-webkit-scrollbar-thumb {
            background-color: #fff;
            /* Cor do "polegar" da barra de rolagem */
            border-radius: 2px;
            /* Bordas arredondadas */
        }

        body::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Cor do fundo da barra de rolagem */
        }
    </style>


</head><!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div><!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header"><a href="javascript:;" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ --> <img
                        src="{{ asset('assets/images/idpharm-desk1.png') }}" class="img-fluid w-75 mt-2" alt="logo">
                </a></div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-hasmenu active" id="dashboard-caixa"><a href="{{ route('painel.index', ['page' => 'dashboard-operator']) }}"
                            class="pc-link"><span class="pc-micon"><svg class="pc-icon">
                                    <use xlink:href="#dashboard"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Dashboard">Dashboard</span> <span
                                class="pc-arrow"></span></a>

                    </li>
                    <li class="pc-item pc-caption border-bottom"><label data-i18n="Widget">Recursos Humanos</label> <i
                            class="pc-micon"><svg class="pc-icon">
                                <use xlink:href="#line-chart"></use>
                            </svg></i></li>
                    <li class="pc-item" id="clientes"><a href="#!" onclick="{{ $user == $rh || $user == $admin ? 'clientes()' : 'alertPermission()' }}" class="pc-link"><span class="pc-micon"><svg class="pc-icon">
                                    <use xlink:href="#usergroup-add"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Statistics">Clientes</span></a></li>
                    <li class="pc-item" id="fornecedores"><a href="#!" onclick="{{ $user == $rh || $user == $admin ? 'fornecedores()' : 'alertPermission()' }}" class="pc-link"><span class="pc-micon"><svg
                                    class="pc-icon">
                                    <use xlink:href="#shopping-cart"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Data">Fornecedores</span></a></li>
                    <li class="pc-item" id="funcionarios"><a href="#!" onclick="{{ $user == $rh || $user == $admin ? 'funcionarios()' : 'alertPermission()' }}" class="pc-link"><span class="pc-micon">
                                <i data-feather="users"></i>
                            </span><span class="pc-mtext" data-i18n="Chart">Funcionários</span></a></li>
                    <li class="pc-item" id="folha-ponto"><a href="#!" onclick="{{ $user == $rh || $user == $admin ? 'folhaPonto()' : 'alertPermission()' }}" class="pc-link"><span class="pc-micon">
                                <i data-feather="file-text"></i>
                            </span><span class="pc-mtext" data-i18n="Chart">Folha de Ponto</span></a></li>
                    <li class="pc-item pc-caption border-bottom"><label data-i18n="dashboard-financeiro">Financeiro</label> <i
                            class="pc-micon"><svg class="pc-icon">
                                <use xlink:href="#read"></use>
                            </svg></i></li>
                    <li class="pc-item pc-hasmenu" id="gestao-contas"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'gestaoContas()' : 'alertPermission()' }}" class="pc-link"><span class="pc-micon"><svg
                                    class="pc-icon">
                                    <use xlink:href="#credit-card"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Gestão de Contas">Gestão de contas</span>
                        </a>
                    </li>
                    <li class="pc-item pc-hasmenu" id="faturas"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'faturas()' : 'alertPermission()' }}" class="pc-link"><span class="pc-micon"><svg
                                    class="pc-icon">
                                    <use xlink:href="#container"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Gestão de Contas">Faturas</span>
                        </a>
                    </li>
                    <li class="pc-item pc-hasmenu" id="cotações"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'cotações()' : 'alertPermission()' }}" class="pc-link"><span class="pc-micon"><svg
                                    class="pc-icon">
                                    <use xlink:href="#container"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Gestão de Contas">Cotações</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption pc-divider border-bottom"><label data-i18n="Admin Panel">Compras</label> <i
                            class="pc-micon"><svg class="pc-icon">
                                <use xlink:href="#read"></use>
                            </svg></i></li>
                    <li class="pc-item pc-hasmenu" id="gestao-produtos"><a href="#!" onclick="{{ $user == $dt_tf || $user == $admin ? 'gestaoProdutos()' : 'alertPermission()' }}" class="pc-link"><span class="pc-micon"><svg
                                    class="pc-icon">
                                    <use xlink:href="#appstore-add"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Membership">Gestão de Produtos</span>
                        </a>

                    </li>
                        <li class="pc-item pc-caption border-bottom bg-light"><label data-i18n="dashboard-financeiro">Vendas</label> <i
                            class="pc-micon"><svg class="pc-icon">
                                <use xlink:href="#read"></use>
                            </svg> <i class="ti ti-cash-banknote"></i></i></li>

                    </li>

                    <li class="pc-item" id="abrir-caixa"><a href="#!" onclick="{{ $user == $operator || $user == $admin ? 'abrirCaixa()' : 'alertPermission()' }}" class="pc-link"><span
                                class="pc-micon"><svg class="pc-icon">
                                    <use xlink:href="#pic-center"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Calender">Abrir Caixa</span></a></li>


                    <li class="pc-item" id="fechar-caixa"><a href="#!" onclick="{{ $user == $operator || $user == $admin ? 'openModalFecharCaixa()' : 'alertPermission()' }}" class="pc-link"><span
                                class="pc-micon"><svg class="pc-icon">
                                    <use xlink:href="#pic-center"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Calender">Fechar Caixa</span></a></li>

                    <li class="pc-item " id="pdv"><a href="#!" onclick="{{ $user == $operator || $user == $admin ? 'pdv()' : 'alertPermission()' }}" class="pc-link" data-i18n="Ponto de Venda(PDV)"><span
                                class="pc-micon"><svg class="pc-icon">
                                    <use xlink:href="#shop"></use>
                                </svg> </span><span class="pc-mtext" data-i18n="Calender">Ponto de Venda(PDV)</span></a></li>

                    <li class="pc-item pc-caption border-bottom bg-light"><label data-i18n="dashboard-financeiro">Precisa de Ajuda?</label> <i
                            class="pc-micon"><svg class="pc-icon">
                                <use xlink:href="#read"></use>
                            </svg> <i class="ti ti-file-text"></i></i></li>

                    </li>
                </ul>

                <div class="card text-center">
                    <div class="card-body"><img src="{{asset('assets/images/help.png')}} " class="img-fluid mb-2 w-50" alt="images">
                        <button class="btn btn-primary">Ticket</button>
                    </div>
                </div>
            </div>
        </div>
    </nav><!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper">
            <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- 
                    <li class="pc-h-item pc-sidebar-collapse"><a href="#" class="pc-head-link ms-0"
                            id="sidebar-hide"><i><svg class="pc-icon">
                                    <use xlink:href="#menu-unfold"></use>
                                </svg></i></a></li>
                    <li class="pc-h-item pc-sidebar-popup"><a href="#" class="pc-head-link ms-0"
                            id="mobile-collapse"><i><svg class="pc-icon">
                                    <use xlink:href="#menu-unfold"></use>
                                </svg></i></a></li>
                                 Menu col=======lapse Icon ===== -->
                    <li class="dropdown pc-h-item d-inline-flex d-md-none"><a
                            class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false"><i><svg class="pc-icon">
                                    <use xlink:href="#search"></use>
                                </svg></i></a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">

                        </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">

                    </li>
                </ul>
            </div><!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">

                    <li class="dropdown pc-h-item pc-mega-menu"><a class=" dropdown-toggle btn btn-outline-primary me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false" data-bs-auto-close="outside"><i><svg class="pc-icon">
                                    <use xlink:href="#bar-chart"></use>
                                </svg></i>Relatórios</a>
                        <div class="dropdown-menu pc-h-dropdown pc-mega-dmenu">
                            <div class="row g-0">
                                <div class="col image-block">

                                    <h2 class="text-white">Relatórios</h2>
                                    <p class="text-white my-4 hover-effect">Acesse informações detalhadas e tome decisões estratégicas com facilidade.</p>
                                    <div class="row align-items-end">
                                        <div class="col-auto">

                                        </div>
                                        <div class="col hover-effect"><img src="{{asset('assets/images/background-1.png')}}" alt="image"
                                                class="img-fluid img-charts"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="mega-title">Financeiro</h6>
                                    <div class="dropdown-divider"></div>
                                    <ul class="pc-mega-list">
                                        <li id="vendas"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'vendas()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i> Vendas</a>
                                        </li>
                                        <li id="compras"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'compras()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>
                                                Compras</a></li>
                                        <li id="compras-vs-vendas"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'comprasVsVendas()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>
                                                Compras VS Vendas</a></li>
                                        <li id="produtos-vendidos"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'produtosVendidos()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>
                                                Produtos vendidos</a></li>
                                        <li id="despesas"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'despesas()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i> Despesas</a>
                                        </li>
                                        <li id="contas-a-receber"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'contasAReceber()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i> Contas a Receber</a>
                                        </li>
                                        <li id="contas-a-pagar"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'contasAPagar()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i> Contas a Pagar</a>
                                        </li>
                                        <li id="mapa-pagamentos"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'mapaPagamentos()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i> Mapa de Pagamentos</a>
                                        </li>
                                        <li id="fluxo-caixa"><a href="#!" onclick="{{ $user == $finance || $user == $admin ? 'fluxoCaixa()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i> Fluxo de Caixa</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <span class="p-2">
                                        <h6 class="mega-title">Recursos Humanos</h6>
                                        <div class="dropdown-divider"></div>
                                        <ul class="pc-mega-list">
                                            <li id="status-clientes"><a href="#!" onclick="{{ $user == $rh || $user == $admin ? 'statusClientes()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>Status de Clientes </a>
                                            </li>
                                            <li id="status-fornecedores"><a href="#!" onclick="{{ $user == $rh || $user == $admin ? 'statusFornecedores()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i> Status de Fornecedores</a></li>
                                            <li id="folha-pagamento"><a href="#!" onclick="{{ $user == $rh || $user == $admin ? 'folhaPagamento()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>
                                                    Folha de Pagamento</a></li>
                                            <li id="mapa-efetividade"><a href="#!" onclick="{{ $user == $rh || $user == $admin ? 'mapaEfetividade()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i> Mapa de Efetividade</a></li>

                                        </ul>
                                        <span class="  ">

                                            <h6 class="mega-title">Operador de Caixa</h6>
                                            <div class="dropdown-divider"></div>
                                        </span>
                                        <ul class="pc-mega-list">
                                            <li id="produtos-vendidos"><a href="#!" onclick="{{ $user == $operator ? 'relProdutosVendidos()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>Mapa de Vendas por Caixa (Terminal) </a>
                                            </li>

                                        </ul>
                                </div>
                                <div class="col">
                                    <h6 class="mega-title">Gestão de Estoque</h6>
                                    <div class="dropdown-divider"></div>
                                    <ul class="pc-mega-list">
                                        <li id="ficha-inventario"><a href="#!" onclick="{{ $user == $dt_tf || $user == $admin ? 'fichaInventario()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>Ficha de Inventário</a></li>
                                        <li id="estoque-produtos"><a href="#!" onclick="{{ $user == $dt_tf || $user == $admin ? 'estoqueProdutos()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>Estoque de Produtos</a></li>
                                        <li id="movimentacao-estoque"><a href="#!" onclick="{{ $user == $dt_tf || $user == $admin ? 'movimentacaoEstoque()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>Movimentação de Estoque</a></li>
                                        <li id="estoque-por-fornecedor"><a href="#!" onclick="{{ $user == $dt_tf || $user == $admin ? 'estoquePorFornecedor()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>Estoque por Fornecedor</a></li>
                                        <li id="status-produtos"><a href="#!" onclick="{{ $user == $dt_tf || $user == $admin ? 'statusProdutos()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>Status de Produtos</a></li>
                                        <li id="mapa-requisicao"><a href="#!" onclick="{{ $user == $dt_tf || $user == $admin ? 'mapaRequisicao()' : 'relatorioPermission()' }}" class="dropdown-item"><i class="ti ti-circle"></i>Mapa de requisição</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="pc-h-item" id="meus-servicos"><a class="btn  btn-light-info   ms-2 me-2" href="#!" onclick="{{ $user == $operator || $user == $admin ? 'meusServicos()' : 'alertPermission()' }}"><i><svg class="pc-icon">
                                    <use xlink:href="#codepen"></use>
                                </svg></i>Meus serviços</a>
                    </li>

                    <li class="dropdown pc-h-item"><a class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false"><i><svg class="pc-icon">
                                    <use xlink:href="#translation"></use>
                                </svg></i></a>
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown lng-dropdown"><a href="#!"
                                class="dropdown-item" data-lng="en"><span>English <small>(UK)</small> </span></a><a
                                href="#!" class="dropdown-item" data-lng="fr"><span>français <small>(French)</small>
                                </span></a><a href="#!" class="dropdown-item" data-lng="ro"><span>Română
                                    <small>(Romanian)</small> </span></a><a href="#!" class="dropdown-item"
                                data-lng="cn"><span>中国人 <small>(Chinese)</small></span></a></div>
                    </li>
                    <li class="dropdown pc-h-item"><a class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false"><i><svg class="pc-icon">
                                    <use xlink:href="#bell"></use>
                                </svg> </i><span class="badge bg-success pc-h-badge">3</span></a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Notification</h5><a href="#!" class="pc-head-link bg-transparent"><i
                                        class="ti ti-circle-check text-success"></i></a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                                style="max-height: calc(100vh - 215px)">
                                <div class="list-group list-group-flush w-100"><a
                                        class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-success"><i class="ti ti-gift"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-1"><span class="float-end text-muted">3:00
                                                    AM</span>
                                                <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.
                                                </p><span class="text-muted">2 min ago</span>
                                            </div>
                                        </div>
                                    </a><a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-primary"><i
                                                        class="ti ti-message-circle"></i></div>
                                            </div>
                                            <div class="flex-grow-1 ms-1"><span class="float-end text-muted">6:00
                                                    PM</span>
                                                <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p><span
                                                    class="text-muted">5 August</span>
                                            </div>
                                        </div>
                                    </a><a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-danger"><i class="ti ti-settings"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-1"><span class="float-end text-muted">2:45
                                                    PM</span>
                                                <p class="text-body mb-1">Your Profile is Complete &nbsp; <b>60%</b></p>
                                                <span class="text-muted">7 hours ago</span>
                                            </div>
                                        </div>
                                    </a><a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-primary"><i class="ti ti-headset"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-1"><span class="float-end text-muted">9:10
                                                    PM</span>
                                                <p class="text-body mb-1"><b>Cristina Danny</b> invited to join
                                                    <b>Meeting.</b>
                                                </p><span class="text-muted">Daily scrum meeting
                                                    time</span>
                                            </div>
                                        </div>
                                    </a></div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2"><a href="#!" class="link-primary">View all</a></div>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item"><a class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false" data-bs-auto-close="outside"><i><svg class="pc-icon">
                                    <use xlink:href="#mail"></use>
                                </svg></i></a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Message</h5><a href="#!" class="pc-head-link bg-transparent"><i
                                        class="ti ti-x text-danger"></i></a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header px-0 text-wrap message-notification-scroll position-relative"
                                style="max-height: calc(100vh - 215px)">
                                <div class="list-group list-group-flush w-100"><a
                                        class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src=""
                                                    alt="user-image" class="user-avtar"></div>
                                            <div class="flex-grow-1 ms-1"><span class="float-end text-muted">3:00
                                                    AM</span>
                                                <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.
                                                </p><span class="text-muted">2 min ago</span>
                                            </div>
                                        </div>
                                    </a><a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src=" "
                                                    alt="user-image" class="user-avtar"></div>
                                            <div class="flex-grow-1 ms-1"><span class="float-end text-muted">6:00
                                                    PM</span>
                                                <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p><span
                                                    class="text-muted">5 August</span>
                                            </div>
                                        </div>
                                    </a><a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src=""
                                                    alt="user-image" class="user-avtar"></div>
                                            <div class="flex-grow-1 ms-1"><span class="float-end text-muted">2:45
                                                    PM</span>
                                                <p class="text-body mb-1"><b>There was a failure to your setup.</b></p>
                                                <span class="text-muted">7 hours ago</span>
                                            </div>
                                        </div>
                                    </a><a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src=""
                                                    alt="user-image" class="user-avtar"></div>
                                            <div class="flex-grow-1 ms-1"><span class="float-end text-muted">9:10
                                                    PM</span>
                                                <p class="text-body mb-1"><b>Cristina Danny</b> invited to join
                                                    <b>Meeting.</b>
                                                </p><span class="text-muted">Daily scrum meeting
                                                    time</span>
                                            </div>
                                        </div>
                                    </a></div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2"><a href="#!" class="link-primary">View all</a></div>
                        </div>
                    </li>

                    <li class="dropdown pc-h-item header-user-profile"><a
                            class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false"><img
                                src="{{asset('assets/images/avatar-1.jpg')}}" alt="user-image" class="user-avtar">
                            <span>{{session('nome_usuario')}}</span></a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">

                            </div>
                            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                                <li class="nav-item" role="presentation"><button class="nav-link active" id="drp-t1"
                                        data-bs-toggle="tab" data-bs-target="#drp-tab-1" type="button" role="tab"
                                        aria-controls="drp-tab-1" aria-selected="true"><i class="ti ti-user"></i>
                                        Terminar Sessão</button></li>
                                <li class="nav-item" role="presentation"><button class="nav-link" id="drp-t2"
                                        data-bs-toggle="tab" data-bs-target="#drp-tab-2" type="button" role="tab"
                                        aria-controls="drp-tab-2" aria-selected="false"><i class="ti ti-settings"></i>
                                        Config.</button></li>
                            </ul>
                            <div class="tab-content" id="mysrpTabContent">
                                <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel"
                                    aria-labelledby="drp-t1" tabindex="0"> <a href="{{route('logout')}}"
                                        class="dropdown-item"><i class="ti ti-power text-danger"></i> <span>Logout</span></a></div>
                                <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2"
                                    tabindex="0">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="col-md-12 p-3">
                                            <h5>Alterar Senha</h5>
                                            <form action="" method="post">
                                                @csrf
                                                <div class="mb-2">
                                                    <label for="senha_atual" class="form-label">Senha Atual</label>
                                                    <input type="password" class="form-control" id="senha_atual" name="senha_atual">
                                                    <small><span id="senha_atual-error" class="error-message text-danger text-small"></span></small>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="senha_nova" class="form-label">Nova Senha</label>
                                                    <input type="password" class="form-control" id="senha_nova" name="senha_nova" autocomplete="new-password">
                                                    <small><span id="senha_nova-error" class="error-message text-danger text-small"></span></small>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="senha_confirmacao" class="form-label">Confirmar Nova Senha</label>
                                                    <input type="password" class="form-control" id="senha_confirmacao" name="senha_confirmacao">
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Alterar Senha</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header><!-- [ Header ] end -->
    <!-- [ Main Content ] start -->
    <div class="pc-container">

        @php
        // Obtém o ID do software e o tipo de dispositivo da sessão
        $idSoftware = session('software_id');
        $deviceType = isMobile() ? 'mobile' : 'desktop';

        // Define o diretório do software
        switch ($idSoftware) {
        case 888:
        $softwarePath = 'ngestor';
        break;
        case 890:
        $softwarePath = 'idpharm';
        break;
        case 889:
        $softwarePath = 'xread';
        break;
        default:
        $softwarePath = null;
        }

        // Monta o caminho completo do template
        $templatePath = $softwarePath
        ? "{$deviceType}.{$softwarePath}.templates.{$page}"
        : null;
        @endphp

        @if ($templatePath && view()->exists($templatePath))
        @include($templatePath)
        @else
        <p>A página solicitada não foi encontrada.</p>
        @endif

    </div><!-- [ Main Content ] end -->

    <!-- [ Modal Abertura de Caixa ] start -->
    <div
        class="modal fade  "
        id="modal-abrir-caixa"
        tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Abertura de Caixa</h5>

                </div>

                <form id="form_abrir_caixa" action="" autocomplete="off" method="post">
                    @csrf
                    <div class="modal-body">


                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="data_abertura" class="form-label">Data de Abertura <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control  datepicker " id="data_abertura" name="data_abertura" readonly placeholder="dd-mm-yyyy">
                                <small><span id="data_abertura-error" class="error-message text-danger text-small"></span></small>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="turno" class="form-label"> Selecione o turno <span class="text-danger">*</span></label>
                                <select data-trigger class="choices-text form-control" id="turno" name="turno">

                                </select>

                                <small><span id="turno-error" class="error-message text-danger text-small"></span></small>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="caixa" class="form-label">Caixa <span class="text-danger">*</span> </label>
                                <select data-trigger class="choices-text form-control" id="caixa" name="caixa">

                                </select>

                                <small><span id="caixa-error" class="error-message text-danger text-small"></span></small>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="valor_abertura" class="form-label">Float inicial</label>
                                <input type="text" class="form-control  text-dark " id="valor_abertura" name="valor_abertura" placeholder="0.00" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/,/g, '.');">
                                <small><span id="valor_abertura-error" class="error-message text-danger text-small"></span></small>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <span type="button" id="btn-cancelar" class="btn btn-outline-danger btn-cancelar fs-6"><i class="fa-solid fa-circle-xmark "></i> Cancelar</span>
                        <button type="submit" class="btn btn-primary fs-6" id="btn-abrir-caixa"><i class="bi bi-check-circle"></i> Abrir Caixa</button>


                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ Modal Abertura de Caixa ] end -->

    <!-- [ Modal Fechamento de Caixa ] start -->
    <div
        class="modal fade"
        id="modal-fechar-caixa"
        tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Fechamento de Caixa</h5>

                </div>
                <form id="form_fechar_caixa" action="" autocomplete="off" method="post">
                    @csrf
                    <div class="modal-body p-3 mt-2">

                        <div class="row">
                            <div class="col-7 mb-2">
                                <label for="turno" class="form-label">Hora de Fechamento</label>
                                <input type="text" class="form-control read-only" id="hora_fechamento" value="{{ $data_hora_fechamento }}" readonly>
                                <small><span id="hora_fechamento-error" class="error-message text-danger text-small"></span></small>
                            </div>
                            <div class="col-5 mb-2">
                                <label for="caixa_numero" class="form-label">Caixa Nº</label>
                                <input type="text" class="form-control read-only" id="caixa_numero" name="caixa_id" readonly>
                                <small><span id="caixa_numero-error" class="error-message text-danger text-small"></span></small>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="valor_fechamento" class="form-label">Float Final <small class="text-secondary"> (float inicial + total venda)</small></label>
                                <div class="input-group">
                                    <input type="number" name="valor_fechamento" class="form-control" id="valor_fechamento">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <small><span id="valor_fechamento-error" class="error-message text-danger text-small"></span></small>
                            </div>
                            <div class="col-12 mb-0 py-0">
                                <label for="observacao" class="form-label">Observação (Opcional)</label>
                                <textarea class="form-control " id="observacao" name="observacao" rows="3"></textarea>
                                <small><span id="observacao-error" class="error-message text-danger text-small"></span></small>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <span
                            type="button"
                            id="btn-cancelar"
                            class="btn btn-outline-danger btn-cancelar fs-6"
                            data-bs-dismiss="modal">
                            Cancelar
                        </span>
                        <button type="submit" class="btn btn-primary btn-fechar-caixa fs-6">
                            Fechar Caixa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ Modal Fechamento de Caixa ] end -->

    <!-- [ Modal Aviso ] start -->
    @include('desktop.idpharm.modal.rel-produtos-vendidos')
    @include('desktop.idpharm.modal.rel-mapa_vendas')

    <!-- [Page Specific JS] start -->


    <!-- [Page Specific JS] start -->

    <!-- [Page Specific JS] end --><!-- Required Js -->

    <script src="{{ asset('assets/js/alertify.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-ant-icon.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/i18next.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/i18nextHttpBackend.min.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>



    <script src="{{ asset('assets/js/plugins/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.select.min.js') }}"></script>
   
   <script>
        layout_change("light");
    </script>
    <script>
        change_box_container("false");
    </script>
    <script>
        layout_rtl_change("false");
    </script>
    <script>
        preset_change("preset-1");
    </script>
    <script>
        font_change("Public-Sans");
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
        function alertPermission() {
            alertify.set("notifier", "position", "top-right");
                    alertify.notify(
                        "Não tem permissão para acessar a página",
                        "error",
                        2
                    );


        }

        function relatorioPermission() {
            alertify.set("notifier", "position", "top-right");
            alertify.notify(
                "Não tem permissão para acessar o relatórios",
                "error",
                2
            );
        }
        
        var modalRelProdutosVendidos = new bootstrap.Modal(document.getElementById('modal-rel-produtos-vendidos'), {
            backdrop: 'static',
            keyboard: false
        });
        function relProdutosVendidos() {
            modalRelProdutosVendidos.show();
        }

        var modalRelMapaVendas = new bootstrap.Modal(document.getElementById('modal-rel-mapa-vendas'), {
            backdrop: 'static',
            keyboard: false
        });
        function relMapaVendas() {
            modalRelMapaVendas.show();
        }

        function planoDeLicenca() {
            window.location.href = urlPlanoDeLicenca;
        }

        var modal = new bootstrap.Modal($('#modal-abrir-caixa'));
        var closeModalBtn = document.getElementById('btn-cancelar');

        // Abrir o modal
        closeModalBtn.onclick = function() {
            modal.hide();
        }

        //Carregar caixas
        $(document).ready(function() {
            verificarCaixa();
        });
        const saldoCaixa = $('#saldo-caixa');
        const numeroCaixa = $('#numero-caixa');

        function verificarCaixa() {

            $.ajax({
                url: urlVerificarCaixa,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // console.log(response);

                    if (response.success) {
                        var total_venda = parseFloat(response.data.total_venda);
                        var valor_abertura = parseFloat(response.data.valor_abertura);
                        var saldo = total_venda + valor_abertura;
                        saldoCaixa.text(' ' + saldo.toFixed(2).replace('.', ','));
                        numeroCaixa.text(response.data.caixa_id);
                        $('#fechar-caixa').removeClass('d-none');
                        $('#abrir-caixa').addClass('d-none');
                    } else {
                        $('#abrir-caixa').removeClass('d-none');
                        $('#fechar-caixa').addClass('d-none');
                    }
                }
            });
        };



        function abrirCaixa() {
            $('#modal-abrir-caixa').modal('show');
        }

        function openModalFecharCaixa() {
            $.ajax({
                url: urlVerificarCaixa,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        var float_abertura = parseFloat(response.data.valor_abertura);
                        var total_venda = parseFloat(response.data.total_venda);
                        var float_final = float_abertura + total_venda;
                        var caixa = response.data.caixa_id;
                        $('#caixa_numero').val(caixa);
                        $('#valor_fechamento').val(float_final);
                        $('#modal-fechar-caixa').modal('show');
                    } else {
                        $('#modal-abrir-caixa').modal('show');
                    }
                },
                error: function(xhr) {
                    alertify.error('Erro ao processar a requisição. Tente novamente.');
                }
            });

        }


        function pdv() {
            event.preventDefault();
            $.ajax({
                url: urlVerificarCaixa,
                type: "GET",
                dataType: "json",

                success: function(response) {
                    var caixa = '';
                    var valor_venda = '';
                    var valor_abertura = '';
                    if (response.success) {
                        window.location.href = response.redirect;
                    } else {
                        alertify.confirm(
                                '<i class="ti ti-alert-circle text-warning fs-3 border-bottom ms-2"></i><span class="text-dark fs-5">Ação necessária!</span>',
                                'Precisa estar com o caixa aberto para continuar.',
                                function() {
                                    $('#modal-abrir-caixa').modal('show');
                                },
                                function() {
                                    alertify.error("Ação cancelada!");
                                }
                            )
                            .set('labels', {
                                ok: 'Confirmar',
                                cancel: 'Cancelar'
                            })
                            .set('buttonReverse', true)
                            .set('closable', false);
                    }
                },
                error: function(xhr) {
                    alertify.error('Erro ao processar a requisição. Tente novamente.');
                }
            });
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
                            options += '<option value="' + turno.id + '">' + turno.turno + '</option>';
                        });
                        $('#turno').html(options);


                    }
                }
            });
        });

        //Carregar caixas
        $(document).ready(function() {
            $.ajax({
                url: urlCaixas,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        var options = '';
                        options += '<option value="" disabled selected>Caixas...</option>';
                        response.caixas.forEach(function(caixa) {
                            options += '<option value="' + caixa.id + '">' + caixa.nome + '</option>';
                        });
                        $('#caixa').html(options);

                    }
                }
            });
        });



        //Abrir caixa
        $(document).ready(function() {
            $('#form_abrir_caixa').submit(function(e) {
                e.preventDefault();
                // Limpar mensagens de erro anteriores
                $('.error-message').text('');




                var formData = new FormData(this);
                formData.append('_token', token);

                $.ajax({
                    url: urlAbrirCaixa,
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#btn-abrir-caixa').prop('disabled', true);
                        $('#btn-abrir-caixa').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde...');
                    },
                    success: function(response) {
                        if (response.success) {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.notify(response.message, 'success', 3, function() {
                                window.location.href = response.redirect;
                                $('#btn-abrir-caixa').prop('disabled', false);
                                $('#btn-abrir-caixa').html('<i class="bi bi-check-circle"></i> Abrir Caixa');
                            });

                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.notify(response.message, 'warning', 2, function() {
                                $('#btn-abrir-caixa').prop('disabled', false);
                                $('#btn-abrir-caixa').html('<i class="bi bi-check-circle"></i> Abrir Caixa');
                            });
                        }
                    },
                    error: function(xhr) {
                        $('.error-message').text('');
                        $('#btn-abrir-caixa').prop('disabled', false);
                        $('#btn-abrir-caixa').html('<i class="bi bi-check-circle"></i> Abrir Caixa');
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.notify('Por favor, preencha os campos obrigatórios.', 'error', 5, function() {

                            });

                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('#' + key + '-error').text(value[0]);
                            });
                        } else {
                            console.log(xhr);
                            alertify.notify('Erro ao processar a requisição. Tente novamente.', 'error', 5, function() {

                            });
                        }
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
                            alertify.notify(response.message, 'warning', 3, function() {});
                        }
                    },
                    error: function(xhr) {
                        $('.error-message').text('');
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.notify('Preencha os campos obrigatórios', 'warning', 3, function() {});

                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('#' + key + '-error').text(value[0]);
                                console.log(key);
                            });
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.notify('Erro ao processar a requisição. Tente novamente.', 'error', 3, function() {});
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
                            months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
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
        // Registrar o Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(function(registration) {
                        console.log('Service Worker registrado com sucesso:', registration.scope);
                    })
                    .catch(function(error) {
                        console.log('Falha ao registrar o Service Worker:', error);
                    });
            });
        }
    </script>

</body><!-- [Body] end -->
<!-- Mirrored from mantisdashboard.io/bootstrap/default/dashboard/analytics.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Mar 2025 18:35:23 GMT -->

</html>