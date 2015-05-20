<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Hotspot;
use App\Http\Requests\CreateHotspotRequest;
use App\Http\Requests\UpdateHotspotRequest;

use Illuminate\Http\Request;

/**
 * User: Masoud
 * Date: 2/17/15
 * Time: 5:46 PM
 */

class HotspotController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Hotspot::with('hotspotMaster')->groupBy('road_name')->take(300)->get();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateHotspotRequest $request)
	{
		$data = $request->all();
        $hotspot = Hotspot::firstOrCreate($data);
        $msg = array('message'=>'The hotspot is created successfully.', 'status'=>200);
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
		return Hotspot::findOrFail($id);
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
	public function update($id, UpdateHotspotRequest $request)
	{
		$hotspot = Hotspot::findOrFail($id);
		$data = $request->all();
		$hotspot->update($data);
		$msg = array('message'=>'The hotspot is updated successfully.', 'status'=>200);
        return json_encode($msg);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$hotspot = Hotspot::where('id', $id)->first();
        if ($hotspot){
            Hotspot::where('id', $id)->delete();
            $msg = array('message'=>'The hotspot is deleted successfully.', 'status'=>200);
        	return json_encode($msg);
        }else{
            $msg = array('message'=>'The hotspot does not exist.', 'status'=>401);
        	return json_encode($msg);
        }
	}


	public function search(Request $request){

		$hotspot = Hotspot::where('id', '!=', '0');
		// return var_dump($request->all() );

		if( $request->has('locality') and $request->locality ){
			$hotspot->where('locality', 'LIKE', '%'.$request->locality.'%');
		}

		if( $request->has('city') and $request->city ){
			$hotspot->where('city', $request->city);
		}

		if( $request->has('municipal') and $request->municipal ){
			$hotspot->where('municipal', $request->municipal);
		}

		if( $request->has('street') and $request->street ){
			$hotspot->where('street', $request->street);
		}

		

		$hotspot = $hotspot->orderby('id', 'desc')->get();
		return $hotspot;
	}



}
