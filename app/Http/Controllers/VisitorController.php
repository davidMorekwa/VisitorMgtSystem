<?php

namespace App\Http\Controllers;

use App\Livewire\Form;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    function showRegistrationForm()
    {
        return view('visitor-reg');
    }
    function saveVisitor($visitor)
    {
        $saved_visitor = Visitor::create($visitor);
        return $saved_visitor->id;
    }
    function showThankYouPage()
    {
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
    function getVisitorVisits($id){
        $visits = Visit::where('visitor_id', '=', $id)->get();
        // dd($visits);
        return $visits;
    }

    function deleteVisitor(Request $request){
        Visitor::find($request->visitor_id)->delete();
        return redirect()->route('dashboard.visitors');
    }
}
