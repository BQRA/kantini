<?php

class Flag extends \Eloquent {

	protected $table = 'flags';
	protected $fillable = ['user_id', 'username', 'post_id', 'ip_address'];
	
}