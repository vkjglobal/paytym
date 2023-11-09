<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployerPaymentDueMailToAdmins extends Mailable
{
    use Queueable, SerializesModels;
    public $employer;
    public $invoice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employer,$invoice)
    {
        //
        $this->employer = $employer;
        $this->invoice = $invoice;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Employer Payment Due',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.send-admin-employerpaymentdue',
            with: [
                'employer' => $this->employer,
                'invoice' => $this->invoice
                
            ]
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
