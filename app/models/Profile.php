<?php

class Profile extends \Eloquent {
	protected $table = 'profiles';
	protected $fillable = ['user_id', 'full_name', 'school', 'gender', 'twitter', 'instagram', 'facebook'];

	public function user() {
		return $this->belongsTo('User');
	}

	public function isCurrent() {

		if(!Auth::check()) return false;

		return Auth::user()->id == $this->id;
	}
}