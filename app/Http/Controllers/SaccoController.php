<?php

namespace App\Http\Controllers;

use App\Models\Handler;
use App\Models\Sacco;
use Illuminate\Http\Request;

class SaccoController extends Controller
{
    function getSaccoPortfolioID($sacco_id = 1){
        return Sacco::find($sacco_id, ['portfolio_id']);
    }
}
