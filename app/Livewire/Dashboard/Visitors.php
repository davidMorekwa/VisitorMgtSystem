<?php

namespace App\Livewire\Dashboard;

use App\Http\Controllers\VisitorController;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Visitors extends Component
{
    public $is_visitor_selected = false;
    public $visits = [];
    public $isEdit = false;
    private $visitors = [];

    public function handleVisitorClick($id){
        $visitor = Visitor::find($id);
        Log::info("SELECTED VISITOR: ",[$visitor]);
        // $visits = Visit::where('visitor_id', '=', $id)->get();
        $visits = DB::table('visits')
            ->where('visits.visitor_id', '=', $id)
            ->join('saccos', 'visits.sacco_id', '=', 'saccos.id', type:'left')
            ->orderBy('visits.time_in', 'desc')
            ->get();
        $this->is_visitor_selected = true;
        $this->dispatch('selected_visitor_event', $visitor, $this->is_visitor_selected);
        $this->visits = $visits;
    }
    function handleEditClick($id){
        Log::info($id);
        $this->isEdit = true;
    }

    function getVisitorByPurpose($purpose){
        $visitors = DB::table('visits')
            ->where('purpose_of_visit', '=', $purpose)
            ->join('visitors', 'visits.visitor_id', '=', 'visitors.id')
            ->paginate(20);
        $this->visitors = $visitors;
        return view('livewire.dashboard.visitors')
        ->with('visitors', $visitors)
            ->with('selected_visitor', $this->selected_visitor)
            ->with('visits', $this->visits)
            ->with('isEdit', $this->isEdit)
            ->layout('layouts.app');
    }


    public function render()
    {
        $visitors = DB::table('visits')
            ->join('visitors', 'visits.visitor_id', '=', 'visitors.id')
            ->orderBy('visits.time_in')
            ->paginate(20);
        $this->visitors = $visitors;
        return view('livewire.dashboard.visitors')
            ->with('visitors', $this->visitors)
            ->with('is_visitor_selected', $this->is_visitor_selected)
            ->with('visits', $this->visits)
            ->with('isEdit', $this->isEdit)
            ->layout('layouts.app');
    }
}
