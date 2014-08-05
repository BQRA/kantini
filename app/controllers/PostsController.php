<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostsController extends \BaseController {

	public function SendPost() {
		$data = Input::all();

			if(!Sentry::check()) {
				$username 	= guest_username();
				$member 	= '0';
				$gender 	= Input::get('gender');
					$rules = [
						'gender' 	=> 'required',
						'post'		=> 'required|min:5|max:800'
					];
			} else {
				$username 	= Sentry::getUser()->username;
				$member		= '1';
				$gender 	= Sentry::getUser()->gender;

				$rules = [
						'post'		=> 'required|min:5|max:800'
				];
			}

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$post = new Post;
			$post->username = $username;
			$post->gender 	= $gender;
			$post->post 	= trim(Input::get('post'));
			$post->member 	= $member;
			$post->type 	= 'dedikod';
			$post->save();

			Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
			return Redirect::route('home');
		} else {

		return Redirect::route('home')
		->withErrors($validator)
		->withInput();
		}
	}

	public function CreateOrganization() {
		$data = Input::all();

		$rules = [
			'org_name' => 'required'
		];

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$file            = Input::file('org_photo');
			$destinationPath = public_path().'/Organizations/';
			$filename        = Sentry::getUser()->username.'_'.Hash::make($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
			$uploadSuccess   = $file->move($destinationPath, $filename);
			
			$post = new Post;
			$post->username 	= Sentry::getUser()->username;
			$post->gender 		= Sentry::getUser()->gender;
			$post->member 		= '1';
			$post->type 		= 'event';
			$post->org_name 	= trim(Input::get('org_name'));
			$post->org_date 	= trim(Input::get('org_date'));
			$post->org_address 	= trim(Input::get('org_address'));
			$post->org_map	 	= trim(Input::get('org_map'));
			$post->org_auth 	= trim(Input::get('org_auth'));
			$post->org_auth_contact = trim(Input::get('org_auth_contact'));
			$post->org_price 	= trim(Input::get('org_price'));
			$post->org_message 	= trim(Input::get('org_message'));
			$post->org_photo    = $filename;
			$post->save();

			Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
			return Redirect::route('home');
		} else {
			return Redirect::to('/?lightbox=false')
			->withErrors($validator)
			->withInput();
		}
	}

	public function SendComment() {
		try {
			$post_id	= Input::get('post_id');
			$post 		= Post::where('id', '=', $post_id)->firstOrFail();
		} catch (Exception $e) {
			return View::make('errors.404');
		}

		$data = Input::all();

		if(!Sentry::check()) {
			$commenter 	= guest_username();
			$gender 	= null;
			$member 	= '0';
			$type  		= null;
				$rules = [
					'comment' => 'required|min:5|max:800'
				];
		} else {
			$commenter 	= Sentry::getUser()->username;
			$gender 	= Sentry::getUser()->gender;
			$member		= '1';
			$type 	 	= Input::get('post_type');
				$rules = [
						'comment' => 'required|min:5|max:800'
				];
		}

		$validator = Validator::make($data, $rules);
		
		if($validator->passes()) {
			$comment = new Comment;
			$comment->commenter 	= $commenter;
			$comment->gender 		= $gender;
			$comment->member 		= $member;
			$comment->post_id 		= $post_id;
			$comment->comment 		= trim(Input::get('comment'));
			$comment->type 			= $type;
			$comment->save();

			Session::flash('comment-message', 'Yorumunuz başarıyla gönderilmiştir!');
			return Redirect::back();

		} else {
			return Redirect::back()
			->withErrors($validator);
		}
	}

	public function ShowOrganization($id) {
		try {
			$post = Post::where('id', '=', $id)->firstOrFail();
		} catch (Exception $e) {
			return View::make('errors.404');
		}
		
		return View::make('organizations.show-organization')
		->with('post', $post);
	}

	public function ShowPost($id) {
		try {
			$post = Post::where('id', '=', $id)->firstOrFail();
		} catch (Exception $e) {
			return View::make('errors.404');
		}

		$likes 		= Like::where('post_id', '=', $id )->get();
		$comments 	= Comment::orderBy('created_at', 'DESC')
								->where('post_id', '=', $id)
								->get();
		
		return View::make('posts.show-post')
		->with('post', $post)
		->with('likes', $likes)
		->with('comments', $comments);
	}
}