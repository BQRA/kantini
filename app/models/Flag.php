<?php

class Flag extends \Eloquent {

	protected $table = 'flags';
	protected $fillable = ['user_id', 'post_id'];
	
}