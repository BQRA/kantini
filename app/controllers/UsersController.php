<?php

class UsersController extends \BaseController {

	public function PostRegister() {
		$data = Input::all();

		$rules = array(
			'username' 			=> 'required|min:3|max:18|alpha_dash|unique:users',
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

			if(Input::hasFile('image')) {
				$file            = Input::file('image');
			    $destinationPath = public_path().'/Avatars/';
			    $filename        = Sentry::getUser()->username. '.jpg';
			    $uploadSuccess   = $file->move($destinationPath, $filename);
			} else {
				$filename = 'guest';
			}

			$profile = new Profile;
			$profile->user_id 			 = Sentry::getUser()->id;
			$profile->full_name 		 = Input::get('full_name');
			$profile->twitter_username 	 = Input::get('twitter_username');
			$profile->instagram_username = Input::get('instagram_username');
			$profile->facebook_username  = Input::get('facebook_username');
			$profile->Avatar 			 = $filename;
			$profile->save();

			Session::flash('message', 'Üyeliğiniz başarıyla gerçekleştirilmiştir. Giriş yapabilirsiniz.');
			return Redirect::route('home');
		} else {
			return Redirect::route('register')
			->withErrors($validator)
			->withInput();
		}
	}
	
	public function PostLogin() {
		$data = Input::all();

		$rules = [
			'username' 	=> 'required',
			'password'  => 'required|min:6|max:18'
		];

		$validator = Validator::make($data, $rules);

		if($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		} else {

			try {
				$credentials = [
					'username' 	=> Input::get('username'),
					'password' 	=> Input::get('password')
				];

				$user = Sentry::authenticate($credentials, false);

				} catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
				return Redirect::route('home')
				->with(array('message' => 'Kimliğiniz geçici olarak askıya alınmıştır. Lütfen yönetici ile irtibata geçiniz.'));

				} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
				return Redirect::back()
				->with(array('message' => 'Şifre veya Eposta hatalı.'))->withInput();

				} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
				return Redirect::back()
				->with(array('message' => 'Kullanıcı bununamadı.'));

				} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
				return Redirect::back()
				->with(array('message' => 'Kullanıcı Banlanmış. Lütfen yönetici ile irtibata geçiniz.'));

			}	return Redirect::back(); 
		}
	}

	public function ShowProfile($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}
		
		$posts_all  = Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->where('type', '=', '0')
							->get();

		$orgs_all 	= Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->where('type', '=', '1')
							->get();

		$comments_all = Comment::orderBy('created_at', 'DESC')
							->where('commenter', '=', $username)
							->get();

		$likes  	 = Like::orderBy('created_at', 'DESC')
							->where('liker', '=', $username)
							->get();
		
		return View::make('users.profile')
		->withUser($user)
		->with('posts_all', $posts_all)
		->with('orgs_all', $orgs_all)
		->with('comments_all', $comments_all)
		->with('likes', $likes);
	}

	public function EditProfile($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}
		return View::make('users.edit-profile')->withUser($user);
	}

	public function UpdateProfile($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}
		
		if(Sentry::getUser()->username == $username) {
			if(Input::hasFile('image')) {
				$file            = Input::file('image');
				$destinationPath = public_path().'/Avatars/';
				$filename        = Sentry::getUser()->username. '.jpg';
				$uploadSuccess   = $file->move($destinationPath, $filename);

				DB::table('profiles')
	            ->where('user_id', Sentry::getUser()->id)
	            ->update(array('avatar' => $filename));
			}

			$data = Input::only('full_name', 'twitter_username', 'instagram_username', 'facebook_username');
			
			$user->profile->fill($data)->save();

			Session::flash('message', 'Profiliniz başarıyla güncellenmiştir.');
			return Redirect::back();
		} else {
			echo 'Sen hayırdır la BEBE! :)';
		}
	}

	public function ShowUserAllPosts($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		$posts_all 		= Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->get();

		$comments_all 	= Comment::orderBy('created_at', 'DESC')
							->where('commenter', '=', $username)
							->get();

		$likes 			= Like::orderBy('created_at', 'DESC')
							->where('liker', '=', $username)
							->get();
		
		return View::make('users.all-posts')
		->withUser($user)
		->with('posts_all', $posts_all)
		->with('comments_all', $comments_all)
		->with('likes', $likes);
	}

	public function ShowUserAllComments($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		$posts_all 		= Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->get();

		$comments_all 	= Comment::orderBy('created_at', 'DESC')
							->where('commenter', '=', $username)
							->get();

		$likes 			= Like::orderBy('created_at', 'DESC')
							->where('liker', '=', $username)
							->get();
		
		return View::make('users.all-comments')
		->withUser($user)
		->with('posts_all', $posts_all)
		->with('comments_all', $comments_all)
		->with('likes', $likes);
	}

	public function ShowUserAllOrganizations($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		$orgs_all = Post::orderBy('created_at', 'DESC')
							->where('username', '=', $username)
							->where('type', '=', '1')
							->get();
		
		return View::make('users.all-organizations')
		->withUser($user)
		->with('orgs_all', $orgs_all);
	}

	public function ShowUserAllLikes($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		$likes = Like::orderBy('created_at', 'DESC')
							->where('liker', '=', $username)
							->get();
		
		return View::make('users.all-likes')
		->withUser($user)
		->with('likes', $likes);
	}
}
