<?php
class SearchController extends \BaseController {

	public function Search() {
		$query = Input::get('q');

		$validator = Validator::make(['q' => $query], ['q' => 'min:2']);

		if($validator->passes()) {
			$posts = $query
			? Post::search($query)->paginate(3)
			: Post::orderBy('created_at', 'DESC')->paginate(3);

			return View::make('pages.search', compact('posts'));	
		} else {
			return Redirect::back()
				->withErrors($validator);
		}
	}
}
