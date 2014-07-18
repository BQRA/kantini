<?php

class Post extends Eloquent {

	protected $table = 'posts';
	protected $fillable = ['username', 'gender', 'post', 'member'];
}