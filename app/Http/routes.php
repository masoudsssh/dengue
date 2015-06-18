<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
					return Redirect::to('/index'); 
				});
Route::get('/index', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::post('upload', array('as'=>'FileUpload', 'uses'=>'HelperController@uploadFile' ));
Route::post('import', array('as'=>'importExcel', 'uses'=>'HelperController@importExcelFile' ) );

Route::get('map', function(){
								return View::make('map'); 
							});

Route::get('case-filter-by/{groupType}', 'CaseController@filterBy' );
Route::resource('case', 'CaseController', ['except' => ['edit', 'create']]);

Route::resource('hotspot', 'HotspotController', ['except' => ['edit', 'create']]);

Route::post('hotspot', 'HotspotController@search');
Route::get('hotspotmaster', 'HotspotController@displayAllHotspotMaster');



Route::resource('faq', 'FaqController', ['except' => ['edit', 'create']]);
Route::resource('controlkit', 'ControlKitController', ['except' => ['edit', 'create']]);
Route::resource('danguealert', 'DengueAlertController', ['except' => ['edit', 'create']]);

Route::post('login', array('as'=>'login', 'uses'=>'UserController@login' ));
Route::post('login/fb', 'UserController@fbLogin');

Route::post('signup', array('as'=>'signup', 'uses'=>'UserController@signup' ));
Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@logout' ));
Route::put('update-user', array('as'=>'updateUser', 'uses'=>'UserController@updateUser' ));

Route::post('newsletter', array('as'=>'newsletter', 'uses'=>'UserController@newsletter' ));

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::get('/facebook', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    	 // Send an array of permissions to request
	    $login_url = $fb->getLoginUrl(['email']);

	    // Obviously you'd do this in blade :)
	    echo '<a href="' . $login_url . '">Login with Facebook</a>';
});


// Endpoint that is redirected to after an authentication attempt
Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Obtain an access token.
    try {
        $token = $fb->getAccessTokenFromRedirect();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (! $token) {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (! $helper->getError()) {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
            $helper->getError(),
            $helper->getErrorCode(),
            $helper->getErrorReason(),
            $helper->getErrorDescription()
        );
    }

    if (! $token->isLongLived()) {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try {
            $token = $oauth_client->getLongLivedAccessToken($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    $fb->setDefaultAccessToken($token);

    // Save for later
    Session::put('fb_user_access_token', (string) $token);

    // Get basic info on the user from Facebook.
    try {
        $response = $fb->get('/me?fields=id,name,email');
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    $facebook_user = $response->getGraphUser();
    //echo $facebook_user;

    $linkData = [
	  'link' => 'http://mytest.com',
	  'message' => 'my test message',
	  ];

	try {
	  $params['appsecret_proof'] =  hash_hmac('sha256', $token, 'b6c6b21d501b4ac96efa28fc66d218a4');

	  // Returns a `Facebook\FacebookResponse` object
	  $response = $fb->post('/me/feed', $linkData, 'CAACEdEose0cBADRDmxO9K8yZAEnDpwznHmevbFdZBo8SuNPbyAzETQHl8vrU2E9SclHyOv9Hqu29iM9ZCcY7hhSwX3WJeYRl59ryWZAOK4UeiWtMRtTE9iXIS1LyrmretxgTe36GNbMzPatqhixsiG7KtevI4t8iZAlgHvuRWmxvWDsaOcLIpr82hrpxJ4L2SQBXInRthZBcdHdZAKeJekpKFuNZAn8ajZBIZD' , $params);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

    return $facebook_user;
});


Route::get('/twitter', function()
{
    return Twitter::postTweet(['status' => 'this is another test!!', 'format' => 'json']);
});
