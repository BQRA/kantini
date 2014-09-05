<?php

class FlagsController extends \BaseController {

	public function flag($id) {

		if(Auth::check()) {
			$user_id  = Auth::user()->id;
			$username = Auth::user()->username;
		} else {
			$user_id  = null;
			$username = guest_username();
		}

		$flag = new Flag;
		$flag->user_id = $user_id;
		$flag->username = $username;
		$flag->post_id = $id;
		$flag->ip_address = $_SERVER['REMOTE_ADDR'];
		$flag->save();

		$flag = Flag::where('post_id', $id)->get();
		
		if ($flag->count() >= 3) {
			$post = Post::find($id);
			$post->flag = 'YES';
			$post->save();
		}

		return Redirect::back();
	}

}