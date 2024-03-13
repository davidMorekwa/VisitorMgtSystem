<?php

namespace App\Livewire;

use Livewire\Component;

class Homescreen extends Component
{
    public function render()
    {
        return view('livewire.homescreen')
            ->layout('components.layouts.app');
    }
}
