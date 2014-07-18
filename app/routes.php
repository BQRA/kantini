<?php
Route::get('/', ['as' => 'home', 'uses' => 'PageController@index']);
Route::get('about-us', ['as' => 'about-us', 'uses' => 'PageController@aboutUs']);
Route::get('kantini', ['as'	=> 'kantini', 'uses' => 'PageController@kantini']);
Route::get('agreement', ['as' => 'agreement', 'uses' 	=> 'PageController@agreement']);

Route::get('male-posts', ['as' => 'male-posts', 'uses' => 'PageController@male']);
Route::get('female-posts', ['as' => 'female-posts', 'uses' => 'PageController@female']);

#Contact us#
Route::get('contact-us', ['as' => 'contact-us', 'uses' => 'PageController@contactUs']);
Route::post('contact-us', ['before' => 'csrf', 'as'=> 'contact-us', 'uses' => 'MessageController@sendMessage']);

#Send-post#
Route::get('send-post', ['before' => ['baran', 'edit-filter'], 'as' => 'send-post', 'uses' => 'PostController@sendPost']);
Route::post('send-post', ['before' => 'csrf', 'as' => 'send-post', 'uses' => 'PostController@sendPost']);

#User Register#
Route::get('user/register', ['as' => 'user-register', 'uses' => 'UserController@getRegister']);
Route::post('user/register', ['before' => 'csrf', 'as' => 'user-register', 'uses' => 'UserController@postRegister']);

#User Login#
Route::get('user/login', ['as' => 'user-login', 'uses' => 'UserController@getLogin']);
Route::post('user/login', ['before' => 'csrf', 'as' => 'user-login', 'uses' => 'UserController@postLogin']);

Route::get('user/logout', ['as' => 'user-logout', 'uses' => 'UserController@Logout']);


Route::group(['before' => 'admin'], function() {

	Route::get('admin', [
		'as' 	=> 'admin',
		'uses' 	=> 'AdminController@index'
	]);
	
	Route::get('admin/all-posts', [
		'as' 	=> 'admin-all-posts',
		'uses' 	=> 'AdminController@getAdminAllPosts'
	]);
	
	Route::get('admin/all-comments', [
		'as' 	=> 'admin-all-comments',
		'uses' 	=> 'AdminController@getAdminAllComments'
	]);
	
	Route::get('admin/all-messages', [
		'as' 	=> 'admin-all-messages',
		'uses' 	=> 'AdminController@getAdminAllMessages'
	]);
	
	Route::get('admin/all-organizations', [
		'as' 	=> 'admin-all-organizations',
		'uses' 	=> 'AdminController@getAdminAllOrganizations'
	]);
	
	Route::get('admin/all-members', [
		'as' 	=> 'admin-all-members',
		'uses' 	=> 'AdminController@getAdminAllMembers'
	]);

	#Deleting#
	Route::get('admin/delete-post/{id}', [
		'as' 	=> 'admin-delete-post/{id}', 
		'uses'	=> 'AdminController@AdminDeletePost'
	]);
	
	Route::get('admin/delete-comment/{id}', [
		'as' 	=> 'admin-delete-comment/{id}',
		'uses' 	=> 'AdminController@AdminDeleteComment'
	]);
	
	Route::get('admin/delete-message/{id}', [
		'as' 	=> 'admin-delete-message/{id}',
		'uses' 	=> 'AdminController@AdminDeleteMessage'
	]);
	
	Route::get('admin/delete-organization/{id}', [
		'as' 	=> 'admin-delete-organization/{id}',
		'uses' 	=> 'AdminController@AdminDeleteOrganization'
	]);
	
	Route::get('admin/delete-member/{id}', [
		'as' 	=> 'admin-delete-member/{id}',
		'uses' 	=> 'AdminController@AdminDeleteMember'
	]);

	Route::get('admin/ban-member/{id}', [
		'as' 	=> 'admin-ban-member/{id}',
		'uses' 	=> 'AdminController@AdminBanMember'
	]);

	Route::get('admin/unban-member/{id}', [
		'as' 	=> 'admin-unban-member/{id}',
		'uses' 	=> 'AdminController@AdminUnBanMember'
	]);

	Route::get('admin/update-organizaiton/{id}', [
		'as' 	=> 'admin-update-organization/{id}', 
		'uses' 	=> 'AdminController@AdminUpdateOrganization'
	]);
});



Route::group(['before' => 'organization-filter'], function() {

	Route::get('user/{profile}/create-organization', [
		'as' 	=> 'create-organization',
		'uses' 	=> 'PageController@getCreateOrganization'
	]);

		Route::post('user/{profile}/create-organization', [
			'before' 	=> 'csrf',
			'as' 		=> 'create-organization',
			'uses' 		=> 'UserController@postCreateOrganization'
		]);
});

Route::group(['before' => 'edit-filter'], function() {

	Route::get('user/{profile}/edit', [
		'as' 	=> 'edit-profile',
		'uses' 	=> 'UserController@editProfile'	
	]);

		Route::post('user/{profile}/edit', [
			'before' 	=> 'csrf',
			'as' 		=> 'update-profile',
			'uses' 		=> 'UserController@updateProfile'
		]);
});

Route::group(['before' => 'baran'], function() {

	Route::get('user/{profile}/', [
		'as' 	=> 'show-profile',
		'uses' 	=> 'UserController@showProfile'
	]);

	Route::get('user/{profile}/all-posts', [
		'as' 	=> 'users-all-posts',
		'uses' 	=> 'UserController@getUserAllPosts'
	]);

	Route::get('user/{profile}/all-comments', [
		'as' 	=> 'users-all-comments',
		'uses' 	=> 'UserController@getUserAllComments'
	]);

	Route::get('user/{profile}/all-organizations', [
		'as' 	=> 'users-all-organizations',
		'uses' 	=> 'UserController@getUserAllOrganizations'
	]);

	Route::get('organizations', [
		'as' 	=> 'organization',
		'uses' 	=> 'PageController@getOrganization'
	]);

	Route::get('organization/{id}', [
		'as' 	=> 'show-organization',
		'uses' 	=> 'PageController@showOrganization'
	]);

});

Route::get('post/{id}', [
	'as' 	=> 'post/{id}',
	'uses' 	=> 'PostController@getPosts'
])->where('id', '[0-9]+');

	Route::post('post/{id}', [
		'before' => 'csrf',
		'as' 	=> 'post/{id}',
		'uses' 	=> 'PostController@sendComment'
	]);