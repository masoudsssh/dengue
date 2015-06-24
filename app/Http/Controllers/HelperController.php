<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateFileRequest;
use Illuminate\Http\Request;
use App\Hotspot;
use Auth;

class HelperController extends Controller{

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
    



    public function importExcelFile(CreateFileRequest $request){
	$oldName = $request->file('file')->getClientOriginalName();
            $newFileName = str_random(10).'.'.$request->file('file')->getClientOriginalExtension();
            $uploadPath = public_path().'/uploadedFiles/';
            $request->file('file')->move($uploadPath, $newFileName);
            $file = public_path().'/uploadedFiles/'.$newFileName;


		\Excel::load( $file, function($reader) {

  		// reader methods
		$results = $reader->get();

            // Loop through all sheets
            $results->each(function($sheet) {
    		    $cell = array();
                        // Loop through all rows
    		    foreach($sheet as $index => $row){
                             $cell[$index]=$row;
                        }

		if ($cell['week']!=""){

if( strtolower($cell['state'])=='wilayah persekutuan' ){
	$cell['start']="2090-01-01";
}

                $date = date_create();
                date_isodate_set($date, 2015, intval($cell['week']), 1);
                $week_day = date_format($date, 'Y-m-d');
                $week_day = strtotime( $week_day );
                $dateStart = strtotime( $cell['start'] );

                if( $dateStart >= $week_day ){
                    $last_week = Hotspot::where( 'week', '<', intval($cell['week']) )
                                    ->where('road_name', $cell['road_name'] )
                                    ->where('state', $cell['state'])
                                    ->orderBy('week', 'desc')
                                    ->first();

                    if( $last_week!=null ){
                        $no_of_cases = $cell['no_of_cases']+intval($last_week->no_of_cases) ;
                        $hotspot = Hotspot::insert(array(
                            'state' => $cell['state'],
                            'week' => $cell['week'],
                            'road_name' => $cell['road_name'],
                            'no_of_cases' => $no_of_cases, 
                            'start' => $cell['start'],
                            'end' => $cell['end']
                        ));
                    }else{
                        $hotspot = Hotspot::insert(array(
                            'state' => $cell['state'],
                            'week' => $cell['week'],
                            'road_name' => $cell['road_name'],
                            'no_of_cases' => $cell['no_of_cases'],
                            'start' => $cell['start'],
                            'end' => $cell['end']
                        ));
                    }
                }else{
                    $hotspot = Hotspot::insert(array(
                        'state' => $cell['state'],
                        'week' => $cell['week'],
                        'road_name' => $cell['road_name'],
                        'no_of_cases' => $cell['no_of_cases'],
                        'start' => $cell['start'],
                        'end' => $cell['end']
                    ));
                }
               }
            });

        $msg = array('message'=>'File is imported successfully.', 'status'=>200);
        return json_encode($msg);

	});

    }

}
