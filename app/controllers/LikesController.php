<?php

class LikesController extends \BaseController {

	public function GuestLike() {
		$like = new Like;
		$like->ip_address = $_SERVER['REMOTE_ADDR'];
		$like->post_id 	  = Input::get('post_id');
		$like->save();

		return Redirect::back();
	}

	public function Like() {
		$like = new Like;
		$like->liker 	  = Input::get('liker');
		$like->post_id 	  = Input::get('post_id');
		$like->ip_address = $_SERVER['REMOTE_ADDR'];
		$like->save();

		return Redirect::back();
	}
}