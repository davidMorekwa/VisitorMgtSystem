<?php

namespace App\Livewire\Dashboard;

use App\Mail\Feedback;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Illuminate\Notifications\Facades\Vonage;
use Illuminate\Support\Facades\Mail;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;
use Livewire\Component;

class Message extends Component
{
    #[Validate('required', message: "The 'From Date' field is required")]
    public $from_date;
    #[Validate('required', message: "The 'To Date' field is required")]
    public $to_date;
    public $is_search = false;
    public $visitors = [];
    public $message_to_send;

    function handleFormSubmit()
    {
        $this->validate();
        $this->is_search = true;
        Log::info("Values: ", [$this->from_date, $this->to_date]);
        $visitors = DB::table('visits')
            ->where('time_in', '>=', $this->from_date . ' 00:00:00')
            ->join('visitors', 'visitors.id', '=', 'visits.visitor_id')
            ->get();
        $this->visitors = $visitors;
    }
    function handleSendSMSClick(){
        Log::info('Message: ', [$this->message_to_send]);
        $basic  = new Basic("cd0f93ab", "32KnoDtZijH2SwwM");
        $client = new Client($basic);
        Log::info("(" . Auth()->user()->name . ") Sending SMS");
        foreach ($this->visitors as $visitor) {
             Log::info("Phone Number: ".$visitor->phone_number);
            $response = $client->sms()->send(
                new SMS(to: $visitor->phone_number, from: "SASRA", message: $this->message_to_send)
            );
            $message = $response->current();
            if ($message->getStatus() == 0) {
                echo "The message was sent successfully\n";
            } else {
                echo "The message failed with status: " . $message->getStatus() . "\n";
            }
        }
        
    }
    function handleSendEmailClick(){
        Log::info('Message: ', [$this->message_to_send]);
        Log::info("(" . Auth()->user()->name . ") Sending Email");
        foreach ($this->visitors as $visitor) {
            $email = $this->sendEmail(to: $visitor->email, subject:"SASRA CUSTOMER FEEDBACK", visitor_name:$visitor->name, email_body:$this->message_to_send);
        }
    }
    function sendEmail($to, $subject, $visitor_name, $email_body){
        $email = new Feedback(subject:$subject, visitor_name:$visitor_name, email_body:$email_body);
        return Mail::to($to)->send($email);
    }
    public function render()
    {
        return view('livewire.dashboard.message')
            ->with('visitors', $this->visitors)
            ->with('is_search', $this->is_search)
            ->layout('layouts.app');
    }
}
