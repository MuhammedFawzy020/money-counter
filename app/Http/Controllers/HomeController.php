<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imports;
use App\Models\exports;

class HomeController extends Controller
{
    public function home(){
        $imports = imports::latest()->take(5)->get();
        $exports = exports::latest()->take(5)->get();
        
        return view('welcome')->with([
            'imports' => $imports ,
            'exports' => $exports,
        ]);
    }
}
