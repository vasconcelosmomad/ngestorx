<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class DownloadCsv extends Controller
{
    public function downloadCsv()
    {
        $produtos = Produto::all();
        $csv = fopen('produtos.csv', 'w');
        fputcsv($csv, ['Código', 'Nome', 'Categoria', 'Estoque', 'Preço de Venda', 'IVA']);
        foreach ($produtos as $produto) {
            fputcsv($csv, [
                $produto->codigo,
                $produto->nome,
                $produto->categoria->nome,
                $produto->estoque,
                $produto->preco_venda,
                $produto->iva->nome
            ]);
        }
        fclose($csv);
        return response()->download('produtos.csv');
    }
    
    

}
