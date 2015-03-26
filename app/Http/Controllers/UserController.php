<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

/**
 * User: Masoud
 * Date: 2/17/15
 * Time: 5:46 PM
 */

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function login(Request $request)
	{
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
        	$user = User::where('email', $request->email)->first();
            $msg = array('message'=>$user, 'status'=>200);
		    return json_encode($msg);
        }else{
        	$msg = array('message'=>'Username/password is wrong!', 'status'=>401);
		    return json_encode($msg); 
        }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function signup(CreateUserRequest $request)
	{
		$password = bcrypt( $request->password );
		User::firstOrCreate(array('name'=>$request->name, 'email'=>$request->email, 'password'=>$password));
		$msg = array('message'=>'The user is registered successfully.', 'status'=>200);
		return json_encode($msg);
	}


	public function logout(Request $request)
	{
		Auth::logout();
		$msg = array('message'=>'The user is logged out successfully.', 'status'=>200);
		return json_encode($msg);
	}

	public function updateUser(UpdateUserRequest $request){
		$password = bcrypt( $request->password );
		$user = Auth::user();
		$user->name = $request->name ;
		$user->email = $request->email ;
		$user->password = $password;
		$user->save();
		$msg = array('message'=>'The profile is updated successfully.', 'status'=>200);
		return json_encode($msg);
	}

}
