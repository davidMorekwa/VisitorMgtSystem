<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VisitPurpose;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function showHomeScreen(){
        return view('welcome');
    }
    function store(Request $request){
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role_id" => $request->role_id
        ]);
        return redirect()->route('dashboard.other');
    }
    function showLogs(){
        $file = storage_path('/logs/laravel.log');
        return response()->file($file);
    }
    function addPurposeOfVisit(Request $request){
        VisitPurpose::create($request->all());
        return redirect()->route('dashboard.other');
    }
    function deletePurposeOfVisit(){
        
    }
}
