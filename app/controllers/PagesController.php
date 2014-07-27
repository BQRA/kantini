<?php

class PagesController extends \BaseController {
	
	public function Home() {

		$posts = Post::orderBy('created_at', 'DESC')->get();

		return View::make('pages.index')
		->with('posts', $posts);
	}

	public function Kantini() {
		return View::make('pages.kantini');
	}

	public function ContactUs() {
		return View::make('pages.contact-us');
	}

	public function Ad() {
		return View::make('pages.ad');
	}

	public function AboutUs() {
		return View::make('pages.about-us');
	}

	public function UDontKnow() {
		return View::make('pages.u-dont-know');
	}

	public function CreateOrganization() {
		return View::make('pages.create-organization');
	}

	public function Register() {
		return View::make('users.register');
	}

	public function Login() {
		return View::make('users.login');
	}

	public function Logout() {
		Sentry::logout();
		Session::flash('message', 'Çıkış yaptınız.');
		return Redirect::route('home');
	}
}
