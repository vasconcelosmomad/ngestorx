<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = '';
    
    protected $fillable = ['id', 'nome', 'endereco', 'email', 'telefone', 'data_cadastro', 'data_vinculo', 'status'];
    

    public function setTable($table)
    {
        $this->table = $table;
    }

    public $timestamps = false;
}
