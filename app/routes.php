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

	Route::post('edit-post/{id}', 'PostsController@editPost');

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
	
	// resim upload için kullanılacak fonksiyon.
	// yalnız 'image' değişkeni dışında formdan hiç bir data post olmuyor.
	// kontrolleri sağlanırsa memnun olurum sn. Bora Dan (:
	// Formda ki datatype kısmı lazım bana.
	Route::post('event-image-upload', function() {

		if(Input::get('imagetype') == 'event') {

			$data = Input::get('image');

			list($type, $data) = explode(';', $data);
			list(, $data)      = explode(',', $data);
			$data = base64_decode($data);

			file_put_contents(public_path().'/Events/'.imageNumber().'.jpg', $data);

			$img = Image::make('Events/'.imageNumber().'.jpg');
			$img->fit(100);
			$img->save('Events/sm-events/sm-'.imageNumber().'.jpg');

			return HTML::image('/Events/sm-events/sm-'.imageNumber().'.jpg');

		} elseif(Input::get('imagetype') == 'mediaFromPc') {
			
			$data = Input::get('image');

			list($type, $data) = explode(';', $data);
			list(, $data)      = explode(',', $data);
			$data = base64_decode($data);

			file_put_contents(public_path().'/images/'.imageNumber().'.jpg', $data);

			$img = Image::make('images/'.imageNumber().'.jpg');
			$img->fit(100);
			$img->save('images/sm-images/sm-'.imageNumber().'.jpg');

			return HTML::image('/images/sm-images/sm-'.imageNumber().'.jpg');
		}		

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

Route::get('all-uni', function()
{
	return View::make('pages.all-uni');
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

Route::get('user/profile/{username}/all-votes', [
	'as' 	=> 'user.all.votes',
	'uses' 	=> 'UsersController@showUserAllVotes'
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
