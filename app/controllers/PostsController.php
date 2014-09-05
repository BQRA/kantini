
<?php

class PostsController extends \BaseController {

	public function sendPost() {
		
		if(Input::has('school')) {
			$school = Input::get('school');
		} else {
			$school = null;
		}

		$var = trim(Input::get('post_type'));
		
		if(empty($var)) {
			$data = Input::all();

			if(Auth::check()) {
				$username 	= Auth::user()->username;
				$user_id 	= Auth::user()->id;
				$anonymous 	= 0;
				$gender 	= Auth::user()->profile->gender;

				$rules = [
					'dedikod' => 'required|min:5|max:800'
				];
			} else {
				$username 	= guest_username();
				$user_id 	= null;
				$anonymous 	= 1;
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
				$post->user_id  = $user_id;
				$post->anonymous = $anonymous;
				$post->gender 	= $gender;
				$post->dedikod 	= trim(Input::get('dedikod'));
				$post->type 	= 'dedikod';
				$post->school 	= $school;
				$post->save();

				Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
				return Redirect::back();
			} else {

			return Redirect::back()
			->withErrors($validator)
			->withInput();
			}
		} elseif(Input::get('post_type') == 'event') {
			$data = Input::all();

			$rules = [
			//gerekli kontroller eklenecek
				//'dedikod' 		=> 'required|min:3|max:800',
				//'event_name' 	=> 'required|min:5|max:50',
				//'event_date'	=> 'required',
				//'event_auth' 	=> 'required|alpha_dash',
				//'event_auth_contact' => 'required|numeric',
			];

			$validator = Validator::make($data, $rules);

			if($validator->passes()) {

				$date 		= Input::get('event_date');
				$timestamp 	= date('Y-m-d', strtotime($date));
				$filename 	= 'default_event_image.png';

				$post = new Post;
				$post->username 			= Auth::user()->username;
				$post->user_id  			= Auth::user()->id;
				$post->anonymous 			= 0;
				$post->gender 				= Auth::user()->profile->gender;
				$post->type 				= Input::get('post_type');
				$post->event_name 			= trim(Input::get('event_name'));
				$post->event_date 			= $timestamp;
				$post->event_address 		= trim(Input::get('event_address'));
				$post->event_map 			= trim(Input::get('event_map'));
				$post->event_auth 			= trim(Input::get('event_auth'));
				$post->event_auth_contact 	= trim(Input::get('event_auth_contact'));
				$post->event_price 			= trim(Input::get('event_price'));
				$post->event_photo 			= $filename;
				$post->dedikod 				= trim(Input::get('dedikod'));
				$post->save();

				if(Auth::check()) {
					$image_number = Profile::find(Auth::user()->id);
					$image_number->image_number = str_random(22);
					$image_number->save();
				}

				Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
				return Redirect::back();
			} else {
				//Validasyon hatalı döndüğünde etkinlik lightbox'ı açık ve doldurulan alanların dolu gelmesi gerek
				return Redirect::to('/')
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
				$post->user_id  	= Auth::user()->id;
				$post->anonymous 	= 0;
				$post->gender 		= Auth::user()->profile->gender;
				$post->type 		= Input::get('post_type');
				$post->dedikod 		= trim(Input::get('dedikod'));
				$post->links 		= Input::get('media');
				$post->save();

				Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
				return Redirect::back();
			} else {
				return Redirect::back()
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
				$post->user_id  	= Auth::user()->id;
				$post->anonymous 	= 0;
				$post->gender 		= Auth::user()->profile->gender;
				$post->type 		= Input::get('post_type');
				$post->dedikod 		= trim(Input::get('dedikod'));
				$post->links 		= Input::get('media');
				$post->save();

				if(Auth::check()) {
					$image_number = Profile::find(Auth::user()->id);
					$image_number->image_number = str_random(22);
					$image_number->save();
				}

				Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
				return Redirect::back();
			} else {
				return Redirect::back()
				->withErrors($validator)
				->withInput();
			}
		}
	}

	public function showPost($id) {
		try {
			$post = Post::where('id', $id)->firstOrFail();
		} catch (Exception $e) {
			return View::make('errors.404');
		}

		$post_id 	= $post->id;
		$user 		= User::whereUsername($post->username)->first();

		$comments 	= Comment::orderBy('created_at', 'DESC')
							->where('post_id', $id)
							->get();

		return View::make('posts.show-post', compact('post', 'comments', 'user', 'post_id'));
	}

	public function sendComment($id) {
		try {
			$post = Post::select('id')->where('id', $id)->firstOrFail();
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
			$comment->post_id 		= $id;
			$comment->comment 		= trim(Input::get('comment'));
			$comment->save();

			$comments = Comment::select('post_id')->where('post_id', $id)->get();
			$comments_count = $comments->count();

			$post = Post::find($id);
			$post->comments_count = $comments_count;
			$post->save();

			/*
			$user = User::whereUsername($post->username)->first();
			
			if(!empty($user)) {
				//geliştirelecek!!!
				Mail::send('emails.auth.comment', ['link'=> URL::route('show.post', $id)], function($message) use ($user) {
					$message->to($user->email)->subject('Kantini - Cevap!');
				});
			}
			*/

			$date = Comment::find($comment->id);
			$comment_date = $date->created_at;
			return $comment_date;

		} else {
			return Redirect::back()
			->withErrors($validator);
		}
	}

	public function userDeleteDedikod($id) {

		Post::find($id)->delete();
		Comment::wherePost_id($id)->delete();
		Vote::wherePost_id($id)->delete();

		return Redirect::back()->with('message', 'Gönderiniz başarıyla silinmiştir.');
	}
}
