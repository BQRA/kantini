<?php

class PostsController extends \BaseController {

	public function SendPost() {
		$data = Input::all();

		$rules = array(
			'username' 	=> 'required|min:3|max:18|alpha_dash',
			'gender' 	=> 'required',
			'post'		=> 'required|min:5|max:800'
		);

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$post = new Post;
			$post->username = trim(Input::get('username'));
			$post->gender 	= Input::get('gender');
			$post->post 	= trim(Input::get('post'));
			$post->member 	= Input::get('member');
			$post->type 	= '0';
			$post->save();

			Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
			return Redirect::route('home');
		} else {

		return Redirect::route('home')
		->withErrors($validator)
		->withInput();
		}
	}

	public function ShowPost($id) {
		
		$post 		= Post::where('id', '=', $id)->firstOrFail();
		$comments 	= Comment::orderBy('created_at', 'DESC')
								->where('post_id', '=', $id)
								->get();
		
		return View::make('posts.show-post')
		->with('post', $post)
		->with('comments', $comments);
	}

	public function Secret($id) {
		
		$post 		= Post::where('id', '=', $id)->firstOrFail();
		$comments 	= Comment::orderBy('created_at', 'DESC')
								->where('post_id', '=', $id)
								->get();
		
		return View::make('posts.secret')
		->with('post', $post)
		->with('comments', $comments);
	}

	public function SendComment() {
		$data = Input::all();

		$rules = array(
					'commenter' => 'required|min:3|max:18|alpha_dash',
					'gender'	=> 'required', 
					'comment' 	=> 'required|min:5|max:800'
				);

		$validator = Validator::make($data, $rules);
		
		if($validator->passes()) {
			$comment = new Comment;
			$comment->commenter 	= trim(Input::get('commenter'));
			$comment->gender 		= Input::get('gender');
			$comment->member 		= Input::get('member');
			$comment->post_id 		= Input::get('post_id');
			$comment->comment 		= trim(Input::get('comment'));
			$comment->save();

			Session::flash('comment-message', 'Yorumunuz başarıyla gönderilmiştir!');
			return Redirect::back();

		} else {
			return Redirect::back()
			->withErrors($validator);
		}
	}

	public function CreateOrganization() {
		$data = Input::all();

		$rules = array(
			//kurallar geliştirelecek
			'org_name' 			=> 'required',
			'org_date' 			=> 'required',
			'org_place' 		=> 'required',
			'org_auth' 			=> 'required',
			'org_auth_contact' 	=> 'required',
			'org_price' 		=> 'required',
			'org_message' 		=> 'required'
		);

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$post = new Post;
			$post->username 	= Sentry::getUser()->username;
			$post->gender 		= Sentry::getUser()->gender;
			$post->member 		= '1';
			$post->type 		= '1';
			$post->org_name 	= trim(Input::get('org_name'));
			$post->org_date 	= trim(Input::get('org_date'));
			$post->org_place 	= trim(Input::get('org_place'));
			$post->org_auth 	= trim(Input::get('org_auth'));
			$post->org_auth_contact 	= trim(Input::get('org_auth_contact'));
			$post->org_price 	= trim(Input::get('org_price'));
			$post->org_message 	= trim(Input::get('org_message'));
			$post->save();

			Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
			return Redirect::route('home');
		} else {

		return Redirect::route('create.organization')
		->withErrors($validator)
		->withInput();
		}
	}

	public function ShowOrganization($id) {
		
		$post = Post::where('id', '=', $id)->firstOrFail();
		
		return View::make('organizations.show-organization')
		->with('post', $post);
	}
}