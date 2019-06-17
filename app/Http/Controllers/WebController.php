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

    
    //create a Tag
    public function createTag(Requests\CreateTagRequest $request){
        //return error if a tag with the given name already exists
        $duplicateTag = Tag::where('name', $request->input('name'))->first();
        if($duplicateTag != null){
            return response()->json(['success' => false, 'message' => 'A Tag with the name "' . $request->input('name') . '" already exists']);
        }
        
        //assign entity attributes
        $tag = new Tag();
        $tag->name = $request->input('name');        
        if(!is_null($tag->type)){
            $tag->type = $request->input('type');
        }
        $tag->show_on_homepage = ($request->input('show_on_homepage') == 'true');

        //handle file upload if included in request
        if($request->hasFile('icon')){
            $imageFolder = 'assets/logos/';

            $uploadedImage = $request->file('icon');

            //create unique filename using current timestamp, store into imageFolder
            $imageName = $uploadedImage->getClientOriginalName();
            $storageName = explode('.', $imageName)[0] . '-' . strval(time()) . '.' . explode('.', $imageName)[1];
            
            $uploadedImage->storeAs($imageFolder, $storageName, 'public');

            $tag->icon_filepath = $imageFolder . $storageName;
        }

        $tag->save();

        return response()->json(['success' => true, 'message' => 'The Tag "' . $tag->name . '" has been added']);
    }
}
