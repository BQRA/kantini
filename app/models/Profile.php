<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Profile extends \Eloquent {
	
	use SoftDeletingTrait;
	
	protected $table = 'profiles';
	protected $dates = ['deleted_at'];
	protected $fillable = ['user_id', 'full_name', 'school', 'gender', 'twitter', 'instagram', 'facebook'];

	public function user() {
		return $this->belongsTo('User');
	}

	public function isCurrent() {

		if(!Auth::check()) return false;

		return Auth::user()->id == $this->id;
	}
}