<?php

class RatesController extends \BaseController {

	public function rate() {

		$post_id = Input::get('post_id');

		if(Auth::check()) {
			$rater 	= Auth::user()->username;
			$type 	= Input::get('post_type');
		} else {
			$rater 	= guest_username();
			$type 	= null;
		}

		if(Input::get('rate') == 'up') {
			if (!Up::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0) {
			
			if(Down::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0) {
				$down_delete = Down::wherePost_id($post_id)->firstOrFail();
				$down_delete->delete($down_delete);
			}

			$up = new Up;
			$up->rater 		= $rater;
			$up->post_id 	= $post_id;
			$up->type 		= $type;
			$up->ip_address = $_SERVER['REMOTE_ADDR'];
			$up->save();

			return Redirect::back();

			} else {
				$up_delete = Up::wherePost_id($post_id)->firstOrFail();
				$up_delete->delete($up_delete);

				return Redirect::back();
			}
		}  

		if(Input::get('rate') == 'down') {
			if (!Down::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0) {

			if(Up::where('post_id', $post_id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0) {
				$up_delete = Up::wherePost_id($post_id)->firstOrFail();
				$up_delete->delete($up_delete);
			}
			
			$down = new Down;
			$down->rater 		= $rater;
			$down->post_id 		= $post_id;
			$down->type 		= $type;
			$down->ip_address 	= $_SERVER['REMOTE_ADDR'];
			$down->save();

			return Redirect::back();

			} else {
				$down_delete = Down::wherePost_id($post_id)->firstOrFail();
				$down_delete->delete($down_delete);

				return Redirect::back();
			}
		}
	}
}