<?php

namespace App\Http\Controllers;

use App\Exports\VisitorByPurpose;
use App\Exports\VisitorExport;
use App\Http\Requests\VisitorsRequest;
use App\Livewire\Form;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class VisitorController extends Controller
{
    function showRegistrationForm()
    {
        return view('visitor-reg');
    }
    function showTimeOutView(){
        return view('time-out');
    }
    function saveVisitor($visitor)
    {
        $saved_visitor = Visitor::create($visitor);
        return $saved_visitor->id;
    }
    function showThankYouPage()
    {
        Log::info("Showing the Thank you page");
        return view('thank-you');
    }
    function getVisitors()
    {
        $visits = DB::table('visits')
            ->join('visitors', 'visits.visitor_id', '=', 'visitors.id')
            ->orderBy('visits.time_in')
            ->paginate(30);
        // dd($visits);
        return view('dashboard.visitors')->with('visitors', $visits);
    }
    function getVisitorVisits($id)
    {
        $visits = Visit::where('visitor_id', '=', $id)->get();
        // dd($visits);
        return $visits;
    }
    function getPeakHours()
    {
        $visits = Visit::select('time_in')
            ->whereNotNull('time_in')
            ->get();
        $visitorCount = [];

        foreach ($visits as $visit) {
            $hour = date('H', strtotime($visit->time_in));
            if ($hour >= "08" && $hour <= "17") {
                if (!isset($visitorCount[$hour . "00hrs"])) {
                    $visitorCount[$hour . "00hrs"] = 1;
                } else {
                    $visitorCount[$hour . "00hrs"]++;
                }
            }
        }
        ksort($visitorCount);
        $hours = array_keys($visitorCount);
        $counts = array_values($visitorCount);
        $data = array(
            "hours" => $hours,
            "values" => $counts
        );
        return $data;
    }

    function getVisitorByPurpose()
    {
        $visits = Visit::all()->groupBy('purpose_of_visit');
        $data = [];
        foreach ($visits as $key => $value) {
            $data[$key] = count($visits[$key]);
        }
        return $data;
    }
    function get_visitor_data(){
        return Excel::download(new VisitorExport(), 'visitors.xlsx');
    }
    function export_visitors_by_purpose($purpose){
        Log::info("EXPORT PURPOSE: ".$purpose);
        return Excel::download(new VisitorByPurpose(), 'visitors '.$purpose.'.xlsx');
    }
}
