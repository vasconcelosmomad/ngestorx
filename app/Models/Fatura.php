<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $table = '';

    protected $fillable = [
        'id',
        'venda_id',
        'cliente_id',
        'valor_total',
        'valor_restante',
        'data_emissao',
        'data_vencimento',
        'date_on_update',
        'status'
    ];


    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}
