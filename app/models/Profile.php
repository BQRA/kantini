<?php

class Profile extends \Eloquent {

	protected $table = 'profiles';
	protected $fillable = array('full_name', 'twitter_username', 'instagram_username', 'facebook_username', 'avatar');

	public function user() {
		return $this->belongsTo('User');
	}
}