<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailreset extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    protected $email;
    protected $path;

    /**
     * Create a new message instance.
     */
    public function __construct($token, $email, $path)
    {
        $this->token = $token;
        $this->email = $email;
        $this->path = $path;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Mailreset',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'reset-password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->view('reset-password')
            ->with([
                'token' => $this->token,
                'email' => $this->email,
                'path' => $this->path,
            ])
            ->subject('Réinitialisation de mot de passe');
    }
}
