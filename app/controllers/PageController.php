<?php

class PageController extends \BaseController {

	public function index($username = null) {

		if(Sentry::check()) {
			$username = Sentry::getUser()->username;
		}
		
		$posts 				= Post::orderBy('created_at', 'DESC')->get();
		$posts_all 			= Post::where('username', '=', $username)->get();
		$comments_all 		= Comment::where('comment_username', '=', $username)->get();
		$organizations_all 	= Organization::where('creator_username', '=', $username)->get();
		
		return View::make('pages.index')
							->with('posts', $posts)
							->with('posts_all', $posts_all)
							->with('comments_all', $comments_all)
							->with('organizations_all', $organizations_all);
	}

	public function aboutUs() {
		return View::make('pages.about-us');
	}

	public function kantini() {
		return View::make('pages.kantini');
	}

	public function agreement() {
		return View::make('pages.agreement');
	}

	public function contactUs() {
		return View::make('pages.contact-us');
	}

	public function getOrganization() {
		$organizations = Organization::orderBy('created_at', 'DESC')
		->get();

		return View::make('pages.organizations')
		->with('organizations', $organizations);
	}

	public function showOrganization($id) {
		$organizations = Organization::orderBy('created_at', 'DESC')
		->where('id', '=', $id)
		->get();
		
		return View::make('pages.show-organization')
		->with('organizations', $organizations);
	}

	public function getCreateOrganization($username) {
		$user = User::whereUsername($username)
		->firstOrFail();
		
		return View::make('pages.user.create-organization')
		->withUser($user);
	}

	public function male() {
		$posts = Post::orderBy('created_at', 'DESC')
								->where('gender', '=', 'male')
								->get();

		return View::make('pages.gender-pages.male')
		->with('posts', $posts);
	}

	public function female() {
		$posts = Post::orderBy('created_at', 'DESC')
								->where('gender', '=', 'female')
								->get();
								
		return View::make('pages.gender-pages.female')
		->with('posts', $posts);
	}
}
