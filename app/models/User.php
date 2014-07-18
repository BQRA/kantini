<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $fillable = ['username', 'email', 'school', 'gender'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public function profile() {
		return $this->hasOne('Profile');
	}

	public function comment() {
		return $this->hasOne('Comment');
	}

	public function isCurrent() {

		if(!Sentry::check()) return false;

		return Sentry::getUser()->id == $this->id;
	}

}
