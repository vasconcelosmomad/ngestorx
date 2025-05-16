<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'pagamentos';
    protected $fillable = [
        'id',
        'empresa_id',
        'metodo_pagamento',
        'comprovativo',
        'plano_id',
        'data',
        'status',
    ];

    public function getPagamentos()
    {
        return $this->all();
    }
    
    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}

