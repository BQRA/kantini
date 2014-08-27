<?php

class Post extends \Eloquent {
	protected $table = 'posts';
	protected $fillable = [
				'username', 
				'gender', 
				'dedikod', 
				'type', 
				'event_name',
				'event_date',
				'event_address',
				'event_map',
				'event_auth',
				'event_auth_contact',
				'event_price',
				'event_photo',
				'links'
			];

	public function user() {
		return $this->belongsTo('User');
	}

	public function comments() {
		return $this->hasMany('Comment');
	}

	public function scopeSearch($query, $search) {
		return $query->where('dedikod', 'LIKE', '%'.$search.'%');
	}
}