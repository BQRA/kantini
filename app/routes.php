<?php
Route::controller('password', 'RemindersController');

Route::get('/', [
	'as' 	=> 'home',
	'uses' 	=> 'PagesController@home'
]);

Route::get('user/register', [
	'as' 	 => 'user.register',
	'uses' 	 => 'PagesController@register',
	'before' => 'guest'
]);

	Route::post('register', 'UsersController@postRegister')->before('crsf');

	Route::post('login', 'SessionsController@login')->before('crsf');

	//
	Route::post('create-event', 'PostsController@eventImage')->before('csrf');
	//

Route::get('logout', [
	'as' 	 => 'user.logout',
	'uses' 	 => 'SessionsController@logout',
	'before' => 'auth'
]);

Route::get('search',[
	'as' 	=> 'search',
	'uses'  => 'SearchController@Search'
]);

	Route::post('rate/{id}', 'RatesController@rate');

Route::get('create-event', [
	'as' 	 => 'create.event',
	'uses'	 => 'PagesController@createEvent',
	'before' => 'auth'
]);

	Route::post('event-image-upload', function() {

		$data = Input::get('image');

		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);

		file_put_contents(public_path().'/Events/'.imageNumber().'.JPG', $data);

		return HTML::image('/Events/'.imageNumber().'.jpg');
	});

Route::get('add-media', [
	'as' 	 => 'add.media',
	'uses' 	 => 'PagesController@addMedia',
	'before' => 'auth'
]);

Route::get('authorization', function()
{
	return View::make('pages.authorization');
});


	Route::post('send-post', 'PostsController@sendPost')->before('crsf');

	Route::post('send-comment/{id}', 'PostsController@sendComment')->before('crsf');

Route::get('delete-dedikod/{id}',[
	'as' 	=> 'user.delete.dedikod',
	'uses' 	=> 'PostsController@userDeleteDedikod'
]);

Route::get('user/profile/{username}', [
	'as' 	=> 'show.profile',
	'uses' 	=> 'UsersController@showProfile'
]);

Route::get('user/profile/{username}/edit', [
	'as' 	 => 'edit.profile',
	'uses' 	 => 'UsersController@editProfile',
	'before' => 'edit'
]);

	Route::post('user/profile/{username}/edit', 'UsersController@updateProfile')->before('crsf');

	Route::post('user/profile/{username}/change-password', 'UsersController@changePassword')->before('crsf');

Route::get('post/{id}', [
	'as' 	=> 'show.post',
	'uses' 	=> 'PostsController@showPost'
]);

Route::get('user/profile/{username}/all-posts', [
	'as' 	=> 'user.all.posts',
	'uses' 	=> 'UsersController@showUserAllPosts'
]);

Route::get('user/profile/{username}/all-comments', [
	'as' 	=> 'user.all.comments',
	'uses' 	=> 'UsersController@showUserAllComments'
]);

Route::get('user/profile/{username}/all-rates', [
	'as' 	=> 'user.all.rates',
	'uses' 	=> 'UsersController@showUserAllRates'
]);

Route::get('/uni/{school}',[
	'as' 	=> 'school',
	'uses'  => 'PagesController@school'
]);

Route::get('/user/account-activate/{code}', [
	'as' 	=> 'account.activate',
	'uses' 	=> 'UsersController@accountActivate'
]);

	Route::post('flag/{id}', 'FlagsController@flag');