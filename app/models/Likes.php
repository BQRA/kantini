<?php

class Likes extends \Eloquent {

	protected $table = 'likes';
	protected $fillable = array('user_id', 'post_id', 'ip_address');
}