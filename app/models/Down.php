<?php

class Down extends \Eloquent {
	
	protected $table = 'downs';
	protected $fillable = ['rater', 'post_id', 'type'];
}