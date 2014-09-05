<?php

class UsersController extends \BaseController {

	public function postRegister() {
		
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
			$username 	= Input::get('username');
			$email 		= Input::get('email');
			$code 		= str_random(60);

			$user = new User;
			$user->username 		= $username;
			$user->email 			= $email;
			$user->password 		= Hash::make(Input::get('password'));
			$user->activation_code  = $code;
			$user->save();

			if(Input::hasFile('image')) {
				$file            = Input::file('image');
				$destinationPath = public_path().'/Avatars/';
				$filename        = $user->username. '.jpg';
				$uploadSuccess   = $file->move($destinationPath, $filename);
				} else {
				$filename = 'guest';
			}

			if(trim(Input::get('full_name')) == false) {
				$full_name = null;
				} else {
				$full_name = trim(Input::get('full_name'));
			}

			if(trim(Input::get('twitter')) == false) {
				$twitter = null;
				} else {
				$twitter = trim(Input::get('twitter'));
			}

			if(trim(Input::get('instagram')) == false) {
				$instagram = null;
				} else {
				$instagram = trim(Input::get('instagram'));
			}

			if(trim(Input::get('facebook')) == false) {
				$facebook = null;
				} else {
				$facebook = trim(Input::get('facebook'));
			}

			$profile = new Profile;
			$profile->user_id 	= $user->id;
			$profile->full_name = $full_name;
			$profile->twitter 	= $twitter;
			$profile->instagram = $instagram;
			$profile->facebook  = $facebook;
			$profile->school  	= Input::get('school');
			$profile->gender 	= Input::get('gender');
			$profile->avatar 	= $filename;
			$profile->image_number = str_random(22);
			$profile->save();

			Mail::send('emails.auth.account-activate', ['link'=> URL::route('account.activate', $code), 'username' => $username], function($message) use ($user) {
				$message->to($user->email, $user->username)->subject('Kantini - Hoşgeldiniz!');
			});

			Session::flash('message', 'Üyeliğiniz başarıyla gerçekleştirilmiştir. Lütfen eposta adresinizi kontrol ediniz ve üyeliğinizi aktifleştiriniz.');
			return Redirect::route('home');
			} else {
				return Redirect::route('user.register')
				->withErrors($validator)
				->withInput();
			}
	}

	public function accountActivate($code) {
		$user = User::where('activation_code', $code)->where('active', 0);

		if($user->count()) {
			$user = $user->first();

			$user->active = 1;
			$user->activation_code = null;

			if($user->save()) {
				return Redirect::route('home')->with('message', 'Üyeliğiniz başarıyla aktifleştirilmiştir.');
			}
		} else {
			return Redirect::route('home')->with('message', 'Üyeliğiniz aktifleştirilirken bir hata meydana geldi.');
		}
	}

	public function showProfile($username) {
		
		$user 				= User::whereUsername($username)->firstOrFail();
		$users_all_posts 	= Post::where('username', $username)->get();
		$users_all_comments = Comment::where('commenter', $username)->get();
		$users_all_votes 	= Vote::where('rater', $username)->get();

		return View::make('users.profile', compact('user', 'users_all_posts', 'users_all_comments', 'users_all_votes'));
	}

	public function EditProfile($username) {
		
		try {
			$user = User::whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return 'Kullanıcı bulunamadı';
		}

		return View::make('users.edit-profile')->withUser($user);
	}

	public function updateProfile($username) {

		try {
			$user = User::with('profile')->whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return 'Kullanıcı bulunamadı';
		}
		
		if(Auth::user()->username == $username) {
			if(Input::hasFile('image')) {
				$file            = Input::file('image');
				$destinationPath = public_path().'/Avatars/';
				$filename        = Auth::user()->username. '.jpg';
				$uploadSuccess   = $file->move($destinationPath, $filename);

				DB::table('profiles')
	            ->where('user_id', Auth::user()->id)
	            ->update(['avatar' => $filename]);
			}

			$data = Input::only('full_name', 'twitter', 'instagram', 'facebook');
		
			$user->profile->fill($data)->save();

			Session::flash('message', 'Profiliniz başarıyla güncellenmiştir.');
			return Redirect::back();
		} else {
			echo 'Sen hayırdır la BEBE! :)';
		}
	}

	public function changePassword() {

		$data = Input::all();

		$rules = [
			'current_password' 		=> 'required|min:6|max:18',
			'new_password' 			=> 'required|min:6|max:18',
			'new_password_again' 	=> 'required|same:new_password'
		];

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$user = Auth::user();
			$current_password = Input::get('current_password');

			if (strlen($current_password) > 0 && !Hash::check($current_password, $user->password)) {
	        	return Redirect::back()
	        	->withErrors('Please specify the good current password');
	    	}

	    	$new_password = Input::get('new_password');

	    	$user = Auth::user();
			$user->password = Hash::make($new_password);
			$user->save();

			Session::flash('message', 'Şifreniz başarıyla değiştirilmiştir.');
			return Redirect::back();
		} else {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}

	public function showUserAllPosts($username) {

		try {
			$user = User::whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		if (Input::has('type') && Input::has('orderBy')) {
			$type 		= $_GET['type'];
			$orderBy 	= $_GET['orderBy'];

			$users_all_posts = Post::where('username', $username)
								->where('type', $type)
								->orderBy('created_at', $orderBy)
								->where('flag', 'NO')
								->Paginate(36);

		} elseif (Input::has('orderBy')) {
			$orderBy = $_GET['orderBy'];

			$users_all_posts = Post::where('username', $username)
								->orderBy('created_at', $orderBy)
								->where('flag', 'NO')
								->Paginate(36);

		} elseif (Input::has('type')) {
			$type = $_GET['type'];

			$users_all_posts = Post::orderBy('created_at', 'DESC')
								->where('username', $username)
								->where('type', $type)
								->where('flag', 'NO')
								->Paginate(36);
			
		} else {
			$users_all_posts = Post::where('username', $username)
								->orderBy('created_at', 'DESC')
								->where('flag', 'NO')
								->Paginate(36);
		}

		return View::make('users.all-posts', compact('user', 'users_all_posts'));
	}

	public function showUserAllComments($username) {

		try {
			$user = User::whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		if (Input::has('type') && Input::has('orderBy')) {
			$type 		= $_GET['type'];
			$orderBy 	= $_GET['orderBy'];

			$users_all_comments = DB::table('comments')
									->leftjoin('posts', 'posts.id', '=', 'comments.post_id')
									->where('commenter', $username)
									->where('flag', 'NO')
									->where('type', $type)
									->groupBy('post_id')
									->orderBy('comment_created_at', $orderBy)
									->Paginate(36);

		} elseif (Input::has('orderBy')) {
			$orderBy = $_GET['orderBy'];

			$users_all_comments = DB::table('comments')
									->leftjoin('posts', 'posts.id', '=', 'comments.post_id')
									->where('commenter', $username)
									->where('flag', 'NO')
									->groupBy('post_id')
									->orderBy('comment_created_at', $orderBy)
									->Paginate(36);

		} elseif (Input::has('type')) {
			$type = $_GET['type'];

			$users_all_comments = DB::table('comments')
									->leftjoin('posts', 'posts.id', '=', 'comments.post_id')
									->where('commenter', $username)
									->where('flag', 'NO')
									->where('type', $type)
									->groupBy('post_id')
									->orderBy('comment_created_at', 'DESC')
									->Paginate(36);
			
		} else {
			$users_all_comments = DB::table('comments')
									->leftjoin('posts', 'posts.id', '=', 'comments.post_id')
									->where('commenter', $username)
									->where('flag', 'NO')
									->groupBy('post_id')
									->orderBy('comment_created_at', 'DESC')
									->Paginate(36);
		}

		return View::make('users.all-comments', compact('user', 'users_all_comments'));
	}

	public function showUserAllVotes($username) {

		try {
			$user = User::whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		if (Input::has('type') && Input::has('orderBy')) {
			$type 		= $_GET['type'];
			$orderBy 	= $_GET['orderBy'];

			$users_all_votes = DB::table('votes')
									->leftjoin('posts', 'posts.id', '=', 'votes.post_id')
									->where('rater', $username)
									->where('flag', 'NO')
									->where('type', $type)
									->groupBy('post_id')
									->orderBy('vote_created_at', $orderBy)
									->Paginate(36);

		} elseif (Input::has('orderBy')) {
			$orderBy = $_GET['orderBy'];

			$users_all_votes = DB::table('votes')
									->leftjoin('posts', 'posts.id', '=', 'votes.post_id')
									->where('rater', $username)
									->where('flag', 'NO')
									->groupBy('post_id')
									->orderBy('vote_created_at', $orderBy)
									->Paginate(36);

		} elseif (Input::has('type')) {
			$type = $_GET['type'];

			$users_all_votes = DB::table('votes')
									->leftjoin('posts', 'posts.id', '=', 'votes.post_id')
									->where('rater', $username)
									->where('flag', 'NO')
									->where('type', $type)
									->groupBy('post_id')
									->orderBy('vote_created_at', 'DESC')
									->Paginate(36);
			
		} else {
			$users_all_votes = DB::table('votes')
									->leftjoin('posts', 'posts.id', '=', 'votes.post_id')
									->where('rater', $username)
									->where('flag', 'NO')
									->groupBy('post_id')
									->orderBy('vote_created_at', 'DESC')
									->Paginate(36);
		}

		return View::make('users.all-rates', compact('user', 'users_all_votes'));
	}
}
