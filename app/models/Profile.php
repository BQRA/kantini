<?php

class Profile extends Eloquent {

	protected $table = 'profiles';
	protected $fillable = ['user_id', 'first_name', 'last_name', 'bio', 'twitter_username', 'instagram_username'];

	public function user() {
		return $this->belongsTo('User');
	}
}