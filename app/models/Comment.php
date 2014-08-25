<?php

class Comment extends \Eloquent {

	protected $table = 'comments';
	protected $fillable = ['post_id', 'commenter', 'user_id', 'comment', 'type'];

	public function post() {
		return $this->belongsTo('Post');
	}

	public function user() {
		return $this->belongsTo('User');
	}
}