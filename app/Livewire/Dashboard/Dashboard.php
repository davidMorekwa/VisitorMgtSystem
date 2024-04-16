<?php

namespace App\Livewire\Dashboard;

use App\Exports\VisitorByPurpose;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Dashboard extends Component
{
    public $is_purpose_clicked = false;
    public $purpose_clicked = "";
    public $visitors;
    // #[Validate('required', message: "The 'From Date' field is required")]
    public $from_date;
    // #[Validate('required', message: "The 'To Date' field is required")]
    public $to_date;
    private function getTypesOfComplaints()
    {
        $complaints = Visit::all(['purpose_of_visit']);
        return $complaints->uniqueStrict('purpose_of_visit');
    }

    public function handlePurposeClick($purpose)
    {
        Log::info("(".Auth()->user()->name.") Purpose button clicked", [$purpose]);
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

    public function handleDateFilterFormSubmit(){
        $visitors = DB::table('visits')
            ->where('purpose_of_visit', '=', $this->purpose_clicked)
            ->where('visits.time_in', '>=', $this->from_date . ' 00:00:00')
            ->where('visits.time_in', '<=', $this-> to_date . ' 00:00:00')
            ->join('visitors', 'visits.visitor_id', '=', 'visitors.id')
            ->join('saccos', 'saccos.id', '=', 'visits.sacco_id', type: 'left')
            ->orderBy('visits.time_in')
            ->select(['visitors.*', 'visits.purpose_of_visit', 'visits.person_to_see', 'saccos.sacco_name', 'visits.time_in', 'visits.time_out'])
            ->get();
        $this->visitors = $visitors;
    }

    public function handleExportClick(){
        Log::info("(" . Auth()->user()->name . ") Visitors by purpose: ". $this->purpose_clicked." exported");
        return Excel::download(new VisitorByPurpose(visitors:$this->visitors), 'visitors ' . $this->purpose_clicked . '.xlsx');
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
