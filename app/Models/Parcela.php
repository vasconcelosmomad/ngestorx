<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    protected $table = '';

    protected $fillable = ['id', 'fatura_id', 'numero', 'valor', 'data_vencimento', 'status'];


    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}
