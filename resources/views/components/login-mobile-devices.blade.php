<div class="w-full max-w-sm bg-white p-4">
   <div class="text-left">
      <div class="flex items-center mb-4">
         <img src="{{ url('assets/icons/logo-ngestorx.png') }}" alt="nGestorX" class="w-16 h-16">
         <span class="text-blue-950 font-bold text-2xl">nGestorX</span>
      </div>
   </div>
   <h2 class="text-xl font-semibold text-gray-900 text-center">Bem-vindo de volta</h2>
   <p class="text-gray-500 text-sm text-center mt-1 mb-6">Faça login com as suas credenciais</p>
   <form action="#" method="POST" class="space-y-3">
      <!-- Linha com os dois campos lado a lado -->
      <div class="flex gap-2">
         <div class="w-1/2">
            <label for="uid" class="block text-sm text-gray-700 font-semibold">UID da Empresa</label>
            <input type="text" id="uid" name="uid"
               class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200"
               required />
         </div>
         <div class="w-1/2">
            <label for="modulo" class="block text-sm text-gray-700 font-semibold">Nome do Módulo</label>
            <input type="text" id="modulo" name="modulo"
               class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200"
               required />
         </div>
      </div>
      <div>
         <label for="email" class="block text-sm text-gray-700 font-semibold">E-mail</label>
         <input type="email" id="email" name="email"
            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200"
            required />
      </div>
      <div>
         <label for="senha" class="block text-sm text-gray-700 font-semibold">Senha</label>
         <input type="password" id="senha" name="senha"
            class="mt-1 w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-indigo-200"
            required />
      </div>
      <button type="submit"
         class="flex items-center justify-center w-full bg-blue-600 text-white py-2 text-sm font-semibold shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded">
      <i data-lucide="log-in" class="w-6 h-6 text-white mr-2"></i>Login
      </button>
   </form>
   <div class="flex justify-between items-center mt-3 text-sm">
      <a href="javascript:void(0)" class="text-blue-600 hover:text-blue-800">Esqueceu a senha?</a>
      <a href="javascript:void(0)" class="text-blue-600 hover:text-blue-800">Criar conta</a>
   </div>
 
</div>
<footer>
    <div class="flex flex-col sm:flex-row text-center justify-center lg:justify-start gap-4 mt-4 mb-2">
        <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800">www.ngestorx.softetech.com</a>
    </div>
</footer>
