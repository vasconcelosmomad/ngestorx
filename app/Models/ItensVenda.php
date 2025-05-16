<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensVenda extends Model
{

    protected $table = '';

    protected $fillable = [
        'id',
        'produto_id',
        'compra_id',
        'iva',
        'pu',
        'quantidade',
        'total',
        'usuario_id',
        'venda_id',
        'data',
        'status'
    ];

    public function setTable($table)
    {
        $this->table = $table;
    }
    public $timestamps = false;
}
