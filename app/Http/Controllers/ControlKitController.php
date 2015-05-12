<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ControlKit;
use App\Http\Requests\CreateControlKitRequest;
use Illuminate\Http\Request;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class ControlKitController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		return ControlKit::orderBy('id','desc')->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateControlKitRequest $request)
	{
		$data = $request->all();
        $faq = ControlKit::firstOrCreate($data);

        \Mail::queue('emails.default',
	        array(
	            'name' => $request->get('name'),
	            'email' => $request->get('email')
	        ), function($message)
	    {
	        $message->from('kbd@info.com');
	        $message->to('masoudsssh@gmail.com', 'masoud')->subject('KBD');
	    });


        $msg = array('message'=>'The ControlKit request is submited successfully.', 'status'=>200);
        return json_encode($msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
