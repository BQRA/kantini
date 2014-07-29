<?php

class Post extends \Eloquent {

	protected $table = 'posts';
	protected $fillable = array('username', 'gender', 'post', 'member', 'type', 'org_name', 'org_date', 'org_address', 'org_map', 'org_auth', 'org_auth_contact', 'org_price', 'org_message', 'org_photo');

	public function comment() {
		return $this->hasOne('Comment');
	}

	public function like() {
		return $this->hasOne('Like');
	}
}
