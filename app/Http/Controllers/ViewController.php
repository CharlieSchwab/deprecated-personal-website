<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function showHomePage(Request $request){
        return view('home');
    }

}
