<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function showCreateTagPage(Request $request){
        return view('CRUD.createTag');
    }
}
