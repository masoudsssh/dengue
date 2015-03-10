<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateFileRequest;
use Illuminate\Http\Request;

class HelperController extends Controller {

    public function uploadFile(CreateFileRequest $request)
    {   
        session()->flush();
        session()->regenerate();
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