<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProcessPayrollReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $employer;
    public $user;
    public $payperiod;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employer,$user,$payperiod)
    {
        //
        $this->employer = $employer;
        $this->user = $user;
        $this->payperiod = $payperiod;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Process Payroll Reminder Mail',
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
            markdown: 'mail.send-payrollprocess-reminder',
            with: [
                'employer' => $this->employer,
                'user' => $this->user,
                'payperiod' => $this->payperiod
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
