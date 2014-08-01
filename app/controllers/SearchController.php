<?php
class SearchController extends \BaseController {

	public function Search() {
		$query = Input::get('q');

		$posts = $query
		? Post::search($query)->get()
		: Post::orderBy('created_at', 'DESC')->get();

		return View::make('pages.search', compact('posts'));
	}
}
