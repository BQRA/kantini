<?php
Route::get('/', ['as' => 'home', 'uses' => 'PageController@index']);
Route::get('/about-us/', ['as' => 'about-us', 'uses' => 'PageController@aboutUs']);
Route::get('/kantini/', ['as'	=> 'kantini', 'uses' => 'PageController@kantini']);
Route::get('/agreement/', ['as' => 'agreement', 'uses' 	=> 'PageController@agreement']);
Route::get('/dont-know/', ['as' => 'dont-know', 'uses' 	=> 'PageController@dontKnow']);

Route::get('/male-posts/', ['as' => 'male-posts', 'uses' => 'PageController@male']);
Route::get('/female-posts/', ['as' => 'female-posts', 'uses' => 'PageController@female']);

#Contact us#
Route::get('/contact-us/', ['as' => 'contact-us', 'uses' => 'PageController@contactUs']);
Route::post('/contact-us/', ['as'=> 'contact-us', 'before' => 'csrf', 'uses' => 'MessageController@sendMessage']);

#Send-post#
Route::post('/send-post/', ['as' => 'send-post', 'before' => 'csrf', 'uses' => 'PostController@sendPost']);

#User Register#
Route::get('/user/register/', ['as' => 'user-register', 'uses' => 'UserController@getRegister']);
Route::post('/user/register/', ['as' => 'user-register', 'before' => 'csrf', 'uses' => 'UserController@postRegister']);

#User Login#
Route::get('/user/login/', ['as' => 'user-login', 'uses' => 'UserController@getLogin']);
Route::post('/user/login/', ['as' => 'user-login', 'before' => 'csrf', 'uses' => 'UserController@postLogin']);

Route::get('/user/logout/', ['as' => 'user-logout', 'uses' => 'UserController@Logout']);

Route::get('/organizations/', ['as' => 'organization', 'uses' => 'PageController@getOrganization']);
Route::get('/organization/{id}/', ['as' => 'show-organization', 'uses' => 'PageController@showOrganization']);

Route::group(['before' => 'organization-filter'], function() {
	Route::get('/user/{profile}/create-organization/', ['as' => 'create-organization', 'uses' => 'PageController@getCreateOrganization']);
	Route::post('/user/{profile}/create-organization/', ['as' => 'create-organization', 'before' => 'csrf', 'uses' => 'UserController@postCreateOrganization']);
});

Route::group(['before' => 'edit-filter'], function() {
	Route::get('/user/{profile}/edit/', ['as' => 'edit-profile', 'uses' => 'UserController@editProfile']);
	Route::post('/user/{profile}/edit/', ['as' => 'update-profile', 'before' => 'csrf', 'uses' => 'UserController@updateProfile']);
});

Route::get('/user/{profile}/', ['as' => 'show-profile', 'uses' => 'UserController@showProfile']);
Route::get('/user/{profile}/all-posts/', ['as' => 'users-all-posts', 'uses' => 'UserController@getUserAllPosts']);
Route::get('/user/{profile}/all-comments/', ['as' => 'users-all-comments', 'uses' => 'UserController@getUserAllComments']);
Route::get('/user/{profile}/all-organizations/', ['as' => 'users-all-organizations', 'uses' => 'UserController@getUserAllOrganizations']);

Route::get('/post/{id}/', ['as' => 'post/{id}', 'uses' => 'PostController@getPosts'])->where('id', '[0-9]+');
Route::get('/post/{id}/secret', ['as' => 'secret', 'uses' => 'PostController@getPostsSecret']);
Route::post('/post/{id}/', ['as' => 'post/{id}', 'before' => 'csrf', 'uses' => 'PostController@sendComment']);

Route::group(['before' => 'admin'], function() {

	Route::get('/admin/', [
		'as' 	=> 'admin',
		'uses' 	=> 'AdminController@index'
	]);
	
	Route::get('/admin/all-posts/', [
		'as' 	=> 'admin-all-posts',
		'uses' 	=> 'AdminController@getAdminAllPosts'
	]);
	
	Route::get('/admin/all-comments/', [
		'as' 	=> 'admin-all-comments',
		'uses' 	=> 'AdminController@getAdminAllComments'
	]);
	
	Route::get('/admin/all-messages/', [
		'as' 	=> 'admin-all-messages',
		'uses' 	=> 'AdminController@getAdminAllMessages'
	]);
	
	Route::get('/admin/all-organizations/', [
		'as' 	=> 'admin-all-organizations',
		'uses' 	=> 'AdminController@getAdminAllOrganizations'
	]);
	
	Route::get('/admin/all-members/', [
		'as' 	=> 'admin-all-members',
		'uses' 	=> 'AdminController@getAdminAllMembers'
	]);

	#Deleting#
	Route::get('/admin/delete-post/{id}/', [
		'as' 	=> 'admin-delete-post/{id}', 
		'uses'	=> 'AdminController@AdminDeletePost'
	]);
	
	Route::get('/admin/delete-comment/{id}/', [
		'as' 	=> 'admin-delete-comment/{id}',
		'uses' 	=> 'AdminController@AdminDeleteComment'
	]);
	
	Route::get('/admin/delete-message/{id}/', [
		'as' 	=> 'admin-delete-message/{id}',
		'uses' 	=> 'AdminController@AdminDeleteMessage'
	]);
	
	Route::get('/admin/delete-organization/{id}/', [
		'as' 	=> 'admin-delete-organization/{id}',
		'uses' 	=> 'AdminController@AdminDeleteOrganization'
	]);
	
	Route::get('/admin/delete-member/{id}/', [
		'as' 	=> 'admin-delete-member/{id}',
		'uses' 	=> 'AdminController@AdminDeleteMember'
	]);

	Route::get('/admin/ban-member/{id}/', [
		'as' 	=> 'admin-ban-member/{id}',
		'uses' 	=> 'AdminController@AdminBanMember'
	]);

	Route::get('/admin/unban-member/{id}/', [
		'as' 	=> 'admin-unban-member/{id}',
		'uses' 	=> 'AdminController@AdminUnBanMember'
	]);
});