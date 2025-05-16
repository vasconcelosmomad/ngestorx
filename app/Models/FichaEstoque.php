<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaEstoque extends Model
{
    // Defina a conexão de banco de dados
    protected $connection = 'empresa';

    // Defina os campos que são atribuíveis em massa
    protected $table = '';  

    // Defina as colunas que podem ser atualizadas
    protected $fillable = [
        'produto_id', 'entrada', 'venda', 'ajusteP', 'ajusteN', 'stock', 'usuario', 'data', 'observacao'
    ];
    
    // Função para definir a tabela dinamicamente
    public function setTable($table)
    {
        $this->table = $table;
    }
    // Defina se você tem timestamps ou não (se não tiver, defina como false)
    public $timestamps = true; // ou true, dependendo da tabela    
    
    
}
