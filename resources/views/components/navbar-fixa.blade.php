@php
$nome_usuario = session()->get('nome_usuario');
$primeira_letra = substr($nome_usuario, 0, 1);
$notificacoes_nao_lidas = 3; // substitua isso com a contagem real do banco de dados
@endphp

<nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50 gap-3 flex justify-between items-center px-4 py-2 border-b">
    
    <div class="flex items-center gap-4">
        <!-- Logotipo -->
        <div class="flex items-center">
            <img src="{{ url('assets/icons/logo-ngestorx.png') }}" class="w-10 h-10" alt="Logo" />
            <span class="font-semibold text-blue-950 text-xl">nGestorX</span>
        </div>
    </div>

    <div class="flex items-center gap-4 relative">
        <!-- Ícone de Notificação com Badge -->
        <div class="relative">
            <a href="javascript:void(0)" id="notificationBtn" class="flex items-center focus:outline-none" aria-label="Notificações">
                <i data-lucide="bell" class="text-blue-700 w-6 h-6"></i>
            </a>
           
            <span class="absolute -top-1 -right-1 bg-yellow-400 text-white text-xs font-bold rounded-full px-1.5 py-0.5 leading-none z-50">
           0
            </span>
       
        </div>

        <!-- Botão do usuário -->
        <button id="userDropdownBtn" class="flex items-center focus:outline-none" aria-label="Abrir menu do usuário">
            <span
                class="w-10 h-10 rounded-full ring-1 ring-blue-600 p-2 text-center text-white bg-blue-500"
                title="{{ $nome_usuario }}"
            >
                {{ $primeira_letra }}
            </span>
        </button>

        <!-- Dropdown -->
        <div id="userDropdown" class="hidden absolute right-0 top-14 bg-white shadow-xl w-60 p-2 z-50 rounded-b-lg">
            <div class="flex items-center gap-2 px-3 py-2 text-sm text-gray-900 border-b">
                <i data-lucide="user"></i> {{ $nome_usuario }}
            </div>
            <a href="javascript:void(0)" class="flex items-center gap-2 block px-3 py-2 text-sm hover:bg-gray-100 rounded">
                <i data-lucide="settings"></i> Configurações
            </a>
            <a href="{{ route('logout') }}" class="flex items-center gap-2 block px-3 py-2 text-sm text-red-600 hover:bg-gray-100 rounded">
                <i data-lucide="log-out"></i> Logout
            </a>
        </div>
    </div>
</nav>
