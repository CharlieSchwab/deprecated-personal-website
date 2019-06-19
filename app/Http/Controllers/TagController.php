<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Tag;
use Exception;

class TagController extends Controller
{
    private static $imageFolder = 'assets/logos';//folder in which images should be stored to

    //needs to be authenticated to use this controller
    public function __construct()
    {
        $this->middleware('auth');
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
        if(!is_null($request->input('type'))){
            $tag->type = $request->input('type');
        }
        $tag->show_on_homepage = ($request->input('show_on_homepage') == 'true');

        //handle file upload if included in request, surround with try/catch in case upload fails
        if($request->hasFile('icon')){
            try{
                $uploadedImage = $request->file('icon');
                //create unique filename using current timestamp, store into imageFolder
                $imageName = $uploadedImage->getClientOriginalName();
                $storageName = explode('.', $imageName)[0] . '-' . strval(time()) . '.' . explode('.', $imageName)[1];

                $storedFile = $uploadedImage->storeAs(TagController::$imageFolder, $storageName, 'public');
                $tag->icon_filepath = $storedFile;
            }
            catch(Exception $e){
                return response()->json(['success' => false, 'message' => 'Error on uploading image']);//return error response
            }
        }    

        $tag->save();//save the tag

        //return success response
        return response()->json(['success' => true, 'message' => 'The Tag "' . $tag->name . '" has been added']);
    }


    
    //returns all tags in the database
    public function getTags(Request $request){
        $tags = Tag::all();
        return response()->json(['success' => true, 'tags' => $tags]);
    }


    //TOOD...
    public function updateTag(Request $request){

    }

    public function deleteTag(Request $request){

    }   
}
