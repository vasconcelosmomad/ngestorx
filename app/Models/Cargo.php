<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    
    public function setTable($table)
    {
        $this->table = $table;
    }

    protected $fillable = [
        'nome',
        'faixa_salarial_min',
        'faixa_salarial_max',
        'descricao',
        'status'
    ];
    protected $primaryKey = 'id';

    public $timestamps = false;
}
