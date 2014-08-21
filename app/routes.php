<?php
Route::controller('password', 'RemindersController');

Route::get('/', [
	'as' 	=> 'home',
	'uses' 	=> 'PagesController@home'
]);

Route::get('register', [
	'as' 	=> 'user.register',
	'uses' 	=> 'PagesController@register'
]);

	Route::post('register', 'UsersController@postRegister');

	Route::post('login', 'SessionsController@login');

Route::get('logout', [
	'as' 	=> 'user.logout',
	'uses' 	=> 'SessionsController@logout'
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

	Route::post('user/profile/{username}/edit', 'UsersController@updateProfile');

	Route::post('user/profile/{username}/change-password', 'UsersController@changePassword');

	Route::post('send-post', 'PostsController@sendPost');

Route::get('create-event', [
	'as' 	=> 'create.event',
	'uses'	=> 'PagesController@createEvent'
]);

Route::get('post/{id}', [
	'as' 	=> 'show.post',
	'uses' 	=> 'PostsController@showPost'
]);

	Route::post('send-comment', 'PostsController@sendComment');

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

	Route::post('up', 'RatesController@up');
	Route::post('down', 'RatesController@down');

Route::get('add-media', 'PagesController@addMedia');
