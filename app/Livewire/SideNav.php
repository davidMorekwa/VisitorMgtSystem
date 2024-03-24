<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SideNav extends Component
{
    public $selected_menu_option = "";

    public function handleMenuOptionClick($option){
        $this->selected_menu_option = $option;
        Log::info("Menu selected ".$this->selected_menu_option);
    }
    public function render()
    {
        return view('livewire.side-nav');
    }
}
