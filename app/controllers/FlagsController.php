<?php

class FlagsController extends \BaseController {

	public function flag($id) {

		if(!Flag::where('post_id', $id)->where('user_id', Auth::user()->id)->count()>0) {
			$flag = new Flag;
			$flag->user_id = Auth::user()->id;
			$flag->post_id = $id;
			$flag->save();

			$flag = Flag::where('post_id', $id)->get();
			
			if ($flag->count() >= 3) {
				$post = Post::find($id);
				$post->flag = 'YES';
				$post->save();
			}

			return Redirect::back();	
		} else {
			return Redirect::back();
		}
		
	}

}