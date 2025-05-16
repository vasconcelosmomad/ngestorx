<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class NewTicketReply extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Os dados do ticket e da mensagem.
     *
     * @var array
     */
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nova resposta no ticket #{$this->data['ticket_id']} - {$this->data['ticket_title']}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket-reply',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        
        // Adicionar anexo se existir
        if (!empty($this->data['attachment'])) {
            $attachments[] = Attachment::fromStorage("public/{$this->data['attachment']}");
        }
        
        return $attachments;
    }
}
