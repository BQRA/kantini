<?php

class Like extends \Eloquent {

	protected $table = 'likes';
	protected $fillable = ['liker', 'post_id', 'ip_address'];

	public function user() {
		return $this->belongsTo('User');
	}

	public function post() {
		return $this->belongsTo('Post');
	}
}
