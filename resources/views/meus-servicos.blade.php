  <!-- Navegação -->
  <nav class="fixed w-full z-50 transition-all duration-300 backdrop-blur-sm"
    x-data="{ isOpen: false, isScrolled: false, activeSection: 'home', loginOpen: false }"
    x-init="window.addEventListener('scroll', () => { 
      isScrolled = window.pageYOffset > 20;
      ['home', 'saiba-mais', 'solucoes-integradas', 'recursos', 'beneficios', 'planos', 'contato'].forEach(section => {
        const el = document.getElementById(section);
        if (el && window.pageYOffset >= el.offsetTop - 100) {
          activeSection = section;
        }
      });
    })"
    :class="{ 'nav-scrolled': isScrolled, 'bg-white/80': !isScrolled }">
    <div class="w-full px-6 sm:px-10 lg:px-12">
      <div class="flex justify-between h-20">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
          <a href="#" class="flex items-center space-x-2 text-blue-600 text-xl font-bold tracking-tight hover:text-blue-700 transition-colors duration-300">
            <img src="{{ asset('assets/icons/ngestor.png') }}" alt="NgestorX" class="w-8 h-8">
            <div class="flex items-center">
              <span class="bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">nGestorX</span>
              <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium  border border-blue-200 shadow-sm">
                v2.0.0 Beta
              </span>
            </div>
          </a>
        </div>

        <!-- Links de navegação desktop e botões -->
        <div class="hidden md:flex md:items-center md:space-x-6">
          <a href="#home"
            class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium"
            :class="{ 'text-blue-600': activeSection === 'home', 'text-gray-600': activeSection !== 'home' }">
            <i data-lucide="home" class="mr-2 w-4 h-4"></i>
            Início
          </a>
          <a href="#planos"
            class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium"
            :class="{ 'text-blue-600': activeSection === 'planos', 'text-gray-600': activeSection !== 'planos' }">
            <i data-lucide="credit-card" class="mr-2 w-4 h-4"></i>
            Planos
          </a>
          <a href="#solucoes-integradas"
            class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium"
            :class="{ 'text-blue-600': activeSection === 'solucoes-integradas', 'text-gray-600': activeSection !== 'solucoes-integradas' }">
            <i data-lucide="puzzle" class="mr-2 w-4 h-4"></i>
            Soluções
          </a>
          <a href="#recursos"
            class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium"
            :class="{ 'text-blue-600': activeSection === 'recursos', 'text-gray-600': activeSection !== 'recursos' }">
            <i data-lucide="settings" class="mr-2 w-4 h-4"></i>
            Recursos
          </a>
          <a href="#beneficios"
            class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium"
            :class="{ 'text-blue-600': activeSection === 'beneficios', 'text-gray-600': activeSection !== 'beneficios' }">
            <i data-lucide="star" class="mr-2 w-4 h-4"></i>
            Benefícios
          </a>
          <a href="#contato"
            class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium"
            :class="{ 'text-blue-600': activeSection === 'contato', 'text-gray-600': activeSection !== 'contato' }">
            <i data-lucide="mail" class="mr-2 w-4 h-4"></i>
            Contato
          </a>

          <!-- Meus Serviços -->
          <div x-data="{ loginOpen: false }" class="relative">
            <button
              @click="loginOpen = !loginOpen"
              class="inline-flex items-center justify-center px-6 py-2 text-sm font-medium text-white bg-blue-400 bg-gradient-to-r from-blue-400 to-blue-500 hover:bg-blue-700 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300">
              <i data-lucide="layout-grid" class="mr-2 w-4 h-4"></i>
              Meus Serviços
            </button>

            <!-- Modal de Login -->
            <div x-show="loginOpen"
              x-cloak
              @click.away="loginOpen = false"
              @keydown.escape.window="loginOpen = false"
              class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50"
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-200"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0">
              <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-lg">
                <h4 class="text-3xl font-bold text-gray-900 mb-6 text-center">Meus Serviços</h4>
                <p class="text-sm text-gray-600 mb-6 text-left fs-5">Por favor, entre com as suas credenciais para acessar os seus serviços disponíveis</p>
                <form action="" method="POST">
                  @csrf
                  <div class="mb-4">
                    <label for="uid-desktop" class="block text-sm font-medium text-gray-700 mb-1 text-left  ">UID Empresa</label>
                    <input type="text" id="uid-desktop" name="uid" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Digite seu UID Empresa">
                  </div>
                  <div class="mb-6">
                    <label for="chave-desktop" class="block text-sm font-medium text-gray-700 mb-1 text-left">Chave de Acesso</label>
                    <input type="password" id="chave-desktop" name="chave" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Digite sua Chave de Acesso">
                  </div>

                  <!-- Botão para fechar o modal E Entrar-->

                  <div class="flex justify-center mb-4">
                    <button @click="loginOpen = false" class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white bg-blue-400 bg-gradient-to-r from-blue-400 to-blue-500 hover:bg-blue-700 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 w-full md:w-auto">
                      Fechar
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white bg-blue-400 bg-gradient-to-r from-blue-400 to-blue-500 hover:bg-blue-700 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 w-full md:w-auto">
                      Acessar serviços
                    </button>
                  </div>
                  <p class="text-sm text-gray-600 mb-6 text-left fs-5">Não tem uma conta? <a href="#contato" @click="loginOpen = false" class="text-blue-600 hover:text-blue-700">Solicite registro</a></p>

                </form>

              </div>
            </div>

          </div>
          <!-- Menu de Usuário -->
          <div x-data="{ isOpen: false }" class="relative">
            <button
              @click="isOpen = !isOpen"
              @keydown.escape="isOpen = false"
              class="flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105 focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
              <i class="bi bi-person-circle text-lg"></i>
              <span>Minha Conta</span>
              <i class="bi bi-chevron-down transition-transform duration-300" :class="{ 'rotate-180': isOpen }"></i>
            </button>

            <!-- Menu dropdown -->
            <div
              x-show="isOpen"
              @click.away="isOpen = false"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-100"
              x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-95"
              class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50"
              x-cloak>
              <a href="{{ route('login') }}" class="flex items-center space-x-2 px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                <i data-lucide="key-round"></i>
                <span>Login nGestorX</span>
              </a>
              <a href="#contato" @click="isOpen = false" class="flex items-center space-x-2 px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                <i data-lucide="user-plus"></i>
                <span>Solicitar registro</span>
              </a>


            </div>
          </div>
        </div>

        <!-- Botão mobile -->
        <div class="flex items-center md:hidden">
          <button @click="isOpen = !isOpen"
            class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-colors duration-200">
            <span class="sr-only">Abrir menu</span>
            <i class="bi" :class="isOpen ? 'bi-x text-xl' : 'bi-list text-2xl'"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Menu mobile -->
    <div class="md:hidden" x-show="isOpen"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 -translate-y-1"
      x-transition:enter-end="opacity-100 translate-y-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 translate-y-0"
      x-transition:leave-end="opacity-0 -translate-y-1"
      class="bg-white shadow-lg rounded-b-3xl border-t border-gray-100"
      x-cloak>
      <div class="pt-2 pb-3 space-y-1 bg-white rounded-b-3xl">
        <a href="#home" @click="isOpen = false" class="block px-4 py-2 text-base font-medium text-blue-600 bg-white hover:bg-gray-50 hover:shadow-sm rounded-lg mx-2 transition-all duration-200">
          <i class="bi bi-house-door me-2"></i>
          Início
        </a>
        <a href="#planos" @click="isOpen = false" class="block px-4 py-2 text-base font-medium text-gray-600 bg-white hover:bg-gray-50 hover:shadow-sm hover:text-gray-900 rounded-lg mx-2 transition-all duration-200">
          <i class="bi bi-credit-card me-2"></i>
          Planos
        </a>
        <a href="#solucoes-integradas" @click="isOpen = false" class="block px-4 py-2 text-base font-medium text-gray-600 bg-white hover:bg-gray-50 hover:shadow-sm hover:text-gray-900 rounded-lg mx-2 transition-all duration-200">
          <i class="bi bi-puzzle me-2"></i>
          Soluções
        </a>
        <a href="#recursos" @click="isOpen = false" class="block px-4 py-2 text-base font-medium text-gray-600 bg-white hover:bg-gray-50 hover:shadow-sm hover:text-gray-900 rounded-lg mx-2 transition-all duration-200">
          <i class="bi bi-gear me-2"></i>
          Recursos
        </a>
        <a href="#beneficios" @click="isOpen = false" class="block px-4 py-2 text-base font-medium text-gray-600 bg-white hover:bg-gray-50 hover:shadow-sm hover:text-gray-900 rounded-lg mx-2 transition-all duration-200">
          <i class="bi bi-star me-2"></i>
          Benefícios
        </a>
        <a href="#contato" @click="isOpen = false" class="block px-4 py-2 text-base font-medium text-gray-600 bg-white hover:bg-gray-50 hover:shadow-sm hover:text-gray-900 rounded-lg mx-2 transition-all duration-200">
          <i class="bi bi-envelope me-2"></i>
          Contato
        </a>
        <div class="mt-4 px-4 py-3 space-y-3 bg-white rounded-lg mx-2 shadow-sm">
          <!-- Botão Meus Serviços -->
          <div x-data="{ meusServicosOpen: false }">
            <!-- Botão Meus Serviços -->
            <button @click="meusServicosOpen = true;"
              class="w-full flex items-center justify-center px-4 py-2 text-base font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg hover:shadow-lg transition-all duration-300">
              <i class="bi bi-grid-1x2 mr-2"></i>
              Meus Serviços
            </button>

            <!-- Modal de Meus Serviços -->
            <div x-show="meusServicosOpen"
              x-cloak
              @click.away="meusServicosOpen = false"
              @keydown.escape.window="meusServicosOpen = false"
              class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50"
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-200"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0">

              <div class="bg-white w-full max-w-md p-6 m-2 rounded-2xl shadow-lg">
                <h4 class="text-3xl font-bold text-gray-900 mb-6 text-center">Meus Serviços</h4>
                <p class="text-sm text-gray-600 mb-6 text-left fs-5">Por favor, entre com as suas credenciais para acessar os seus serviços disponíveis</p>
                <form action="" method="POST">
                  @csrf
                  <div class="mb-4">
                    <label for="uid-mobile" class="block text-sm font-medium text-gray-700 mb-1 text-left  ">UID Empresa</label>
                    <input type="text" id="uid-mobile" name="uid" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Digite seu UID Empresa">
                  </div>
                  <div class="mb-6">
                    <label for="chave-mobile" class="block text-sm font-medium text-gray-700 mb-1 text-left">Chave de Acesso</label>
                    <input type="password" id="chave-mobile" name="chave" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Digite sua Chave de Acesso">
                  </div>

                  <!-- Botão para fechar o modal E Entrar-->

                  <div class="flex justify-center mb-4">
                    <button @click="meusServicosOpen = false" class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white bg-blue-400 bg-gradient-to-r from-blue-400 to-blue-500 hover:bg-blue-700 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 w-full md:w-auto mr-2">
                      Fechar
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white bg-blue-400 bg-gradient-to-r from-blue-400 to-blue-500 hover:bg-blue-700 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 w-full md:w-auto">
                      Acessar
                    </button>
                  </div>
                  <p class="text-sm text-gray-600 mb-6 text-left fs-5">Não tem uma conta? <a href="#contato" @click="meusServicosOpen = false; isOpen = false" class="text-blue-600 hover:text-blue-700">Solicite registro</a></p>

                </form>

              </div>
            </div>
          </div>

          <!-- Botão Minha Conta -->
          <div x-data="{ isOpen: false }" class="relative">
            <button
              @click="isOpen = !isOpen"
              @keydown.escape="isOpen = false"
              class="w-full flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:shadow-lg transition-all duration-300">
              <i class="bi bi-person-circle text-lg mr-2"></i>
              <span>Minha Conta</span>
              <i class="bi bi-chevron-down ml-2 transition-transform duration-300" :class="{ 'rotate-180': isOpen }"></i>
            </button>

            <!-- Menu dropdown -->
            <div
              x-show="isOpen"
              @click.away="isOpen = false"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-100"
              x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-95"
              class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50"
              x-cloak>
              <a href="{{ route('login') }}" class="flex items-center space-x-2 px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                <i data-lucide="key-round"></i>
                <span>Login nGestorX</span>
              </a>
              <a href="#contato" @click="isOpen = false" class="flex items-center space-x-2 px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                <i data-lucide="user-plus"></i>
                <span>Solicitar registro</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>