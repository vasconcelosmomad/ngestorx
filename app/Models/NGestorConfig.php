<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NGestorConfig extends Model
{
    protected $table = 'config_ngestor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nome_empresa',
        'regime_tributacao_id',
        'e_mola',
        'm_pesa',
        'conta_banco',
        'endereco',
        'provincia',
        'cidade',
        'email',
        'telefone_fixo',
        'telefone_movel',
        'nuit',
        'website_url'
    ];
    public $timestamps = false;
}
