<?php
App::before(function($request) {
	//
});


App::after(function($request, $response) {
	//
});

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function() {
	return Auth::basic();
});


Route::filter('guest', function() {
	if (!Sentry::check()) 
		return Redirect::to('/');
});


Route::filter('csrf', function() {
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Custom Filters
|--------------------------------------------------------------------------
*/

Route::filter('session', function() {
	if (!Sentry::check()) 
		return Redirect::to('/')
		->with('message', 'Yanlış işler peşindesin (: <br><br>');
});

Route::filter('login', function() {
	if(Sentry::check()) 
		return Redirect::to('/')
		->with('message', 'Yanlış işler peşindesin (: <br><br>');
});

Route::filter('edit', function($route) {
	if(!Sentry::check()) 
		return Redirect::to('/')
		->with('message', 'Yanlış işler peşindesin (: <br><br>');

	if(Sentry::getUser()->username !== $route->parameter('username')) {
		return Redirect::home();
	}
});