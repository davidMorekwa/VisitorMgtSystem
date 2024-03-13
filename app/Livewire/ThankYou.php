<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class ThankYou extends Component
{
    #[On('return-home-event')]
    public function handleReturnHomeEvent()
    {
        Log::info("Return Home Event Received");
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.thank-you')
            ->layout('components.layouts.app')
            ->with('title', "Thank You");
    }
}
