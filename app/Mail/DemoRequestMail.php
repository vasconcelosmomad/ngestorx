<?php

namespace App\Mail;

use App\Models\DemoRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demoRequest;

    public function __construct(DemoRequest $demoRequest)
    {
        $this->demoRequest = $demoRequest;
    }

    public function build()
    {
        return $this->markdown('emails.demo-request')
                    ->subject('Nova Solicitação de Demonstração - ' . $this->demoRequest->company);
    }
} 