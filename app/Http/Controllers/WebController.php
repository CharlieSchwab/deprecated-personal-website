<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use App\Tag;
use App\ProjectTag;

class WebController extends Controller
{
    /**
     * Create a new controller instance, NEED to be authorized to use this controller's functions
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function showAdminDashboard(Request $request){
        return view('dashboard');
    }



    public function createTag(Requests\CreateTagRequest $request){
        /*
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->icon_filepath = $request->input('icon_filepath');
        $tag->save();
        */
        return response()->json(['success' => $request->input('name')]);
    }
}
