<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaturaRecibo extends Model
{
    protected $table = '';

    protected $fillable = [
        'id',
        'id_venda',
        'valor_recebido',
        'desconto',
        'troco',
        'forma_pgto',
        'cliente',
        'nuit',
        'endereco',
    ];

    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
    
}
