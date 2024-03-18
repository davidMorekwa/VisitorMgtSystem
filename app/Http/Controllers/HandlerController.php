<?php

namespace App\Http\Controllers;

use App\Models\Handler;
use Illuminate\Http\Request;

class HandlerController extends Controller
{
    function getPortfolioHandler($portfolio_id = 6)
    {
        $response = Handler::where('portfolio_id', '=', $portfolio_id)->first(['email', 'name']);
        print_r($response);
        return $response;
    }
}
