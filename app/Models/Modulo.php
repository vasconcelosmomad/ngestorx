<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'data_lancamento',
        'status'
    ];

    public function getModulos()
    {
        return Modulo::all();
    }

    public function timestamps()
    {
        return false;
    }   
}
