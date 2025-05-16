 <div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>  
<footer
    class="fixed bottom-0 left-0 w-full bg-white shadow-2xl flex justify-around items-center py-3 z-50 rounded-t-xl">
    <a href="{{ route('painel.index', ['page' => 'dashboard']) }}" class="flex flex-col items-center text-gray-500">
        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
        <span class="text-xs mt-1 text-gray-500">Dashboard</span>
    </a>
    <button id="openSidebar" class="flex flex-col items-center text-white rounded-full bg-blue-500 p-2">
        <i data-lucide="list-tree" class="w-6 h-6 "></i>
    </button>
    <a href="{{ route('backup') }}" class="flex flex-col items-center text-gray-500">
        <i data-lucide="database-backup" class="w-5 h-5"></i>
        <span class="text-xs mt-1 text-gray-500">Backups</span>
    </a>
</footer>