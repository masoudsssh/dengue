<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateFileRequest;
use Illuminate\Http\Request;

use Auth; 

class HelperController extends Controller {

    public function uploadFile(CreateFileRequest $request)
    {   
        $user = Auth::user();

        if(session()->has('app.uploadedFile') ){
            session()->forget('app.uploadedFile');
        }
        session()->regenerate();

        session()->push('app.user', $user );
        // if ( $request::hasFile('file') ) {
            $oldName = $request->file('file')->getClientOriginalName();
            $newFileName = str_random(10).'.'.$request->file('file')->getClientOriginalExtension();
            $uploadPath = public_path().'/uploadedFiles/';
            $request->file('file')->move($uploadPath, $newFileName);
            session()->push('app.uploadedFile', array($newFileName,$oldName));
        // } else {
        //     echo 'No files';
        // }
    }

}