<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayrollTemplateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $path, $EmployerId, $csv_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($path, $EmployerId, $csv_name)
    {
        $this->path = $path;
        $this->EmployerId = $EmployerId;
        $this->csv_name = $csv_name;
       
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Payroll Template Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $path=$this->path;
        $EmployerId=$this->EmployerId;
        $csv_name=$this->csv_name;

        return new Content(
            markdown: 'mail.send-payroll-template',
            with: [
                'path' => $path,
                'EmployerId' => $EmployerId,
                'csv_name' => $csv_name,
            ],
        );

        return new Content(
            view: 'view.name',
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
