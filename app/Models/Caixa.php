<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    protected $table = '';
    protected $fillable = [
        'id',
        'caixa_id',
        'data',
        'turno',
        'valor_abertura',
        'total_venda',
        'tota_venda_FT',
        'valor_fechamento',
        'valor_quebra',
        'status',
        'usuario_abertura',
        'usuario_fechamento',
        'observacoes'
    ];

    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}
