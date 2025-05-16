@php
$user = session()->get('nivel_acesso');
$data_hora_fechamento = date('d-m-Y H\h:i\m');

@endphp

<div id="sidebar"
    class="fixed top-0 left-0 w-64 h-full bg-white shadow-md border-r border-gray-200 backdrop-blur-md transform -translate-x-full transition-transform duration-300 z-40 pt-16 rounded-tr-xl">
    <ul class="p-4 space-y-4">
        <!-- DASHBOARD -->
        <li>
            <button onclick="toggleSubmenu('dashboard')"
                class="flex justify-between items-center w-full text-gray-700 font-medium text-sm md:text-base hover:bg-gray-100 p-2 rounded transition">
                <span class="flex gap-2 items-center">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 stroke-[1.5] text-blue-500"></i> Dashboard{{ $user }}
                </span>
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
            </button>
            <ul id="submenu-dashboard" class="ml-6 mt-2 space-y-1 text-sm text-gray-500">
                <li>
                    <a href="{{ route('painel.index', ['page' => 'dashboard']) }}" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="bar-chart-2" class="w-5 h-5"></i> Resumo
                    </a>
                </li>
              
                <li id="opnModalMapaVendas" class="abrirModal hidden" data-modal="mapaVendas">
                    <a href="javascript:void(0)"   class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="file-text" class="w-5 h-5"></i>Mapa de vendas
                    </a>
                </li>
            </ul>
        </li>

        <!-- VENDAS -->
        <li id="vendas">
            <button onclick="toggleSubmenu('fr')"
                class="flex justify-between items-center w-full text-gray-700 font-medium text-sm md:text-base hover:bg-gray-100 p-2 rounded transition">
                <span class="flex gap-2 items-center">
                    <i data-lucide="shopping-cart" class="w-5 h-5 stroke-[1.5] text-green-600"></i>Faturamento(VD)
                </span>
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
            </button>
            <ul id="submenu-fr" class="ml-6 mt-2 space-y-1 text-sm text-gray-500">
                <li id="abertura" class="abrirModal hidden" data-modal="abrirCaixa">
                    <a href="javascript:void(0)" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="log-in" class="w-4 h-4"></i> Abertura de caixa
                    </a>
                </li>
                <li id="fechamento" class="abrirModal hidden" data-modal="fecharCaixa">
                    <a href="javascript:void(0)" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Fechamento de caixa
                    </a>
                </li>
                <li id="pdv" onclick="pdv()">
                    <a href="javascript:void(0)" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="tablet-smartphone" class="w-4 h-4"></i> Ponto de venda (PDV)
                    </a>
                </li>
                <li>
                    <a href="{{ route('painel.index', ['page' => 'vendas-concluidas']) }}" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="check-circle" class="w-4 h-4"></i> Vendas concluídas
                    </a>
                </li>
            </ul>
        </li>
          

        <!-- FATURAMENTO -->
        <li id="FT">
            <button onclick="toggleSubmenu('ft')"
                class="flex justify-between items-center w-full text-gray-700 font-medium text-sm md:text-base hover:bg-gray-100 p-2 rounded transition">
                <span class="flex gap-2 items-center">
                    <i data-lucide="shopping-cart" class="w-5 h-5 stroke-[1.5] text-green-600"></i> Faturamento(FT)
                </span>
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
            </button>
            <ul id="submenu-ft" class="ml-6 mt-2 space-y-1 text-sm text-gray-500">
                <li id="abertura" class="abrirModal hidden" data-modal="abrirCaixa">
                    <a href="javascript:void(0)" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="log-in" class="w-4 h-4"></i> Abertura de caixa
                    </a>
                </li>
                <li id="fechamento" class="abrirModal hidden" data-modal="fecharCaixa">
                    <a href="javascript:void(0)" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Fechamento de caixa
                    </a>
                </li>
                <li id="pdv" onclick="pdv()">
                    <a href="javascript:void(0)" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="tablet-smartphone" class="w-4 h-4"></i> Ponto de venda (PDV)
                    </a>
                </li>
                <li>
                    <a href="{{ route('painel.index', ['page' => 'vendas-concluidas']) }}" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>Faturas (FT) Emitidas
                    </a>
                </li>
            </ul>
        </li>

         <!--  GESTÃO DE CONTAS A PAGAR -->
        <li id="contas">
            <button onclick="toggleSubmenu('contas')"
                class="flex justify-between items-center w-full text-gray-700 font-medium text-sm md:text-base hover:bg-gray-100 p-2 rounded transition">
                <span class="flex gap-2 items-center">
                    <i data-lucide="shopping-cart" class="w-5 h-5 stroke-[1.5] text-green-600"></i> Gestão de Contas
                </span>
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
            </button>
            <ul id="submenu-contas" class="ml-6 mt-2 space-y-1 text-sm text-gray-500">
                <li class="abrirModal " data-modal="fecharCaixa">
                    <a href="javascript:void(0)" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="hand-coins" class="w-4 h-4"></i> Contas a Pagar
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="hand-helping" class="w-4 h-4"></i>Contas a Receber
                    </a>
                </li>
            </ul>
        </li>
            
        
        <!-- AJUDA -->
        <li>
            <button onclick="toggleSubmenu('ajuda')"
                class="flex justify-between items-center w-full text-gray-700 font-medium text-sm md:text-base hover:bg-gray-100 p-2 rounded transition">
                <span class="flex gap-2 items-center">
                    <i data-lucide="headset" class="w-5 h-5 stroke-[1.5] text-purple-600"></i>Suporte Técnico
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
            </button>
            <ul id="submenu-ajuda" class="ml-6 mt-2 space-y-1 text-sm text-gray-500">
                <li>
                    <a href="{{route('painel.index', ['page' => 'chat'])}}" class="flex items-center gap-2 hover:text-blue-600 transition">
                        <i data-lucide="message-circle" class="w-4 h-4"></i> Tickets
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- FOOTER
     <div class="absolute bottom-0 z-100 left-0 w-full p-4 mb-6  border-gray-200 text-center text-xs text-gray-400">
    &copy; 2024 - {{ date('Y') }} SOFTETECH, EI. Todos os direitos reservados.
</div>
     
      -->


</div>
<script>
    switch ("{{ $user }}") {
        case '1':
  
            break;
        case '2':
          document.getElementById("sidebar").classList.add("hidden");
            break;  
        case '3':
            document.getElementById("vendas").classList.add("hidden");
            break;
        default:
          document.getElementById("vendas").classList.add("hidden");
    }
    
</script>
    
