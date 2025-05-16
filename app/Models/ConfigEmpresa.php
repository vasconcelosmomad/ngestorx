<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigEmpresa extends Model
{
    protected $table = '';
    protected $primaryKey = 'id';
    public function setTable($table)
    {
        $this->table = $table;
    }

    protected $fillable = [
        'nome_empresa',
        'regime_tributacao_id',
        'm_pesa',
        'e_mola',
        'conta_banco',
        'endereco',
        'provincia',
        'cidade',
        'email',
        'telefone_fixo',
        'telefone_movel',
        'nuit',
        'website_url',
    ];


    public $timestamps = false;
}
