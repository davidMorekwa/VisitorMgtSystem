<?php

namespace App\Livewire\Dashboard;

use App\Http\Controllers\VisitorController;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Visitors extends Component
{
    public $is_visitor_selected = false;
    public $visits = [];
    public $isEdit = false;
    private $visitors = [];
    public $search_value;
    private $is_search = false;
    // #[Validate('required', message: "The 'From Date' field is required")]
    public $from_date;
    // #[Validate('required', message: "The 'To Date' field is required")]
    public $to_date;
    public $is_filter = false;

    public function getVisitors(){
        $visitors = DB::table('visitors')
            ->paginate(20);
        $visitors;
        return $visitors;
        // dd($visitors);
        // $this->render();
    }

    public function handleVisitorClick($id)
    {
        $visitor = Visitor::find($id);
        Log::info("SELECTED VISITOR: ", [$visitor]);
        // $visits = Visit::where('visitor_id', '=', $id)->get();
        $visits = DB::table('visits')
            ->where('visits.visitor_id', '=', $id)
            ->join('saccos', 'visits.sacco_id', '=', 'saccos.id', type: 'left')
            ->orderBy('visits.time_in', 'desc')
            ->get();
        $this->is_visitor_selected = true;
        $this->dispatch('selected_visitor_event', $visitor, $this->is_visitor_selected);
        $this->visits = $visits;
        // dd($visits);
    }
    function handleEditClick($id)
    {
        Log::info($id);
        $this->isEdit = true;
    }

    function handleSearch(){
        $this->is_search = true;
        Log::info("Search Term: ".$this->search_value);
        $visitors = DB::table('visitors')
            ->where('name', 'like', '%'.$this->search_value.'%')
            ->paginate();
        // dd($visitors);
        return $visitors;
        // $this->visitors = $visitors;
    }

    function handleTimeRangeFormSubmit(){
        // $this->validate();
        $this->is_filter = true;
        $visitors = DB::table('visits')
            ->where('time_in', '>=', $this->from_date)
            ->where('time_in', '<=', $this->to_date)
            ->join('visitors', 'visitors.id', '=', 'visits.visitor_id')
            ->paginate();
        return $visitors;
        // dd($visitors);
    }


    public function render()
    {
        if ($this->is_search) {
            $visitors = $this->handleSearch();
        } else if($this->is_filter){
            $visitors = $this->handleTimeRangeFormSubmit();
        } else {
            $visitors = $this->getVisitors();
        }
        $this->visitors = $visitors;
        Log::info("Visitors Gotten: ", [$this->visitors]);
        return view('livewire.dashboard.visitors')
            ->with('visitors', $this->visitors)
            ->with('is_visitor_selected', $this->is_visitor_selected)
            ->with('visits', $this->visits)
            ->with('isEdit', $this->isEdit)
            ->layout('layouts.app');
    }
}
