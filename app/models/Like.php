<?php

class Like extends \Eloquent {

	protected $table = 'likes';
	protected $fillable = array('liker', 'post_id', 'ip_address');

	public function post() {
		return $this->belongsTo('Post');
	}
}
