<?php

namespace App\Http\Controllers;

use App\Models\Handler;
use App\Models\Sacco;
use Illuminate\Http\Request;

class SaccoController extends Controller
{
    function get($id = 290){
        $saccos = Sacco::where('id', '=', $id)->get();
        dd($saccos);
    }
}
