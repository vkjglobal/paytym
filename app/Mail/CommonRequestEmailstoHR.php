<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommonRequestEmailstoHR extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $content;
    public $title;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$content,$subject,$title)
    {
        //
        $this->user = $user;
        $this->content = $content;
        $this->title = $title;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
       /*  return new Content(
            view: 'view.name',
        ); */

        return new Content(
            markdown: 'mail.send-request-HR',
            with: [
                'user' => $this->user,
                'content' => $this->content,
                'title' => $this->title,
                'subject' => $this->subject
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
