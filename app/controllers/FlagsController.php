<?php

class FlagsController extends \BaseController {

	public function flag($id) {

		if(Auth::check()) {
			$user_id = Auth::user()->id;
			$username = Auth::user()->username;
		} else {
			$user_id = null;
			$username = null;
		}

		$flag = new Flag;
		$flag->user_id = $user_id;
		$flag->username = $username;
		$flag->post_id = $id;
		$flag->save();

		return Redirect::back();
	}

}