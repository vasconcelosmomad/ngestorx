<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    // Defina a conexão de banco de dados
    protected $connection = 'empresa';

    // Defina os campos que são atribuíveis em massa
    protected $table = '';

    // Defina as colunas que podem ser     atualizadas

    protected $fillable = [
        'id',
        'codigo_compra',
        'produto_id',
        'fornecedor',
        'lote',
        'preco_compra',
        'preco_venda',
        'quantidade',
        'estoque_disponivel',
        'data_compra',
        'data_validade'
    ];

    // Função para definir a tabela dinamicamente
    public function setTable($table)
    {
        $this->table = $table;
    }
    // Defina se você tem timestamps ou não (se não tiver, defina como false)
    public $timestamps = false; // ou true, dependendo da tabela
}
