<?php

class Like extends \Eloquent {

	protected $table = 'likes';
	protected $fillable = ['liker', 'post_id', 'ip_address'];

	public function post() {
		return $this->belongsTo('Post');
	}
}
