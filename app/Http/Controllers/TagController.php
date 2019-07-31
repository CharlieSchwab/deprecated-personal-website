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

    //Need to be authenticated to use this controller
    public function __construct()
    {
        $this->middleware('auth');
    }


    //helper function to handle file upload (used in both create/update operations)
    //throws exception upwards
    public static function storeFile($uploadedImage){
        try{
            //create unique filename using current timestamp, store into imageFolder
            $imageName = $uploadedImage->getClientOriginalName();
            $storageName = explode('.', $imageName)[0] . '-' . strval(time()) . '.' . explode('.', $imageName)[1];

            $storedFileLocation = $uploadedImage->storeAs(TagController::$imageFolder, $storageName, 'public');
            return $storedFileLocation;
        }
        catch(Exception $e){
            throw $e;
        }
    }


    //Create a Tag
    public function createTag(Requests\CreateTagRequest $request){
        //return error if a tag with the given name already exists
        $duplicateTag = Tag::where('name', $request->input('name'))->first();
        if($duplicateTag != null){
            return response()->json(['success' => false, 'message' => 'A Tag with the name "' . $request->input('name') . '" already exists']);
        }
        
        //assign entity attributes
        $tag = new Tag();
        $tag->name = $request->input('name');  
        if($request->has('type')){
            $tag->type = $request->input('type');
        }

        //if checkbox is selected, request parameter will come in, if checkbox is not checked, the request element will not exist
        if($request->has('show_on_homepage')) $tag->show_on_homepage = true;
        else $tag->show_on_homepage = false;

        //handle file upload if included in request, handle exception thrown by helper method
        if($request->hasFile('icon')){
            try{
                $tag->icon_filepath = TagController::storeFile($request->file('icon'));
            }
            catch(Exception $e){
                return response()->json(['success' => false, 'message' => 'Error on uploading image']);//return error response
            }
        }    

        //save the tag in the DB, return success
        $tag->save();
        return response()->json(['success' => true, 'message' => 'The Tag "' . $tag->name . '" has been added']);
    }


    //returns all tags in the database
    public function getTags(Request $request){
        $tags = Tag::all();
        return response()->json(['success' => true, 'tags' => $tags]);
    }


    //Update tag
    public function updateTag(Requests\UpdateTagRequest $request){
        $tag = Tag::find($request->input('id'));//tag to update
        
        //if tag does not exist in DB, return error
        if(is_null($tag)) return response()->json([ 'success' => false, 'message' => 'The tag could not be found']);

        //set tag data if it is new
        if($tag->name != $request->input('name')) $tag->name = $request->input('name');
        
        if($request->has('type')){
            if($tag->type != $request->input('type')) $tag->type = $request->input('type');
        }
        else $tag->type = "";//if blank value for type, set it to blank

        //if checkbox is selected, request parameter will come in, if checkbox is not checked, the request element will not exist
        if($request->has('show_on_homepage')) $tag->show_on_homepage = true;
        else $tag->show_on_homepage = false;

        //if image file was uploaded, update the image
        if($request->hasFile('icon')){
            try{
                //if a image file already exists, delete existing file
                if($tag->icon_filepath != ""){
                    Storage::disk('public')->delete($tag->icon_filepath);
                }
                //save location of new uploaded file
                $tag->icon_filepath = TagController::storeFile($request->file('icon'));
            }
            catch(Exception $e){
                return response()->json(['success' => false, 'message' => 'There was an issue with updating the image']);
            }
        }

        //if user wants to remove the image altogether, delete image and set icon_filepath to empty string
        if($request->has('delete_existing_image')){
            if($tag->icon_filepath != null){
                Storage::disk('public')->delete($tag->icon_filepath);
                $tag->icon_filepath = "";
            }
        }

        $tag->save();
        return response()->json(['success' => true, 'message' => 'The Tag "' . $tag->name . " was just updated"]);   
    }


    // Delete Tag functionality, uses same request as update
    public function deleteTag(Requests\UpdateTagRequest $request){
        $tag = Tag::find($request->input('id'));

        if(!is_null($tag)){
            //if img file exists, delete the file as well
            if($tag->icon_filepath != ""){
                try{
                    Storage::disk('public')->delete($tag->icon_filepath);
                }
                catch(Exception $e){
                    return response()->json(['success' => false, 'message' => 'There was an issue with trying to delete the image']);
                }
            }
    
            $tag->delete();
            return response()->json(['success' => true, 'deletedID' => $tag->id, 'message' => 'The Tag "' . $tag->name . '" has been deleted']);    
        }
        else{
            return response()->json(['success' => false, 'message' => 'The Tag does not exist']);
        }
    }   
}
