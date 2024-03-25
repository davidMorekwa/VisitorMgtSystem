<?php

namespace App\Livewire;

use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PersonalInformation extends Component
{
    public $record_exists = true;

    #[Validate('required', message: "Name required")]
    #[Validate('regex:/^[a-zA-Z]/', message: "Ivalid character in name")]
    public $name = "";

    #[Validate('required', message: "Phone Number Required")]
    #[Validate('min:10', message: "Invalid phone number")]
    public $phone_number = "";

    #[Validate('required', message: "ID/Passport Number required")]
    #[Validate('min:8', message: "Invalid ID Number")]
    public $ID_number = "";

    #[Validate('required', message: "Email Address Required")]
    #[Validate('regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', "Invalid email address")]
    public $email = "";

    public function updated($propertyName)
    {
        if ($propertyName == "name") {
            Log::info("Name: " . $this->name);
        }
    }
    public function handleClick()
    {
        if($this->record_exists){
            $visitor = Visitor::where('ID/Passport_number', '=', $this->ID_number)->first();
            Log::info("",[$visitor]);
            if ($visitor === null) {
                Log::info("STATUS: false");
                $this->record_exists = false;
            } else {
                Log::info("STATUS true");
                $this->dispatch('visitor-exists-event', $visitor);
                Log::info("EVENT DISPATCHED");

            }
        } else {
            $validated = $this->validate();
            Log::info("Validation status: ", [$validated]);
            $personal_information = [
                "Name" => $this->name,
                "ID Number" => $this->ID_number,
                "Phone Number" => $this->phone_number,
                "Email Address" => $this->email
            ];
            $this->dispatch('click-next-event', $personal_information);
        }
    }
    
    public function handleIDNumberChange(){
        Log::info("ID NUmber ".$this->ID_number);
    }
    public function handleNameInputChange()
    {
        Log::info("Name: " . $this->name);
    }
    public function render()
    {
        return view('livewire.personal-information')
            ->with('record_exists', $this->record_exists);
    }
}

