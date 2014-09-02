<?php

class Vote extends \Eloquent {

	protected $table = 'votes';
	protected $fillable = ['rater', 'post_id', 'ip_address', 'type', 'value'];

	public function user() {
		return $this->belongsTo('User');
	}

	public function posts() {
		return $this->belongsTo('Post');
	}
}