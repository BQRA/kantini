<?php

class PagesController extends \BaseController {
	
	public function Home() {

		if (isset($_GET['type']) && isset($_GET['orderBy'])) {
			$type = $_GET['type'];

			$orderBy = $_GET['orderBy'];
			$posts = Post::orderBy('created_at', $orderBy)->where('type', '=', $type)->get();
		} elseif (isset($_GET['orderBy'])) {
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)->get();
		} elseif (isset($_GET['type'])) {
			$type = $_GET['type'];

			$posts = Post::orderBy('created_at', 'DESC')->where('type', '=', $type)->get();
		} else {
			$posts = Post::orderBy('created_at', 'DESC')->get();
		}

		return View::make('pages.index')->with('posts', $posts);
	}

	public function ContactUs() {
		return View::make('pages.contact-us');
	}

	public function CreateOrganization() {
		return View::make('pages.create-organization');
	}

	public function AddMedia() {
		return View::make('pages.add-media');
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
