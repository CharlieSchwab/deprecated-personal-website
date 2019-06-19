<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function showHomePage(Request $request){
        return view('home');
    }

    public function showAllProjects(Request $request){
        return view('allProjects');
    }


    //this function will only be called from a protected route
    public function showAdminDashboard(Request $request){
        return view('dashboard');
    }

}
