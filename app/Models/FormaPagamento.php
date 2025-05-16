<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    protected $table = 'formas_pagamentos';
    protected $fillable = ['id', 'nome', 'numero', 'titular', 'descricao'];
    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}
