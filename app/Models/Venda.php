<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = '';


    protected $fillable = [
        'id',
        'tipo',
        'total',
        'data_emissao',
        'data_pagamento',
        'usuario_id',
        'caixa_id',
        'status',
        'date_on_update'
    ];

    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = true;
}
