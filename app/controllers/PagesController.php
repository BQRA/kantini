<?php

class PagesController extends \BaseController {

	public function home($school = null) {

		if(Auth::check()) {
			$login_user = User::whereUsername(Auth::user()->username)->first();
		}

		if (Input::has('type') && Input::has('orderBy')) {
			$type 		= $_GET['type'];
			$orderBy 	= $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)
						->where('type', $type)
						->Paginate(36);

		} elseif (Input::has('orderBy')) {
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)->Paginate(36);

		} elseif (Input::has('type')) {
			$type = $_GET['type'];

			$posts = Post::orderBy('created_at', 'DESC')
						->where('type', $type)
						->Paginate(36);
			
		} else {
			$posts = Post::orderBy('created_at', 'DESC')->Paginate(36);
		}

		return View::make('pages.index', compact('posts', 'login_user', 'school'));
	}

	public function school($school) {

		try {
			$value = Post::whereSchool($school)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return 'Okul bulunamadı';
		}

		if(Auth::check()) {
			$login_user = User::whereUsername(Auth::user()->username)->first();
		}

		if (Input::has('type') && Input::has('orderBy')) {
			$type 		= $_GET['type'];
			$orderBy 	= $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)
						->where('type', $type)
						->where('school', $school)
						->Paginate(36);

		} elseif (Input::has('orderBy')) {
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)
						->where('school', $school)
						->Paginate(36);

		} elseif (Input::has('type')) {
			$type = $_GET['type'];

			$posts = Post::orderBy('created_at', 'DESC')
						->where('type', $type)
						->where('school', $school)
						->Paginate(36);
			
		} else {
			$posts = Post::orderBy('created_at', 'DESC')
						->where('school', $school)
						->Paginate(36);
		}

		return View::make('pages.index', compact('posts', 'login_user', 'school'));
	}

	public function register() {
		return View::make('users.register');
	}

	public function createEvent() {
		return View::make('pages.create-event');
	}

	public function addMedia() {
		return View::make('pages.add-media');
	}
}