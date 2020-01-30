<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function storePhoto(Request $request)
    {
        /*
        Validator::make($request->all(), [
            'file' => 'required|image',
        ])->validate();
        */

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            if($request->hasFile('file')){
                $image = $request->file('file');
                $file_path = $image->store('public/'.$user_id.'jpg');
            }
        }
        return response()->json(Storage::url($file_path));
    }
    
}
