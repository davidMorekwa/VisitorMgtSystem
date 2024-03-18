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
    public $selected_visitor = "";
    public $visits = [];
    public $isEdit = false;

    public function handleVisitorClick($id){
        $visitor = Visitor::find($id);
        Log::info("SELECTED VISITOR: ",[$visitor]);
        $this->selected_visitor = $visitor;
        // $visits = Visit::where('visitor_id', '=', $id)->get();
        $visits = DB::table('visits')
            ->where('visits.visitor_id', '=', $id)
            ->join('saccos', 'visits.sacco_id', '=', 'saccos.id', type:'left')
            ->orderBy('visits.time_in', 'desc')
            ->get();
        // dd($visits);

        $this->visits = $visits;
    }

    public function render()
    {
        $visitors = DB::table('visits')
            ->join('visitors', 'visits.visitor_id', '=', 'visitors.id')
            ->orderBy('visits.time_in')
            ->paginate(20);
        return view('livewire.dashboard.visitors')
            ->with('visitors', $visitors)
            ->with('selected_visitor', $this->selected_visitor)
            ->with('visits', $this->visits)
            ->with('isEdit', $this->isEdit)
            ->layout('layouts.app');
    }
}
