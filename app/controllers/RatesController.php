<?php

class RatesController extends \BaseController {

	public function rate($id) {

		$post = Post::find($id);

		if(Input::get('rate') == 'up') {
			if(Auth::check()) {
				if (!Vote::where('post_id', $id)->where('rater', Auth::user()->username)->where('value', 'up')->count()>0) {
					
					if(Vote::where('post_id', $id)->where('rater', Auth::user()->username)->where('value', 'down')->count()>0) {
						Vote::wherePost_id($id)->where('rater', Auth::user()->username)->where('value', 'down')->delete();

						$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
						$down = Vote::where('post_id', $id)->where('value', 'down')->get();

						$up_count = $up->count();
						$down_count = $down->count();
						
						$vote_count = $up_count - $down_count;

						$post = Post::find($id);
						$post->votes_count = $vote_count;
						$post->save();
					}

					$vote = new Vote;
					$vote->rater = Auth::user()->username;
					$vote->post_id = $id;
					$vote->value = 'up';
					$vote->save();

					$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
					$down = Vote::where('post_id', $id)->where('value', 'down')->get();

					$up_count = $up->count();
					$down_count = $down->count();
					
					$vote_count = $up_count - $down_count;

					$post = Post::find($id);
					$post->votes_count = $vote_count;
					$post->save();

				} else {
					Vote::wherePost_id($id)->where('rater', Auth::user()->username)->where('value', 'up')->delete();

					$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
					$down = Vote::where('post_id', $id)->where('value', 'down')->get();

					$up_count = $up->count();
					$down_count = $down->count();
					
					$vote_count = $up_count - $down_count;

					$post = Post::find($id);
					$post->votes_count = $vote_count;
					$post->save();
				}
			} else {
				if (!Vote::where('post_id', $id)->where('rater', guest_username())->where('value', 'up')->count()>0) {
					
					if(Vote::where('post_id', $id)->where('rater', guest_username())->where('value', 'down')->count()>0) {
						Vote::wherePost_id($id)->where('rater', guest_username())->where('value', 'down')->delete();

						$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
						$down = Vote::where('post_id', $id)->where('value', 'down')->get();

						$up_count = $up->count();
						$down_count = $down->count();
						
						$vote_count = $up_count - $down_count;

						$post = Post::find($id);
						$post->votes_count = $vote_count;
						$post->save();
					}

					$vote = new Vote;
					$vote->rater = guest_username();
					$vote->post_id = $id;
					$vote->value = 'up';
					$vote->save();

					$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
					$down = Vote::where('post_id', $id)->where('value', 'down')->get();

					$up_count = $up->count();
					$down_count = $down->count();
					
					$vote_count = $up_count - $down_count;

					$post = Post::find($id);
					$post->votes_count = $vote_count;
					$post->save();

				} else {
					Vote::wherePost_id($id)->where('rater', guest_username())->where('value', 'up')->delete();

					$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
					$down = Vote::where('post_id', $id)->where('value', 'down')->get();

					$up_count = $up->count();
					$down_count = $down->count();
					
					$vote_count = $up_count - $down_count;

					$post = Post::find($id);
					$post->votes_count = $vote_count;
					$post->save();
				}
			}
		}

		if(Input::get('rate') == 'down') {
			if(Auth::check()) {
				if (!Vote::where('post_id', $id)->where('rater', Auth::user()->username)->where('value', 'down')->count()>0) {
					
					if(Vote::where('post_id', $id)->where('rater', Auth::user()->username)->where('value', 'up')->count()>0) {
						Vote::wherePost_id($id)->where('rater', Auth::user()->username)->where('value', 'up')->delete();

						$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
						$down = Vote::where('post_id', $id)->where('value', 'down')->get();

						$up_count = $up->count();
						$down_count = $down->count();
						
						$vote_count = $up_count - $down_count;

						$post = Post::find($id);
						$post->votes_count = $vote_count;
						$post->save();
					}

					$vote = new Vote;
					$vote->rater = Auth::user()->username;
					$vote->post_id = $id;
					$vote->value = 'down';
					$vote->save();

					$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
					$down = Vote::where('post_id', $id)->where('value', 'down')->get();

					$up_count = $up->count();
					$down_count = $down->count();
					
					$vote_count = $up_count - $down_count;

					$post = Post::find($id);
					$post->votes_count = $vote_count;
					$post->save();

				} else {
					Vote::wherePost_id($id)->where('rater', Auth::user()->username)->where('value', 'down')->delete();

					$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
					$down = Vote::where('post_id', $id)->where('value', 'down')->get();

					$up_count = $up->count();
					$down_count = $down->count();
					
					$vote_count = $up_count - $down_count;

					$post = Post::find($id);
					$post->votes_count = $vote_count;
					$post->save();
				}
			} else {
				if (!Vote::where('post_id', $id)->where('rater', guest_username())->where('value', 'down')->count()>0) {
					
					if(Vote::where('post_id', $id)->where('rater', guest_username())->where('value', 'up')->count()>0) {
						Vote::wherePost_id($id)->where('rater', guest_username())->where('value', 'up')->delete();

						$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
						$down = Vote::where('post_id', $id)->where('value', 'down')->get();

						$up_count = $up->count();
						$down_count = $down->count();
						
						$vote_count = $up_count - $down_count;

						$post = Post::find($id);
						$post->votes_count = $vote_count;
						$post->save();
					}

					$vote = new Vote;
					$vote->rater = guest_username();
					$vote->post_id = $id;
					$vote->value = 'down';
					$vote->save();

					$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
					$down = Vote::where('post_id', $id)->where('value', 'down')->get();

					$up_count = $up->count();
					$down_count = $down->count();
					
					$vote_count = $up_count - $down_count;

					$post = Post::find($id);
					$post->votes_count = $vote_count;
					$post->save();

				} else {
					Vote::wherePost_id($id)->where('rater', guest_username())->where('value', 'down')->delete();

					$up   = Vote::where('post_id', $id)->where('value', 'up')->get();
					$down = Vote::where('post_id', $id)->where('value', 'down')->get();

					$up_count = $up->count();
					$down_count = $down->count();
					
					$vote_count = $up_count - $down_count;

					$post = Post::find($id);
					$post->votes_count = $vote_count;
					$post->save();
				}
			}
		}
	}
}