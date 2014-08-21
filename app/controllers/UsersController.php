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
			$user = new User;
			$user->username 		= Input::get('username');
			$user->email 			= Input::get('email');
			$user->password 		= Hash::make(Input::get('password'));
			$user->activation_code  = str_random(60);
			$user->save();

			if(Input::hasFile('image')) {
				$file            = Input::file('image');
				$destinationPath = public_path().'/Avatars/';
				$filename        = $user->username. '.jpg';
				$uploadSuccess   = $file->move($destinationPath, $filename);
				} else {
					$filename = 'guest';
			}

			$full_name 	= (!empty(Input::get('full_name'))) ? trim(Input::get('full_name')) : null;
			$twitter 	= (!empty(Input::get('twitter'))) ? trim(Input::get('twitter')) : null;
			$instagram  = (!empty(Input::get('instagram'))) ? trim(Input::get('instagram')) : null;
			$facebook 	= (!empty(Input::get('facebook'))) ? trim(Input::get('facebook')) : null;

			$profile = new Profile;
			$profile->user_id 	= $user->id;
			$profile->full_name = $full_name;
			$profile->twitter 	= $twitter;
			$profile->instagram = $instagram;
			$profile->facebook  = $facebook;
			$profile->school  	= Input::get('school');
			$profile->gender 	= Input::get('gender');
			$profile->avatar 	= $filename;
			$profile->save();

			Session::flash('message', 'Üyeliğiniz başarıyla gerçekleştirilmiştir. Giriş yapabilirsiniz.');
			return Redirect::route('home');
			} else {
				return Redirect::route('user.register')
				->withErrors($validator)
				->withInput();
			}
	}

	public function showProfile($username) {
		
		$user = User::whereUsername($username)->firstOrFail();
		$users_all_posts = Post::where('username', '=', $username)->get();
		$users_all_comments = Comment::where('commenter', '=', $username)->get();

		return View::make('users.profile', compact('user', 'users_all_posts', 'users_all_comments'));
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

		$users_all_posts = Post::orderBy('created_at', 'DESC')
								->where('username', '=', $username)
								->orderBy('created_at', 'DESC')
								->simplePaginate(36);

		return View::make('users.all-posts', compact('user', 'users_all_posts'));
	}

	public function showUserAllComments($username) {

		try {
			$user = User::whereUsername($username)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		$users_all_comments = Comment::where('commenter', '=', $username)
										->groupBy('post_id')
										->orderBy('created_at', 'DESC')
										->simplePaginate(36);

		return View::make('users.all-comments', compact('user', 'users_all_comments'));
	}

}
