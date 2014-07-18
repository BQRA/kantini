<?php

class PostController extends \BaseController {

	public function sendPost() {
		$data = Input::all();

		$rules = [
			'username' 	=> 'required|min:3|max:15',
			'gender' 	=> 'required',
			'post'		=> 'required|min:5|max:800'
		];

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$post = new Post;
			$post->username = Input::get('username');
			$post->gender 	= Input::get('gender');
			$post->post 	= Input::get('post');
			$post->member 	= Input::get('member');
			$post->save();

			Session::flash('message', 'İletiniz başarıyla gönderilmiştir!');
			return Redirect::route('home');
		} else {

		return Redirect::route('home')
		->withErrors($validator)
		->withInput();
		}
	}

	public function getPosts($id, $post_id = null) {

		try { $post = Post::where('id', '=', $id)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return Response::view('errors.post', array(), 404);
		}
		$comments = Comment::orderBy('created_at', 'DESC')
								->where('post_id', '=', $id)
								->get();

		return View::make('pages.show-posts')
		->with('post', $post)
		->with('comments', $comments);
	}

	public function sendComment() {
		$data = Input::all();

		$rules = ['comment' => 'required|min:5|max:800'];

		$validator = Validator::make($data, $rules);
		
		if($validator->passes()) {
			$comment = new Comment;
			$comment->user_id = Sentry::getUser()->id;
			$comment->comment_username = Sentry::getUser()->username;
			$comment->post_id = Input::get('post_id');
			$comment->comment = Input::get('comment');
			$comment->save();

			Session::flash('comment-message', 'Yorumunuz başarıyla gönderilmiştir!');
			return Redirect::back();

		} else {
			return Redirect::back()
			->withErrors($validator);
		}
	}	
}