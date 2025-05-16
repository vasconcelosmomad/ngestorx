<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class Usuario extends Model implements Authenticatable
{
    use AuthenticatableTrait;
      // Nome da tabela associada ao modelo (caso não siga o padrão de pluralização)
      protected $table = 'empresas'; // Definição padrão

    public function setDynamicTable($tableName)
    {
        $this->setTable($tableName);
    }
    protected $fillable = [
        'id_funcionario',
        'usuario',
        'password',
        'nivel',
        'status'
    ];

    public function setDynamicConnection($connection)
    {
        $this->setConnection($connection);
    }
      
      public $timestamps = false;
}
