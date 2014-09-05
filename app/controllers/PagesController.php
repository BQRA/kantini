<?php

class PagesController extends \BaseController {

	public function home($school = null) {
		
		if (Input::has('type') && Input::has('orderBy')) {
			$type 		= $_GET['type'];
			$orderBy 	= $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)
						->where('type', $type)
						->where('flag', 'NO')
						->Paginate(36);

		} elseif (Input::has('orderBy')) {
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)->Paginate(36);

		} elseif (Input::has('type')) {
			$type = $_GET['type'];

			$posts = Post::orderBy('created_at', 'DESC')
						->where('type', $type)
						->where('flag', 'NO')
						->Paginate(36);
			
		} else {
			$posts = Post::orderBy('created_at', 'DESC')->where('flag', 'NO')->Paginate(36);
		}

		return View::make('pages.index', compact('posts', 'school'));
	}

	public function school($school) {

		try {
			$value = School::whereSchool($school)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return 'Okul bulunamadı';
		}

		if (Input::has('type') && Input::has('orderBy')) {
			$type 		= $_GET['type'];
			$orderBy 	= $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)
						->where('type', $type)
						->where('school', $school)
						->where('flag', 'NO')
						->Paginate(36);

		} elseif (Input::has('orderBy')) {
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)
						->where('school', $school)
						->where('flag', 'NO')
						->Paginate(36);

		} elseif (Input::has('type')) {
			$type = $_GET['type'];

			$posts = Post::orderBy('created_at', 'DESC')
						->where('type', $type)
						->where('school', $school)
						->where('flag', 'NO')
						->Paginate(36);
			
		} else {
			$posts = Post::orderBy('created_at', 'DESC')
						->where('school', $school)
						->where('flag', 'NO')
						->Paginate(36);
		}

		return View::make('pages.index', compact('posts', 'school'));
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