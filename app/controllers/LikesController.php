<?php

class LikesController extends \BaseController {

	public function GuestLike() {
		$like = new Like;
		$like->liker 	  = guest_username();
		$like->post_id 	  = Input::get('post_id');
		$like->ip_address = $_SERVER['REMOTE_ADDR'];
		$like->type 	  = null;
		$like->save();

		return Redirect::back();
	}

	public function Like() {
		$like = new Like;
		$like->liker 	  = Sentry::getUser()->username;
		$like->post_id 	  = Input::get('post_id');
		$like->ip_address = $_SERVER['REMOTE_ADDR'];
		$like->type 	  = Input::get('post_type');
		$like->save();

		return Redirect::back();
	}
}
