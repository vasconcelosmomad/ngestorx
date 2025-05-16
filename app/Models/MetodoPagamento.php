<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPagamento extends Model
{
    protected $table = '';

    protected $fillable = [
        'id',
        'nome',
    ];

    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}
