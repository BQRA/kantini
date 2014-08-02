<?php

class UsersController extends \BaseController {

	public function PostRegister() {
		$data = Input::all();

		$rules = [
			'username' 			=> 'required|min:3|max:18|alpha_dash|unique:users',
			'email' 			=> 'required|email|unique:users',
			'password' 			=> 'required|min:6|max:18',
			'password_again' 	=> 'required|same:password',
			'school' 			=> 'required',
			'gender' 			=> 'required'
		];

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$user = Sentry::register([
				'email' 	=> Input::get('email'),
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password'),
				'school' 	=> Input::get('school'),
				'gender' 	=> Input::get('gender') ,
			]);

			if(Input::hasFile('image')) {
				$file            = Input::file('image');
			    $destinationPath = public_path().'/Avatars/';
			    $filename        = Sentry::getUser()->username. '.jpg';
			    $uploadSuccess   = $file->move($destinationPath, $filename);
				} else {
					$filename = 'guest';
			}

			if(empty(trim(Input::get('full_name')))) {
				$full_name = null;
				} else {
				$full_name = trim(Input::get('full_name'));
			}

			if(empty(trim(Input::get('twitter_username')))) {
				$twitter_username = null;
				} else {
				$twitter_username = trim(Input::get('twitter_username'));
			}

			if(empty(trim(Input::get('instagram_username')))) {
				$instagram_username = null;
				} else {
				$instagram_username = trim(Input::get('instagram_username'));
			}

			if(empty(trim(Input::get('facebook_username')))) {
				$facebook_username = null;
				} else {
				$facebook_username = trim(Input::get('facebook_username'));
			}

			$profile = new Profile;
			$profile->user_id 			 = Sentry::getUser()->id;
			$profile->full_name 		 = $full_name;
			$profile->twitter_username 	 = $twitter_username;
			$profile->instagram_username = $instagram_username;
			$profile->facebook_username  = $facebook_username;
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
				->with(['message' => 'Kimliğiniz geçici olarak askıya alınmıştır. Lütfen yönetici ile irtibata geçiniz.']);

				} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
				return Redirect::back()
				->with(['message' => 'Şifre veya Eposta hatalı.'])->withInput();

				} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
				return Redirect::back()
				->with(['message' => 'Kullanıcı bununamadı.']);

				} catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
				return Redirect::back()
				->with(['message' => 'Kullanıcı Banlanmış. Lütfen yönetici ile irtibata geçiniz.']);

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
	            ->update(['avatar' => $filename]);
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

		if(empty($_GET['sort'])) {
			if(empty($_GET['orderBy'])) {
				$posts_all 	= Post::orderBy('created_at', 'DESC')
								->where('username', '=', $username)
								->get();
			} else {
				if($_GET['orderBy']) {
					$posts_all 	= Post::orderBy('created_at', $_GET['orderBy'])
									->where('username', '=', $username)
									->get();
				} else {
					$posts_all 	= Post::orderBy('created_at', $_GET['orderBy'])
									->where('username', '=', $username)
									->get();
				}
			}
		} else {
			if($_GET['sort'] == 'dedikods') {
				$posts_all 	= Post::orderBy('created_at', 'DESC')
								->where('username', '=', $username)
								->where('type', '=', '0')
								->get();
			} elseif($_GET['sort'] == 'organizations') {
				$posts_all 	= Post::orderBy('created_at', 'DESC')
								->where('username', '=', $username)
								->where('type', '=', '1')
								->get();
			} elseif($_GET['sort'] == 'photos') {
				$posts_all 	= Post::orderBy('created_at', 'DESC')
								->where('username', '=', $username)
								->where('type', '=', '2')
								->get();
			} elseif($_GET['sort'] == 'videos') {
				$posts_all 	= Post::orderBy('created_at', 'DESC')
								->where('username', '=', $username)
								->where('type', '=', '3')
								->get();
			} else {
				$posts_all 	= Post::orderBy('created_at', 'DESC')
								->where('username', '=', $username)
								->get();
			}
		}
		
		return View::make('users.all-posts')
		->withUser($user)
		->with('posts_all', $posts_all);
	}

	public function ShowUserAllComments($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		if(empty($_GET['orderBy'])) {
			$comments 	= Comment::orderBy('created_at', 'DESC')
							->where('commenter', '=', $username)
							->get();
		} else {
			if($_GET['orderBy']) {
				$comments 	= Comment::orderBy('created_at', $_GET['orderBy'])
								->where('commenter', '=', $username)
								->get();
			} else {
				$comments 	= Comment::orderBy('created_at', $_GET['orderBy'])
								->where('commenter', '=', $username)
								->get();
			}
		}
		
		return View::make('users.all-comments')
		->withUser($user)
		->with('comments', $comments);
	}

	public function ShowUserAllLikes($username) {
		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		if(empty($_GET['orderBy'])) {
			$likes = Like::orderBy('created_at', 'DESC')
						->where('liker', '=', $username)
						->get();
		} else {
			if($_GET['orderBy']) {
				$likes = Like::orderBy('created_at', $_GET['orderBy'])
						->where('liker', '=', $username)
						->get();
			} else {
				$likes = Like::orderBy('created_at', $_GET['orderBy'])
						->where('liker', '=', $username)
						->get();
			}
		}
		
		return View::make('users.all-likes')
		->withUser($user)
		->with('likes', $likes);
	}
}
