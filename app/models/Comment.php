<?php

class Comment extends Eloquent {

	protected $table = 'comments';
	protected $fillable = ['comment_username', 'user_id','comment'];

	public function user() {
		return $this->belongsTo('User');
	}
}