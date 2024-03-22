<?php

namespace App\Livewire\Dashboard;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class SelectedVisitorForm extends Component
{
    public $is_visitor_selected = false;
    public $id = "";
    public $name = "";
    public $email = "";
    public $phone_number = "";
    public $ID_Passport_number = "";
    public $selected_visitor = [
        "id" => "",
        "name" => "",
        "email" => "",
        "phone_number" => "",
        "ID/Passport_number" => ""
    ];

    #[On('selected_visitor_event')]
    function handleSelectedVisitorEvent($visitor, $is_visitor_selected){
        $this->is_visitor_selected = $is_visitor_selected;
        $this->id = $visitor["id"];
        $this->name = $visitor["name"];
        $this->email = $visitor["email"];
        $this->phone_number = $visitor["phone_number"];
        $this->ID_Passport_number = $visitor["ID/Passport_number"];
    }

    function handleSubmit(){
        Log::info("Form submitted");
        $visitor = Visitor::find($this->id);
        Log::info("Retrieved Visitor ", [$visitor]);
        $visitor->name = $this->name;
        $visitor->{'ID/Passport_number'} = $this->ID_Passport_number;
        $visitor->phone_number = $this->phone_number;
        $visitor->email = $this->email;
        $visitor->save();
        if($visitor->save()){
            $this->dispatch('visitor_info_update_success_event');
        } else {
            $this->dispatch('visitor_info_update_fail_event');
        }
        // return redirect()->route('dashboard.visitors.update');
    }
    function handleDeleteClick(){
        if(Auth::user()->role_id == 1){
            Visitor::find($this->id)->delete();
            return redirect()->route('dashboard.visitors');
        } else {
            Log::error("You do not have the permission to carry out this operation");
            $this->dispatch('visitor_info_delete_fail_event');
        }
    }
    public function render()
    {
        return view('livewire.dashboard.selected-visitor-form')
            ->with('selected_visitor', $this->selected_visitor)
            ->with('is_visitor_selected', $this->is_visitor_selected);
    }
}
