<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = '';
    protected $fillable = ['id_produto', 'stock_disponivel', 'unidades_contadas', 'diferenca', 'observacao', 'data'];
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function setTable($table)
    {
        $this->table = $table;
    }
}
