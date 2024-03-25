<?php

namespace App\Livewire;

use App\Models\Sacco;
use App\Models\Saccos;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OfficialInformation extends Component
{
    #[Validate('required', message: "Purpose of visit required")]
    public $selected_purpose = "";

    // #[Validate('required', message: "Name required")]
    // #[Validate('regex:/^[a-zA-Z\-\'\s]+$/', message: "Invalid character in name")]
    public $person_to_visit = "";
    public $options = [
        'Make a complaint',
        'Official visit',
        'Accounts',
        'Delivery'
    ];
    public $isLoading = false;
    // #[Validate('required', message:"Required")]
    public $sacco_type = "";

    // #[Validate('required', message:"Required")]
    public $sacco_name = "";

    public $saccos = [];


    

    public function handleSaccoTypeChange()
    {
        Log::info("Sacco type " . $this->sacco_type);
        $saccos = Sacco::where('sacco_type', '=', $this->sacco_type)->orderBy('sacco_name')->get();
        $this->saccos = $saccos;
    }

    public function handleOptionChange()
    {
        Log::info("Option: " . $this->selected_purpose);
    }

    public function handleNameInputChange()
    {
        Log::info("Name " . $this->person_to_visit);
    }
    public function handleBackClick()
    {
        $this->dispatch('back-click-event');
    }

    public function handleFinishClick()
    {
        $this->validate();
        $official_information =
            $this->selected_purpose == "Accounts" || $this->selected_purpose == "Make a complaint"
            ?
            [
                "Selected Purpose" => $this->selected_purpose,
                "SACCO_Name" => $this->sacco_name
            ]
            :
            [
                "Selected Purpose" => $this->selected_purpose,
                "Person to Visit" => $this->person_to_visit
            ];
        Log::info("Official Information ", [$official_information]);
        $this->dispatch('finish-click-event', $official_information);
        $this->isLoading = true;
    }
    #[On('visitor-saved-event')]
    function handleVisitorSavedEvent(){
        Log::info("VISITOR SAVED EVENT HANDLED");
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.official-information')
            ->with("options", $this->options)
            ->with("selected", $this->selected_purpose)
            ->with("saccos", $this->saccos)
            ->with("selected_sacco", $this->sacco_name)
            ->with("sacco_type", $this->sacco_type)
            ->with("isLoading", $this->isLoading);
    }
}
