<?php

class Post extends Eloquent {

	protected $table = 'posts';
	protected $fillable = ['username', 'gender', 'post', 'member'];

	public function comment() {
		return $this->hasOne('Comment');
	}
}