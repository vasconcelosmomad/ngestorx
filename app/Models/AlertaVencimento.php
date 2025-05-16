<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class AlertaVencimento extends Model
{
    protected $table = '';


    protected $fillable = [
        'produto_id',
        'quantidade',
        'lote',
        'num_guia',
        'data_entrada',
        'data_vencimento',
        'data_alerta',
        'obs',
        'status',
    ];
    protected $connection = 'empresa';

    public function setTable($table){
        $this->table = $table;
    }

    public function getAlertaVencimento($dataVencimento, $diasAntes = 90){
        $dataAlertaObj = new DateTime($dataVencimento);
        $dataAlertaObj->modify('-' . $diasAntes . ' days');
        return $dataAlertaObj->format('Y-m-d');
    }

    //
    public $timestamps = false;

    
}
