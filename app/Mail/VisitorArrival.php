<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitorArrival extends Mailable
{
    use Queueable, SerializesModels;
    public $handler_name;
    public $purpose_of_visit;
    public $visitor_phone_number;
    public $subject;
    public $visitor_name;
    /**
     * Create a new message instance.
     */
    public function __construct($subject, $visitor_name, $handler_name, $purpose_of_visit, $visitor_phone_number)
    {
        $this->subject = $subject;
        $this->visitor_name = $visitor_name;
        $this->handler_name = $handler_name;
        $this->purpose_of_visit = $purpose_of_visit;
        $this->visitor_phone_number = $visitor_phone_number;
    }
    public function build()
    {
        return $this
            ->subject($this->subject)
            ->from("Sasra-VMS@demomailtrap.com")
            ->view('emails.visitor-arrival')
            ->with([
                'visitor_name' => $this->visitor_name,
                'handler_nname' => $this->handler_name,
                'purpose_of_visit' => $this->purpose_of_visit,
                'visitor_phone_number' => $this->visitor_phone_number
            ]);
    }
}
