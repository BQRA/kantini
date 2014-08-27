<?php
Route::controller('password', 'RemindersController');

Route::get('/', [
	'as' 	=> 'home',
	'uses' 	=> 'PagesController@home'
]);

Route::get('register', [
	'as' 	 => 'user.register',
	'uses' 	 => 'PagesController@register',
	'before' => 'login'
]);

	Route::post('register', 'UsersController@postRegister')->before('crsf');

	Route::post('login', 'SessionsController@login')->before('crsf');

Route::get('logout', [
	'as' 	 => 'user.logout',
	'uses' 	 => 'SessionsController@logout',
	'before' => 'guest'
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

	Route::post('user/profile/{username}/edit', 'UsersController@updateProfile')->before('edit', 'crsf');

	Route::post('user/profile/{username}/change-password', 'UsersController@changePassword')->before('edit', 'crsf');

	Route::post('send-post', 'PostsController@sendPost')->before('crsf');

Route::get('create-event', [
	'as' 	 => 'create.event',
	'uses'	 => 'PagesController@createEvent',
	'before' => 'session'
]);

Route::get('add-media', [
	'as' 	 => 'add.media',
	'uses' 	 => 'PagesController@addMedia',
	'before' => 'session'
]);

Route::get('post/{id}', [
	'as' 	=> 'show.post',
	'uses' 	=> 'PostsController@showPost'
]);

	Route::post('send-comment', 'PostsController@sendComment')->before('crsf');

Route::get('user/profile/{username}/all-posts', [
	'as' 	=> 'user.all.posts',
	'uses' 	=> 'UsersController@showUserAllPosts'
]);

Route::get('user/profile/{username}/all-comments', [
	'as' 	=> 'user.all.comments',
	'uses' 	=> 'UsersController@showUserAllComments'
]);

Route::get('search',[
	'as' => 'search',
	'uses' => 'SearchController@Search'
]);

	Route::post('rate', 'RatesController@rate')->before('crsf');
