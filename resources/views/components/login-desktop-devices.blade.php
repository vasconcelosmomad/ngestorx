   <!-- Seção Hero -->
   <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-r from-[#010511] via-[#1738a7] to-[#f2f6fc] px-4">
        <div
            class="container mx-auto max-w-7xl flex flex-col-reverse lg:flex-row items-center justify-between gap-10 relative">

            <!-- Conteúdo Esquerdo -->
            <div class="text-white lg:w-1/2 text-center lg:text-left">
                <span
                    class="inline-block bg-blue-700/50 text-blue-200 text-sm font-medium px-4 py-1 rounded-full shadow mb-4">Sistema
                    de Gestão</span>
                <h1 class="text-3xl sm:text-4xl font-bold leading-tight">
                    Decisões Inteligentes com Dados em Tempo Real
                </h1>
                <p class="mt-4 text-lg text-blue-100">
                    Dashboards intuitivos, automação para farmácias, restaurantes e empresas modernas.
                </p>

                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 mt-8">
                    <a href="{{ url('/') }}" class="text-white text-sm">
                        www.ngestorx.softetech.com
                    </a>

                </div>
            </div>

            <!-- Formulário de Login -->
            <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md">
                <div class="text-left">
                    <div class="flex items-center mb-4">
                        <img src="{{ url('assets/icons/logo-ngestorx.png') }}" alt="nGestorX" class="w-16 h-16">
                        <span class="text-blue-950 font-bold text-2xl">nGestorX</span>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 text-center">Bem-vindo de volta</h2>
                <p class="text-gray-500 text-sm text-center mt-1 mb-6">Faça login com as suas credenciais</p>

                <form action="#" method="POST" class="space-y-4">
                    <div class="flex gap-2">
                        <div class="w-1/2">
                            <label for="uid_empresa" class="block text-sm text-gray-700 font-semibold">UID da
                                Empresa</label>
                            <input type="text" id="uid_empresa" name="uid_empresa" value="123456"
                                class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                        </div>
                        <div class="w-1/2">
                            <label for="modulo" class="block text-sm text-gray-700 font-semibold">Módulo</label>
                            <select id="modulo" name="modulo"
                                class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                                <option value="">Selecione o Módulo</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="username" class="block text-sm text-gray-700 font-semibold">E-mail ou Nome de
                            Usuário</label>
                        <input type="text" id="username" name="username" value=" "
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="password" class="block text-sm text-gray-700 font-semibold">Senha</label>
                        <input type="password" id="password" name="password" value=""
                            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200">
                    </div>

                    <button type="submit"
                        class=" w-full flex items-center text-center justify-center rounded-lg px-6  text-white  bg-gradient-to-r from-blue-700 to-blue-500 text-white  py-2 px-6 rounded-full shadow-lg"><i
                            data-lucide="log-in" class="w-5 h-5 text-white mr-2"></i>Login </button>
                </form>

                <div class="flex justify-between text-sm mt-4">
                    <a href="javascript:void(0)" class="text-blue-600 ">Esqueceu a senha?</a>
                    <a href="javascript:void(0)" class="text-blue-600 ">Criar conta</a>
                </div>
            </div>
        </div>
    </div>