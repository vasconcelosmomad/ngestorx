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



    <!-- Modifique a linha do Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->

    <link rel="stylesheet" href="{{ url('assets/css/alertify.min.css') }}">
    <script src="{{ url('assets/js/alertify.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100;9..40,200;9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap"
        rel="stylesheet">

    <style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .animate-on-scroll.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Estilo para header fixo */
    body {
        font-family: 'DM Sans', sans-serif;
        font-weight: 300;
        color: #334155;
        background-color: #fdfdfd;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 500;
        color: #1e293b;
    }

    .font-light {
        font-weight: 300;
    }

    .font-normal {
        font-weight: 400;
    }

    .font-medium {
        font-weight: 500;
    }

    .font-semibold {
        font-weight: 600;
    }

    .font-bold {
        font-weight: 700;
    }

    .header-fixed-padding {
        padding-top: 76px;
        /* Ajuste conforme a altura do seu header */
    }

    .glassmorphism {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .modern-shadow {
        box-shadow: 0 10px 30px -5px rgba(22, 119, 255, 0.1);
    }

    .btn-gradient {
        background: linear-gradient(90deg, #125fcc 0%, #1677ff 50%, #4592ff 100%);
        background-size: 200% auto;
        transition: 0.5s;
    }

    .btn-gradient:hover {
        background-position: right center;
    }

    .gradient-border {
        position: relative;
        border: double 2px transparent;
        border-radius: 0.5rem;
        background-image: linear-gradient(white, white),
            linear-gradient(90deg, #125fcc, #4592ff);
        background-origin: border-box;
        background-clip: padding-box, border-box;
    }

    .floating-effect {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-15px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    /* Novos estilos ultra modernos */
    .hover-shadow-blue {
        transition: all 0.3s ease;
    }

    .hover-shadow-blue:hover {
        box-shadow: 0 10px 30px -10px rgba(22, 119, 255, 0.3);
        transform: translateY(-5px);
    }

    .card-hover {
        transition: all 0.3s ease;
        border-top: 3px solid transparent;
    }

    .card-hover:hover {
        border-top: 3px solid #1677ff;
        transform: translateY(-3px);
    }

    .text-gradient {
        background: linear-gradient(90deg, #125fcc, #4592ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        color: transparent;
    }

    .dot-pattern {
        background-image: radial-gradient(#4592ff 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.1;
    }

    .spotlight-effect {
        position: relative;
        overflow: hidden;
    }

    .spotlight-effect::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 60%);
        opacity: 0;
        transition: opacity 0.5s ease;
        transform: translate(-100%, -100%);
        pointer-events: none;
    }

    .spotlight-effect:hover::after {
        opacity: 1;
        transform: translate(0, 0);
    }

    /* Melhorias no gráfico */
    #chart {
        max-width: 100%;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(22, 119, 255, 0.1);
        border-radius: 16px;
        background-color: white;
    }

    /* Melhorias de responsividade */
    @media (max-width: 768px) {
        .chart-container {
            padding: 0.5rem !important;
            overflow-x: auto;
        }

        .chart-header {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 0.5rem;
        }

        .chart-legend {
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 1rem;
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }

        .feature-card {
            height: 100%;
        }

        .mobile-padding {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Melhorias adicionais para responsividade */
        h1.text-3xl {
            font-size: 1.75rem;
            line-height: 2.25rem;
        }

        .apexcharts-canvas {
            max-width: 100% !important;
        }

        /* Melhorar espaçamento em dispositivos móveis */
        section {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        section.py-20 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
    }

    /* Efeitos de hover aprimorados */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Melhorias para SVG e ícones */
    [data-lucide] {
        stroke-width: 1.5;
        transition: transform 0.2s ease;
    }

    a:hover [data-lucide] {
        transform: translateY(-2px);
    }

    #scroll-top-btn {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    /* Aumentar tamanho das letras no menu mobile */
    #mobile-menu a {
        font-size: 1rem;
        /* Aumenta o tamanho da fonte */
        padding: 0.75rem 1rem;
        /* Mais espaço para tocar */
        font-weight: 400;
        /* Um pouco mais de peso */
    }

    /* Centralizar o botão de login no menu mobile */
    #mobile-menu li:last-child {
        text-align: center;
        margin-top: 1rem;
    }

    #mobile-menu li:last-child a {
        display: inline-flex;
        justify-content: center;
        width: 100%;
        align-items: center;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }
    </style>
</head>

<body class="bg-white text-gray-700 font-sans min-h-screen">
    <div class="relative" id="content-wrapper">
        <!-- Header Modernizado -->
        <header class="py-3 md:py-4 fixed w-full top-0 left-0 right-0 z-50 glassmorphism transition-all duration-300" id="main-header">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <a href="#" class="flex items-center font-display font-semibold text-gray-900">
                        <img src="{{ url('assets/icons/logo-ngestorx.png') }}" alt="nGestorX" class="w-14 h-14 ">
                        <span class="text-2xl text-blue-950">nGestorX <span class="text-xs text-blue-600 mt-1">Versão 2.1.0 rc</span></span>
                    </a>

                    <!-- Desktop Menu -->
                    <nav class="hidden md:flex space-x-1">
                        <a href="#inicio"
                            class="flex items-center gap-2 text-gray-600 hover:text-blue-600 font-light transition-colors py-2 px-3 rounded-lg hover:bg-blue-50/50 text-sm">
                            <i data-lucide="home" class="w-4 h-4"></i> Início
                        </a>
                        <a href="#pricing"
                            class="flex items-center gap-2 text-gray-600 hover:text-blue-600 font-light transition-colors py-2 px-3 rounded-lg hover:bg-blue-50/50 text-sm">
                            <i data-lucide="credit-card" class="w-4 h-4"></i> Planos
                        </a>
                        <a href="#solutions"
                            class="flex items-center gap-2 text-gray-600 hover:text-blue-600 font-light transition-colors py-2 px-3 rounded-lg hover:bg-blue-50/50 text-sm">
                            <i data-lucide="lightbulb" class="w-4 h-4"></i> Soluções
                        </a>
                        <a href="#features"
                            class="flex items-center gap-2 text-gray-600 hover:text-blue-600 font-light transition-colors py-2 px-3 rounded-lg hover:bg-blue-50/50 text-sm">
                            <i data-lucide="layers" class="w-4 h-4"></i> Recursos
                        </a>
                        <a href="#benefits"
                            class="flex items-center gap-2 text-gray-600 hover:text-blue-600 font-light transition-colors py-2 px-3 rounded-lg hover:bg-blue-50/50 text-sm">
                            <i data-lucide="star" class="w-4 h-4"></i> Benefícios
                        </a>
                        <a href="#contact"
                            class="flex items-center gap-2 text-gray-600 hover:text-blue-600 font-light transition-colors py-2 px-3 rounded-lg hover:bg-blue-50/50 text-sm">
                            <i data-lucide="mail" class="w-4 h-4"></i> Contato
                        </a>
                        <a href=""
                            class="flex items-center gap-2 rounded-lg px-4  text-white  bg-primary-500 hover:from-primary-300 hover:via-primary-500 hover:to-primary-600 transition shadow-md hover:shadow-lg">
                            <i data-lucide="group" class="w-5 h-5"></i> Meus serviços
                        </a>
                        <a href="{{ route('login') }}"
                        class=" flex items-center gap-2 rounded-lg px-6  text-white  bg-blue-600 hover:from-blue-700 hover:via-blue-500 hover:to-blue-600 transition shadow-md hover:shadow-lg">
                            <i data-lucide="log-in" class="w-5 h-5 text-white"></i> Login
                        </a>
                    </nav>

                    <!-- Mobile Menu Button -->
                    <button
                        class="md:hidden text-gray-700 p-2 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
                        id="mobile-menu-btn" aria-label="Menu">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Mobile Menu (Hidden by Default) -->
                <div class="hidden absolute top-full left-0 right-0 bg-white p-4 rounded-b-lg shadow-lg z-50 mt-1"
                    id="mobile-menu">
                    <ul class="space-y-2">
                        <li><a href="#" onclick="scrollToSection(event, 'inicio')"
                                class="flex items-center gap-2 text-gray-600 hover:text-primary-500 font-light transition-colors py-1.5 px-3 rounded-lg hover:bg-primary-50/50 text-sm"><i
                                    data-lucide="home" class="w-4 h-4"></i> Início</a></li>
                        <li><a href="#pricing" onclick="scrollToSection(event, 'pricing')"
                                class="flex items-center gap-2 text-gray-600 hover:text-primary-500 font-light transition-colors py-1.5 px-3 rounded-lg hover:bg-primary-50/50 text-sm"><i
                                    data-lucide="credit-card" class="w-5 h-5"></i> Planos</a></li>
                        <li><a href="#solutions"
                                class="flex items-center gap-2 text-gray-600 hover:text-primary-500 font-light transition-colors py-1 px-3 rounded-lg hover:bg-primary-50/50 text-sm"><i
                                    data-lucide="lightbulb" class="w-5 h-5"></i> Soluções</a></li>
                        <li><a href="#features"
                                class="flex items-center gap-2 text-gray-600 hover:text-primary-500 font-light transition-colors py-1 px-3 rounded-lg hover:bg-primary-50/50 text-sm"><i
                                    data-lucide="layers" class="w-5 h-5"></i> Recursos</a></li>
                        <li><a href="#benefits"
                                class="flex items-center gap-2 text-gray-600 hover:text-primary-500 font-light transition-colors py-1 px-3 rounded-lg hover:bg-primary-50/50 text-sm"><i
                                    data-lucide="star" class="w-5 h-5"></i> Benefícios</a></li>
                        <li><a href="#contact"
                                class="flex items-center gap-2 text-gray-600 hover:text-primary-500 font-light transition-colors py-1 px-3 rounded-lg hover:bg-primary-50/50 text-sm"><i
                                    data-lucide="mail" class="w-5 h-5"></i> Contato</a></li>
                        <ul class="space-y-2">
                            <!-- Botão Meus Serviços (outline) -->
                            <li class="text-center">
                                <a href="#servicos"
                                    class="mt-2 w-full justify-center inline-flex items-center px-6 py-2 text-blue-600 border border-blue-600 rounded-lg bg-white hover:bg-blue-50 transition shadow-sm hover:shadow-md">
                                    <i data-lucide="group" class="w-5 h-5 mr-2"></i>
                                    Meus serviços
                                </a>
                            </li>

                            <!-- Botão Login (preenchido com gradiente) -->
                            <li class="text-center">
                                <a href="{{ route('login') }}"
                                    class="mt-2 w-full justify-center inline-flex items-center px-6 py-2 text-white rounded-lg bg-blue-600 hover:from-blue-700 hover:via-blue-500 hover:to-blue-600 transition shadow-md hover:shadow-lg">
                                    <i data-lucide="log-in" class="w-5 h-5 mr-2"></i>
                                    Login
                                </a>

                            </li>
                        </ul>

                    </ul>
                </div>
            </div>
        </header>

        <!-- Hero com gradiente azul escuro -->
        <section id="inicio" class="min-h-screen relative overflow-hidden bg-gradient-to-r from-[#010511] via-[#1738a7] to-[#f2f6fc] py-24 md:py-0 flex items-center justify-center">
            <div class="absolute inset-0 bg-pattern-dots opacity-5"></div>
            <div class="absolute -left-20 -top-20 w-72 h-72 bg-blue-700/30 rounded-full blur-3xl"></div>
            <div class="absolute -right-20 top-40 w-96 h-96 bg-blue-900/20 rounded-full blur-3xl"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                    <!-- Conteúdo textual -->
                    <div class="md:w-1/2 text-center md:text-left">
                        <span class="text-blue-200 font-medium text-sm px-3 py-1 bg-blue-700/50 rounded-full inline-block mb-4 shadow-sm">
                            Sistema de Gestão Inteligente
                        </span>
                        <h1 class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                            Decisões Inteligentes com Dados em Tempo Real
                        </h1>
                        <p class="mt-4 text-blue-100 text-lg">
                            Dashboards intuitivos, automação para farmácias, restaurantes e empresas modernas.
                        </p>

                        <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4 mt-8">
                            <a href="#demo"
                                class="inline-flex items-center justify-center text-blue-900 px-6 py-3 rounded-xl transition shadow-md hover:shadow-lg bg-white hover:bg-blue-50">
                                <i data-lucide="info" class="w-4 h-4 mr-2"></i>Saiba mais
                            </a>

                            <a href="#demo"
                                class="inline-flex items-center justify-center text-center border border-blue-200 text-white px-6 py-3 rounded-xl transition hover:bg-blue-700/50">
                                <i data-lucide="play" class="w-4 h-4 mr-2"></i>Ver Demo
                            </a>
                        </div>
                    </div>

                    <div class="md:w-1/2 mt-10 md:mt-0 relative floating-effect">
                        <div class="bg-white rounded-2xl p-6 shadow-xl chart-container spotlight-effect">
                            <div class="flex items-center justify-between mb-6 chart-header">
                                <h3 class="text-lg font-semibold text-gray-800 font-display">Desempenho Financeiro</h3>
                                <div class="flex gap-2">
                                    <button
                                        class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded-md hover:bg-blue-100 transition-colors">Mensal</button>
                                    <button
                                        class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-md hover:bg-gray-200 transition-colors">Trimestral</button>
                                    <button
                                        class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-md hover:bg-gray-200 transition-colors">Anual</button>
                                </div>
                            </div>
                            <div id="chart"></div>
                            <div class="flex justify-between mt-4 text-sm text-gray-500 px-4 chart-legend">
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-blue-600 inline-block mr-2"></span>
                                    <span>Receitas</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-green-500 inline-block mr-2"></span>
                                    <span>Lucros</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-red-500 inline-block mr-2"></span>
                                    <span>Despesas</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-purple-500 inline-block mr-2"></span>
                                    <span>Contas a receber</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card flutuante com estatísticas - Ajustado para melhor contraste -->
                        <div class="absolute top-6 -right-6 glassmorphism bg-white/90 p-4 rounded-xl shadow-xl z-20">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-blue-800 to-blue-600 rounded-full flex items-center justify-center shadow-md">
                                    <i data-lucide="trending-up" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Crescimento</p>
                                    <p class="font-bold text-base text-gradient">+24.5%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Soluções -->
        <section id="solutions" class="py-16 md:py-24 bg-white relative">
            <div class="absolute inset-0 bg-pattern-grid opacity-5"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-16">
                    <span class="text-blue-600 font-medium text-sm px-3 py-1 bg-blue-50 rounded-full shadow-sm">Soluções
                        Avançadas</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-4 text-gray-800 font-display">Soluções completas
                        para seu <span class="text-gradient">negócio</span></h2>
                    <p class="text-gray-500 max-w-3xl mx-auto">Conheça nossas soluções integradas que transformam a
                        forma como você gerencia seu negócio.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all hover:-translate-y-1 hover:shadow card-hover spotlight-effect">
                        <div class="bg-primary-50 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="users" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Gestão de Recursos Humanos
                        </h3>
                        <p class="text-gray-500">
                            Otimize o acompanhamento do desempenho e processos da sua equipe com fluxos personalizados.
                            Encontre o equilíbrio ideal entre produtividade e bem-estar dos colaboradores.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all hover:-translate-y-1 hover:shadow card-hover spotlight-effect">
                        <div class="bg-primary-50 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="users" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Gestão de Clientes</h3>
                        <p class="text-gray-500">Centralize informações de clientes, histórico de compras e interações,
                            permitindo atendimento personalizado.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all hover:-translate-y-1 hover:shadow card-hover spotlight-effect">
                        <div class="bg-primary-50 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="package" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Controle de Estoque</h3>
                        <p class="text-gray-500">Gerencie seu inventário em tempo real, com alertas inteligentes e
                            previsão de demanda automatizada.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all hover:-translate-y-1 hover:shadow card-hover spotlight-effect">
                        <div class="bg-primary-50 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="pie-chart" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Análise Financeira</h3>
                        <p class="text-gray-500">Tenha insights importantes sobre o desempenho financeiro com relatórios
                            detalhados e dashboards intuitivos.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recursos -->
        <section id="features" class="py-16 md:py-24 bg-gradient-to-br from-blue-50 via-white to-blue-50 relative">
            <div class="absolute inset-0 bg-pattern-dots opacity-5"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-16">
                    <span class="text-blue-600 font-medium text-sm px-3 py-1 bg-blue-50 rounded-full shadow-sm">Recursos
                        Avançados</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-4 text-gray-800 font-display">Recursos exclusivos
                        do <span class="text-gradient">nGestorX</span></h2>
                    <p class="text-gray-500 max-w-3xl mx-auto">Explore recursos inovadores que simplificam sua gestão e
                        impulsionam resultados.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all hover:-translate-y-1 hover:shadow">
                        <div class="bg-primary-50 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="zap" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Automação Inteligente</h3>
                        <p class="text-gray-500">Automatize tarefas repetitivas com fluxos de trabalho personalizáveis e
                            gatilhos inteligentes.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all hover:-translate-y-1 hover:shadow">
                        <div class="bg-primary-50 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="activity" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Relatórios em Tempo Real</h3>
                        <p class="text-gray-500">Acesse dados atualizados instantaneamente para tomar decisões
                            fundamentadas em tempo real.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all hover:-translate-y-1 hover:shadow">
                        <div class="bg-primary-50 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="smartphone" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Acesso Mobile</h3>
                        <p class="text-gray-500">Gerencie seu negócio de qualquer lugar com nosso aplicativo otimizado
                            para dispositivos móveis.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all hover:-translate-y-1 hover:shadow">
                        <div class="bg-primary-50 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="layers" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Integração Completa</h3>
                        <p class="text-gray-500">Conecte-se facilmente com outras ferramentas e sistemas para um
                            ecossistema unificado.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefícios -->
        <section id="benefits" class="py-16 md:py-24 bg-white relative">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span
                        class="text-blue-600 font-medium text-sm px-3 py-1 bg-blue-50 rounded-full shadow-sm">Benefícios
                        Exclusivos</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-4 text-gray-800 font-display">Por que escolher o
                        <span class="text-gradient">nGestorX</span>
                    </h2>
                    <p class="text-gray-500 max-w-3xl mx-auto">Descubra as vantagens que fizeram milhares de empresas
                        escolherem o nGestorX.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-8">
                        <div
                            class="flex gap-5 p-6 bg-white rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-blue-50 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="trending-up" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Aumento da
                                    Produtividade</h3>
                                <p class="text-gray-500">Nossos clientes relatam um aumento médio de 40% na
                                    produtividade após adotar nossa plataforma, graças à automação e otimização de
                                    processos.</p>
                            </div>
                        </div>
                        <div
                            class="flex gap-5 p-6 bg-white rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-blue-50 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="shield" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Segurança de Dados
                                </h3>
                                <p class="text-gray-500">Protegemos seus dados com criptografia de ponta e controles de
                                    acesso em conformidade com as principais regulamentações globais.</p>
                            </div>
                        </div>
                        <div
                            class="flex gap-5 p-6 bg-white rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-blue-50 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="clock" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Economia de Tempo</h3>
                                <p class="text-gray-500">Reduza o tempo gasto em tarefas administrativas e foque no
                                    crescimento estratégico do seu negócio com nossos processos otimizados.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div
                            class="flex gap-5 p-6 bg-white rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-blue-50 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="bar-chart-2" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Decisões Baseadas em
                                    Dados</h3>
                                <p class="text-gray-500">Acesse insights valiosos com análises avançadas que transformam
                                    dados complexos em informações acionáveis para seu negócio.</p>
                            </div>
                        </div>
                        <div
                            class="flex gap-5 p-6 bg-white rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-blue-50 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Colaboração Aprimorada
                                </h3>
                                <p class="text-gray-500">Promova a colaboração em tempo real entre equipes,
                                    departamentos e até mesmo com parceiros externos de forma segura e eficiente.</p>
                            </div>
                        </div>
                        <div
                            class="flex gap-5 p-6 bg-white rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-blue-50 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <i data-lucide="headphones" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 font-display">Suporte Especializado
                                </h3>
                                <p class="text-gray-500">Nossa equipe de suporte está disponível 24/7 para garantir que
                                    sua experiência seja sempre a melhor possível, com tempo médio de resposta de apenas
                                    3 horas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Módulos Integrados -->
        <section id="modules" class="py-16 md:py-24 bg-white relative">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-16">
                    <span class="text-primary-500 font-medium text-sm px-3 py-1 bg-primary-50 rounded-full">
                        Soluções Especializadas
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-4 text-gray-800 font-display">
                        Módulos Integrados ao <span class="text-gradient">nGestorX</span>
                    </h2>
                    <p class="text-gray-500 max-w-3xl mx-auto">
                        Conheça nossas soluções setoriais que potencializam o gerenciamento de diversos segmentos de
                        negócio.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- IDPharm -->
                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-md transition-all animate-fadeInUp">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center justify-center w-16 h-16 bg-blue-50 rounded-full">
                            <img src="{{ url('assets/icons/logo-idpharm.png') }}" alt="nGestorX" class="w-12  h-12 "> 
                            </div>
                            <div class="flex flex-col items-end">
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Ativo</span>
                               
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 font-display">IDPharm</h3>
                        <p class="text-gray-500 mt-4">
                            Solução completa para farmácias com controle de estoque, validade e conformidade
                            regulatória.
                        </p>
                        <div class="mt-4 flex items-center gap-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                            </div>
                            <span class="text-sm text-green-700">100%</span>
                        </div>
                    </div>

                    <!-- RestGo -->
                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-md transition-all animate-fadeInUp delay-100">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center justify-center w-16 h-16 bg-blue-50 rounded-full">
                              <img src="{{ url('assets/icons/logo-restgo.png') }}" alt="nGestorX" class="w-12  h-12 ">
                            </div>
                            <div class="flex flex-col items-end">
                                <span
                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">Beta</span>
                        
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 font-display">RestGo</h3>
                        <p class="text-gray-500 mt-4">
                            Gestão inteligente para restaurantes com foco em atendimento, insumos e equipe.
                        </p>
                        <div class="mt-4 flex items-center gap-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                            <span class="text-sm text-yellow-700">75%</span>
                        </div>
                    </div>

                    <!-- FlexityX -->
                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-md transition-all animate-fadeInUp delay-200">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center justify-center w-16 h-16 bg-blue-50 rounded-full">
                              <img src="{{ url('assets/icons/logo-flexityx.png') }}" alt="nGestorX" class="w-12  h-12 ">
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">Em
                                    breve</span>
                      
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 font-display">FlexityX</h3>
                        <p class="text-gray-500 mt-4">
                            Plataforma versátil para empresas com fluxos personalizáveis e integração sob demanda.
                        </p>
                        <div class="mt-4 flex items-center gap-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 50%"></div>
                            </div>
                            <span class="text-sm text-blue-700">50%</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out both;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }
        </style>

        <!-- Planos -->
        <section id="pricing" class="py-16 md:py-24 relative bg-gradient-to-br from-blue-50 via-white to-blue-50">
            <!-- Efeito de fundo sutíl -->
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            <div class="absolute top-0 left-0 right-0 h-40 bg-gradient-to-b from-white to-transparent"></div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-16">
                    <span class="text-blue-600 font-medium text-sm px-3 py-1 bg-blue-50 rounded-full shadow-sm">Planos
                        Flexíveis</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-4 text-gray-800 font-display">Escolha o plano
                        ideal para seu <span class="text-gradient">negócio</span></h2>
                    <p class="text-gray-500 max-w-3xl mx-auto">Soluções adaptadas às necessidades específicas da sua
                        empresa, com flexibilidade para crescer.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <!-- Plano Básico -->
                    <div
                        class="bg-white rounded-2xl p-8 flex flex-col h-full border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-xl font-semibold text-blue-600">Básico</h3>
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Iniciante</span>
                            </div>
                            <div class="flex items-baseline mb-2">
                                <span class="text-3xl font-bold text-blue-600">900</span>
                                <span class="text-lg text-gray-500 ml-1">.00 MZN</span>
                            </div>
                            <div class="text-gray-400 text-sm">mensal / por módulo</div>
                        </div>

                        <div class="rounded-xl bg-gradient-to-r from-blue-50 to-blue-100 p-4 mb-6">
                            <div class="flex items-center justify-center space-x-2">
                                <i data-lucide="zap" class="w-5 h-5 text-blue-600"></i>
                                <span class="text-blue-700 font-medium">Ideal para pequenos negócios</span>
                            </div>
                        </div>

                        <div class="mt-2 mb-8 flex-grow">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">1 Acesso Mobile</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="trending-up" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">37% Aumento na retenção</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="hard-drive" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">Backup Mensal dos dados</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="bar-chart" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">Relatórios básicos</span>
                                </li>
                            </ul>
                        </div>

                        <a href="#contact"
                            class="py-2 px-6 rounded-xl bg-white border border-blue-600 text-blue-600 font-medium transition-all hover:bg-blue-50 text-center flex items-center justify-center space-x-2">
                            <span>Fale conosco</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <!-- Plano Profissional (Popular) -->
                    <div
                        class="bg-white rounded-2xl p-8 border-2 border-blue-600 relative flex flex-col h-full shadow-xl transform hover:-translate-y-2 transition-all duration-300 z-10 scale-105">
                        <div
                            class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-700 to-blue-500 text-white font-bold py-2 px-6 rounded-full shadow-lg">
                            <span class="flex items-center">
                                <i data-lucide="award" class="w-4 h-4 mr-1"></i>
                                <span class="text-white text-sm">Mais Popular</span>
                            </span>
                        </div>

                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-xl font-semibold text-blue-700">Profissional</h3>
                                <span class="px-2 py-1 bg-blue-600 text-white text-xs rounded-full">Recomendado</span>
                            </div>
                            <div class="flex items-baseline mb-2">
                                <span class="text-3xl font-bold text-blue-600">2,800</span>
                                <span class="text-lg text-gray-500 ml-1">.00 MZN</span>
                            </div>
                            <div class="text-gray-400 text-sm">mensal / por módulo</div>
                        </div>

                        <div class="rounded-xl bg-gradient-to-r from-blue-600/10 to-blue-600/20 p-4 mb-6">
                            <div class="flex items-center justify-center space-x-2">
                                <i data-lucide="trending-up" class="w-5 h-5 text-blue-700"></i>
                                <span class="text-blue-800 font-medium">Perfeito para empresas em crescimento</span>
                            </div>
                        </div>

                        <div class="mt-2 mb-8 flex-grow">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">3 Acessos (Mobile + Desktop)</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="trending-up" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">37% Aumento na retenção</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="bot" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">72% Atendimento automatizado</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="timer" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">63% Redução no tempo de gestão</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="hard-drive" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">Backup Semanal dos dados</span>
                                </li>
                            </ul>
                        </div>

                        <a href="#contact"
                            class="mt-2 w-full justify-center inline-flex items-center px-6 py-2 text-white rounded-lg bg-gradient-to-r from-blue-200 via-blue-400 to-blue-500 hover:from-blue-300 hover:via-blue-500 hover:to-blue-600 transition shadow-md hover:shadow-lg space-x-2">
                            <span>Fale conosco</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <!-- Plano Enterprise -->
                    <div
                        class="bg-white rounded-2xl p-8 flex flex-col h-full border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-xl font-semibold text-blue-600">Enterprise</h3>
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Avançado</span>
                            </div>
                            <div class="flex items-baseline mb-2">
                                <span class="text-3xl font-bold text-blue-600">4,500</span>
                                <span class="text-lg text-gray-500 ml-1">.00 MZN</span>
                            </div>
                            <div class="text-gray-400 text-sm">mensal / por módulo</div>
                        </div>

                        <div class="rounded-xl bg-gradient-to-r from-blue-50 to-blue-100 p-4 mb-6">
                            <div class="flex items-center justify-center space-x-2">
                                <i data-lucide="building" class="w-5 h-5 text-blue-600"></i>
                                <span class="text-blue-700 font-medium">Para grandes operações</span>
                            </div>
                        </div>

                        <div class="mt-2 mb-8 flex-grow">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">Acessos Ilimitados</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="user" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">Consultor dedicado</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="star" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">Suporte premium</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="settings" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">Automação completa</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="database" class="w-5 h-5 text-blue-600 mr-2 shrink-0"></i>
                                    <span class="text-gray-600">Backup Diário dos dados</span>
                                </li>
                            </ul>
                        </div>

                        <a href="#contact"
                            class="py-2 px-6 rounded-xl bg-white border border-blue-600 text-blue-600 font-medium transition-all hover:bg-blue-50 text-center flex items-center justify-center space-x-2">
                            <span>Fale conosco</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Seção de Contato Reorganizada -->
        <section id="contact" class="py-16 md:py-24 bg-white relative">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-16">
                    <span class="text-blue-600 font-medium text-sm px-3 py-1 bg-blue-50 rounded-full shadow-sm">Fale
                        Conosco</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-4 text-gray-800 font-display">Entre em <span
                            class="text-gradient">contato</span></h2>
                    <p class="text-gray-500 max-w-3xl mx-auto">Estamos prontos para responder suas dúvidas e ajudar sua
                        empresa a crescer com nossas soluções.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <!-- Informações de Contato (Coluna 1) -->
                    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <h3 class="text-xl font-semibold mb-6 text-blue-600 text-center">Informações de Contato</h3>

                        <div class="space-y-6">
                            <!-- Endereço -->
                            <div class="flex items-start space-x-4">
                                <div
                                    class="bg-blue-50 w-12 h-12 rounded-lg flex-shrink-0 flex items-center justify-center">
                                    <i data-lucide="map-pin" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium mb-1 text-gray-800">Endereço</h4>
                                    <p class="text-gray-600">Cidade de Nampula,ECP 3100<br />Nampula, MOZ - Moçambique</p>
                                </div>
                            </div>

                            <!-- Telefone -->
                            <div class="flex items-start space-x-4">
                                <div
                                    class="bg-blue-50 w-12 h-12 rounded-lg flex-shrink-0 flex items-center justify-center">
                                    <i data-lucide="phone" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium mb-1 text-gray-800">Telefone</h4>
                                    <p class="text-gray-600">+258 84 755 3731<br />+258 87 813 1994</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start space-x-4">
                                <div
                                    class="bg-blue-50 w-12 h-12 rounded-lg flex-shrink-0 flex items-center justify-center">
                                    <i data-lucide="mail" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium mb-1 text-gray-800">Email</h4>
                                    <p class="text-gray-600">ngestorx@softetech.com<br />contato@softetech.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Redes Sociais -->
                        <div class="mt-8">
                            <h4 class="text-lg font-medium mb-4 text-gray-800 text-center">Redes Sociais</h4>
                            <div class="flex justify-center space-x-4">
                                <a href="#"
                                    class="bg-blue-50 w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors">
                                    <i data-lucide="facebook" class="w-5 h-5 text-blue-600"></i>
                                </a>

                                <a href="#"
                                    class="bg-blue-50 w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors">
                                    <i data-lucide="linkedin" class="w-5 h-5 text-blue-600"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Formulário de Contato (Coluna 2-3) -->
                    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 lg:col-span-2">
                        <h3 class="text-xl font-semibold mb-6 text-blue-600">Envie sua mensagem</h3>
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome
                                        completo</label>
                                    <input type="text" id="nome" name="nome"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                        placeholder="Seu nome completo" />
                                </div>
                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                        placeholder="seu.email@exemplo.com" />
                                </div>
                            </div>

                            <div>
                                <label for="assunto"
                                    class="block text-sm font-medium text-gray-700 mb-1">Assunto</label>
                                <input type="text" id="assunto" name="assunto"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    placeholder="Assunto da mensagem" />
                            </div>

                            <div>
                                <label for="mensagem"
                                    class="block text-sm font-medium text-gray-700 mb-1">Mensagem</label>
                                <textarea id="mensagem" name="mensagem" rows="5"
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    placeholder="Digite sua mensagem aqui..."></textarea>
                            </div>

                            <div class="flex items-center">
                                <input id="termos" type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                                <label for="termos" class="ml-2 block text-sm text-gray-700">
                                    Concordo com os <a href="#" class="text-blue-600 hover:text-blue-700">termos de
                                        serviço</a> e
                                    <a href="#" class="text-blue-600 hover:text-blue-700">política de privacidade</a>
                                </label>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-3 rounded-lg transition shadow-md hover:shadow-lg flex items-center justify-center">
                                    <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                                    Enviar mensagem
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Rodapé -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-gradient">
                            <span class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-lg  flex items-center justify-center text-white font-bold">
                                    <img src="{{ url('assets/icons/logo-ngestorx.png') }}" alt="nGestorX" class="w-16 h-16">
                                    </div>
                                nGestorX
                            </span>
                        </h3>
                        <p class="text-gray-400">Integração inteligente para gestão empresarial moderna e eficiente.</p>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold mb-4 text-white">Redes Sociais</h4>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="bg-blue-50 w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors">
                                <i data-lucide="facebook" class="w-5 h-5 text-blue-600"></i>
                            </a>

                            <a href="#"
                                class="bg-blue-50 w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors">
                                <i data-lucide="linkedin" class="w-5 h-5 text-blue-600"></i>
                            </a>

                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4 text-white">Legais</h4>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            Termos de uso
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            Política de privacidade
                        </a>
                    </div>
                </div>
                <div class="border-t border-gray-700 pt-8 text-center">
                    <p class="text-sm text-gray-400">&copy; 2024 - {{ date('Y') }}. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>

        <!-- Botão Flutuante de Scroll -->
        <div class="fixed bottom-6 right-6 z-50 hidden" id="scroll-top-btn">
            <button
                class="text-white w-12 h-12 text-2xl flex items-center justify-center rounded-full bg-blue-700 hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                <i data-lucide="chevron-up" class="w-6 h-6"></i>
            </button>
        </div>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicialização dos ícones Lucide
        lucide.createIcons();

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const header = document.getElementById('main-header');
        const contentWrapper = document.getElementById('content-wrapper');

        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Fechar menu ao clicar nos links
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 10) {
                header.classList.add('shadow');
                header.classList.remove('py-4');
                header.classList.add('py-3');
            } else {
                header.classList.remove('shadow');
                header.classList.remove('py-3');
                header.classList.add('py-4');
            }
        });

        // Adicionar efeito de hover nas cards
        const cards = document.querySelectorAll('.bg-white.p-6, .bg-white.p-8');
        cards.forEach(card => {
            card.classList.add('hover-lift');
        });

        // Inicialização do gráfico ApexCharts - com melhorias de responsividade
        let options = {
            series: [{
                name: 'Vendas',
                data: [61000, 40000, 28000, 51000, 42000, 109000, 100000, 120000, 95000, 105000,
                    85000, 110000
                ]
            }, {
                name: 'Receitas',
                data: [35000, 45000, 32000, 55000, 48000, 115000, 106000, 124000, 92000, 107000,
                    90000, 115000
                ]
            }, {
                name: 'Despesas',
                data: [25000, 30000, 26000, 35000, 30000, 85000, 75000, 90000, 70000, 80000, 75000,
                    85000
                ]
            }, {
                name: 'Compras',
                data: [20000, 25000, 22000, 30000, 28000, 75000, 68000, 85000, 65000, 72000, 70000,
                    80000
                ]
            }],

            chart: {
                height: 280,
                type: 'area',
                fontFamily: 'DM Sans, sans-serif',
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                },
                zoom: {
                    enabled: false
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            },
            colors: ['#125fcc', '#10b981', '#ef4444', '#8b5cf6'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            grid: {
                borderColor: '#f1f1f1',
                row: {
                    colors: ['transparent', 'transparent'],
                    opacity: 0.5
                },
                padding: {
                    left: 5,
                    right: 5
                }
            },
            markers: {
                size: 0,
                hover: {
                    size: 5
                }
            },
            xaxis: {
                categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov',
                    'Dez'
                ],
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '12px',
                        fontFamily: 'DM Sans, sans-serif',
                    },
                    rotateAlways: false,
                    hideOverlappingLabels: true
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '12px',
                        fontFamily: 'DM Sans, sans-serif',
                    },
                    formatter: function(value) {
                        return parseFloat(value).toLocaleString('pt-MZ', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }

                },
                min: function(min) {
                    return min - 5;
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
                y: {
                    formatter: function(value) {
                        return parseFloat(value).toLocaleString('pt-MZ', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }

                },
                style: {
                    fontSize: '12px',
                    fontFamily: 'DM Sans, sans-serif'
                }
            },
            legend: {
                show: false
            }
        };

        // Verificar se o elemento do gráfico existe antes de inicializar
        const chartElement = document.querySelector('#chart');
        if (chartElement) {
            const chart = new ApexCharts(chartElement, options);
            chart.render();

            // Função para gerar dados aleatórios
            function gerarDadosAleatorios() {
                return {
                    vendas: options.series[0].data.map(valor => {
                        // Varia entre -10% e +10% do valor original
                        const variacao = valor * (0.9 + Math.random() * 0.2);
                        return Math.round(variacao);
                    }),
                    receitas: options.series[1].data.map(valor => {
                        const variacao = valor * (0.92 + Math.random() * 0.16);
                        return Math.round(variacao);
                    }),
                    despesas: options.series[2].data.map(valor => {
                        const variacao = valor * (0.95 + Math.random() * 0.1);
                        return Math.round(variacao);
                    }),
                    compras: options.series[3].data.map(valor => {
                        const variacao = valor * (0.93 + Math.random() * 0.14);
                        return Math.round(variacao);
                    })
                };
            }

            // Função para atualizar o gráfico
            function atualizarGrafico() {
                const novosDados = gerarDadosAleatorios();

                chart.updateSeries([{
                        name: 'Vendas',
                        data: novosDados.vendas
                    },
                    {
                        name: 'Receitas',
                        data: novosDados.receitas
                    },
                    {
                        name: 'Despesas',
                        data: novosDados.despesas
                    },
                    {
                        name: 'Compras',
                        data: novosDados.compras
                    }
                ]);
            }

            // Atualizar o gráfico a cada 3 segundos
            setInterval(atualizarGrafico, 3000);
        }

        // Adicionar animações ao scroll
        const animateElements = document.querySelectorAll('.animate-on-scroll');

        function checkVisibility() {
            animateElements.forEach(element => {
                const rect = element.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;

                if (rect.top <= windowHeight * 0.8) {
                    element.classList.add('active');
                }
            });
        }

        // Verificar visibilidade inicial e ao scroll
        window.addEventListener('scroll', checkVisibility);
        checkVisibility();

        // Código para o botão de scroll
        const scrollTopBtn = document.getElementById('scroll-top-btn');

        // Mostrar/ocultar botão baseado na posição de scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.remove('hidden');
            } else {
                scrollTopBtn.classList.add('hidden');
            }
        });

        // Ação de scroll ao topo
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Função para scroll suave
        function scrollToSection(event, targetId) {
            event.preventDefault();
            const target = document.getElementById(targetId);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
                history.replaceState(null, null, ' ');
            }
        }

        // Adiciona a função ao escopo global (window)
        window.scrollToSection = scrollToSection;

        // Scroll suave para todos os links internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && href !== '#') {
                    const id = href.slice(1);
                    const target = document.getElementById(id);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                        history.replaceState(null, null, ' ');
                    }
                }
            });
        });
    });
    </script>

</body>

</html>