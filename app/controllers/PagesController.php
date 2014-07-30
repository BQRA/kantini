<?php

class PagesController extends \BaseController {
	
	public function Home() {

		$sortby = Input::get('sortby');
		$order 	= Input::get('order');

		if($sortby && $order) {
			$posts = Post::orderBy($sortby, $order)->get();
		} else {
			$posts = Post::orderBy('created_at', 'DESC')->get();
		}

		return View::make('pages.index', compact('posts', 'sortby', 'order'));
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
