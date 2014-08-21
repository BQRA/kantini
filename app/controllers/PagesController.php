<?php

class PagesController extends \BaseController {

	public function home() {

		if(Auth::check()) {
			$login_user = User::whereUsername(Auth::user()->username)->first();
		}
				
		$posts = Post::orderBy('created_at', 'DESC')->get();
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