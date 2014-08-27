<?php
class SearchController extends \BaseController {

	public function Search() {
		$query = Input::get('q');

		$validator = Validator::make(['q' => $query], ['q' => 'min:2']);

		if($validator->passes()) {

			if($posts = $query) {
				if (isset($_GET['type']) && isset($_GET['orderBy'])) {
					$type 		= $_GET['type'];
					$orderBy 	= $_GET['orderBy'];

					$count = Post::search($query)->orderBy('created_at', $orderBy)->where('type', $type)->get();
					$posts = Post::search($query)->orderBy('created_at', $orderBy)->where('type', $type)->Paginate(3);

				} elseif (isset($_GET['orderBy'])) {
					$orderBy = $_GET['orderBy'];

					$count = Post::search($query)->orderBy('created_at', $orderBy)->get();
					$posts = Post::search($query)->orderBy('created_at', $orderBy)->Paginate(3);

				} elseif (isset($_GET['type'])) {
					$type = $_GET['type'];

					$count = Post::search($query)->orderBy('created_at', 'DESC')->where('type', $type)->get();
					$posts = Post::search($query)->orderBy('created_at', 'DESC')->where('type', $type)->Paginate(3);
					
				} else {
					$count = Post::search($query)->orderBy('created_at', 'DESC')->get();
					$posts = Post::search($query)->orderBy('created_at', 'DESC')->Paginate(3);
				}
			} else {
				$count = Post::orderBy('created_at', 'DESC')->get();
				$posts = Post::orderBy('created_at', 'DESC')->Paginate(3);
			}
			return View::make('pages.search', compact('posts', 'count'));

		} else {
			return Redirect::back()
				->withErrors($validator);
		}
	}
}
