<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turnos extends Model
{
    protected $table = '';
    protected $fillable = ['turno', 'status'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function setTable($table)
    {
        $this->table = $table;
    }


}
