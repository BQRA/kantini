<?php

class Comment extends \Eloquent {

	protected $table = 'comments';
	protected $fillable = ['commenter', 'gender', 'member', 'post_id', 'comment'];

	public function user() {
		return $this->belongsTo('User');
	}

	public function post() {
		return $this->belongsTo('Post');
	}
}