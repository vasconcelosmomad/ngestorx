<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaIdpharm extends Model
{
    protected $table = '';
    
    public function setTable($table)
    {
        $this->table = $table;
    }

    protected $fillable = [
        'id',
        'nome', 
        'descricao'
    ];

    public $timestamps = false;
}
