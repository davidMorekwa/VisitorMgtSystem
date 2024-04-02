<?php

namespace App\Livewire;

use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TimeOut extends Component
{
    #[Validate('required', message: "ID/Passport Number required")]
    #[Validate('min:8', message: "Invalid ID Number")]
    public $ID_number = "";
    public $time_out;
    public function handleFormSubmit(){
        $this->validate();
        $visitor = Visitor::where('ID/Passport_number', '=', $this->ID_number)->first();
        $visitor_id = $visitor->id;
        $visit = DB::table('visits')
            ->where('visitor_id', '=', $visitor_id)
            ->orderBy('time_in', 'desc')
            ->first();
        $timestamp = strtotime(date("F j, Y, g:i a"));
        $timestamp += 3 * 3600;
        // $visits->time_out = date('Y-m-d H:i:s', $timestamp);
        $result = DB::table('visits')
        ->where('id', '=', $visit->id) // Assuming 'id' is the primary key column of the 'visits' table
            ->update(['time_out' => date('Y-m-d H:i:s', $timestamp)]);
        if($result){
            // return $this->dispatch('time_out_recorded_event');
            return redirect()->route('visitor.home');
        }
        
    }
    public function render()
    {
        return view('livewire.time-out')
            ->layout('components.layouts.app');
    }
}
