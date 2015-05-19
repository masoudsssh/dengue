<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DengueAlert;
use Auth;
use App\Http\Requests\CreateDangueAlertRequest;
use Illuminate\Http\Request;

class DengueAlertController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		if(!Auth::check() ){
			return 'wrong parameter';
		}else{
			return DengueAlert::where('user_id', Auth::user()->id )->orderBy('id','desc')->get();
		}
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
	public function store(CreateDangueAlertRequest $request)
	{
		if( $request->has('area') and $request->has('user_id') ){
			$data = $request->all();

	       DengueAlert::insert($data);

	        $msg = array('message'=>'The dengue alert is created successfully.', 'status'=>200);
	        return json_encode($msg);
	    }else{
        	$msg = array('message'=>'wrong parameter!', 'status'=>401);
		    return json_encode($msg); 
        }
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
		$dengueAlert = DengueAlert::where('id', $id)->first();
        if ($dengueAlert){
            DengueAlert::where('id', $id)->delete();
            $msg = array('message'=>'The dengue alert is deleted successfully.', 'status'=>200);
        	return json_encode($msg);
        }else{
            $msg = array('message'=>'The dengue alert does not exist.', 'status'=>401);
        	return json_encode($msg);
        }
	}

}
