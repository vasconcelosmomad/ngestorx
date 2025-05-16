<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $table = 'planos';
    protected $connection = 'central';
    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'descricao_completa',
        'valor',
        'desconto',
        'base_anual',
        'duracao_meses',
        'tipo_plano',
        'status',
    ];

    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}
