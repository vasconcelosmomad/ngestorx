<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\APIRequestService;
use Illuminate\Contracts\Http\Kernel;
use App\Http\Middleware\DetectDevice;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Kernel $kernel): void
    {
        // Configuração do timezone do PHP
        date_default_timezone_set('Africa/Maputo');
        
        // Configuração do locale para formatação de datas
        setlocale(LC_TIME, 'pt_PT.utf8', 'pt_PT', 'Portuguese_Portugal');
        
        // Configuração do locale do Carbon e timezone
        \Carbon\Carbon::setLocale('pt_PT');
        config(['app.timezone' => 'Africa/Maputo']);
        
        // Configurar o formato de data padrão para o banco de dados
        DB::statement("SET time_zone='+02:00'");
        
        View::share('admin',1);
        View::share('rh',2);
        View::share('dt_tf',3);
        View::share('finance',4);
        View::share('developer',5);
        View::share('operator',6);
        View::share('taxa',300);
        View::share('plano',1500);
    }
}
