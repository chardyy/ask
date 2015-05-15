<?php

class UsersController extends \BaseController {
    //public $restful = true;
	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('users.new')
                    ->with('title', 'Murag ASKfm - Register');
	}

    public function getLogin(){
        return View::make('users.login')
                    ->with('title', 'Murag ASKfm - Login');
    }

    public function postLogin()
    {
            $user = [
                'username' => Input::get('username'),
                'password' => Input::get('password')
            ];

        if(Auth::attempt($user)){
            return Redirect::to('/')->with('message', 'You are logged in!');
        }else{
            return Redirect::to('login')->with('message', 'Something went wrong!')->withInput();
        }
    }

    public function getLogout(){
        if(Auth::check()){
            Auth::logout();

            return Redirect::to('login')->with('message', 'You logged out!');
        }
        else{
            return Redirect::to('/');
        }
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $validator = Validator::make(Input::all(), User::$rules);

        if($validator->passes()){
            User::create([
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'))
            ]);
            $user = User::WHERE('username', '=' , Input::get('username'))->first();
            Auth::login($user);

            return Redirect::to('/')->with('message', 'Thanks for registering. You are now logged in');
        }
        else{
            return Redirect::to('register')->withErrors($validator)->withInput();
        }
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
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
	 * GET /users/{id}/edit
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
	 * PUT /users/{id}
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
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}