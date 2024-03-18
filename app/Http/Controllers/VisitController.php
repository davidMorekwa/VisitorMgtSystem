<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VisitController extends Controller
{
    function getVisits(){
        $visits = DB::table('visits')
            ->join('visitors', 'visits.visitor_id' , '=', 'visitors.id')
            ->get();
        return $visits->groupBy('purpose_of_visit');
    }
    
}
