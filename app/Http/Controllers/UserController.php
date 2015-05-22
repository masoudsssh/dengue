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
        	Auth::loginUsingId($user->id);
            $msg = array('message'=>$user, 'status'=>200);
		    return json_encode($msg);
        }else{
        	$msg = array('message'=>'Username/password is wrong!', 'status'=>401);
		    return json_encode($msg); 
        }
	}


	public function fbLogin(Request $request){
		if( $request->has('email') ){
	        $user = User::firstOrCreate(array('email'=>$request->email ) );
	        $input['first_name'] = $request->first_name;
	        $input['last_name'] = $request->last_name;
	        $user->update($input);
	        Auth::loginUsingId($user->id);
	        $msg = array('message'=>$user, 'status'=>200);
			return json_encode($msg);
		}else{
        	$msg = array('message'=>'wrong parameter!', 'status'=>401);
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
		User::firstOrCreate(array('name'=>$request->name, 'email'=>$request->email, 'password'=>$password, 'role_id'=>1 ));
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

		if(session()->has('app.uploadedFile') && session('app.uploadedFile')!=""){
		    foreach(session('app.uploadedFile') as $files):
				$input['filePath'] = $files[0];
				$input['fileNewName'] = $files[1];
			endforeach;

			session()->forget('app.uploadedFile');

			$image = '/uploadedFiles/'.$input['filePath'];
			$user = Auth::user();
			//return Auth::user();
			$user->name = $request->name ;
			$user->email = $request->email ;
			$user->password = bcrypt( $request->password );
			$user->image = $image;
			$user->save();
		}else{
			$user = Auth::user();
			//return Auth::user()->id;
			$user->name = $request->name ;
			$user->email = $request->email ;
			$user->password = bcrypt( $request->password );
			$user->save();
		}

			$msg = array('message'=>'The profile is updated successfully.', 'user'=>$user, 'status'=>200);
			return json_encode($msg);

	}

}
