<?php

class Comment extends \Eloquent {

	protected $table = 'comments';
	protected $fillable = array('commenter', 'gender', 'member', 'post_id', 'comment');

	public function post() {
		return $this->belongsTo('Post');
	}
}