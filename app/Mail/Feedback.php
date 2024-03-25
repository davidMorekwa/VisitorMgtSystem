<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Feedback extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $subject;
    public $visitor_name;
    public $email_body;
    public function __construct($subject, $visitor_name, $email_body)
    {
        $this->subject = $subject;
        $this->visitor_name = $visitor_name;
        $this->email_body = $email_body;
    }

    public function build(){
        return $this
            ->subject($this->subject)
            ->from("Sasra-VMS@demomailtrap.com")
            ->view('emails.feedback')
            ->with([
                'visitor_name'=> $this->visitor_name,
                'email_body' => $this->email_body
            ]);
    }
}
