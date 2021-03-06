<?php

class SessionController extends \BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$messages = Session::get('message');
		return View::make('frontend.guest.register-login')->with('message',$messages);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try
		{
		    // Login credentials
			$credentials = array(
				'email' => Input::has('email') ? Input::get('email') : null,
				'password' => Input::has('password') ? Input::get('password') : null,
				);

		    // Authenticate the user
			$user = Sentry::authenticate($credentials, Input::has('remember'));
		}

		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return Redirect::route('login')->withErrors(['signin'=>'Invalid credentials provided.']);
		}

		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			return Redirect::route('login')->withErrors(['signin'=>'Account not activated.']);
		}

		// Logged in successfully - redirect
		$user = Sentry::getUser();
		$membergroup = Sentry::findGroupByName('Members');
		$admingroup = Sentry::findGroupByName('Admin');
		$usergroup = Sentry::findGroupByName('Users');

		if ($user->inGroup($membergroup)) return Redirect::intended('/');
		elseif ($user->inGroup($admingroup)) return Redirect::intended('admin');
		elseif ($user->inGroup($usergroup)) return Redirect::intended('user');
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id=null)
	{
		Sentry::logout();
		return Redirect::home();
	}
}
