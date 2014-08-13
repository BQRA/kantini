<?php
Route::get('/', [
	'as' 	=> 'home',
	'uses' 	=> 'PagesController@home'
]);

Route::get('/contact-us/', [
	'as' 	=> 'contact.us',
	'uses' 	=> 'PagesController@ContactUs'
]);

Route::get('/user/register/', [
	'as' 	 => 'register',
	'uses' 	 => 'PagesController@Register',
	'before' => 'login'
]);
	
	Route::post('/user/register/', [
		'as' 	 => 'post.register',
		'uses' 	 => 'UsersController@PostRegister',
		'before' => 'csrf'
	]);

Route::get('/user/logout/', [
	'as' 	 => 'logout',
	'uses' 	 => 'PagesController@Logout',
	'before' => 'guest'
]);

Route::get('/search/',[
	'as' => 'search',
	'uses' => 'SearchController@Search'
]);

/* User Profiles */
Route::get('/user/profile/{username}/', [
	'as' 	=> 'show.profile',
	'uses' 	=> 'UsersController@ShowProfile'
]);

Route::get('/user/profile/{username}/edit/', [
	'as' 	=> 'edit.profile',
	'uses' 	=> 'UsersController@EditProfile',
	'before' => 'edit'
]);
	
	Route::post('/user/profile/{username}/edit/', [
		'as' 	 => 'update.profile',
		'uses' 	 => 'UsersController@UpdateProfile',
		'before' => 'csrf'
	]);

Route::get('/user/profile/{username}/all-posts/', [
	'as' 	=> 'show.users.all.posts',
	'uses'  => 'UsersController@ShowUserAllPosts'
]);

Route::get('/user/profile/{username}/all-comments/', [
	'as' 	=> 'show.users.all.comments',
	'uses'  => 'UsersController@ShowUserAllComments'
]);

Route::get('/user/profile/{username}/all-likes/', [
	'as' 	=> 'show.users.all.likes',
	'uses'  => 'UsersController@ShowUserAllLikes'
]);
/* User Profiles */

Route::get('/post/{id}/', [
	'as' 	=> 'show.post',
	'uses' 	=> 'PostsController@ShowPost'
]);

/* Just Post Routes */
	Route::post('/send-post/', [
		'as' 	 => 'send.post',
		'uses'   => 'PostsController@SendPost',
		'before' => 'csrf'
	]);

	Route::post('/send-comment/', [
		'as' 	 => 'send.comment',
		'uses'   => 'PostsController@SendComment',
		'before' => 'csrf'
	]);

	Route::post('/like/', [
		'as' 	 => 'like',
		'uses'   => 'LikesController@Like',
		'before' => 'csrf'
	]);

	Route::post('/guest-like/', [
		'as' 	 => 'like',
		'uses' 	 => 'LikesController@GuestLike',
		'before' => 'csrf'
	]);

	Route::post('/dislike/', [
		'as' 	 => 'dislike',
		'uses'   => 'LikesController@Dislike',
		'before' => 'csrf'
	]);

	Route::post('/guest-dislike/', [
		'as' 	 => 'dislike',
		'uses'   => 'LikesController@GuestDislike',
		'before' => 'csrf'
	]);

	Route::post('/user/login/', [
		'as' 	 => 'post.login',
		'uses'   => 'UsersController@PostLogin',
		'before' => 'csrf'
	]);
/* Just Post Routes */

Route::get('/create-organization/', [
	'as' 	 => 'create.organization',
	'uses' 	 => 'PagesController@CreateOrganization',
	'before' => 'session'
]);

	Route::post('/create-organization/', [
		'as' 	 => 'create.organization',
		'uses' 	 => 'PostsController@CreateOrganization',
		'before' => 'csrf'
	]);

Route::get('/add-media/', [
	'as' 	 => 'add.media',
	'uses' 	 => 'PagesController@AddMedia',
	'before' => 'session'
]);