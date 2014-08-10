<?php

class LikesController extends \BaseController {

	public function GuestLike() {
		$control = Like::whereLiker(guest_username())->where('post_id', '=', Input::get('post_id'))->get();
		if($control->count() > 0) {
			return Redirect::back();
		} else {
			$like = new Like;
			$like->liker 	  = guest_username();
			$like->post_id 	  = Input::get('post_id');
			$like->ip_address = $_SERVER['REMOTE_ADDR'];
			$like->type 	  = null;
			$like->save();

			return Redirect::back();
		}
	}

	public function Like() {
		$control = Like::whereLiker(Sentry::getUser()->username)->where('post_id', '=', Input::get('post_id'))->get();
		if($control->count() > 0) {
			return Redirect::back(); 
		} else {
			$like = new Like;
			$like->liker 	  = Sentry::getUser()->username;
			$like->post_id 	  = Input::get('post_id');
			$like->ip_address = $_SERVER['REMOTE_ADDR'];
			$like->type 	  = Input::get('post_type');
			$like->save();

		return Redirect::back();
		}	
	}

	public function GuestDislike() {
		$dislike = Like::wherePost_id(Input::get('post_id'))->firstOrFail();
		$dislike->delete($dislike);

		return Redirect::back();
	}

	public function Dislike() {
		$dislike = Like::wherePost_id(Input::get('post_id'))->firstOrFail();
		$dislike->delete($dislike);

		return Redirect::back();
	}
}
