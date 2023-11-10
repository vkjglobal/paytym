<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployerSupportTicketMailToAdmins extends Mailable
{
    use Queueable, SerializesModels;
    public $employer;
    public $supportTicket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employer,$supportTicket)
    {
        //
        $this->employer = $employer;
        $this->supportTicket = $supportTicket;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Support Ticket from Employer',
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
            markdown: 'mail.send-admin-employersupportticket',
            with: [
                'employer' => $this->employer,
                'supportTicket' => $this->supportTicket
                
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
