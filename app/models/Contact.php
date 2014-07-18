<?php

class Contact extends Eloquent {

	protected $table = 'messages';
	protected $fillable = ['fullname', 'email', 'subject', 'message'];
}