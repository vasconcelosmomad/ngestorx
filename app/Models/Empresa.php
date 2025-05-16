<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
        // Nome da tabela associada ao modelo (caso não siga o padrão de pluralização)
        protected $table = 'empresas';

        // Definir a conexão com o banco de dados da empresa
        protected $connection = 'central';
    
        // Campos que podem ser atribuídos em massa
        protected $fillable = ['id', 'nome', 'db_host', 'db_name', 'db_user', 'db_password', 'status'];
    
        // Caso necessário, você pode desabilitar a marcação de timestamps
        public $timestamps = false;
}
