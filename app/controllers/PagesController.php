<?php

class PagesController extends \BaseController {

	public function home() {

		if(Auth::check()) {
			$login_user = User::whereUsername(Auth::user()->username)->first();
		}

		if (isset($_GET['type']) && isset($_GET['orderBy'])) {
			$type = $_GET['type'];
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)->where('type', $type)->Paginate(3);

		} elseif (isset($_GET['orderBy'])) {
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)->Paginate(3);

		} elseif (isset($_GET['type'])) {
			$type = $_GET['type'];

			$posts = Post::orderBy('created_at', 'DESC')->where('type', $type)->Paginate(3);
			
		} else {
			$posts = Post::orderBy('created_at', 'DESC')->Paginate(3);
		}

		return View::make('pages.index', compact('posts', 'login_user'));
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