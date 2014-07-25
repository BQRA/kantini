<?php

class Like extends \Eloquent {

	protected $table = 'likes';
	protected $fillable = array('user_id', 'liker', 'post_id', 'ip_address');
}