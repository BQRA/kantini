
<?php

class PostsController extends \BaseController {

	public function sendPost() {
		
		if(Input::has('school')) {
			$school = Input::get('school');
		} else {
			$school = 'kantini';
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

				$record = new Record;
				$record->post_id = $post->id;
				$record->ip_address = get_client_ip();
				$record->save();

				/*
				if(Spam::whereIp_address(get_client_ip())->count() > 0 ) {
					
					$now = strtotime(Carbon::now());
					
					$spam = Spam::where('ip_address', get_client_ip())->first();
					$DB_time = strtotime($spam->created_at);

					$diff = round(abs($now - $DB_time) / 60*60);
					$count_spam = $spam->count_spam;

						if($count_spam > 2) {
							$records = Record::where('ip_address', get_client_ip())->lists('post_id');
							Post::destroy($records);
							return 'Spam dedikod göndermeye utanmıyor musun?';
						} else {
							if($diff < 181) {
							$new_count_spam = $count_spam + 1;

							DB::table('spam_dedikod_controls')
					            ->where('ip_address', get_client_ip())
					            ->update(['count_spam' => $new_count_spam]);
							}
						}

				} else {

					$spam = new Spam;
					$spam->ip_address = get_client_ip();
					$spam->save();
				}
				*/
				
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
				'dedikod' 		=> 'required|min:5|max:800',
				'event_name' 	=> 'required|min:5|max:50',
				'event_date'	=> 'required',
				'event_auth' 	=> 'required',
				'event_price'	=> 'required',
				'event_auth_contact' => 'numeric'
			];

			$validator = Validator::make($data, $rules);

			if($validator->passes()) {

				if(trim(Input::get('event_time')) == false) {
					$event_time = null;
					} else {
					$event_time = trim(Input::get('event_time'));
				}

				if(trim(Input::get('event_address')) == false) {
					$event_address = null;
					} else {
					$event_address = trim(Input::get('event_address'));
				}

				if(trim(Input::get('event_map')) == false) {
					$event_map = null;
					} else {
					$event_map = trim(Input::get('event_map'));
				}

				if(trim(Input::get('event_auth_contact')) == false) {
					$event_auth_contact = null;
					} else {
					$event_auth_contact = trim(Input::get('event_auth_contact'));
				}

				$date 		= Input::get('event_date');
				$timestamp 	= date('Y-m-d', strtotime($date));

				$post = new Post;
				$post->username 			= Auth::user()->username;
				$post->user_id  			= Auth::user()->id;
				$post->anonymous 			= 0;
				$post->gender 				= Auth::user()->profile->gender;
				$post->type 				= Input::get('post_type');
				$post->event_name 			= trim(Input::get('event_name'));
				$post->event_date 			= $timestamp;
				$post->event_time 			= $event_time;
				$post->event_address 		= $event_address;
				$post->event_map 			= $event_map;
				$post->event_auth 			= trim(Input::get('event_auth'));
				$post->event_auth_contact 	= $event_auth_contact;
				$post->event_price 			= trim(Input::get('event_price'));
				$post->event_photo 			= imageNumber();
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
		
		$user = User::whereUsername($post->username)->first();
		$uni  = School::select('school_name', 'school_fullname')->where('school_name', $post->school)->first();

		$comments = Comment::orderBy('created_at', 'DESC')
							->where('post_id', $id)
							->get();

		return View::make('posts.show-post', compact('post', 'comments', 'user', 'uni'));
	}

	public function editPost($id) {
		try {
			$post = Post::where('id', $id)->firstOrFail();
		} catch (Exception $e) {
			return View::make('errors.404');
		}

		if(Auth::user()->username == $post->username) {
			$data = Input::get('edit-dedikod');

			$rules = [
				'edit-dedikod' => 'required|min:5|max:800'
			];

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->passes()) {
				$post = Post::find($id);
				$post->dedikod = $data;
				$post->save();

				return Redirect::back();
			} else {
				return Redirect::back()
				->withErrors($validator);
			}
		} else {
			return 'sen hayirdir la!';
		}
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
				//Commenter'la dedikod'u gönderen kişi aynı ise mail gönderme

				Mail::send('emails.auth.comment', ['link'=> URL::route('show.post', $id)], function($message) use ($user) {
					$message->to($user->email)->subject('Kantini - Cevap!');
				});
			}
			*/

			$date = Comment::find($comment->id);
			$comment_date = $date->created_at->diffForHumans();
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
		Flag::wherePost_id($id)->delete();

		return Redirect::back()->with('message', 'Gönderiniz başarıyla silinmiştir.');
	}
}
