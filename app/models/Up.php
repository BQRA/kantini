<?php

class Up extends \Eloquent {

	protected $table = 'ups';
	protected $dates = ['deleted_at'];
	protected $fillable = ['rater', 'post_id', 'type'];
}