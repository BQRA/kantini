<?php

class PagesController extends \BaseController {
	
	public function Home() {

		$posts = Post::orderBy('created_at', 'DESC')->get();

		return View::make('pages.index')
		->with('posts', $posts);
	}

	public function ContactUs() {
		return View::make('pages.contact-us');
	}

	public function CreateOrganization() {
		return View::make('pages.create-organization');
	}

	public function Register() {
		return View::make('users.register');
	}

	public function Logout() {
		Sentry::logout();
		Session::flash('message', 'Çıkış yaptınız.');
		return Redirect::route('home');
	}
}
