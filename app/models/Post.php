<?php

class Post extends \Eloquent {

	protected $table = 'posts';
	protected $fillable = ['username', 
							'gender', 
							'post', 
							'member', 
							'type', 
							'org_name', 
							'org_date', 
							'org_address', 
							'org_map', 
							'org_auth', 
							'org_auth_contact', 
							'org_price', 
							'org_message', 
							'org_photo',
							'media',
							'school'];

	public function user() {
		return $this->belongsTo('User');
	}

	public function comment() {
		return $this->hasMany('Comment');
	}

	public function like() {
		return $this->hasMany('Like');
	}

	public function scopeSearch($query, $search) {
		return $query->where('post', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'DESC');
	}
}
