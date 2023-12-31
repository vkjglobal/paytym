<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $employer;
    public $invoice;
    public $plan;
    public $total_employee_rate;
    public $invoiceNumber;
    public $pdfInvoice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employer,$invoice,$plan,$total_employee_rate,$invoiceNumber,$pdfInvoice)
    {
        $this->employer = $employer;
        $this->invoice = $invoice;
        $this->plan = $plan;
        $this->total_employee_rate = $total_employee_rate;
        $this->invoiceNumber = $invoiceNumber;
        $this->pdfInvoice = $pdfInvoice;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Invoice Due Now',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
      //$pdfInvoice = generatePdfInvoice($employer, $invoice, $plan, $total_employee_rate, $invoiceNumber);


    $this->attachData($this->pdfInvoice, 'invoice.pdf', [
        'mime' => 'application/pdf',
    ]);
        return new Content(
            markdown: 'mail.send-employer-invoice',
            with: [
                'employer' => $this->employer,
                'invoice' => $this->invoice,
                'plan' => $this->plan,
                'total_employee_rate' => $this->total_employee_rate,
                'invoiceNumber' => $this->invoiceNumber
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
