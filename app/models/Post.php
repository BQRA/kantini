<?php

class Post extends \Eloquent {

	protected $table = 'posts';
	protected $fillable = array('username', 'gender', 'post', 'member', 'type', 'org_name', 'org_date', 'org_place', 'org_auth', 'org_auth_contact', 'org_price', 'org_message');

	public function comment() {
		return $this->hasOne('Comment');
	}
}