<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = 'support_tickets';
    
    protected $fillable = [
        'uid_empresa',
        'usuario_id',
        'title',
        'status',
        'priority',
        'last_reply_at',
        'closed_at'
    ];
  
    
    
    protected $casts = [
        'last_reply_at' => 'datetime',
        'closed_at' => 'datetime',
    ];
    
    public function setDynamicConnection($connection)
    {
        $this->setConnection($connection);
    }
    
    
    
    // Status do ticket: 'open', 'in_progress', 'closed'
    public function isOpen()
    {
        return $this->status === 'open';
    }
    
    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }
    
    public function isClosed()
    {
        return $this->status === 'closed';
    }
}
