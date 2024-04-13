<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        if (Auth::user()->role_id == 1) {
            $file = storage_path('/logs/laravel.log');
            return response()->file($file);
        } else{
            return response(status:403, content:"Unathorized Operation");
        }
        
    }
}
