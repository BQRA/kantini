<?php
Route::get('/', array(
	'as' 	=> 'home',
	'uses' 	=> 'PagesController@home'
));

Route::get('/kantini/', array(
	'as' 	=> 'kantini',
	'uses' 	=> 'PagesController@Kantini'
));

Route::get('/contact-us/', array(
	'as' 	=> 'contact.us',
	'uses' 	=> 'PagesController@ContactUs'
));

Route::get('/ad/', array(
	'as' 	=> 'ad',
	'uses' 	=> 'PagesController@Ad'
));

Route::get('/about-us/', array(
	'as' 	=> 'about.us',
	'uses' 	=> 'PagesController@AboutUs'
));

Route::get('/u-dont-know/', array(
	'as' 	=> 'u.dont.know',
	'uses' 	=> 'PagesController@UDontKnow'
));

Route::get('/user/register/', array(
	'as' 	 => 'register',
	'uses' 	 => 'PagesController@Register'
));
	
	Route::post('/user/register/', array(
		'as' 	 => 'post.register',
		'uses' 	 => 'UsersController@PostRegister',
		'before' => 'csrf'
	));

Route::get('/user/login/', array(
	'as' 	 => 'login',
	'uses' 	 => 'PagesController@Login'
));

	Route::post('/user/login/', array(
		'as' 	 => 'post.login',
		'uses'   => 'UsersController@PostLogin',
		'before' => 'csrf'
	));

Route::get('/user/logout/', array(
	'as' 	 => 'logout',
	'uses' 	 => 'PagesController@Logout',
	'before' => 'guest'
));


/* User Profiles */
Route::get('/user/profile/{username}/', array(
	'as' 	=> 'show.profile',
	'uses' 	=> 'UsersController@ShowProfile'
));

Route::get('/user/profile/{username}/edit/', array(
	'as' 	=> 'edit.profile',
	'uses' 	=> 'UsersController@EditProfile'
));
	
	Route::post('/user/profile/{username}/edit/', array(
		'as' 	 => 'update.profile',
		'uses' 	 => 'UsersController@UpdateProfile',
		'before' => 'csrf'
	));
/* User Profiles */

Route::get('/post/{id}/', array(
	'as' 	=> 'show.post',
	'uses' 	=> 'PostsController@ShowPost'
));

Route::get('/post/{id}/secret', array(
	'as' 	=> 'secret',
	'uses' 	=> 'PostsController@Secret'
));

/* Just Post Routes */
	Route::post('/send-post/', array(
		'as' 	 => 'send.post',
		'uses'   => 'PostsController@SendPost',
		'before' => 'csrf'
	));

	Route::post('/send-comment/', array(
		'as' 	=> 'send.comment',
		'uses' => 'PostsController@SendComment',
		'before' => 'csrf'
	));
/* Just Post Routes */

Route::get('/create-organization/', array(
	'as' 	=> 'create.organization',
	'uses' 	=> 'PagesController@CreateOrganization',
	'before' => 'session'
));

	Route::post('/create-organization/', array(
		'as' 	=> 'create.organization',
		'uses' 	=> 'PostsController@CreateOrganization',
		'before' => 'csrf'
	));

Route::get('/organization/{id}', array(
	'as' 	=> 'show.organization',
	'uses' 	=> 'PostsController@ShowOrganization'
));