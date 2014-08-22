<?php

class PostsController extends \BaseController {

	public function sendPost() {
		$var = trim(Input::get('post_type'));
		
		if(empty($var)) {
			$data = Input::all();

			if(Auth::check()) {
				$username 	= Auth::user()->username;
				$gender 	= Auth::user()->profile->gender;

				$rules = [
					'dedikod' => 'required|min:5|max:800'
				];
			} else {
				$username 	= guest_username();
				$gender 	= Input::get('gender');

				$rules = [
					'gender' 	=> 'required',
					'dedikod'	=> 'required|min:5|max:800'
				];
			}

			$validator = Validator::make($data, $rules);

			if($validator->passes()) {
				$post = new Post;
				$post->username = $username;
				$post->gender 	= $gender;
				$post->dedikod 	= trim(Input::get('dedikod'));
				$post->type 	= 'dedikod';
				$post->save();

				Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
				return Redirect::route('home');
			} else {

			return Redirect::route('home')
			->withErrors($validator)
			->withInput();
			}
		} elseif(Input::get('post_type') == 'event') {
			$data = Input::all();

			$rules = [
			//gerekli kontroller eklenecek
				'dedikod' 		=> 'required|min:3|max:800',
				'event_name' 	=> 'required|min:5|max:50'
			];

			$validator = Validator::make($data, $rules);

			if($validator->passes()) {
				if(Input::hasFile('org_photo')) {
				$file            = Input::file('event_photo');
				$destinationPath = public_path().'/Organizations/';
				$filename        = Auth::user()->username.'_'.Hash::make($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
				$uploadSuccess   = $file->move($destinationPath, $filename);
			} else {
				$filename = 'default_org_photo';
			}

				$post = new Post;
				$post->username 			= Auth::user()->username;
				$post->gender 				= Auth::user()->profile->gender;
				$post->type 				= Input::get('post_type');
				$post->event_name 			= trim(Input::get('event_name'));
				$post->event_date 			= Input::get('event_date');
				$post->event_address 		= trim(Input::get('event_address'));
				$post->event_map 			= trim(Input::get('event_map'));
				$post->event_auth 			= trim(Input::get('event_auth'));
				$post->event_auth_contact 	= trim(Input::get('event_auth_contact'));
				$post->event_price 			= trim(Input::get('event_price'));
				$post->event_photo 			= $filename;
				$post->dedikod 				= trim(Input::get('dedikod'));
				$post->save();

				Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
				return Redirect::route('home');
			} else {
				//Validasyon hatalı döndüğünde etkinlik lightbox'ı açık ve doldurulan alanların dolu gelmesi gerek
				return Redirect::to('/?lightbox=false')
				->withErrors($validator)
				->withInput();
			}
		} elseif(Input::get('post_type') == 'video') {
			$data = Input::all();

			$rules = [
				'dedikod' 	=> 'required|min:5|max:800',
				'media' 	=> 'required'
			];

			$validator = Validator::make($data, $rules);

			if($validator->passes()) {
				$post = new Post;
				$post->username 	= Auth::user()->username;
				$post->gender 		= Auth::user()->profile->gender;
				$post->type 		= Input::get('post_type');
				$post->dedikod 		= trim(Input::get('dedikod'));
				$post->links 		= Input::get('media');
				$post->save();

				Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
				return Redirect::route('home');
			} else {
				return Redirect::route('home')
				->withErrors($validator)
				->withInput();
			}
		} elseif(Input::get('post_type') == 'image') {
			$data = Input::all();

			$rules = [
				'dedikod' 	=> 'required|min:5|max:800',
				'media' 	=> 'required'
			];

			$validator = Validator::make($data, $rules);

			if($validator->passes()) {
				$post = new Post;
				$post->username 	= Auth::user()->username;
				$post->gender 		= Auth::user()->profile->gender;
				$post->type 		= Input::get('post_type');
				$post->dedikod 		= trim(Input::get('dedikod'));
				$post->links 		= Input::get('media');
				$post->save();

				Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
				return Redirect::route('home');
			} else {
				return Redirect::route('home')
				->withErrors($validator)
				->withInput();
			}
		}
	}

	public function showPost($id) {
		try {
			$post = Post::where('id', '=', $id)->firstOrFail();
		} catch (Exception $e) {
			return View::make('errors.404');
		}

		if(Auth::check()) {
			$login_user = User::whereUsername(Auth::user()->username)->first();
		}

		$post_id 	= $post->id;
		$up 		= Up::where('post_id', '=', $post_id);
		$down 		= Down::where('post_id', '=', $post_id);
		$user 		= User::whereUsername($post->username)->first();

		$comments 	= Comment::orderBy('created_at', 'DESC')
							->where('post_id', '=', $id)
							->get();

		return View::make('posts.show-post', compact('post', 'comments', 'login_user', 'user', 'post_id', 'up', 'down'));
	}

	public function sendComment() {
		try {
			$post 	= Post::where('id', '=', Input::get('post_id'))->firstOrFail();
		} catch (Exception $e) {
			return View::make('errors.404');
		}

		$data = Input::all();

		if(Auth::check()) {
			$commenter = Auth::user()->username;
			$rules = [
					'comment' => 'required|min:5|max:800'
				];
		} else {
			$commenter = guest_username();
			$rules = [
					'comment' => 'required|min:5|max:800'
				];
		}

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$comment = new Comment;
			$comment->commenter 	= $commenter;
			$comment->post_id 		= Input::get('post_id');
			$comment->comment 		= trim(Input::get('comment'));
			$comment->save();

			Session::flash('message', 'Yorumunuz başarıyla gönderilmiştir!');
			return Redirect::back();

		} else {
			return Redirect::back()
			->withErrors($validator);
		}
	}
}