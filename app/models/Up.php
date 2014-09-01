<?php

class Up extends \Eloquent {

	protected $table = 'ups';
	protected $fillable = ['rater', 'post_id', 'type'];
}