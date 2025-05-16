<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // Defina a conexão de banco de dados
    protected $connection = ' ';

    // Defina os campos que são atribuíveis em massa
    protected $table = '';

    // Defina as colunas que podem ser atualizadas
    protected $fillable = [
        'id', 'codigo', 'nome', 'venda', 'iva_id', 'estoque', 'estoque_mini', 'estoque_maxi', 'categoria_id', 'descricao', 'imagem'
    ];

    // Função para definir a tabela dinamicamente
    public function setTable($table)
    {
        $this->table = $table;
    }
    // Defina se você tem timestamps ou não (se não tiver, defina como false)
    public $timestamps = false; // ou true, dependendo da tabela
}
