<?php

namespace App\Livewire;

use App\Models\Visit;
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
        $res = Visit::join('visitors', function ($join){
            $join->on('visits.visitor_id', '=', 'visitors.id')
                ->where('visitors.ID/Passport_number', '=', $this->ID_number)
                ->orderBy('visits.time_in')
                ;
        })->first();
        // $res = DB::table('visits')
        //     ->join('visitors', 'visitors.id', '=', 'visits.visitor_id')
        //     ->where('visitors.ID/Passport_number', '=', $this->ID_number)
        //     ->orderBy('visits.time_in', 'desc')
        //     ->first();
        // dd($res);
        $timestamp = strtotime(date("F j, Y, g:i a"));
        $res->time_out = date('Y-m-d H:i:s', $timestamp);
        $res->save();
        return redirect()->route('visitor.home');
    }
    public function render()
    {
        return view('livewire.time-out')
            ->layout('components.layouts.app');
    }
}
