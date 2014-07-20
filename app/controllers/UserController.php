<?php

class UserController extends BaseController {

	public function getRegister() {
		return View::make('pages.user.register');
	}

	public function postRegister() {
		$data = Input::all();

		$rules = [
			'username' 		 => 'required|min:3|max:15|alpha_dash',
			'email' 		 => 'required|email|unique:users',
			'password'		 => 'required|min:6|max:18',
			'password_again' => 'required|same:password',
			'school'		 => 'required',
			'gender' 		 => 'required',
		];

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$user = Sentry::register([
				'username' 	=> Input::get('username'),
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password'),
				'school' 	=> Input::get('school'),
				'gender' 	=> Input::get('gender'),
				'activated' => '1'
			]);

			$profile = new Profile;
			$profile->user_id = Sentry::getUser()->id;
			$profile->first_name = Input::get('first_name');
			$profile->last_name = Input::get('last_name');
			$profile->twitter_username = Input::get('twitter_username');
			$profile->instagram_username = Input::get('instagram_username');
			$profile->bio = Input::get('bio');
			$profile->save();

			/*
			$destinationPath = '';
    		$filename        = '';

    		
		    if (Input::hasFile('image')) {
		        $file            = Input::file('image');
		        $destinationPath = public_path().'/avatars/';
		        $filename        = Sentry::getUser()->id . '_' . $file->getClientOriginalName();
		        $uploadSuccess   = $file->move($destinationPath, $filename);
		    }
		    */

			//$activationCode = $user->getActivationCode();

			Session::flash('message', 'Üyeliğiniz başarıyla gerçekleştirilmiştir.');
			return Redirect::route('user-login');
		} else {

		return Redirect::route('user-register')
		->withErrors($validator)
		->withInput();
		}
	}

	public function getLogin() {
		return View::make('pages.user.login');
	}

	public function postLogin() {

		$data = Input::all();

		$rules = [
			'email' 	=> 'required|email',
			'password'  => 'required|min:6|max:18'
		];

		$validator = Validator::make($data, $rules);

		if($validator->fails()) {
			return Redirect::route('user-login')
			->withErrors($validator)
			->withInput();
		} else {

			try {
				$credentials = [
					'email' 	=> Input::get('email'),
					'password' 	=> Input::get('password')
				];

				$user = Sentry::authenticate($credentials, false);

				} catch (Cartalyst\Sentry\Users\UserSuspendedException $e) {
				return Redirect::route('home')
				->with(array('message-3' => 'Kimliğiniz geçici olarak askıya alınmıştır. Lütfen yönetici ile irtibata geçiniz.'));

				} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
				return Redirect::route('user-login')
				->with(array('message-2' => 'Şifre veya Eposta hatalı.'))->withInput();

				} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
				return Redirect::route('user-login')
				->with(array('message-1' => 'Kullanıcı bununamadı.'));

				} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
				return Redirect::route('user-login')
				->with(array('message-4' => 'Kullanıcı Banlanmış. Lütfen yönetici ile irtibata geçiniz.'));

			}	return Redirect::route('home'); 
		}
	}

	public function Logout() {
		Sentry::logout();
		Session::flash('message', 'Çıkış yaptınız.');
		return Redirect::route('home');
	}

	public function showProfile($username) {

		$posts 		= Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->take(3)
							->get();

		$posts_all 	= Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->get();

		$comments 		= Comment::orderBy('created_at', 'DESC')
							->where('comment_username', '=', $username)
							->take(3)
							->get();

		$comments_all 	= Comment::orderBy('created_at', 'DESC')
							->where('comment_username', '=', $username)
							->get();

		$organizations_all 	= Organization::orderBy('created_at', 'DESC')
							->where('creator_username', '=', $username)
							->get();

		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}
		
		return View::make('pages.user.profile')
		->withUser($user)
		->with('posts', $posts)
		->with('posts_all', $posts_all)
		->with('comments', $comments)
		->with('comments_all', $comments_all)
		->with('organizations_all', $organizations_all);
	}

	public function getUserAllPosts($username) {

		$posts_all 	= Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->get();				

		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}
		
		return View::make('pages.user.all-posts')
		->withUser($user)
		->with('posts_all', $posts_all);
	}

	public function getUserAllComments($username) {

		$comments_all 	= Comment::orderBy('created_at', 'DESC')
							->where('comment_username', '=', $username)
							->get();				

		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}
		
		return View::make('pages.user.all-comments')
		->withUser($user)
		->with('comments_all', $comments_all);
	}

	public function getUserAllOrganizations($username) {

		$organizations_all 	= Organization::orderBy('created_at', 'DESC')
							->where('creator_username', '=', $username)
							->get();				

		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}
		
		return View::make('pages.user.all-organizations')
		->withUser($user)
		->with('organizations_all', $organizations_all);
	}

	public function editProfile($username) {

		$user = User::whereUsername($username)->firstOrFail();
		return View::make('pages.user.edit-profile')->withUser($user);
	}

	public function updateProfile($username) {
		$user = User::whereUsername($username)->firstOrFail();
		$data = Input::only('first_name', 'last_name', 'bio', 'twitter_username', 'instagram_username');

		$user->profile->fill($data)->save();

		Session::flash('message', 'Profiliniz başarıyla güncellenmiştir.');
		return Redirect::back();
	}

	public function postCreateOrganization() {
		$data = Input::all();

		$rules = [
			'organization-name'  		 => 'required|min:5|max:60',
			'organization-date'  		 => 'required',
			'organization-place' 		 => 'required|min:5|max:60',
			'organization-auth'  		 => 'required|min:5|max:60',
			'organization-auth-contact'  => 'required|min:5|max:60',
			'organization-price' 		 => 'required|numeric',
			'organization-message'  	 => 'required|min:5|max:150',
		];

		$validator = Validator::make($data, $rules);
		
		if($validator->passes()) {
			$organization = new Organization;
			$organization->creator_username 	= Sentry::getUser()->username;
			$organization->name 				= Input::get('organization-name');
			$organization->organization_date 	= Input::get('organization-date');
			$organization->place 				= Input::get('organization-place');
			$organization->auth 				= Input::get('organization-auth');
			$organization->auth_contact 		= Input::get('organization-auth-contact');
			$organization->price 				= Input::get('organization-price');
			$organization->message 				= Input::get('organization-message');
			$organization->save();

			Session::flash('message', 'Etkinliğiniz başarıyla oluşturulmuştur.');
			return Redirect::route('organization');

		} else {
			return Redirect::back()
			->withErrors($validator);
		}
	}
}