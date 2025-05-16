<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PainelController extends Controller
{
    public function __invoke()
    {
        return view('login');
    }



    public function painel(Request $request)
    {
        $page = $request->page;
     
        // Obtém o ID do software
        $idSoftware = session('software_id');
        
        // Define o caminho da visualização com base no dispositivo e no software
        $deviceType = isMobile() ? 'modulos' : 'modulos';
        
        // Define o dis retório do software com base no ID
        $modulePath = $this->getSoftwarePath($idSoftware);
        
        // Se o software não for reconhecido, redireciona para index
        if (!$modulePath) {
            return view('login');
        }

        // Caminho completo para a visualização
        $viewPath = "{$deviceType}.{$modulePath}.templates.{$page}";

        // Verifica se a visualização existe
        if (view()->exists($viewPath)) {
            return view("{$deviceType}.{$modulePath}.index", ['page' => $page]);
        }

        // Caso a visualização não exista, retorna página offline
        return view('login');
    }

    /**
     * Define o caminho do software com base no ID
     */
    private function getSoftwarePath($idSoftware)
    {
        switch ($idSoftware) {
            case 888:
                return 'restgo'; // Pasta para o software de restaurante
            case 890:
                return 'idpharm'; // Pasta para o software de farmácia
            case 889:
                return 'xread'; // Pasta para o software de bottle store
            default:
                return null; // Software não reconhecido
        }
    }

    public function painelEmpresa(Request $request)
    {
        $page = $request->page;
     
        // Obtém o   ID do software
        $id_usuario = session('id_usuario');
 
        if(!isset($id_usuario)){
                $viewPath = "servicos.index";

        // Verifica se a visualização existe
        if (view()->exists($viewPath)) {
            return view("{$viewPath}", ['page' => $page]);
        }
            return view('servicos.index');
        }else{
            return view('ngestorx');
        }

      
    }

    public function ngestorx(){
        return view('ngestorx');
    }
}