<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($this->data['email'], $this->data['name'])
            ],
            subject: 'Nueva Solicitud de Cotización - VerdeAI',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.quote_request',
        );
    }

    public function attachments()
    {
        return [];
    }
}