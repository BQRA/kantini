<?php

class Organization extends Eloquent {

	protected $table = 'Organizations';
	protected $fillable = ['creator_username', 'name', 'organization_date', 'place', 'auth', 'auth_contact', 'price', 'message'];
}