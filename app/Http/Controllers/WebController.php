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
    private static $uploadedImages = [];
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


    public function handleImageUpload(Request $request){
        if($request->hasFile('icon')){
            $imageFolder = 'public/assets/logos';

            $uploadedImage = $request->file('icon');

            //create unique filename, store into imageFolder
            $imageName = $uploadedImage->getClientOriginalName();
            $storagePath = explode('.', $imageName)[0] . '-' . strval(time()) . explode('.', $imageName)[1];
            $uploadedImagePath = $uploadedImage->storeAs($imageFolder, $storagePath);

            $uploadedImages[] = Storage::url($uploadedImagePath);//the path stored here should be used as the icon filepath for the next tag that is uploaded
            return response()->json(['success' => 'true']);
        }
        
        return response()->json(['success' => 'false']);
    }

    public function createTag(Requests\CreateTagRequest $request){
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->type = $request->input('type');
        //TODO
        
        //$tag->save();
        
        return response()->json(['success' => $request->input('name')]);
    }
}
