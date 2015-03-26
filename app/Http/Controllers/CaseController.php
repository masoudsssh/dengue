<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\CaseItem;
use App\Http\Requests\CreateCaseRequest;
use App\Http\Requests\UpdateCaseRequest;
use Illuminate\Http\Request;

/**
 * User: Masoud
 * Date: 2/17/15
 * Time: 5:46 PM
 */

class CaseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		return CaseItem::orderBy('id','desc')->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateCaseRequest $request)
	{
		//return var_dump(session()->has('app.uploadedFile'));
		if(session()->has('app.uploadedFile') && session('app.uploadedFile')!=""){
			foreach(session('app.uploadedFile') as $files):
				$input['filePath'] = $files[0];
				$input['fileNewName'] = $files[1];
			endforeach;
			CaseItem::firstOrCreate(array('user_id'=>1, 'title'=>$request->title, 'description'=>$request->description, 'image'=>'/uploadedFiles/'.$input['filePath'], 'category'=>$request->category ));
			session()->flush();
			$msg = array('message'=>'The case is created successfully.', 'status'=>200);
        	return json_encode($msg);
		}else{
		        $msg = array('message'=>'Something is wrong.', 'status'=>401);
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
		return CaseItem::findOrFail($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, UpdateCaseRequest $request)
	{	
		$case = CaseItem::findOrFail($id);
		$data = $request->all();
		$case->update($data);
		$msg = array('message'=>'The case is updated successfully.', 'status'=>200);
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
		$case = CaseItem::where('id', $id)->first();
        if ($case){
            CaseItem::where('id', $id)->delete();
            $msg = array('message'=>'The case is deleted successfully.', 'status'=>200);
        	return json_encode($msg);
        }else{
            $msg = array('message'=>'The case does not exist.', 'status'=>401);
        	return json_encode($msg);
        }
	}

	
	public function filterBy($param)
	{
		return CaseItem::where('category', $param)->get();
	}

}
