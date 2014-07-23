<?php

class UsersController extends \BaseController {

	public function PostRegister() {
		$data = Input::all();

		$rules = array(
			'username' 			=> 'required|min:3|max:18|alpha_dash',
			'email' 			=> 'required|email|unique:users',
			'password' 			=> 'required|min:6|max:18',
			'password_again' 	=> 'required|same:password',
			'school' 			=> 'required',
			'gender' 			=> 'required'
		);

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$user = Sentry::register(array(
				'email' 	=> Input::get('email'),
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password'),
				'school' 	=> Input::get('school'),
				'gender' 	=> Input::get('gender') ,
			));

			$profile = new Profile;
			$profile->user_id 			 = Sentry::getUser()->id;
			$profile->full_name 		 = Input::get('full_name');
			$profile->twitter_username 	 = Input::get('twitter_username');
			$profile->instagram_username = Input::get('instagram_username');
			$profile->facebook_username  = Input::get('facebook_username');
			$profile->bio 				 = Input::get('bio');
			$profile->save();

			Session::flash('message', 'Üyeliğiniz başarıyla gerçekleştirilmiştir. Giriş yapabilirsiniz.');
			return Redirect::route('login');
		} else {
			return Redirect::route('register')
			->withErrors($validator)
			->withInput();
		}
	}
	
	public function PostLogin() {
		$data = Input::all();

		$rules = [
			'email' 	=> 'required|email',
			'password'  => 'required|min:6|max:18'
		];

		$validator = Validator::make($data, $rules);

		if($validator->fails()) {
			return Redirect::route('login')
			->withErrors($validator)
			->withInput();
		} else {

			try {
				$credentials = [
					'email' 	=> Input::get('email'),
					'password' 	=> Input::get('password')
				];

				$user = Sentry::authenticate($credentials, false);

				} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
				return Redirect::route('home')
				->with(array('message' => 'Kimliğiniz geçici olarak askıya alınmıştır. Lütfen yönetici ile irtibata geçiniz.'));

				} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
				return Redirect::route('login')
				->with(array('message' => 'Şifre veya Eposta hatalı.'))->withInput();

				} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
				return Redirect::route('login')
				->with(array('message' => 'Kullanıcı bununamadı.'));

				} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
				return Redirect::route('login')
				->with(array('message' => 'Kullanıcı Banlanmış. Lütfen yönetici ile irtibata geçiniz.'));

			}	return Redirect::route('home'); 
		}
	}

	public function ShowProfile($username) {
		$user 		= User::with('profile')->whereUsername($username)->firstOrFail();

		$posts 		= Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->take(3)
							->get();

		$comments 	= Comment::orderBy('created_at', 'DESC')
							->where('commenter', '=', $username)
							->take(3)
							->get();
		
		return View::make('users.profile')
		->withUser($user)
		->with('posts', $posts)
		->with('comments', $comments);
	}

	public function EditProfile($username) {
		$user = User::whereUsername($username)->firstOrFail();
		return View::make('users.edit-profile')->withUser($user);
	}

	public function UpdateProfile($username) {
		$user = User::whereUsername($username)->firstOrFail();
		$data = Input::only('full_name', 'twitter_username', 'instagram_username', 'facebook_username', 'bio');

		$user->profile->fill($data)->save();

		Session::flash('message', 'Profiliniz başarıyla güncellenmiştir.');
		return Redirect::back();
	}
}