<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;
      // Nome da tabela associada ao modelo (caso não siga o padrão de pluralização)
      protected $table = 'usuarios'; // Definição padrão

    public function setDynamicTable($tableName)
    {
        $this->setTable($tableName);
    }
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'created_at',
        'update_at',
        'status'
    ];

    public function setDynamicConnection($connection)
    {
        $this->setConnection($connection);
    }
      // Caso necessário, você pode desabilitar a marcação de timestamps
      public $timestamps = false;
}
