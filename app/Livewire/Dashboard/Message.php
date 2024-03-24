<?php

namespace App\Livewire\Dashboard;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
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
        Log::info("Form submitted");
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
    }
    function handleSendEmailClick(){
        Log::info('Message: ', [$this->message_to_send]);
    }
    public function render()
    {
        return view('livewire.dashboard.message')
            ->with('visitors', $this->visitors)
            ->with('is_search', $this->is_search)
            ->layout('layouts.app');
    }
}
