<?php
class SearchController extends \BaseController {

	public function Search() {
		$query = Input::get('q');

		$validator = Validator::make(['q' => $query], ['q' => 'min:2']);

		if($validator->passes()) {

			if($posts = $query) {
				if (Input::has('type') && Input::has('orderBy')) {
					$type 		= $_GET['type'];
					$orderBy 	= $_GET['orderBy'];

					$count = Post::search($query)
								->orderBy('created_at', $orderBy)
								->where('type', $type)
								->get();

					$posts = Post::search($query)
								->orderBy('created_at', $orderBy)
								->where('type', $type)
								->Paginate(36);

				} elseif (Input::has('orderBy')) {
					$orderBy = $_GET['orderBy'];

					$count = Post::search($query)
								->orderBy('created_at', $orderBy)
								->get();

					$posts = Post::search($query)
								->orderBy('created_at', $orderBy)
								->Paginate(36);

				} elseif (Input::has('type')) {
					$type = $_GET['type'];

					$count = Post::search($query)
								->orderBy('created_at', 'DESC')
								->where('type', $type)
								->get();

					$posts = Post::search($query)
								->orderBy('created_at', 'DESC')
								->where('type', $type)
								->Paginate(36);
					
				} else {
					$count = Post::search($query)
								->orderBy('created_at', 'DESC')
								->get();

					$posts = Post::search($query)
								->orderBy('created_at', 'DESC')
								->Paginate(36);
				}
			} else {
				$count = Post::orderBy('created_at', 'DESC')->get();
				$posts = Post::orderBy('created_at', 'DESC')->Paginate(36);
			}
			
			return View::make('pages.search', compact('posts', 'count'));

		} else {
			return Redirect::back()
				->withErrors($validator);
		}
	}
}
