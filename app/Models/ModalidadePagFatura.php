<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadePagFatura extends Model
{
    protected $table = '';
    protected $fillable = ['id', 'nome_conta', 'numero_conta', 'titular_conta', 'descricao'];

    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;

}
