<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model

{
    protected $table = 'chat_messages';
    protected $fillable = [
        'id',
        'usuario_id',
        'support_ticket_id',
        'menssagem',
        'attachment',
        'is_read',
        'is_support',
        'created_at',
        'updated_at'
    ];

    public function setDynamicConnection($connection)
    {
        $this->setConnection($connection);
    }
      
    public $timestamps = true;
    
   
}
