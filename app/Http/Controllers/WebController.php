<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
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
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->type = $request->input('type');
        
        if($request->hasFile('icon')){
            $imageFolder = 'public/assets/logos';

            $uploadedImage = $request->file('icon');

            //create unique filename using current timestamp, store into imageFolder
            $imageName = $uploadedImage->getClientOriginalName();
            $storagePath = explode('.', $imageName)[0] . '-' . strval(time()) . explode('.', $imageName)[1];
            $uploadedImagePath = $uploadedImage->storeAs($imageFolder, $storagePath);

            $tag->icon_filepath = $uploadedImagePath;
        }
        
        
        //$tag->save();
        
        return response()->json(['success' => $request->input('name')]);
    }
}
