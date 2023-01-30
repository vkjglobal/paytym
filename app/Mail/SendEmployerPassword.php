<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmployerPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $rand_pass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rand_pass)
    {
        $this->rand_pass = $rand_pass;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Send Employer Password',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $rand_pass = $this->rand_pass;
        return new Content(
            markdown: 'mail.send-employer-password',
            with: [
                'rand_pass' => $rand_pass
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
