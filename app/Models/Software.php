<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'softwares';
    protected $fillable = ['id', 'nome', 'descricao', 'valor', 'status'];

    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}
