<?php

class PagesController extends \BaseController {
	
	public function Home() {

		if (isset($_GET['type']) && isset($_GET['orderBy'])) {
			$type = $_GET['type'];

			$orderBy = $_GET['orderBy'];
			$posts = Post::orderBy('created_at', $orderBy)->where('type', '=', $type)->simplePaginate(36);
		} elseif (isset($_GET['orderBy'])) {
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)->simplePaginate(36);
		} elseif (isset($_GET['type'])) {
			$type = $_GET['type'];

			$posts = Post::orderBy('created_at', 'DESC')->where('type', '=', $type)->simplePaginate(36);
		} else {
			$posts = Post::orderBy('created_at', 'DESC')->simplePaginate(36);
		}

		return View::make('pages.index')->with('posts', $posts);
	}

	public function school($school) {
		try {
			$user = Post::whereSchool($school)->firstOrFail();
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return View::make('errors.404');
		}

		if (isset($_GET['type']) && isset($_GET['orderBy'])) {
			$type = $_GET['type'];

			$orderBy = $_GET['orderBy'];
			$posts = Post::orderBy('created_at', $orderBy)
							->where('type', '=', $type)
							->where('school', '=', $school)
							->simplePaginate(36);

		} elseif (isset($_GET['orderBy'])) {
			$orderBy = $_GET['orderBy'];

			$posts = Post::orderBy('created_at', $orderBy)
									->where('school', '=', $school)
									->simplePaginate(36);

		} elseif (isset($_GET['type'])) {
			$type = $_GET['type'];

			$posts = Post::orderBy('created_at', 'DESC')
							->where('type', '=', $type)
							->where('school', '=', $school)
							->simplePaginate(36);
		} else {
			$posts = Post::orderBy('created_at', 'DESC')
									->where('school', '=', $school)
									->simplePaginate(36);
		}

		return View::make('pages.school')->with('posts', $posts);
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
