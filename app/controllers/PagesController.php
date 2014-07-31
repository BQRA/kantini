<?php

class PagesController extends \BaseController {
	
	public function Home() {

		$order 	= Input::get('order');
		
		if($order) {
			$posts = Post::orderBy('created_at', $order)->get();
		} else {
			$posts = Post::orderBy('created_at', 'DESC')->get();
		}

		return View::make('pages.index', compact('posts', 'order'));
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
