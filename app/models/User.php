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
	protected $hidden = ['password', 'remember_token'];

	public function profile() {
		return $this->hasOne('Profile');
	}

	public function posts() {
		return $this->hasMany('Post', 'username');
	}

	public function comment() {
		return $this->hasMany('Comment', 'commenter');
	}

	public function like() {
		return $this->hasMany('Like', 'liker');
	}	

	public function isCurrent() {

		if(!Sentry::check()) return false;

		return Sentry::getUser()->id == $this->id;
	}

}
