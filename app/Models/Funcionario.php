<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = '';
    
    protected $fillable = [
        'id',
        'nome',
        'email',
        'documento',
        'doc_num',
        'telefone_celular',
        'telefone_fixo',
        'funcao',
        'data_contrato',
        'status'
    ];
    public function setTable($table)
    {
        $this->table = $table;
    }
   
    public $timestamps = false;


}

