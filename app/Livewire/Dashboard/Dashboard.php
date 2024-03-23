<?php

namespace App\Livewire\Dashboard;

use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Dashboard extends Component
{
    public $is_purpose_clicked = false;
    public $purpose_clicked = "";
    public $visitors = [];
    private function getTypesOfComplaints()
    {
        $complaints = Visit::all(['purpose_of_visit']);
        return $complaints->uniqueStrict('purpose_of_visit');
    }

    public function handlePurposeClick($purpose)
    {
        Log::info("Purpose button clicked", [$purpose]);
        $this->purpose_clicked = $purpose;
        $this->is_purpose_clicked = true;
        $visitors = DB::table('visits')
            ->where('purpose_of_visit', '=', $purpose)
            ->join('visitors', 'visits.visitor_id', '=', 'visitors.id')
            ->join('saccos', 'saccos.id', '=', 'visits.sacco_id', type:'left')
            ->orderBy('visits.time_in')
            ->get();
            // ->paginate(15);
        // dd($visitors);
        $this->visitors = $visitors;
    }

    public function render()
    {
        $complaints = $this->getTypesOfComplaints();
        return view('livewire.dashboard.dashboard')
            ->with('complaints', $complaints)
            ->with('is_purpose_clicked', $this->is_purpose_clicked)
            ->with('purpose_clicked', $this->purpose_clicked)
            ->with('visitors', $this->visitors)
            ->layout('layouts.app');
    }
}
