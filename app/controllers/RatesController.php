<?php

class RatesController extends \BaseController {

	public function rate($id) {

		$post = Post::find($id);
		$type = $post['type'];

		if(Input::get('rate') == 'up') {
			if(Auth::check()) {
				if (!Vote::where('post_id', $id)->where('rater', Auth::user()->username)->where('value', 'up')->count()>0) {
					
					if(Vote::where('post_id', $id)->where('rater', Auth::user()->username)->where('value', 'down')->count()>0) {
						Vote::wherePost_id($id)->where('rater', Auth::user()->username)->where('value', 'down')->delete();
					}

					$vote = new Vote;
					$vote->rater = Auth::user()->username;
					$vote->post_id = $id;
					$vote->type = $type;
					$vote->value = 'up';
					$vote->save();

				} else {
					Vote::wherePost_id($id)->where('rater', Auth::user()->username)->where('value', 'up')->delete();
				}
			} else {
				if (!Vote::where('post_id', $id)->where('rater', guest_username())->where('value', 'up')->count()>0) {
					
					if(Vote::where('post_id', $id)->where('rater', guest_username())->where('value', 'down')->count()>0) {
						Vote::wherePost_id($id)->where('rater', guest_username())->where('value', 'down')->delete();
					}

					$vote = new Vote;
					$vote->rater = guest_username();
					$vote->post_id = $id;
					$vote->type = $type;
					$vote->value = 'up';
					$vote->save();

				} else {
					Vote::wherePost_id($id)->where('rater', guest_username())->where('value', 'up')->delete();
				}
			}
		}

		if(Input::get('rate') == 'down') {
			if(Auth::check()) {
				if (!Vote::where('post_id', $id)->where('rater', Auth::user()->username)->where('value', 'down')->count()>0) {
					
					if(Vote::where('post_id', $id)->where('rater', Auth::user()->username)->where('value', 'up')->count()>0) {
						Vote::wherePost_id($id)->where('rater', Auth::user()->username)->where('value', 'up')->delete();
					}

					$vote = new Vote;
					$vote->rater = Auth::user()->username;
					$vote->post_id = $id;
					$vote->type = $type;
					$vote->value = 'down';
					$vote->save();

				} else {
					Vote::wherePost_id($id)->where('rater', Auth::user()->username)->where('value', 'down')->delete();
				}
			} else {
				if (!Vote::where('post_id', $id)->where('rater', guest_username())->where('value', 'down')->count()>0) {
					
					if(Vote::where('post_id', $id)->where('rater', guest_username())->where('value', 'up')->count()>0) {
						Vote::wherePost_id($id)->where('rater', guest_username())->where('value', 'up')->delete();
					}

					$vote = new Vote;
					$vote->rater = guest_username();
					$vote->post_id = $id;
					$vote->type = $type;
					$vote->value = 'down';
					$vote->save();

				} else {
					Vote::wherePost_id($id)->where('rater', guest_username())->where('value', 'down')->delete();
				}
			}
		}
	}
}