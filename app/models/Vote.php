<?php

class Vote extends \Eloquent {

	protected $table = 'votes';
	protected $fillable = ['rater', 'post_id', 'ip_address', 'type', 'value'];
}