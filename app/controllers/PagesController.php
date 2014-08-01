<?php

class PagesController extends \BaseController {
	
	public function Home() {

		if(empty($_GET['sort'])) {
			if(empty($_GET['orderBy'])) {
				$posts = Post::orderBy('created_at', 'DESC')->get();
			} else {
				if($_GET['orderBy']) {
					$posts = Post::orderBy('created_at', $_GET['orderBy'])->get();
				} else {
					$posts = Post::orderBy('created_at', $_GET['orderBy'])->get();
				}
			}
		} else {
			if($_GET['sort'] == 'dedikods') {
				$posts = Post::orderBy('created_at', 'DESC')->where('type', '=', '0')->get();

			} elseif($_GET['sort'] == 'organizations') {
				$posts = Post::orderBy('created_at', 'DESC')->where('type', '=', '1')->get();

			} elseif($_GET['sort'] == 'photos') {
				$posts = Post::orderBy('created_at', 'DESC')->where('type', '=', '2')->get();

			} elseif($_GET['sort'] == 'videos') {
				$posts = Post::orderBy('created_at', 'DESC')->where('type', '=', '3')->get();
			} else {
				$posts = Post::orderBy('created_at', 'DESC')->get();
			}
		}

		return View::make('pages.index', compact('posts', 'orderBy'));
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
